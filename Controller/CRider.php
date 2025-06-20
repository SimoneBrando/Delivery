<?php

use Controller\BaseController;
use Entity\EOrdine;
use Foundation\FPersistentManager;
use View\VRider;
use Utility\UHTTPMethods;

require_once __DIR__ . '/../View/VRider.php';
require_once __DIR__ . '/BaseController.php';

class CRider extends BaseController{

    public function showOrders(){
        $this->requireRole('rider');
        $view = new VRider();
        $orders = $this->persistent_manager->getOrdersByState('in_attesa');
        $view->showOrders($orders);
    }

    public function cambiaStatoOrdine(){
        $this->requireRole('rider');
        $ordineId = UHTTPMethods::post('ordineId');
        $ordine = $this->persistent_manager->getObjOnAttribute(EOrdine::class,'id' ,$ordineId);
        if($ordine){
            $nuovoStato = UHTTPMethods::post('stato');
            $ordine->setStato($nuovoStato);
            $this->persistent_manager->updateObj($ordine);  
        }
    }

    public function showOnDeliveryOrders() {
        $this->requireRole('rider');
        $view = new VRider();
        $orders = $this->persistent_manager->getOrdersByState('in_consegna');
        $view->showOrders($orders);
    }

    public function showDeliveredOrders() {
        $this->requireRole('rider');
        $view = new VRider();
        $orders = $this->persistent_manager->getOrdersByState('consegnato');
        $view->showOrders($orders);
    }
}