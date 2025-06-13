<?php

use Foundation\FPersistentManager;
use View\VChef;
use Utility\UHTTPMethods;
use Entity\EOrdine;


require_once __DIR__ . '/../View/VChef.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';
require_once __DIR__ . '/CUser.php';


class CChef extends CUser{

    public function showOrders(){
        if(CChef::isLogged()){
            $ordini = FPersistentManager::getInstance()->getOrdersByState('in_preparazione');
            $view = new VChef();
            $view->showOrders($ordini);
        }
    }

    public function cambiaStatoOrdine(){
        if(CChef::isLogged()){
            $ordineId = UHTTPMethods::post('ordineId');
            $ordine = FPersistentManager::getInstance()->getObjOnAttribute(EOrdine::class, 'id',$ordineId);
            if($ordine){
                $nuovoStato = UHTTPMethods::post('stato');
                $ordine->setStato($nuovoStato);
                FPersistentManager::getInstance()->updateObj($ordine);
            }
        }
        echo "Ordine aggiornato con ID: $ordineId, nuovo stato: $nuovoStato";
    }

    public static function showOrdersChef(){
        $view = new VChef();
        $orders = FPersistentManager::getInstance()->getOrdersByState('in_preparazione');
        $view->showOrders($orders);
    }

}