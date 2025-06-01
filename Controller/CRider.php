<?php

use App\Foundation\FPersistentManager;

class CCucina{

    public function isLogged(){

        $logged = false;
        
        if(UCookie::isSet('PHPSESSID')){
                if(session_status() == PHP_SESSION_NONE){
                    USession::getInstance();
                }
            }
            if(USession::isSetSessionElement('rider')){
                $logged = true;
            }
            if(!$logged){
                header('Location: /Delivery/User/login');
                exit;
            }
        return true;
    }

    public function mostraOrdini(){
        if(CRider::isLogged()){
            $stato = 'in_consegna';
            $ordini = FPersistentManager::getInstance()->getOrdiniCucina('EOrdine', $stato);

            $view = new VOrdini_cucina();
            $view->mostraOrdini($ordini);
        }
    }

    public function cambiaStatoOrdine(){
        if(CRider::isLogged()){
            $ordineId = UHTTPMethods::post('ordineId');
            $ordine = FPersistentManager::getInstance()->risvegliaObj('EOrdine', $ordineId);

            if($ordine){
                $nuovoStato = UHTTPMethods::post('stato');
                $ordine->setStato($nuovoStato);
                FPersistentManager::getInstance()->updateObj($ordine);
            }
        }
    }

}