<?php
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Entity\EOrdine;
use Services\Utility\UFlashMessage;
use Services\Utility\UHTTPMethods;
use Entity\ESegnalazione;

class CSegnalazione extends BaseController{

    public function writeReport(){
        $this->requireRole('cliente');
        try {
            $user = $this->getUser();
            $ordineId = UHTTPMethods::post('ordine_id');
            $ordine = $this->persistent_manager->getObjOnAttribute(EOrdine::class, 'id', $ordineId);
            if ($user->getId() !== $ordine->getCliente()->getId()){
                $this->catchError("Questo ordine non appartiene all'utente loggato","User/showMyOrders");
            }
            if($this->persistent_manager->getWarningByOrderId($ordineId)){
                $this->catchError("Già esiste una segnalazione per quest'ordine","User/showMyOrders");
            }
            $testo = UHTTPMethods::postString('testo');
            $descrizione = UHTTPMethods::postString('descrizione');
            $segnalazione = new ESegnalazione();
            $segnalazione->setCliente($user)
                ->setData(new \DateTime())
                ->setDescrizione($descrizione)
                ->setOrdine($ordine)
                ->setTesto($testo);
            $this->persistent_manager->saveObj($segnalazione);
            UFlashMessage::addMessage('success', 'Segnalazione aggiunta con successo');
            header("Location: /Delivery/User/showMyOrders");
            exit;
        } catch (\Exception $e){
            $this->catchError($e->getMessage(),"User/showMyOrders");
        }
    }
}