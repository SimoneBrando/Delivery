<?php

use Delight\Auth\Auth;
use Doctrine\ORM\Exception\ORMException;
use Entity\ECliente;
use Entity\EUtente;
use Foundation\FPersistentManager;
use View\VUser;
use Services\Utility\USession;
use Services\Utility\UCookie;
use Utility\UHTTPMethods;

require_once __DIR__ . '/../View/VUser.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';
require_once __DIR__ . '/../Entity/ECliente.php';
require_once __DIR__ . '/../Entity/EUtente.php';
require_once __DIR__ . '/../services/utility/UHTTPMethods.php';
require_once __DIR__ . '/../services/utility/USession.php';
require_once __DIR__ . '/../services/utility/UCookie.php';

class CUser{

    public Auth $auth_manager;
    private FPersistentManager $entity_manager;

    public function __construct() {
        $this->entity_manager = FPersistentManager::getInstance();
        $this->auth_manager = getAuth();
    }

    public function showLoginForm(){
        if($this->isLogged()){
            header('Location: /Delivery/User/home');
        }
        $view = new VUser();
        $view->showLoginForm();
    }

    public function showRegisterForm(){
        if($this->isLogged()){
            header('Location: /Delivery/User/home');
        }
        $view = new VUser();
        $view->showRegisterForm();
    }

    public function registerUser(){
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

            $profile = new ECliente();
            $profile
                ->setNome($name)
                ->setCognome($surname)
                ->setUserId($userId)
                ->setEmail($email)
                ->setPassword($password);
            FPersistentManager::getInstance()->saveObj($profile);
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
        $rememberMe = "0";
        $currentUser = USession::isSetSessionElement("user");
        if ($currentUser) {
            $user = USession::getSessionElement("user");
            header('Location: /Delivery/User/home');
            exit;
        }
        try {
            if ($rememberMe) {
                //30 days
                $duration = 60*60*24*30;
            } else {
                //1 day
                $duration = 60*60*24;
            }
            $this->auth_manager->login($email, $password, $duration);
            $userId = $this->auth_manager->getUserId();
            $profile = $this->entity_manager->getObjOnAttribute(EUtente::class, 'user_id', $userId);
            USession::setSessionElement("user", $profile->getId());
            header('Location: /Delivery/User/home');
            exit;
        } catch (\Delight\Auth\InvalidEmailException $e) {
            die('Wrong email address');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Wrong password');
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } catch (\Delight\Auth\AttemptCancelledException|\Delight\Auth\AuthError $e) {
            die('An error occurred');
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
                $subject = 'Reset your password';
                $message = "Hi,\n\nWe received a request to reset your password.\n\nPlease click the following link to reset it:\n\n$url\n\nIf you did not request this, you can ignore this email.";
                $headers = 'From: no-reply@delivery.com' . "\r\n" .
                        'Reply-To: no-reply@delivery.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                mail($email, $subject, $message, $headers);
                // Invia email (solo per esempio — in produzione è meglio usare libreria PHPMailer più robusta)
                /*
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
                $mail->Body = "Click here to reset: $url";    
                $mail->send();
                */
            });
        } catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        } catch (\Delight\Auth\ResetDisabledException $e) {
            die('Password reset is disabled');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } /* catch(Exeption e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }*/
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
        }
    }

    //Quando l'utente è già loggato
    public function changePassword() {
        try {
            $this->auth_manager->changePassword(UHTTPMethods::post('oldPassword'), UHTTPMethods::post('newPassword'));
            echo 'Password has been changed';
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            die('Not logged in');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password(s)');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

    public function isLoggedIn(): bool{
        return $this->auth_manager->isLoggedIn();
    }
    //Capire quale funzione è più corretta
    public static function isLogged(){
        $logged = false;
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
        }
        return $logged;
    }


    public static function showMenu(){
        $view = new VUser();
        $classe = 'EElenco_prodotti';
        $id = 0;
        $menu = 'ciao';
        $view->showMenu($menu);
    }

    public static function mostraMenu(){
        $view = new VUser();
        $menu = FPersistentManager::getInstance()->getMenu();
        $view->showMenu($menu);
    }

    public static function home(){
        $view = new VUser();
        $allReviews = FPersistentManager::getInstance()->getAllReviews();
        shuffle($allReviews);
        $reviews = array_slice($allReviews, 0, 3);
        $view->showHome($reviews);
    }

    public static function order(){
        $view = new VUser();
        $menu = FPersistentManager::getInstance()->getMenu();
        $view->order($menu);
    }

    public static function showMyOrders(){
        $view = new VUser();
        $id = 161;
        $orders = FPersistentManager::getInstance()->getOrdersByClient($id);
        $view->showMyOrders($orders);
    }

}