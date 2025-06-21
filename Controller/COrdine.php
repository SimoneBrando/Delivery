<?php

use Controller\BaseController;
use Entity\EItemOrdine;
use Foundation\FPersistentManager;
use Utility\UHTTPMethods;
use Services\Utility\USession;
use Entity\EOrdine;
use Entity\EProdotto;
use View\VErrors;
use View\VUser;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Entity/EProdotto.php';


class COrdine extends BaseController{

    public function showConfirmOrder(){
        $this->requireRole('cliente');
        $user = $this->getUser();
        $view = new VUser();
        $view->showConfirmOrder($user);
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
                ->setDataRicezione(new DateTime('2025-06-21'))
                ->setCosto($totalPrice)
                ->setCliente($user)
                ->setStato('in_preparazione')
                ->setNote($note);
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
