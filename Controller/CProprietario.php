<?php 
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use View\VProprietario;
use Services\Utility\UHTTPMethods;
use Entity\EProdotto;

class CProprietario extends BaseController {

    public function inserisciProdotto(){
        $this->requireRole('proprietario');
        $prodotto = new EProdotto();
        $this->persistent_manager->saveObj($prodotto);
    }

    public function modificaProdotto(){
        $this->requireRole('proprietario');
        $prodotto = new EProdotto();
        $this->persistent_manager->updateObj($prodotto);
    }

    public function showDashboard(){
        $this->requireRole('proprietario');

        // ordini
        $allOrders = $this->persistent_manager->getAllOrders();

        usort($allOrders, function($a, $b) { 
            return $b->getDataEsecuzione() <=> $a->getDataEsecuzione();
        });
        $orders = array_slice($allOrders, 0, 5);

        $oggi = new \DateTime(); 
        $inizioOggi = (clone $oggi)->setTime(0, 0, 0);
        $fineOggi = (clone $oggi)->setTime(23, 59, 59);
        $inizioSettimana = (clone $oggi)->modify('monday this week')->setTime(0, 0, 0);
        $fineSettimana = (clone $inizioSettimana)->modify('+6 days')->setTime(23, 59, 59);

        $totaleOggi = 0;

        foreach ($allOrders as $ordine) {
            $dataOrdine = $ordine->getDataEsecuzione();

            if ($dataOrdine >= $inizioOggi && $dataOrdine <= $fineOggi) {
                $totaleOggi += $ordine->getCosto();
            }
        }

        $ordiniOggi = 0;

        foreach ($allOrders as $ordine) {
            $dataOrdine = $ordine->getDataEsecuzione();

            if ($dataOrdine >= $inizioOggi && $dataOrdine <= $fineOggi) {
                $ordiniOggi++;
            }
        }

        $prodotti = $this->persistent_manager->getAllProducts();
        $mappaProdotti = [];

        foreach ($prodotti as $prodotto) {
            $mappaProdotti[$prodotto->getId()] = $prodotto->getNome();
        }

        $conteggioPiatti = [];

        foreach ($allOrders as $ordine) {
            $items = $ordine->getItemOrdini();

            foreach ($items as $item) {
                $prodottoId = $item->getProdotto()->getId(); 
                $quantita = $item->getQuantita();

                if (!isset($conteggioPiatti[$prodottoId])) {
                    $conteggioPiatti[$prodottoId] = 0;
                }

                $conteggioPiatti[$prodottoId] += $quantita;
            }
        }

        arsort($conteggioPiatti);

        $top10Piatti = array_slice($conteggioPiatti, 0, 10, true);

        $nomiTopPiatti = [];
        $quantitaTopPiatti = [];

        foreach ($top10Piatti as $id => $quantita) {
            $nome = $mappaProdotti[$id] ?? 'Sconosciuto';
            $nomiTopPiatti[] = $nome;
            $quantitaTopPiatti[] = $quantita;
        }



        // clienti
        $numeroClienti = $this->persistent_manager->getAllClients();
        $numeroClienti = count($numeroClienti);

        // recensioni
        $recensioni = $this->persistent_manager->getAllReviews();

        $sommaValutazioni = 0;
        $numeroRecensioni = count($recensioni);

        if ($numeroRecensioni > 0) {
            foreach ($recensioni as $recensione) {
                $sommaValutazioni += $recensione->getVoto(); 
            }
            $mediaValutazioni = $sommaValutazioni / $numeroRecensioni;
        } else {
            $mediaValutazioni = 0; 
        }

        // fatturato della settimana
        $fatturatoSettimana = [];

        for ($i = 0; $i < 7; $i++) {
            $data = (clone $inizioSettimana)->modify("+$i days")->format('Y-m-d');
            $fatturatoSettimana[$data] = 0;
        }

        foreach ($allOrders as $ordine) {
            $dataOrdine = $ordine->getDataEsecuzione();
            $dataOrdineStr = $dataOrdine->format('Y-m-d');

            if (array_key_exists($dataOrdineStr, $fatturatoSettimana)) {
                $fatturatoSettimana[$dataOrdineStr] += $ordine->getCosto();
            }
        }


        $view = new VProprietario($this->isLoggedIn(), $this->userRole);
        $view -> showDashboard($orders, $totaleOggi, $numeroClienti, $ordiniOggi, $mediaValutazioni, array_values($fatturatoSettimana), $nomiTopPiatti, $quantitaTopPiatti);
        
    }

    public function showPanel(){
        $this->requireRole('proprietario');
        $view = new VProprietario($this->isLoggedIn(), $this->userRole);
        $allOrders = $this->persistent_manager->getAllOrders();

        usort($allOrders, function($a, $b) { 
            return $b->getDataEsecuzione() <=> $a->getDataEsecuzione();
        });
        $orders = array_slice($allOrders, 0, 5);

        $oggi = new \DateTime(); 
        $inizioSettimana = (clone $oggi)->modify('monday this week')->setTime(0, 0, 0);
        $fineSettimana = (clone $inizioSettimana)->modify('+6 days')->setTime(23, 59, 59);
        $ordiniSettimana = 0;
        $totaleSettimana = 0;

        foreach ($allOrders as $ordine) {
            $dataOrdine = $ordine->getDataEsecuzione(); 

            if ($dataOrdine >= $inizioSettimana && $dataOrdine <= $fineSettimana) {
                $ordiniSettimana++;
                $totaleSettimana += $ordine->getCosto(); 
            }
        }

        $numeroClienti = $this->persistent_manager->getAllClients();
        $numeroClienti = count($numeroClienti);

        $view -> showPanel($orders, $ordiniSettimana, $totaleSettimana, $numeroClienti);
    }

    public function createEmployee() {
        $this->requireRole('proprietario');
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
            header("Location: /Delivery/Proprietario/showCreateAccount");
            exit;
        } catch (\Exception $e) {
            die('Unknown error');
        }
    }

    public function deleteEmployee() {
        $this->requireRole('proprietario');
        $employeeId = UHTTPMethods::post('employeeId');
        $user = new CUser();
        $user->removeAccount($employeeId);
        $this->showCreateAccount();
    }

    public function showCreationForm(){
        $this->requireRole('proprietario');
        $view = new VProprietario($this->isLoggedIn(), $this->userRole);
        $view -> showCreationForm();
    }

    public function showReviews(){
        $this->requireRole('proprietario');
        $view = new VProprietario($this->isLoggedIn(), $this->userRole);

        $allReviews = $this->persistent_manager->getAllReviews();

        $sort = $_GET['sort'] ?? 'newest';  
        $stars = $_GET['stars'] ?? 'all';    
        $search = $_GET['search'] ?? '';    

        if ($stars !== 'all') {
            $starsInt = intval($stars);
            $allReviews = array_filter($allReviews, function($review) use ($starsInt) {
                return $review->getVoto() === $starsInt;
            });
        }

        if (!empty($search)) {
            $searchLower = mb_strtolower($search);
            $allReviews = array_filter($allReviews, function($review) use ($searchLower) {
                $descrizione = mb_strtolower($review->getDescrizione());
                $nome = mb_strtolower($review->getCliente()->getNome());
                $cognome = mb_strtolower($review->getCliente()->getCognome());

                return (mb_stripos($descrizione, $searchLower) !== false)
                    || (mb_stripos($nome, $searchLower) !== false)
                    || (mb_stripos($cognome, $searchLower) !== false);
            });
        }

        if ($sort === 'newest') {
            usort($allReviews, function($a, $b) {
                return $b->getData() <=> $a->getData();
            });
        } elseif ($sort === 'oldest') {
            usort($allReviews, function($a, $b) {
                return $a->getData() <=> $b->getData();
            });
        }
        $view->showReviews($allReviews);
    }


    public function showMenu(){
        $this->requireRole('proprietario');
        $view = new VProprietario($this->isLoggedIn(), $this->userRole);
        $prodotti = $this->persistent_manager->getAllActiveProduct();

        $search = $_GET['search'] ?? '';
        $categoryFilter = $_GET['category'] ?? 'all';

        if ($categoryFilter !== 'all') {
            $prodotti = array_filter($prodotti, function($product) use ($categoryFilter) {
                return strtolower($product->getCategoria()->getNome()) === strtolower($categoryFilter);
            });
        }

        if (!empty($search)) {
            $searchLower = mb_strtolower($search);
            $prodotti = array_filter($prodotti, function($product) use ($searchLower) {
                return mb_stripos($product->getNome(), $searchLower) !== false
                    || mb_stripos($product->getDescrizione(), $searchLower) !== false;
            });
        }
        $view->showMenu($prodotti);
    }

    public function showOrders(){
        $this->requireRole('proprietario');
        $view = new VProprietario($this->isLoggedIn(), $this->userRole);
        $allOrders = $this->persistent_manager->getAllOrders();

        $search = $_GET['search'] ?? '';
        $status = $_GET['status'] ?? 'all';
        $sort = $_GET['sort'] ?? 'newest';

        if ($status !== 'all') {
            $allOrders = array_filter($allOrders, function($order) use ($status) {
                return $order->getStato() === $status;
            });
        }

        if (!empty($search)) {
            $searchLower = mb_strtolower($search);
            $allOrders = array_filter($allOrders, function($order) use ($searchLower) {
                $nome = mb_strtolower($order->getCliente()->getNome());
                $cognome = mb_strtolower($order->getCliente()->getCognome());
                $id = (string)$order->getId();

                return mb_stripos($nome, $searchLower) !== false
                    || mb_stripos($cognome, $searchLower) !== false
                    || mb_stripos($id, $searchLower) !== false;
            });
        }

        if ($sort === 'newest') {
            usort($allOrders, function($a, $b) {
                return $b->getDataEsecuzione() <=> $a->getDataEsecuzione();
            });
        } else { 
            usort($allOrders, function($a, $b) {
                return $a->getDataEsecuzione() <=> $b->getDataEsecuzione();
            });
        }
        $view->showOrders($allOrders);
    }

    public function showCreateAccount(){
        $this->requireRole('proprietario');
        $chefs = $this->persistent_manager->getAllChefs();
        $riders= $this->persistent_manager->getAllRiders();
        $view = new VProprietario($this->isLoggedIn(), $this->userRole);
        $view -> showCreateAccount($chefs, $riders);
    }

    public function saveProduct(){
        $this->requireRole('proprietario');

        $id = UHTTPMethods::post('product_id') ?? null;  
        $nome = trim(UHTTPMethods::post('nome') ?? '');
        $categoriaId = UHTTPMethods::post('categoria_id') ?? null;
        $descrizione = trim(UHTTPMethods::post('descrizione') ?? '');
        $costo = floatval(UHTTPMethods::post('costo') ?? 0);

        if (!$nome || !$categoriaId || !$descrizione || $costo <= 0) {
            die('Dati mancanti o non validi');
        }

        $categoria = $this->persistent_manager->getObj(\Entity\ECategoria::class, $categoriaId);

        if ($id) {
            $prodotto = $this->persistent_manager->getObj(EProdotto::class, $id);
            if (!$prodotto) {
                die('Prodotto non trovato');
            }
        } else {
            $prodotto = new EProdotto();
        }

        $prodotto->setNome($nome);
        $prodotto->setCategoria($categoria);
        $prodotto->setDescrizione($descrizione);
        $prodotto->setCosto($costo);

        $this->persistent_manager->saveObj($prodotto);
        header('Location: /Delivery/Proprietario/showMenu/'); 
            
    }

    public function deleteProduct(){
        $this->requireRole('proprietario');
        try{
            $prodottoId = UHTTPMethods::post('product_id');
            $prodotto = $this->persistent_manager->getObjOnAttribute(EProdotto::class, 'id', $prodottoId);
            $prodotto->setAttivo(false);
            $this->persistent_manager->updateObj($prodotto);
            $this->showMenu();
        } catch (\Exception $e) {
            $this->handleError($e);
        }
    }

    public function modifyProduct() {
        $this->requireRole('proprietario');

        $id = UHTTPMethods::post('product_id') ?? null;
        $nome = trim(UHTTPMethods::post('nome') ?? '');
        $categoriaId = UHTTPMethods::post('categoria_id') ?? null;
        $descrizione = trim(UHTTPMethods::post('descrizione') ?? '');
        $costo = floatval(UHTTPMethods::post('costo') ?? 0);

        if (!$nome || !$categoriaId || !$descrizione || $costo <= 0) {
            die('Dati mancanti o non validi');
        }

        $categoria = $this->persistent_manager->getObj(\Entity\ECategoria::class, $categoriaId);
        if (!$categoria) {
            die('Categoria non valida');
        }

        if ($id) {
            $prodotto = $this->persistent_manager->getObj(EProdotto::class, $id);
            if (!$prodotto) {
                die('Prodotto non trovato');
            }
        } else {
            $prodotto = new EProdotto();
        }

        $prodotto->setNome($nome);
        $prodotto->setCategoria($categoria);
        $prodotto->setDescrizione($descrizione);
        $prodotto->setCosto($costo);

        $this->persistent_manager->updateObj($prodotto);

        header('Location: /Delivery/Proprietario/showMenu/');
        exit;
    }


}