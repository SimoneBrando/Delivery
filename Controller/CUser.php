<?php

use Controller\BaseController;
use Doctrine\ORM\Exception\ORMException;
use Entity\EUtente;
use View\VUser;
use Services\Utility\USession;
use Utility\UHTTPMethods;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../View/VUser.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';
require_once __DIR__ . '/../Entity/ECliente.php';
require_once __DIR__ . '/../Entity/EUtente.php';
require_once __DIR__ . '/../services/utility/UHTTPMethods.php';
require_once __DIR__ . '/../services/utility/USession.php';
require_once __DIR__ . '/../services/utility/UCookie.php';

class CUser extends BaseController{

    public function showRegisterForm(){
        if($this->isLoggedIn()){
            header('Location: /Delivery/User/home');
        }
        $view = new VUser();
        $view->showRegisterForm();
    }

    public function registerUser(string $role = 'Cliente', array $extraData = []){
        $password = UHTTPMethods::post('password');
        $email = UHTTPMethods::post('email');
        $name = UHTTPMethods::post('nome');
        $surname = UHTTPMethods::post('cognome');
        if (strlen($password) < 8) {
            die("Please enter a stronger password");
        }
        try {
            $userId = $this->auth_manager->register(
                email: $email,
                password:  $password,
                username: $email,
                callback: null
            );
            $className = "Entity\\E" . ucfirst(strtolower($role));
            if (class_exists($className)) {
                $profile = new $className();
            } else {
                throw new Exception("Classe $className non trovata");
            }
            $profile
                ->setNome($name)
                ->setCognome($surname)
                ->setUserId($userId)
                ->setEmail($email)
                ->setPassword($password);
            foreach ($extraData as $method => $value) {
                if (method_exists($profile, $method)) {
                    $profile->$method($value);
                }
            }
            $this->persistent_manager->saveObj($profile);
            header('Location: /Delivery/User/home');
        } catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('User already exists');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } catch (ORMException $e) {
            //Tentativo di rollback manuale
            if(isset($userId)){
                try {
                    $this->auth_manager->admin()->deleteUserById($userId);
                }
                catch (\Delight\Auth\UnknownIdException $e) {
                    die('Unknown ID');
                }
            }
            die('ORM error');
        } catch (\Delight\Auth\UnknownIdException $e) {
            die('Unknown id');
        }
    }

    public function loginUser(): void {
        $email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
        $password = UHTTPMethods::post('password');
        //Da implementare nella form di login
        $rememberMe = UHTTPMethods::post('rememberMe');
        $currentUser = USession::isSetSessionElement("user");
        if ($currentUser) {
            $user = USession::getSessionElement("user");
            header('Location: /Delivery/User/home');
            exit;
        }
        try {
            if ($rememberMe == 1) {
                //30 days
                $duration = 60*60*24*30;
            } else {
                //1 day
                $duration = 60*60*24;
            }
            $this->auth_manager->login($email, $password, $duration);
            $profile = $this->getUser();
            USession::setSessionElement("user", $profile->getId());
            header('Location: /Delivery/User/home');
            exit;
        } catch (\Delight\Auth\InvalidEmailException $e) {
            $this->showLoginForm();
            die('Wrong email address');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            $this->showLoginForm();
            die('Wrong password');
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } catch (\Delight\Auth\AttemptCancelledException|\Delight\Auth\AuthError $e) {
            $this->handleFatalError();
        }
    }

    public function logoutUser(){
        USession::destroySession();
        $this->auth_manager->logout();
        USession::unsetSessionElement('user');
        header('Location: /Delivery/User/home');
    }

    //Quando l'utente non ricorda la password
    //Step 1 of 3: Initiating the request
    public function forgotPassword() {
        if($this->isLogged()){
            header('Location: /Delivery/User/home');
            exit;
        }
        $email = UHTTPMethods::post('email');
        try {
            $this->auth_manager->forgotPassword($email, function ($selector, $token) use ($email) {
                // Costruisci il link di reset password
                $url = 'https://www.delivery.com/reset_password?selector=' . urlencode($selector) . '&token=' . urlencode($token);
                //Da definire le variabili d'ambiente
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = $_ENV['SMTP_HOST'];
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['SMTP_USERNAME'];
                $mail->Password = $_ENV['SMTP_PASSWORD'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = $_ENV['SMTP_PORT'];
                $mail->setFrom('no-reply@delivery.com', 'Delivery Service');
                $mail->addAddress($email);
                $mail->Subject = 'Reset your password';
                $mail->Body = "Hi,\n\nWe received a request to reset your password.\n\nPlease click the following link to reset it:\n\n$url\n\nIf you did not request this, you can ignore this email.";    
                $mail->send();
                
            });
        } catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        } catch (\Delight\Auth\ResetDisabledException $e) {
            die('Password reset is disabled');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } catch(Exception $e) {
            die($e->errorMessage());
        }
    }
    
    //Step 2 of 3: Verifying an attempt
    public function showResetPasswordForm() {
        if ($this->auth_manager->canResetPassword($_GET['selector'], $_GET['token'])) {
            echo '<form method="post" action="/Delivery/User/resetPassword">';
            echo '<input type="hidden" name="selector" value="' . htmlspecialchars($_GET['selector']) . '">';
            echo '<input type="hidden" name="token" value="' . htmlspecialchars($_GET['token']) . '">';
            echo '<label>New Password:</label>';
            echo '<input type="password" name="password">';
            echo '<button type="submit">Reset Password</button>';
            echo '</form>';
        }
    }

    //Step 3 of 3: Updating the password
    public function resetPassword() {
        $selector = UHTTPMethods::post('selector');
        $token = UHTTPMethods::post('token');
        $newPassword = UHTTPMethods::post('password');
        try {
            $this->auth_manager->resetPasswordAndSignIn($selector, $token, $newPassword);
            echo 'Password has been reset';
            $userId= $this->auth_manager->getUserId(); //recupero userId dell'utente che si è appena loggato cambiando password
            $client = $this->persistent_manager->getObjOnAttribute("Cliente","user_id", $userId); //recupero l'oggetto Cliente relativo a quell'userId
            $oldPassword = $client->getPassword(); //recupero la vecchia password del Cliente (al fine di eseguire un rollback manuale se necessario)
            $client->setPassword($newPassword); //cambio della password nell'oggetto Cliente
            $this->persistent_manager->updateObj($client); //salvataggio sul database
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            die('Invalid token');
        } catch (\Delight\Auth\TokenExpiredException $e) {
            die('Token expired');
        } catch (\Delight\Auth\ResetDisabledException $e) {
            die('Password reset is disabled');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } catch (ORMException $e) {
            //Tentativo di rollback manuale
            if(isset($userId)){
                try {
                    $this->auth_manager->changePassword($newPassword,$oldPassword); //ripristino la vecchia password in caso di errore
                } catch (\Delight\Auth\InvalidPasswordException $e) {
                    die('Invalid password(s)');
                } catch (\Delight\Auth\TooManyRequestsException $e) {
                    die('Too many requests');
                }
            }
            die('ORM error');
        }
    }

    //Quando l'utente è già loggato
    public function changePassword() {
        if (!($this->isLogged())){
            header("/Delivery/User/home");
            exit;
        }
        try {
            $oldPassword = UHTTPMethods::post('oldPassword');
            $newPassword = UHTTPMethods::post('newPassword');
            $this->auth_manager->changePassword($oldPassword,$newPassword);
            $userId= $this->auth_manager->getUserId(); //recupero userId dell'utente loggato
            $client = $this->persistent_manager->getObjOnAttribute(EUtente::class,"user_id", $userId); //recupero l'oggetto Cliente relativo a quell'userId
            $client->setPassword($newPassword); //cambio della password nell'oggetto Cliente
            $this->persistent_manager->updateObj($client); //salvataggio sul database
            header("Location: /Delivery/User/home");
        } catch (\Delight\Auth\NotLoggedInException $e) {
            die('Not logged in');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password(s)');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } catch (ORMException $e) {
            //Tentativo di rollback manuale
            if(isset($userId)){
                try {
                    $this->auth_manager->changePassword($$newPassword,$oldPassword); //ripristino la vecchia password in caso di errore
                } catch (\Delight\Auth\InvalidPasswordException $e) {
                    die('Invalid password(s)');
                } catch (\Delight\Auth\TooManyRequestsException $e) {
                    die('Too many requests');
                }
            }
            die('ORM error');
        }
    }

    public function modifyProfile(){
        $this->requireLogin();
        $newName = UHTTPMethods::post('newName');
        $newSurname = UHTTPMethods::post('newSurname');
        try {
            $user = $this->getUser();
            $user->setNome($newName)
                ->setCognome($newSurname);
            $this->persistent_manager->updateObj($user);
            header("Location: /Delivery/User/showChangePassword");
        } catch (ORMException $e) {
            die("ORM Exception");
        }
    }

    public function removeAccount(string $userId = "") {
        try{
            $this->auth_manager->admin()->deleteUserById($userId);
            $user = $this->persistent_manager->getObjOnAttribute(EUtente::class,'user_id',$userId);
            $this->persistent_manager->deleteObj($user);
        } catch (\Delight\Auth\UnknownIdException $e) {
            die('Unknown ID');
        } catch (\Exception $e) {
            die ("Unknown exception $e");
        } catch (\ArgumentCountError $e) {
            die ("Argument passed not valid");
        }
    }
    public function deleteAccount(){
        if (!($this->isLogged())){
            header("Location: /Delivery/User/home");
            exit;
        }
        $userId = USession::getSessionElement('user');
        $this->logoutUser();
        $this->removeAccount($userId);
        header("Location: /Delivery/User/home");
    }

    public function mostraMenu(){
        $view = new VUser();
        $menu = $this->persistent_manager->getMenu();
        $view->showMenu($menu);
    }

    public function home(){
        $view = new VUser();
        $allReviews = $this->persistent_manager->getAllReviews();
        shuffle($allReviews);
        $reviews = array_slice($allReviews, 0, 3);
        $view->showHome($reviews);
    }

    public function order(){
        $this->requireRole('cliente');
        $view = new VUser();
        $menu = $this->persistent_manager->getMenu();
        $view->order($menu);
    }

    public function showMyOrders(){
        $this->requireRole('cliente');
        $view = new VUser();
        $id = $this->getUser()->getId();
        $orders = $this->persistent_manager->getOrdersByClient($id);
        $view->showMyOrders($orders);
    }

    public function showChangePassword() {
        $this->requireLogin();
        $user = $this->getUser();
        $view = new VUser();
        $view->showChangePassword($user);
    }

    public function showProfile(){
        $this->requireLogin();
        $user = $this->getUser();
        $view = new VUser();
        $view->showChangePassword($user);
    }

    public function showLoginForm(){
        if($this->isLoggedIn()){
            header('Location: /Delivery/User/home');
            exit;
        }
        $view = new VUser();
        $view->showLoginForm();
    }

}