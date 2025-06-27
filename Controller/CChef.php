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
        $ordiniInPreparazione = $this->persistent_manager->getOrdersByState('in_preparazione');
        $view = new VChef($this->isLoggedIn(), $this->userRole);
        $view->showOrders($ordiniInPreparazione);
    }

    public function showOrdiniInAttesa(){
        $this->requireRole('cuoco');
        $this->requireRole('cuoco');
        $ordiniInAttesa = $this->persistent_manager->getOrdersByState('in_attesa');
        $view = new VChef($this->isLoggedIn(), $this->userRole);
        $view->showOrdiniInAttesa($ordiniInAttesa);
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

    public function accettaOrdine(){
        $this->requireRole('cuoco');
        $ordineId = UHTTPMethods::post("ordine_id");
        $this->persistent_manager->beginTransaction();
        try{
            $ordine = $this->persistent_manager->locking(EOrdine::class, $ordineId);
            $ordine->setStato("in_preparazione");
            $this->persistent_manager->flush();
            $this->persistent_manager->commit();
            header("Location: /Delivery/Chef/showOrdiniInAttesa");
            exit;
        } catch (\Exception $e) {
            if ($this->persistent_manager->isTransactionActive()){
                $this->persistent_manager->rollback();
            }
            $this->handleError($e);            
        }
    }

    public function rifiutaOrdine(){
        $this->requireRole('cuoco');
        $ordineId = UHTTPMethods::post("ordine_id");
        $this->persistent_manager->beginTransaction();
        try{
            $ordine = $this->persistent_manager->locking(EOrdine::class, $ordineId);
            $ordine->setStato("annullato");
            $this->persistent_manager->flush();
            $this->persistent_manager->commit();
            header("Location: /Delivery/Chef/showOrdiniInAttesa");
            exit;
        } catch (\Exception $e) {
            if ($this->persistent_manager->isTransactionActive()){
                $this->persistent_manager->rollback();
            }
            $this->handleError($e);            
        }
    }

}