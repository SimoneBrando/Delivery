<?php

class CUser{

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
            header('Location: /Delivery/User/login');
            exit;
        }
        return true;
    }

    public static function login(){
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

    public static function logout(){
        USession::getInstance();
        USession::unsetSession();
        USession::destroySession();
        header('Location: /Delivery/User/login');
    }

    public static function registrati()
    {
        $view = new VUser();
        if(FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')) == false && FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username')) == false){
                $utente = new EUtente(UHTTPMethods::post('name'), UHTTPMethods::post('surname'),UHTTPMethods::post('age'), UHTTPMethods::post('email'),UHTTPMethods::post('password'),UHTTPMethods::post('username'));
                $check = FPersistentManager::getInstance()->uploadObj($user);
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
}