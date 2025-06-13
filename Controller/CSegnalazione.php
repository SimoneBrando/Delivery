<?php

use Entity\EOrdine;
use Foundation\FPersistentManager;
use Services\Utility\USession;
use Utility\UHTTPMethods;
use View\VUser;
use Entity\ESegnalazione;
use Controller\CUser;

class COrdine{

    public function mostraOrdini(){
        if(CUser::isLogged()){
            $userId = USession::getSessionElement('user');
            $ordini = FPersistentManager::getInstance()->getOrdersByClient($userId);
            $view = new VUser();
            $view->showMyOrders($ordini);
        }
    }

    public function inviaSegnalazione(){
        if(CUser::isLogged()){
            $userId = USession::getSessionElement('user');
            $ordineId = USession::getSessionElement('ordine');
            $testoSegnalazione = UHTTPMethods::post('segnalazione');
            $segnalazione = new ESegnalazione();
            $segnalazione->setCliente($userId)
                ->setTesto($testoSegnalazione)
                ->setOrdine(FPersistentManager::getInstance()->getObjOnAttribute(EOrdine::class,'id',$ordineId));
            FPersistentManager::getInstance()->saveObj($segnalazione);
        }
    }
}