<?php
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Entity\ECarta_credito;
use Entity\EIndirizzo;
use Entity\EItemOrdine;
use Foundation\FPersistentManager;
use Services\OrderTimeCalculator;
use Services\Utility\UHTTPMethods;
use Services\MailingService;
use Entity\EOrdine;
use Entity\EProdotto;
use View\VUser;

class COrdine extends BaseController{

    public function showConfirmOrder(){
        $this->requireRole('cliente');
        $cart = json_decode(UHTTPMethods::post('cart_data'), true);
        if (!is_array($cart) || empty($cart)) {
            throw new \InvalidArgumentException("Carrello non valido o vuoto.");
        }    
        $user = $this->getUser();
        $userUtility = new CUser();
        $adresses = $userUtility->findActiveUserAdresses();
        $cards = $userUtility->findActiveUserCards();
        $view = new VUser($this->isLoggedIn(), $this->userRole);
        $view->showConfirmOrder($user, $adresses, $cards);
    }

    public function confirmPayment(){
        try{
            $this->requireRole('cliente');
            $user = $this->getUser();
            $view = new VUser($this->isLoggedIn(), $this->userRole);
            $cart = json_decode(UHTTPMethods::post('cart_data'), true);
            if (!is_array($cart) || empty($cart)) {
                throw new \InvalidArgumentException("Carrello non valido o vuoto.");
            }

            if(!UHTTPMethods::post('indirizzo_id') || !UHTTPMethods::post('numero_carta')) {
                $view->errorCartOrAddress();
                return;
            }
            $note = UHTTPMethods::post("note");
            $dataConsegna = new \DateTime(UHTTPMethods::post('dataConsegna'));
            $daysIT = [
                'Monday' => 'lunedì',
                'Tuesday' => 'martedì',
                'Wednesday' => 'mercoledì',
                'Thursday' => 'giovedì',
                'Friday' => 'venerdì',
                'Saturday' => 'sabato',
                'Sunday' => 'domenica'
            ];
            // 
            $giornoSettimana = $dataConsegna->format('l'); // Esempio: 'Monday', 'Tuesday'

            // Recupera orari apertura/chiusura per quel giorno (ricorrente)
            $giorno = $this->persistent_manager->getDayById($daysIT[$giornoSettimana]);
            $orarioApertura = $giorno ? $giorno->getOrarioApertura() : null;
            $orarioChiusura = $giorno ? $giorno->getOrarioChiusura() : null;

            // Se il giorno non esiste o è chiuso
            if (!$orarioApertura && !$orarioChiusura) {
                $view->dateError();
                return;
            }

            // Controllo chiusure eccezionali
            $giorniChiusuraEccezionali = $this->persistent_manager->getExceptionClosedDays(); // array di oggetti con getExceptionDate()
            $dataConsegnaStr = $dataConsegna->format('Y-m-d');

            foreach ($giorniChiusuraEccezionali as $giornoChiusura) {
                if ($giornoChiusura->getExceptionDate()->format('Y-m-d') === $dataConsegnaStr) {
                    $view->dateError();
                    return;
                }
            }

            // Controllo orario compreso tra apertura e chiusura
            $apertura = (clone $dataConsegna)->setTime((int)$orarioApertura->format('H'), (int)$orarioApertura->format('i'));
            $chiusura = (clone $dataConsegna)->setTime((int)$orarioChiusura->format('H'), (int)$orarioChiusura->format('i'));

            if ($dataConsegna < $apertura || $dataConsegna > $chiusura) {
                $view->dateError();
                return;
            }








            $indirizzoConsegna = $this->persistent_manager->getObjOnAttribute(EIndirizzo::class,'id', UHTTPMethods::post('indirizzo_id'));
            $metodoPagamento = $this->persistent_manager->getObjOnAttribute(ECarta_credito::class, 'numeroCarta', UHTTPMethods::post('numero_carta'));
            $stato = ($this->persistent_manager->getOrdersByState('in_preparazione') > 10) ? "in_attesa" : "in_preparazione";
            $order = new EOrdine();
            $itemOrderList = [];
            $totalPrice = 0;
            foreach ($cart as $item){
                $prodotto = $this->persistent_manager->getObjOnAttribute(EProdotto::class,'id',$item['id']);
                if (!$prodotto) {
                    throw new \InvalidArgumentException("Prodotto {$item['name']} non trovato.");
                }
                if($prodotto->getCosto() != $item['price']) {
                    throw new \InvalidArgumentException("Il prezzo del prodotto {$item['name']} è stato modificato, ora è {$prodotto->getCosto()} Riprovare!", 1);
                }
                $itemOrder = new EItemOrdine;
                $itemOrder->setOrdine($order)
                    ->setProdotto($prodotto)
                    ->setQuantita($item['qty'])
                    ->setPrezzoUnitarioAlMomento($item['price']);
                $order->addItemOrdine($itemOrder);
                $itemOrderList[] = $itemOrder;
                $totalPrice += $item['price'] * $item['qty'];
            }
            $order->setDataEsecuzione(new \DateTime())
                ->setDataRicezione($dataConsegna)
                ->setCosto($totalPrice)
                ->setCliente($user)
                ->setStato($stato)
                ->setNote($note)
                ->setIndirizzoConsegna($indirizzoConsegna)
                ->setMetodoPagamento($metodoPagamento);
            //Inizio Trasazione
            $this->persistent_manager->beginTransaction();
            $this->persistent_manager->persist($order);
            foreach($itemOrderList as $itemOrdine){
                $this->persistent_manager->persist($itemOrdine);
            }
            $this->persistent_manager->flush();
            $this->persistent_manager->commit();
            //Fine Transazione


            $mailService = new MailingService();
            $cliente = $order->getCliente(); 
            $email = $cliente->getEmail();
            $name = $cliente->getNome(); 
            $orderId = $order->getId();

            $message = "
                    <h2>Il tuo ordine è in attesa</h2>
                    <p>Ciao <strong>$name</strong>,</p>
                    <p>Il tuo ordine <strong>#{$orderId}</strong> è attualmente in attesa di essere elaborato.</p>
                    <p>Ti informeremo non appena ci saranno aggiornamenti.</p>
                    <br><p>Il team di Delivery</p>
                    <br><img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
                ";

            $mailService->mailTo(
                    $email,
                    "Ordine #$orderId in attesa",
                    $message
            );

          

            $view = new VUser($this->isLoggedIn(), $this->userRole);
            $view->confermedOrder();
        } catch (\InvalidArgumentException $e){
            if ($this->persistent_manager->isTransactionActive()){
                $this->persistent_manager->rollback();
            }
            $cartError = ($e->getCode()==1) ? true : false;
            error_log("Errore input utente: " . $e->getMessage());
            $this->handleError($e, $cartError);
        } catch (\Exception $e) {
            if ($this->persistent_manager->isTransactionActive()){
                $this->persistent_manager->rollback();
            }
            error_log("Errore database: " . $e->getMessage());
            $this->handleError($e);
        }
    }

    public function getEstimatedTime() {
        try{
            $this->requireRole('cliente');
            $indirizzoId = UHTTPMethods::post('indirizzo_id');
            $indirizzo = $this->persistent_manager->getObjOnAttribute(EIndirizzo::class, 'id', $indirizzoId);
            $indirizzoCliente = "{$indirizzo->getVia()} {$indirizzo->getCivico()}, {$indirizzo->getCitta()}";
            $cart = json_decode(UHTTPMethods::post('cart_data'), true);
            if (!is_array($cart) || empty($cart)) {
                throw new \InvalidArgumentException("Carrello non valido");
            }
            $order = new EOrdine();
            foreach ($cart as $item){
                $prodotto = $this->persistent_manager->getObjOnAttribute(EProdotto::class,'id',$item['id']);
                if (!$prodotto) {
                    throw new \InvalidArgumentException("Prodotto {$item} non trovato");
                    }
                $itemOrder = new EItemOrdine;
                $itemOrder->setOrdine($order)
                    ->setProdotto($prodotto)
                    ->setQuantita($item['qty'])
                    ->setPrezzoUnitarioAlMomento($item['price']);
                $itemOrderList[] = $itemOrder;
            }
            try {
                $ordiniAttivi = $this->persistent_manager->getOrdersByState('in_preparazione');
                $numeroOrdini = is_array($ordiniAttivi) ? count($ordiniAttivi) : 10;
            } catch (\Exception $e) {
                error_log("Errore nel recupero degli ordini in preparazione: " . $e->getMessage());
                // Fallback: impostiamo un numero fittizio per forzare il ritardo
                $numeroOrdini = 10;
            }
            $orderTime = new OrderTimeCalculator();    
            // Esegui il calcolo reale del tempo stimato
            $estimatedTime = $orderTime->orarioConsegnaCalculator($itemOrderList, $numeroOrdini,$indirizzoCliente);

            header('Content-Type: application/json');
            echo json_encode([
                'estimated_time' => $estimatedTime->format('Y-m-d\TH:i')
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'error' => $e->getMessage()
            ]);
            exit;
        }
    }
    
}
