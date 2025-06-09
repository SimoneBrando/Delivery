<?php

use Delight\Auth\Auth;
use Doctrine\ORM\Exception\ORMException;
use Entity\EUtente;
use Foundation\FPersistentManager;
use View\VUser;
use Foundation\FPersistentManager;

require_once __DIR__ . '/../View/VUser.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';

class CUser{

    public Auth $auth_manager;
    private FPersistentManager $entity_manager;

    public static function showLoginForm(){
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            header('Location: /Delivery/User/home');
        }
        $view = new VUser();
        $view->showLoginForm();
    }

    public static function showRegisterForm(){
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            header('Location: /Delivery/User/home');
        }
        $view = new VUser();
        $view->showRegisterForm();
    }

    public function registerUser(
        string $name,
        string $surname,
        string $email,
        string $password,
    ){
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

            $profile = new EUtente();
            $profile
                ->setNome($name)
                ->setCognome($surname)
                ->setUserId($userId);
            
            $this->entity_manager->saveObj($profile);
        } catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('User already exists');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } catch (ORMException $e) {
            die('ORM error');
        } catch (\Delight\Auth\UnknownIdException $e) {
            die('Unknown id');
        }
        header('Location: /Delivery/User/home');
    }

    public function loginUser(string $email, string $password, string $rememberMe = "0"): void
    {
        $currentUser = USession::isSetSessionElement("user");

        if ($currentUser) {
            $user = USession::getSessionElement("user");
            header('Location: /Delivery/User/home');
        }

        try {
            if ($rememberMe) {
                // Remember the user for 30 days
                $duration = 60*60*24*30;
            } else {
                // Remember the user for 1 day
                $duration = 60*60*24;
            }
            $this->auth_manager->login($email, $password, $duration);
            $userId = $this->auth_manager->getUserId();
            $profile = $this->entity_manager->getObjOnAttribute(EUtente::class, 'userId', $userId);

            USession::setSessionElement("user", $profile->getId());
            header('Location: /Delivery/User/home');
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

    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /Delivery/User/login');
    }

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
        if(!$logged){
            header('Location: /Delivery/User/home/');
            exit;
        }
        return true;
    }

    public static function home(){
        $view = new VUser();
        $view->showHome();
    }

    public static function showMenu(){
        $view = new VUser();
        $classe = 'EElenco_prodotti';
        $id = 0;
        $menu = 'ciao';
        $view->showMenu($menu);
    }
      
/*
    public static function registrati()
    {
        $view = new VUser();
        if(FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')) == false && FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username')) == false){
                $utente = new EUtente();
                    $utente->setNome(UHTTPMethods::post('name'));
                    $utente->setCognome(UHTTPMethods::post('surname'));
                    $utente->setEmail(UHTTPMethods::post('email'));
                    $utente->setPassword(UHTTPMethods::post('password'));
                $check = FPersistentManager::getInstance()->uploadObj($utente);
                if($check){
                    $view->showLoginForm();
                }
        }else{
                $view->registrationError();
            }
    }

    public static function checkLogin(){
        $view = new VUser();
        $username = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));                                            
        if($username){
            $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));
            if(password_verify(UHTTPMethods::post('password'), $user->getPassword())){
                USession::getSessionStatus() == PHP_SESSION_NONE;
                    USession::getInstance();
                    USession::setSessionElement('user', $user->getId());
                    header('Location: /Delivery/User/home');
                }
        }else{
            $view->loginError();
        }
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
        $id = 45;
        $orders = FPersistentManager::getInstance()->getOrdersByClient($id);
        $view->showMyOrders($orders);
    }

    public static function showLoginForm(){
        $view = new VUser();
        $view->showLoginForm();
    }

    public static function showRegisterForm(){
        $view = new VUser();
        $view->showRegisterForm();
    }
    
}