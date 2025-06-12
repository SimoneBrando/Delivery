<?php

use Foundation\FPersistentManager;
use Utility\UHTTPMethods;
use Services\Utility\USession;
use Entity\EOrdine;


class COrdine{

    public static function componiOrdine(){
        if(CUser::isLogged()){
            $userId = USession::getSessionElement('user');
            $prodotti = UHTTPMethods::post('prodotti');
            $costo = UHTTPMethods::post('costo');
            $dataRicezione = UHTTPMethods::post('dataRicezione');
            $note = UHTTPMethods::post('note');
            $ordine = new EOrdine();
            $ordine -> setCliente($userId)
                    -> setProdotti($prodotti)
                    -> setCosto($costo)
                    -> setNote($note)
                    -> setDataEsecuzione(new DateTime('now', new DateTimeZone('Europe/Rome')))
                    -> setDataRicezione($dataRicezione)
                    -> setStato('in_attesa');
            FPersistentManager::getInstance()->saveObj($ordine);
        }
    }

    public static function listadiProdotti(){

    }
}