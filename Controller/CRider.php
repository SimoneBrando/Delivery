<?php

namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Entity\EOrdine;
use Exception;
use Services\Utility\UFlashMessage;
use View\VRider;
use Services\Utility\UHTTPMethods;
use Services\MailingService;

class CRider extends BaseController{

    public function showOrders(){
        $this->requireRole('rider');
        $messages = UFlashMessage::getMessage();
        $view = new VRider($this->isLoggedIn(), $this->userRole, $messages);
        $ordersReady = $this->persistent_manager->getOrdersByState('pronto');
        $ordersOnDelivery = $this->persistent_manager->getOrdersByStateNotMine('in_consegna', $this->getUser()->getId());
        $myOrders = $this->persistent_manager->getOrdersByRider($this->getUser()->getId());
        $view->showOrders($ordersReady, $ordersOnDelivery, $myOrders);
    }

    public function cambiaStatoOrdine(){
        $this->requireRole('rider');
        $ordineId = UHTTPMethods::post('ordineId');
        $nuovoStato = UHTTPMethods::postString('stato');
        $mailService = new MailingService();
        $this->persistent_manager->beginTransaction();
        try{
            $ordine = $this->persistent_manager->locking(EOrdine::class, $ordineId);

            // Verifica se l'ordine è gestito dal rider corrente
            if ($ordine->getRiderConsegna() !== $this->getUser() && $ordine->getRiderConsegna() !== null) {
                UFlashMessage::addMessage('error', 'L\'ordine è già stato preso in carico da un altro rider.');
                header("Location: /Delivery/Rider/showOrders");
                exit;
            }

            $ordine->setStato($nuovoStato);
            $ordine->setRiderConsegna($this->getUser());
            if($nuovoStato == 'consegnato'){
                $ordine->setDataConsegna(new \DateTime());
                $dataConsegna = $ordine->getDataConsegna()->format('d/m/Y H:i');
                $cliente = $ordine->getCliente(); 
                $email = $cliente->getEmail();
                $orderId = $ordine->getId();
                $name = $cliente->getNome(); 
                $indirizzo = $ordine->getIndirizzoConsegna(); 
                $via = htmlspecialchars($indirizzo->getVia() . ' ' . $indirizzo->getCivico() . ', ' . $indirizzo->getCap() . ' ' . $indirizzo->getCitta());
                $pagamento = $ordine->getMetodoPagamento();
                $message = "
                <h2>Il tuo ordine è stato consegnato! 🎉</h2>
                <p>Ciao <strong>$name</strong>,</p>
                <p>Confermiamo che l'ordine <strong>#{$orderId}</strong> ti è stato consegnato in data <strong>$dataConsegna</strong>.</p>
                <p>Speriamo che il tuo pasto sia stato di tuo gradimento!</p>
                <p>Se vuoi lasciarci un feedback o segnalare un problema, puoi farlo dalla tua sezione ordini: 
                    <a href='https://deliveryhomerestaurant.altervista.org/Delivery/User/showMyOrders/'>Vai ai tuoi ordini</a>
                </p>
                <br>
                <p><strong>Indirizzo di consegna:</strong><br>$via</p>
                <p><strong>Metodo di pagamento:</strong> " . htmlspecialchars($pagamento->getNominativo()) . "</p>
                <p>Grazie per aver ordinato con Delivery!</p>
                <br><p>Il team di Delivery</p>
                <br><img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
                ";
                $mailService->mailTo(
                    $email,
                    "Ordine #$orderId consegnato con successo!",
                    $message
                );
                $ordine->setDataConsegna(new \DateTime());
            }
            if($nuovoStato == 'in_consegna'){
                $mailService = new MailingService();
                $cliente = $ordine->getCliente(); 
                $email = $cliente->getEmail();
                $name = $cliente->getNome(); 

                $dataPrevista = $ordine->getDataRicezione()->format('d/m/Y H:i');
                $orderId = $ordine->getId();
                $indirizzo = $ordine->getIndirizzoConsegna(); 
                $via = htmlspecialchars($indirizzo->getVia() . ' ' . $indirizzo->getCivico() . ', ' . $indirizzo->getCap() . ' ' . $indirizzo->getCitta());
                $pagamento = $ordine->getMetodoPagamento();

                $message = "
                    <h2>Il tuo ordine e' in consegna! 🚴‍♂️</h2>
                    <p>Ciao <strong>$name</strong>,</p>
                    <p>Il tuo ordine <strong>#{$orderId}</strong> è stato preso in carico dal nostro rider e arriverà approssimativamente entro le <strong>$dataPrevista</strong>.</p>
                    <p><strong>Indirizzo di consegna:</strong><br>$via</p>
                    <p><strong>Metodo di pagamento:</strong> " . htmlspecialchars($pagamento->getNominativo()) . "</p>
                    <p>Grazie per aver scelto Delivery!</p>
                    <br><p>Il team di Delivery</p>
                    <br><img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
                ";

                $mailService->mailTo(
                    $email,
                    "Il tuo ordine #$orderId è in consegna!",
                    $message
                );
            }
            
                
            $this->persistent_manager->flush();
            $this->persistent_manager->commit();
            UFlashMessage::addMessage('success', 'Ordine modificato con successo');
            header("Location: /Delivery/Rider/showOrders");
            exit;
        }
        catch (Exception $e) {
            if ($this->persistent_manager->isTransactionActive()){
                $this->persistent_manager->rollback();
            }
            $this->catchError($e->getMessage(),"Rider/showOrders");            
        }
    }
}