<?php 

use Foundation\FPersistentManager;
use View\VProprietario;
use Utility\UHTTPMethods;
use Services\Utility\UCookie;
use Services\Utility\USession;
use Entity\EProdotto;


require_once __DIR__ . '/../View/VProprietario.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';
require_once __DIR__ . '/../services/utility/UHTTPMethods.php';
require_once __DIR__ . '/CUser.php';

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

    public function createEmployee() {
        $role = UHTTPMethods::post('ruolo');
        $extraData = [];
        if ($role === 'Cuoco') {
            $codiceCuoco = 'CUOCO-'. strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
            $extraData = ['setCodiceCuoco' => $codiceCuoco];
        } elseif ($role === 'Rider') {
            $codiceRider = 'RIDER-' . strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
            $extraData = ['setCodiceRider' => $codiceRider];
        }
        try {
            $user = new CUser();
            $user->registerUser($role, $extraData);
        } catch (Exception $e) {
            die('Unknown error');
        }
    }

    public function showCreationForm(){
        $view = new VProprietario();
        $view -> showCreationForm();
    }

    public function showReviews(){
        $view = new VProprietario();
        $allReviews = FPersistentManager::getInstance()->getAllReviews();

        usort($allReviews, function($a, $b) { //ordina per data di creazione
            return $b->getData() <=> $a->getData();
        });
        $view -> showReviews($allReviews);
    }

    public function showMenu(){
        $view = new VProprietario();
        $prodotti = FPersistentManager::getInstance()->getAllProducts();
        $view -> showMenu($prodotti);
    
    }

    public function showOrders(){
        $view = new VProprietario();
        $allOrders = FPersistentManager::getInstance()->getAllOrders();

        usort($allOrders, function($a, $b) { //ordina per data di esecuzione
            return $b->getDataEsecuzione() <=> $a->getDataEsecuzione();
        });
        
        $view -> showOrders($allOrders);
    }

    public function showCreateAccount(){
        $chefs = FPersistentManager::getInstance()->getAllChefs();
        $riders= FPersistentManager::getInstance()->getAllRiders();
        $view = new VProprietario();
        $view -> showCreateAccount($chefs, $riders);
    }
}