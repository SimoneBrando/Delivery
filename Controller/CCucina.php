<?php

use Foundation\FPersistentManager;
use View\VChef;


require_once __DIR__ . '/../View/VChef.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';

class CCucina{

    public function isLogged(){

        $logged = false;
        
        if(UCookie::isSet('PHPSESSID')){
                if(session_status() == PHP_SESSION_NONE){
                    USession::getInstance();
                }
            }
            if(USession::isSetSessionElement('cuoco')){
                $logged = true;
            }
            if(!$logged){
                header('Location: /Delivery/User/login');
                exit;
            }
        return true;
    }

    public function mostraOrdini(){
        if(CCucina::isLogged()){
            $stato = 'in_cucina';
            $ordini = FPersistentManager::getInstance()->getOrdiniCucina('EOrdine', $stato);

            $view = new VOrdini_cucina();
            $view->mostraOrdini($ordini);
        }
    }

    public function cambiaStatoOrdine(){
        if(CCucina::isLogged()){
            $ordineId = UHTTPMethods::post('ordineId');
            $ordine = FPersistentManager::getInstance()->risvegliaObj('EOrdine', $ordineId);

            if($ordine){
                $nuovoStato = UHTTPMethods::post('stato');
                $ordine->setStato($nuovoStato);
                FPersistentManager::getInstance()->updateObj($ordine);
            }
        }
    }

    public static function showOrdersChef(){
        $view = new VChef();
        $orders = FPersistentManager::getInstance()->getOrdersByState('in_preparazione');
        $view->showOrders($orders);
    }

}