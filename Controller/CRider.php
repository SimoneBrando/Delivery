<?php

use Foundation\FPersistentManager;
use View\VRider;

require_once __DIR__ . '/../View/VRider.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';

class CRider{

    public function isLogged(){

        $logged = false;
        
        if(UCookie::isSet('PHPSESSID')){
                if(session_status() == PHP_SESSION_NONE){
                    USession::getInstance();
                }
            }
            if(USession::isSetSessionElement('rider')){
                $logged = true;
            }
            if(!$logged){
                header('Location: /Delivery/User/login');
                exit;
            }
        return true;
    }

    public function mostraOrdini(){
        if(CRider::isLogged()){
            $stato = 'in_consegna';
            $ordini = FPersistentManager::getInstance()->getOrdiniCucina('EOrdine', $stato);

            $view = new VOrdini_cucina();
            $view->mostraOrdini($ordini);
        }
    }

    public function cambiaStatoOrdine(){
        if(CRider::isLogged()){
            $ordineId = UHTTPMethods::post('ordineId');
            $ordine = FPersistentManager::getInstance()->risvegliaObj('EOrdine', $ordineId);

            if($ordine){
                $nuovoStato = UHTTPMethods::post('stato');
                $ordine->setStato($nuovoStato);
                FPersistentManager::getInstance()->updateObj($ordine);
            }
        }
    }

    public static function showOrders(){
        $view = new VRider();
        $orders = FPersistentManager::getInstance()->getOrdersByState('pronto');
        $view->showOrders($orders);
    }

}