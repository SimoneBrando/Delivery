<?php

class CRecensione{

    public static function inserisciRecensione(){
            if(CUser::isLogged()){
                $userId = USession::getInstance()->getSessionId('user');
                $recensione = new ERecensione($userId, UHTTPMethods::post('recensione'));
                FPersistentManager::getInstance()->saveObj($recensione);
            }
        }
}