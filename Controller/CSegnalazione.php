<?php

use Controller\BaseController;
use Entity\EOrdine;
use Foundation\FPersistentManager;
use Services\Utility\USession;
use Utility\UHTTPMethods;
use View\VUser;
use Entity\ESegnalazione;
use Controller\CUser;

class CSegnalazione extends BaseController{

    public function mostraOrdini(){
        if($this->isLoggedIn()){
            $userId = USession::getSessionElement('user');
            $ordini = FPersistentManager::getInstance()->getOrdersByClient($userId);
            $view = new VUser($this->isLoggedIn(), $this->userRole);
            $view->showMyOrders($ordini);
        }
    }

    public function inviaSegnalazione(){
        if($this->isLoggedIn()){
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