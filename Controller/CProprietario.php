<?php 

use Controller\BaseController;
use Foundation\FPersistentManager;
use View\VProprietario;
use Utility\UHTTPMethods;
use Services\Utility\UCookie;
use Services\Utility\USession;
use Entity\EProdotto;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../View/VProprietario.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';
require_once __DIR__ . '/../services/utility/UHTTPMethods.php';
require_once __DIR__ . '/CUser.php';

class CProprietario extends BaseController {

    public function inserisciProdotto(){
        $this->requireRole('admin');
        $prodotto = new EProdotto(UHTTPMethods::post('inserisci_prodotto'));
        $this->persistent_manager->saveObj($prodotto);
    }

    public function modificaProdotto(){
        $this->requireRole('admin');
        $prodotto = new EProdotto(UHTTPMethods::post('modifica_prodotto'));
        $this->persistent_manager->updateObj($prodotto);
    }

    public function eliminaProdotto(){
        $this->requireRole('admin');
        $prodotto = UHTTPMethods::post('elimina_prodotto');
        $this->persistent_manager->deleteObj($prodotto);
    }

    public function showDashboard(){
        $this->requireRole('admin');
        $view = new VProprietario();
        $view -> showDashboard();
        
    }

    public function showPanel(){
        $this->requireRole('admin');
        $view = new VProprietario();
        $allOrders = $this->persistent_manager->getAllOrders();

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

        $numeroClienti = $this->persistent_manager->getAllClients();
        $numeroClienti = count($numeroClienti);

        $view -> showPanel($orders, $ordiniSettimana, $totaleSettimana, $numeroClienti);
    }

    public function createEmployee() {
        $this->requireRole('admin');
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

    public function deleteEmployee() {
        $this->requireRole('admin');
        $employeeId = UHTTPMethods::post('employeeId');
        $user = new CUser();
        $user->removeAccount($employeeId);
        $this->showCreateAccount();
    }

    public function showCreationForm(){
        $this->requireRole('admin');
        $view = new VProprietario();
        $view -> showCreationForm();
    }

    public function showReviews(){
        $this->requireRole('admin');
        $view = new VProprietario();
        $allReviews = $this->persistent_manager->getAllReviews();

        usort($allReviews, function($a, $b) { //ordina per data di creazione
            return $b->getData() <=> $a->getData();
        });
        $view -> showReviews($allReviews);
    }

    public function showMenu(){
        $this->requireRole('admin');
        $view = new VProprietario();
        $prodotti = $this->persistent_manager->getAllProducts();
        $view -> showMenu($prodotti);
    
    }

    public function showOrders(){
        $this->requireRole('admin');
        $view = new VProprietario();
        $allOrders = $this->persistent_manager->getAllOrders();

        usort($allOrders, function($a, $b) { //ordina per data di esecuzione
            return $b->getDataEsecuzione() <=> $a->getDataEsecuzione();
        });
        
        $view -> showOrders($allOrders);
    }

    public function showCreateAccount(){
        $this->requireRole('admin');
        $chefs = $this->persistent_manager->getAllChefs();
        $riders= $this->persistent_manager->getAllRiders();
        $view = new VProprietario();
        $view -> showCreateAccount($chefs, $riders);
    }
}