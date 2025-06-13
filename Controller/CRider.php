<?php

use Entity\EOrdine;
use Foundation\FPersistentManager;
use View\VRider;
use Utility\UHTTPMethods;

require_once __DIR__ . '/../View/VRider.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';
require_once __DIR__ . '/CUser.php';


class CRider extends CUser{

    public static function showOrders(){
        $view = new VRider();
        $orders = FPersistentManager::getInstance()->getOrdersByState('in_attesa');
        $view->showOrders($orders);
    }

    public function cambiaStatoOrdine(){
        if(CRider::isLogged()){
            $ordineId = UHTTPMethods::post('ordineId');
            $ordine = FPersistentManager::getInstance()->getObjOnAttribute(EOrdine::class,'id' ,$ordineId);
            if($ordine){
                $nuovoStato = UHTTPMethods::post('stato');
                $ordine->setStato($nuovoStato);
                FPersistentManager::getInstance()->updateObj($ordine);
            }
        }
    }

    public function showOnDeliveryOrders() {
        $view = new VRider();
        $orders = FPersistentManager::getInstance()->getOrdersByState('in_consegna');
        $view->showOrders($orders);
    }

    public function showDeliveredOrders() {
        $view = new VRider();
        $orders = FPersistentManager::getInstance()->getOrdersByState('consegnato');
        $view->showOrders($orders);
    }
}