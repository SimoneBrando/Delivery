<?php

use Controller\BaseController;
use View\VChef;
use Utility\UHTTPMethods;
use Entity\EOrdine;

require_once __DIR__ . '/../View/VChef.php';
require_once __DIR__ . '/BaseController.php';

class CChef extends BaseController{

    public function showOrders(){
        $this->requireRole('cuoco');
        $ordini = $this->persistent_manager->getOrdersByState('in_preparazione');
        $view = new VChef();
        $view->showOrders($ordini);
    }

    public function cambiaStatoOrdine(){
        $this->requireRole('cuoco');
        $ordineId = UHTTPMethods::post('ordineId');
        $ordine = $this->persistent_manager->getObjOnAttribute(EOrdine::class, 'id',$ordineId);
        if($ordine){
            $nuovoStato = UHTTPMethods::post('stato');
            $ordine->setStato($nuovoStato);
            $this->persistent_manager->updateObj($ordine);
        }
        echo "Ordine aggiornato con ID: $ordineId, nuovo stato: $nuovoStato";
    }

}