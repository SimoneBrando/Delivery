<?php
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use View\VChef;
use Services\Utility\UHTTPMethods;
use Services\MailingService;
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

    try {
        $ordine = $this->persistent_manager->locking(EOrdine::class, $ordineId);
        $ordine->setStato("in_preparazione");

        // === EMAIL al cliente ===
        $cliente = $ordine->getCliente();
        $email = $cliente->getEmail();
        $name = htmlspecialchars($cliente->getNome());

        $dataPrevista = $ordine->getDataRicezione()->format('d/m/Y H:i');
        $orderId = $ordine->getId();

        $items = $ordine->getItemOrdini();
        $listaProdotti = "<ul>";
        foreach ($items as $item) {
            $prodotto = $item->getProdotto()->getNome();
            $quantita = $item->getQuantita();
            $prezzo = number_format($item->getPrezzoUnitarioAlMomento(), 2);
            $listaProdotti .= "<li>$quantita × $prodotto – €$prezzo</li>";
        }
        $listaProdotti .= "</ul>";

        $totale = number_format($ordine->getCosto(), 2);
        $indirizzo = $ordine->getIndirizzoConsegna();
        $via = htmlspecialchars($indirizzo->getVia() . ' ' . $indirizzo->getCivico() . ', ' . $indirizzo->getCap() . ' ' . $indirizzo->getCitta());

        $message = "
            <h2>Il tuo ordine è stato accettato! 🍽️</h2>
            <p>Ciao <strong>$name</strong>,</p>
            <p>Siamo felici di comunicarti che il tuo ordine <strong>#{$orderId}</strong> è stato accettato ed è ora in preparazione!</p>
            <p><strong>Consegna prevista:</strong> $dataPrevista</p>
            <p><strong>Indirizzo di consegna:</strong><br>$via</p>
            <p><strong>Riepilogo ordine:</strong></p>
            $listaProdotti
            <p><strong>Totale:</strong> €$totale</p>
            <br>
            <p>Riceverai un’altra notifica non appena il rider prenderà in carico l’ordine.</p>
            <p>Grazie per aver scelto Delivery!</p>
            <br>
            <p>Il team di Delivery</p>
            <br><img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
        ";

        $mailService = new \Services\MailingService();
        $mailService->mailTo(
            $email,
            "Il tuo ordine #$orderId è in preparazione!",
            $message
        );

        // Commit
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
            $ordine->setNote("Rifiutato dal cuoco: " . $motivazione);

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