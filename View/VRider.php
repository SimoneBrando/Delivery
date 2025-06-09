<?php

namespace View;

class VRider{

    private $smarty;

    public function __construct(){

        $this->smarty = getSmartyInstance();

    }

    public function showOrders($orders){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $ordersArray = [];

    foreach ($orders as $order) {
        $prodottiData = [];
        foreach ($order->getProdotti()->toArray() as $prodotto) {
            $prodottiData[] = [
                'id' => $prodotto->getId(),
                'nome' => $prodotto->getNome(),
                'descrizione' => $prodotto->getDescrizione(),
                'costo' => $prodotto->getCosto()
            ];
        }

        $ordersArray[] = [
            'id' => $order->getId(),
            'utente_id' => $order->getUtente()->getId(),
            'note' => $order->getNote(),
            'dataEsecuzione' => $order->getDataEsecuzione()->format('Y-m-d H:i:s'),
            'dataRicezione' => $order->getDataRicezione()->format('Y-m-d H:i:s'),
            'costo' => $order->getCosto(),
            'stato' => $order->getStato(),
            'prodotti' => $prodottiData,
        ];
    }

        $this->smarty->assign('orders', $ordersArray);
        $this->smarty->display('rider_orders.tpl');
    }




}