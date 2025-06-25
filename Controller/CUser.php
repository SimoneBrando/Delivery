<?php

use Controller\BaseController;
use Doctrine\ORM\Exception\ORMException;
use Entity\ECarta_credito;
use Entity\EIndirizzo;
use Entity\EUtente;
use View\VErrors;
use View\VUser;
use Services\Utility\USession;
use Utility\UHTTPMethods;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../View/VUser.php';
require_once __DIR__ . '/../View/VErrors.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';
require_once __DIR__ . '/../Entity/ECliente.php';
require_once __DIR__ . '/../Entity/EUtente.php';
require_once __DIR__ . '/../Entity/EIndirizzo.php';
require_once __DIR__ . '/../Entity/ECarta_credito.php';
require_once __DIR__ . '/../services/utility/UHTTPMethods.php';
require_once __DIR__ . '/../services/utility/USession.php';
require_once __DIR__ . '/../services/utility/UCookie.php';

class CUser extends BaseController{

    public function showRegisterForm(string $error = ""){
        if($this->isLoggedIn()){
            header('Location: /Delivery/User/home');
        }
        $view = new VUser($this->isLoggedIn());
        $view->showRegisterForm();
    }

    public function showLoginForm(string $error = ""){
        if($this->isLoggedIn()){
            header('Location: /Delivery/User/home');
            exit;
        }
        $view = new VUser($this->isLoggedIn());
        $view->showLoginForm($error);
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
            $this->auth_manager->login($email, $password);
            header('Location: /Delivery/User/home');
        } catch (\Delight\Auth\InvalidEmailException $e) {
            $this->showRegisterForm("Indirizzo email non valido");
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            $this->showRegisterForm("Password non valida");
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            $this->showRegisterForm("Utente già registrato");
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $this->handleFatalError($e);
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
            $this->handleFatalError($e);
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
            $this->showLoginForm("Email o password errati");
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            $this->showLoginForm("Email o password errati");
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            $this->showLoginForm("Email non verificata");
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $this->handleFatalError($e);
        } catch (\Delight\Auth\AttemptCancelledException|\Delight\Auth\AuthError $e) {
            $this->handleFatalError($e);
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
        try {
            $newName = UHTTPMethods::post('newName');
            $newSurname = UHTTPMethods::post('newSurname');
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
        $view = new VUser($this->isLoggedIn());
        $menu = $this->persistent_manager->getMenu();
        $view->showMenu($menu);
    }

    public function home(){
        $view = new VUser($this->isLoggedIn());
        $allReviews = $this->persistent_manager->getAllReviews();
        shuffle($allReviews);
        $reviews = array_slice($allReviews, 0, 3);
        $view->showHome($reviews);
    }

    public function order(){
        $this->requireRole('cliente');
        $view = new VUser($this->isLoggedIn());
        $menu = $this->persistent_manager->getMenu();
        $view->order($menu);
    }

    public function showMyOrders(){
        $this->requireRole('cliente');
        $view = new VUser($this->isLoggedIn());
        $id = $this->getUser()->getId();
        $orders = $this->persistent_manager->getOrdersByClient($id);
        $view->showMyOrders($orders);
    }

    public function showProfile(){
        $this->requireLogin();
        $user = $this->getUser();
        $userAddresses = $this->findUserAdresses();
        $userCreditCards = $this->findActiveUserCards(); 
        $view = new VUser($this->isLoggedIn());
        $view->showChangePassword($user, $userAddresses, $userCreditCards);
    }

    public function findUserAdresses(){
        $this->requireLogin();
        $user = $this->getUser();
        $addresses = $this->persistent_manager->getAllAddresses();
        $userAddresses = array_filter(
            $addresses, function($address) use ($user) {
            return $address->getClienti()->contains($user);
        });
        return $userAddresses;
    }

    public function findActiveUserCards(){
        $this->requireLogin();
        $user = $this->getUser();
        $credtCards = $this->persistent_manager->getAllCreditCards();
        $userCreditCard = array_filter(
            $credtCards,
            fn($carta) => $carta->getCliente()->getId() === $user->getId() && $carta->getCartaAttiva() === true
        );
        return $userCreditCard;
    }

    //Gestione Indirizzi
    public function showAddressForm(){
        $this->requireRole('cliente');
        $view = new VUser($this->isLoggedIn());
        $view->showAddressForm();
    }
    public function addAddress(){
        $this->requireRole('cliente');
        $user = $this->getUser();
        try {
            $via = UHTTPMethods::post('via');
            $civico = UHTTPMethods::post('civico');
            $cap = UHTTPMethods::postInt('cap',5,5);
            $citta = UHTTPMethods::postString('citta');
            $address = new EIndirizzo();
            $address->setVia($via)
                ->setCivico($civico)
                ->setCap($cap)
                ->setCitta($citta)
                ->addCliente($user);
            $this->persistent_manager->saveObj($address);
            header("Location: /Delivery/User/showProfile");
            exit;
        } catch (InvalidArgumentException $e) {
            $view = new VErrors();
            $view->showFatalError($e->getMessage());
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore durante il salvataggio");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore imprevisto".$th->getMessage());
        }
    }

    /* Da aggiustare in seguito
    public function removeAddress(){
        $this->requireRole('cliente');
        try {
            $addressId = UHTTPMethods::post('address_id');
            $address = $this->persistent_manager->getObjOnAttribute(EIndirizzo::class,'id',$addressId);
            $this->persistent_manager->deleteObj($address);
            $this->showProfile();
        } catch (InvalidArgumentException $e) {
            $view = new VErrors();
            $view->showFatalError($e->getMessage());
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore durante il salvataggio");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore imprevisto".$th->getMessage(). $address->getVia());
        }
    }
    */

    //Gestione MetodiPagamento
    public function showCreditCardForm(){
        $this->requireRole('cliente');
        $view = new VUser($this->isLoggedIn());
        $view->showCreditCardForm();
    }
    public function addCreditCard(){
        $this->requireRole('cliente');
        $user = $this->getUser();
        try{
            $numeroCarta = UHTTPMethods::postInt('numero_carta',16,16);
            $nomeCarta = UHTTPMethods::post('nome_carta');
            $dataScadenza = UHTTPMethods::postDate('data_scadenza', 'm/y');
            $dataScadenza->modify('last day of this month 23:59:59');
            $cvv = UHTTPMethods::postInt('cvv',3,4);
            $nomeIntestatario = UHTTPMethods::postString('nome_intestatario');
            $creditCard = new ECarta_credito();
            $creditCard->setNumeroCarta($numeroCarta)
                ->setNominativo($nomeCarta)
                ->setDataScadenza($dataScadenza)
                ->setCvv($cvv)
                ->setNomeIntestatario($nomeIntestatario)
                ->setUtente($user)
                ->setCartaAttiva(true);
            $this->persistent_manager->saveObj($creditCard);
            header("Location: /Delivery/User/showProfile");
            exit;
        } catch (InvalidArgumentException $e) {
            $view = new VErrors();
            $view->showFatalError($e->getMessage());
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore durante il salvataggio");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore imprevisto".$th->getMessage());
        }
    }
    public function removeCreditCard(){
        try{
            $this->requireRole('cliente');
            $numeroCarta = UHTTPMethods::postInt('numero_carta',16,16);
            $creditCard = $this->persistent_manager->getObjOnAttribute(ECarta_credito::class, 'numeroCarta', $numeroCarta);
            if (!$creditCard) {
                throw new InvalidArgumentException("Carta di credito non trovata.");
            }
            $creditCard->setCartaAttiva(false);
            $this->persistent_manager->updateObj($creditCard);
            header("Location: /Delivery/User/showProfile");
            exit;
        } catch (InvalidArgumentException $e) {
            $view = new VErrors();
            $view->showFatalError($e->getMessage());
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore durante il salvataggio");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore imprevisto");
        }
    }

    public function showReviewForm(){
        $this->requireRole('cliente');
        $view = new VUser($this->isLoggedIn());
        $view->showReviewForm();
    }

}