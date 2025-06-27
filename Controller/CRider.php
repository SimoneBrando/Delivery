<?php

namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Entity\EOrdine;
use Foundation\FPersistentManager;
use View\VRider;
use Services\Utility\UHTTPMethods;

class CRider extends BaseController{

    public function showOrders(){
        $this->requireRole('rider');
        $view = new VRider($this->isLoggedIn(), $this->userRole);
        $orders = $this->persistent_manager->getOrdersByState('in_attesa');
        $view->showOrders($orders);
    }

    public function cambiaStatoOrdine(){
        $this->requireRole('rider');
        $ordineId = UHTTPMethods::post('ordineId');
        $nuovoStato = UHTTPMethods::postString('stato');
        $this->persistent_manager->beginTransaction();
        try{
            $ordine = $this->persistent_manager->locking(EOrdine::class, $ordineId);
            $ordine->setStato($nuovoStato);
            if($nuovoStato == 'consegnato'){
                $ordine->setDataConsegna(new \DateTime());
            }
            $this->persistent_manager->flush();
            $this->persistent_manager->commit();
            header("Location: /Delivery/Rider/showOrders");
            exit;
        } catch (\Exception $e) {
            if ($this->persistent_manager->isTransactionActive()){
                $this->persistent_manager->rollback();
            }
            $this->handleError($e);            
        }
    }

    public function showOnDeliveryOrders() {
        $this->requireRole('rider');
        $view = new VRider($this->isLoggedIn(), $this->userRole);
        $orders = $this->persistent_manager->getOrdersByState('in_consegna');
        $view->showOrders($orders);
    }

    public function showDeliveredOrders() {
        $this->requireRole('rider');
        $view = new VRider($this->isLoggedIn(), $this->userRole);
        $orders = $this->persistent_manager->getOrdersByState('consegnato');
        $view->showOrders($orders);
    }
}