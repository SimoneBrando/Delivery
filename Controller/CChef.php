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
        $error = $this->getErrorFromSession();
        $view = new VChef($this->isLoggedIn(), $this->userRole, $error);
        $view->showOrders($ordiniInPreparazione);
    }

    public function showOrdiniInAttesa(){
        $this->requireRole('cuoco');
        $ordiniInAttesa = $this->persistent_manager->getOrdersByState('in_attesa');
        $error = $this->getErrorFromSession();
        $view = new VChef($this->isLoggedIn(), $this->userRole, $error);
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
            header("Location: /Delivery/Chef/showOrders");
            exit;
        } catch (\Exception $e) {
            if ($this->persistent_manager->isTransactionActive()){
                $this->persistent_manager->rollback();
            }
            $this->catchError($e->getMessage(),"Chef/showOrders");            
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
            $this->catchError($e->getMessage(), "Chef/showOrdiniInAttesa");           
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
            $this->catchError($e->getMessage(), "Chef/showOrdiniInAttesa");            
        }
    }

}