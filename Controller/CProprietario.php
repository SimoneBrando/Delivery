<?php 

use App\Foundation\FPersistentManager;

class proprietario{

    public function isLogged(){

        $logged = false;
        
        if(UCookie::isSet('PHPSESSID')){
                if(session_status() == PHP_SESSION_NONE){
                    USession::getInstance();
                }
            }
            if(USession::isSetSessionElement('proprietario')){
                $logged = true;
            }
            if(!$logged){
                header('Location: /Delivery/User/login');
                exit;
            }
        return true;
    }

    public function mostraMenu(){
        if(CProprietario::isLogged()){
            $view = new VProprietario();
            $view -> mostraMenu();
        }
    }

    public function inserisciProdotto(){
        if(CProprietario::isLogged()){
            $prodotto = new EProdotto(UHTTPMethods::post('inserisci_prodotto'));
            FPersistentManager::getInstance()->salvaObj($prodotto);
        }
    }

    public function modificaProdotto(){
        if(CProprietario::isLogged()){
            $prodotto = new EProdotto(UHTTPMethods::post('modifica_prodotto'));
            FPersistentManager::getInstance()->updateObj($prodotto);
        }
    }

    public function eliminaProdotto(){
        if(CProprietario::isLogged()){
            $prodotto = UHTTPMethods::post('elimina_prodotto');
            FPersistentManager::getInstance()->eliminaObj($prodotto);
        }
    }
}