<?php
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use View\VChef;
use Services\Utility\UHTTPMethods;
use Entity\EOrdine;

class CChef extends BaseController{

    public function showOrders(){
        $this->requireRole('cuoco');
        $ordini = $this->persistent_manager->getOrdersByState('in_preparazione');
        $view = new VChef($this->isLoggedIn(), $this->userRole);
        $view->showOrders($ordini);
    }

    public function cambiaStatoOrdine(){
        $this->requireRole('cuoco');
        $ordineId = UHTTPMethods::post('ordineId');
        $nuovoStato = UHTTPMethods::postString('stato');
        $this->persistent_manager->beginTransaction();
        try{
            $ordine = $this->persistent_manager->locking(EOrdine::class, $ordineId);
            $ordine->setStato($nuovoStato);
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

}