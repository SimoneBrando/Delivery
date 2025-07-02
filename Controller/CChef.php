<?php
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Services\Utility\UFlashMessage;
use View\VChef;
use Services\Utility\UHTTPMethods;
use Services\MailingService;
use Entity\EOrdine;

class CChef extends BaseController{

    public function showOrders(){
        $this->requireRole('cuoco');
        $ordiniInPreparazione = $this->persistent_manager->getOrdersByState('in_preparazione');
        $messages = UFlashMessage::getMessage();
        $view = new VChef($this->isLoggedIn(), $this->userRole, $messages);
        $view->showOrders($ordiniInPreparazione);
    }

    public function showOrdiniInAttesa(){
        $this->requireRole('cuoco');
        $ordiniInAttesa = $this->persistent_manager->getOrdersByState('in_attesa');
        $messages = UFlashMessage::getMessage();
        $view = new VChef($this->isLoggedIn(), $this->userRole, $messages);
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
            if($nuovoStato == 'annullato'){
                $mailService = new MailingService();
                $cliente = $ordine->getCliente(); 
                $email = $cliente->getEmail();
                $name = $cliente->getNome(); 
                $orderId = $ordine->getId();

                $message = "
                    <h2>Il tuo ordine è stato annullato</h2>
                    <p>Ciao <strong>$name</strong>,</p>
                    <p>Ci dispiace informarti che l'ordine <strong>#{$orderId}</strong> è stato annullato.</p>
                    <p>Se hai domande o dubbi, non esitare a contattarci.</p>
                    <br><p>Il team di Delivery</p>
                    <br><img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
                ";

                $mailService->mailTo(
                    $email,
                    "Ordine #$orderId annullato",
                    $message
                );
            }
            $this->persistent_manager->flush();
            $this->persistent_manager->commit();
            UFlashMessage::addMessage('success', 'Ordine modificato con successo');
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
    try {
        $ordine = $this->persistent_manager->locking(EOrdine::class, $ordineId);
        $ordine->setStato("in_preparazione");

        // Recupera info cliente
        $cliente = $ordine->getCliente();
        $email = $cliente->getEmail();
        $nome = $cliente->getNome();

        // Dettagli ordine
        $orderId = $ordine->getId();
        $prodotti = $ordine->getItemOrdini();
        $dataOrdine = $ordine->getDataEsecuzione()->format('d/m/Y H:i');
        $costo = $ordine->getCosto();
        $via = $ordine->getIndirizzoConsegna();
        $indirizzo = htmlspecialchars($via->getVia() . ' ' . $via->getCivico() . ', ' . $via->getCap() . ' ' . $via->getCitta());
        $pagamento = $ordine->getMetodoPagamento();

        // Costruzione lista prodotti
        $listaProdotti = "<ul>";
        foreach ($prodotti as $item) {
            $prodotto = $item->getProdotto();
            $listaProdotti .= "<li>" . htmlspecialchars($prodotto->getNome()) . " - qty: " . $item->getQuantita() . " - €" . $item->getPrezzoUnitarioAlMomento() . "</li>";
        }
        $listaProdotti .= "</ul>";

        // Messaggio email
        $message = "
            <h2>Il tuo ordine è stato accettato! 🍽️</h2>
            <p>Ciao <strong>$nome</strong>,</p>
            <p>Il tuo ordine <strong>#$orderId</strong> effettuato in data <strong>$dataOrdine</strong> è stato <strong>accettato</strong> ed è attualmente <strong>in preparazione</strong>.</p>
            <p><strong>Dettagli ordine:</strong></p>
            $listaProdotti
            <p><strong>Totale:</strong> €$costo</p>
            <p><strong>Indirizzo:</strong><br>$indirizzo</p>
            <p><strong>Metodo di pagamento:</strong> " . htmlspecialchars($pagamento->getNominativo()) . "</p>
            <br>
            <p>Ti invieremo un'altra notifica appena l’ordine sarà pronto per la consegna.</p>
            <br><p>Grazie per aver ordinato con noi!</p>
            <br><p>Il team di Delivery</p>
            <br><img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
        ";

        // Invia mail
        $mailService = new MailingService();
        $mailService->mailTo(
            $email,
            "Ordine #$orderId accettato - È in preparazione!",
            $message
        );

        $this->persistent_manager->flush();
        $this->persistent_manager->commit();
        header("Location: /Delivery/Chef/showOrdiniInAttesa");
        exit;

    } catch (\Exception $e) {
        if ($this->persistent_manager->isTransactionActive()) {
            $this->persistent_manager->rollback();
        }
        $this->handleError($e);
    }
}


    public function rifiutaOrdine(){
        $this->requireRole('cuoco');
        $ordineId = UHTTPMethods::post("ordine_id");
        $motivazione = UHTTPMethods::postString("motivazione_rifiuto");

        $this->persistent_manager->beginTransaction();
        try {
            $ordine = $this->persistent_manager->locking(EOrdine::class, $ordineId);
            $ordine->setStato("annullato");

            // Recupera info cliente
            $cliente = $ordine->getCliente();
            $email = $cliente->getEmail();
            $nome = $cliente->getNome();

            // Dettagli ordine
            $orderId = $ordine->getId();
            $prodotti = $ordine->getItemOrdini();
            $dataOrdine = $ordine->getDataEsecuzione()->format('d/m/Y H:i');
            $costo = $ordine->getCosto();
            $via = $ordine->getIndirizzoConsegna();
            $indirizzo = htmlspecialchars($via->getVia() . ' ' . $via->getCivico() . ', ' . $via->getCap() . ' ' . $via->getCitta());
            $pagamento = $ordine->getMetodoPagamento();
            

            // Costruzione lista prodotti
            $listaProdotti = "<ul>";
            foreach ($prodotti as $item) {
                $prodotto = $item->getProdotto();
                $listaProdotti .= "<li>" . htmlspecialchars($prodotto->getNome()) . " - qty: " . $item->getQuantita() . " - €" . $item->getPrezzoUnitarioAlMomento() . "</li>";
            }
            $listaProdotti .= "</ul>";

            // Messaggio email
            $message = "
                <h2>Ci dispiace, il tuo ordine è stato rifiutato 😞</h2>
                <p>Ciao <strong>$nome</strong>,</p>
                <p>purtroppo il tuo ordine <strong>#$orderId</strong> effettuato in data <strong>$dataOrdine</strong> è stato <strong>rifiutato</strong> dal ristorante.</p>
                <p><strong>Motivazione:</strong><br>$motivazione</p>
                <p><strong>Dettagli ordine:</strong></p>
                $listaProdotti
                <p><strong>Totale:</strong> €$costo</p>
                <p><strong>Indirizzo:</strong><br>$indirizzo</p>
                <p><strong>Metodo di pagamento:</strong> " . htmlspecialchars($pagamento->getNominativo()) . "</p>
                <br>
                <p>Ci scusiamo per l'inconveniente. Ti invitiamo a effettuare un nuovo ordine se lo desideri.</p>
                <br><p>Il team di Delivery</p>
                <br><img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
            ";

            // Invia mail
            $mailService = new MailingService();
            $mailService->mailTo(
                $email,
                "Ordine #$orderId rifiutato - Ci scusiamo per l'inconveniente",
                $message
            );

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