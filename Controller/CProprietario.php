<?php 

use Foundation\FPersistentManager;
use View\VProprietario;
use Utility\UHTTPMethods;

require_once __DIR__ . '/../View/VProprietario.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';

class CProprietario{

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

    public function showDashboard(){

        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $view = new VProprietario();
        $view -> showDashboard();
        
    }

    public function showPanel(){
        $view = new VProprietario();
        $allOrders = FPersistentManager::getInstance()->getAllOrders();

        usort($allOrders, function($a, $b) { //ordina per data di esecuzione
            return $b->getDataEsecuzione() <=> $a->getDataEsecuzione();
        });
        $orders = array_slice($allOrders, 0, 5);

        $oggi = new DateTime(); // oggi
        $inizioSettimana = (clone $oggi)->modify('monday this week')->setTime(0, 0, 0);
        $fineSettimana = (clone $inizioSettimana)->modify('+6 days')->setTime(23, 59, 59);
        $ordiniSettimana = 0;
        $totaleSettimana = 0;

        foreach ($allOrders as $ordine) {
            $dataOrdine = $ordine->getDataEsecuzione(); 

            if ($dataOrdine >= $inizioSettimana && $dataOrdine <= $fineSettimana) {
                $ordiniSettimana++;
                $totaleSettimana += $ordine->getCosto(); // somma il costo dell'ordine
            }
        }

        $numeroClienti = FPersistentManager::getInstance()->getAllClients();
        $numeroClienti = count($numeroClienti);

        $view -> showPanel($orders, $ordiniSettimana, $totaleSettimana, $numeroClienti);
    }
}