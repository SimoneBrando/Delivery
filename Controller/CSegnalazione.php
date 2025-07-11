<?php
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Entity\EOrdine;
use Services\Utility\UFlashMessage;
use Services\Utility\UHTTPMethods;
use Entity\ESegnalazione;
use Services\MailingService;

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

            //  Invia email di conferma
            $email = $user->getEmail();

            $nome = htmlspecialchars($user->getNome());
            $descrizione = htmlspecialchars($descrizione);

            $message = "
                <h2>Grazie per la tua segnalazione!</h2>
                <p>Ciao $nome,</p>
                <p>Abbiamo ricevuto la tua segnalazione con successo:</p>
                <ul>
                    <li><strong>Descrizione:</strong> $descrizione</li>
                    <li><strong>Testo:</strong> $testo</li>
                </ul>
                <p>Il tuo feedback è importante per noi.</p>
                <p>Stiamo lavorando per risolvere il problema segnalato.</p>
                <p>Per qualsiasi ulteriore informazione, non esitare a contattarci.</p>

                <p>Grazie,<br>Il team di Delivery</p>
                 <img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
            ";

            $mailer = new MailingService();
            $mailer->mailTo($email, 'Conferma segnalazione - Delivery', $message);
            UFlashMessage::addMessage('success', 'Segnalazione aggiunta con successo');
            header("Location: /Delivery/User/showMyOrders");
            exit;
        } catch (\Exception $e){
            $this->catchError($e->getMessage(),"User/showMyOrders");
        }
    }
}