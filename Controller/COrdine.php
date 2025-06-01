<?php

use App\Foundation\FPersistentManager;

class COrdine{

    public static function componiOrdine(){
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionId('user');
            $prodotti = UHTTPMethods::post('prodotti');
            $ordine = new EOrdine($userId, $prodotti);
            FPersistentManager::getInstance()->saveObj($ordine);
        }
    }

    public static function listadiProdotti(){

    }
}