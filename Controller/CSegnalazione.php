<?php

use App\Foundation\FPersistentManager;

class COrdine{

    public function mostraOrdini(){
        if(CUser::isLogged()){
            $userId = USession::getInstance()->geSessionId('user');
            $ordini = FPersistentManager::getInstance()->getOrdiniByUserId($userId);

            $view = new VMiei_Ordini();
            $view->mostraOrdini($ordini);
        }
    }

    public function inviaSegnalazione(){
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionId('user');
            $ordineId = USession::getInstance()->getSessionId('ordine');

            $segnalazione = new ESegnalazione(UHTTPMethods::post('segnalazione'), $userId, $ordineId);
            FPersistentManager::getInstance()->salvaObj($segnalazione);
        }
    }
}