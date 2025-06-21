<?php

use Controller\BaseController;
use Entity\ECarta_credito;
use Entity\EIndirizzo;
use Entity\EItemOrdine;
use Foundation\FPersistentManager;
use Services\OrderTimeCalculator;
use Utility\UHTTPMethods;
use Services\Utility\USession;
use Entity\EOrdine;
use Entity\EProdotto;
use View\VErrors;
use View\VUser;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Entity/EProdotto.php';
require_once __DIR__ . '/../services/OrderTimeCalculator.php';


class COrdine extends BaseController{

    public function showConfirmOrder(){
        $this->requireRole('cliente');
        $cart = json_decode(UHTTPMethods::post('cart_data'), true);
        if (!is_array($cart) || empty($cart)) {
            throw new InvalidArgumentException("Carrello non valido o vuoto.");
        }
        $order = new EOrdine();
        foreach ($cart as $item){
                $prodotto = $this->persistent_manager->getObjOnAttribute(EProdotto::class,'id',$item['id']);
                if (!$prodotto) {
                    throw new InvalidArgumentException("Prodotto {$item['name']} non trovato.");
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
        } catch (Exception $e) {
            error_log("Errore nel recupero degli ordini in preparazione: " . $e->getMessage());
            // Fallback: impostiamo un numero fittizio per forzare il ritardo
            $numeroOrdini = 10;
        }
        $calculator = new OrderTimeCalculator;
        $dataConsegna = $calculator->orarioConsegnaCalculator($itemOrderList,$numeroOrdini);        
        $user = $this->getUser();
        $userUtility = new CUser();
        $adresses = $userUtility->findUserAdresses();
        $cards = $userUtility->findUserCards();
        $view = new VUser();
        $view->showConfirmOrder($user,$dataConsegna, $adresses, $cards);
    }

    public function confirmPayment(){
        try{
            $this->requireRole('cliente');
            $user = $this->getUser();
            $cart = json_decode(UHTTPMethods::post('cart_data'), true);
            if (!is_array($cart) || empty($cart)) {
                throw new InvalidArgumentException("Carrello non valido o vuoto.");
            }
            $note = UHTTPMethods::post("note");
            $dataConsegna = new DateTime(UHTTPMethods::post('dataConsegna'));
            $indirizzoConsegna = $this->persistent_manager->getObjOnAttribute(EIndirizzo::class,'id', UHTTPMethods::post('indirizzo_id'));
            $metodoPagamento = $this->persistent_manager->getObjOnAttribute(ECarta_credito::class, 'numeroCarta', UHTTPMethods::post('numero_carta')); 
            $order = new EOrdine();
            $itemOrderList = [];
            $totalPrice = 0;
            foreach ($cart as $item){
                $prodotto = $this->persistent_manager->getObjOnAttribute(EProdotto::class,'id',$item['id']);
                if (!$prodotto) {
                    throw new InvalidArgumentException("Prodotto {$item['name']} non trovato.");
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
            $order->setDataEsecuzione(new DateTime())
                ->setDataRicezione($dataConsegna)
                ->setCosto($totalPrice)
                ->setCliente($user)
                ->setStato('in_preparazione')
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
            $view = new VUser();
            $view->confermedOrder();
        } catch (InvalidArgumentException $e){
            $this->persistent_manager->rollback();
            error_log("Errore input utente: " . $e->getMessage());
            $this->handleError($e);
        } catch (Exception $e) {
            $this->persistent_manager->rollback();
            error_log("Errore database: " . $e->getMessage());
            $this->handleError($e);
        }
    }

    public static function listadiProdotti(){

    }
    
}
