<?php 
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Services\Utility\UFlashMessage;
use View\VProprietario;
use Services\Utility\UHTTPMethods;
use Entity\EProdotto;
use Entity\EWeeklyCalendar;
use Entity\EExceptionCalendar;
use Datetime;

class CProprietario extends BaseController {

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

        $contatori = [];
        foreach ($allOrders as $ordine) {
            $userId = $ordine->getCliente()->getId();
            if (!isset($contatori[$userId])) {
                $contatori[$userId] = [
                    'utente' => $ordine->getCliente(),
                    'conteggio' => 0
                ];
            }
            $contatori[$userId]['conteggio']++;
        }
        // Filtra $maxUtenti utenti con almeno $minOrdini ordini
        $minOrdini = 1;
        $maxUtenti = 5;
        $utentiConMoltiOrdini = array_filter($contatori, function ($info) use($minOrdini) {
            return $info['conteggio'] >= $minOrdini;
        });
        // Ordina per numero di ordini decrescente
        usort($utentiConMoltiOrdini, function ($a, $b) {
            return $b['conteggio'] <=> $a['conteggio'];
        });
        $utentiConMoltiOrdini = array_slice($utentiConMoltiOrdini, 0,$maxUtenti);

        $inizio = new DateTime('-7 days');
        $oggi = new DateTime();
        $ordiniPerGiorno = [];
        while ($inizio <= $oggi) {
            $key = $inizio->format('d/m/Y');
            $ordiniPerGiorno[$key] = 0;
            $inizio->modify('+1 day');
        }
        
        foreach ($allOrders as $ordine) {
            $data = $ordine->getDataEsecuzione()->format('d/m/Y');
            if (isset($ordiniPerGiorno[$data])) {
                $ordiniPerGiorno[$data]++;
            }
        }
        $view = new VProprietario($this->isLoggedIn(), $this->userRole);
        $view -> showDashboard($orders, $totaleOggi, $numeroClienti, $ordiniOggi, $mediaValutazioni, array_values($fatturatoSettimana), $nomiTopPiatti, $quantitaTopPiatti, $utentiConMoltiOrdini, $minOrdini, $ordiniPerGiorno);
        
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
            UFlashMessage::addMessage('success', 'Account dipendente creato con successo');
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
        UFlashMessage::addMessage('success', 'Account dipendente eliminato con successo');
        header("Location: /Delivery/Proprietario/showCreateAccount");
        exit;
    }

    public function showCreationForm(){
        $this->requireRole('proprietario');
        $messages = UFlashMessage::getMessage();
        $view = new VProprietario($this->isLoggedIn(), $this->userRole, $messages);
        $view -> showCreationForm();
    }

    public function showReviews(){
        $this->requireRole('proprietario');
        $messages = UFlashMessage::getMessage();
        $view = new VProprietario($this->isLoggedIn(), $this->userRole, $messages);

        $allReviews = $this->persistent_manager->getAllReviews();

        $sort = UHTTPMethods::get('sort') ?? 'newest';  
        $stars = UHTTPMethods::get('stars') ?? 'all';    
        $search = UHTTPMethods::get('search') ?? '';    

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

    public function showSegnalazioni() {
        $this->requireRole('proprietario');
        $messages = UFlashMessage::getMessage();
        $view = new VProprietario($this->isLoggedIn(), $this->userRole, $messages);

        $segnalazioni = $this->persistent_manager->getAllWarnings();

        $sort = UHTTPMethods::get('sort') ?? 'newest';
        $search = UHTTPMethods::get('search') ?? '';

        if (!empty($search)) {
            $searchLower = mb_strtolower($search);

            $segnalazioni = array_filter($segnalazioni, function($segnalazione) use ($searchLower) {
                $descrizione = mb_strtolower($segnalazione->getDescrizione());
                $nome = '';
                $cognome = '';

                $cliente = $segnalazione->getOrdine()?->getCliente();
                if ($cliente) {
                    $nome = mb_strtolower($cliente->getNome());
                    $cognome = mb_strtolower($cliente->getCognome());
                }

                return (mb_stripos($descrizione, $searchLower) !== false)
                    || (mb_stripos($nome, $searchLower) !== false)
                    || (mb_stripos($cognome, $searchLower) !== false);
            });
        }

        if ($sort === 'newest') {
            usort($segnalazioni, function($a, $b) {
                return $b->getData() <=> $a->getData();
            });
        } elseif ($sort === 'oldest') {
            usort($segnalazioni, function($a, $b) {
                return $a->getData() <=> $b->getData();
            });
        }

        $view->showSegnalazioni($segnalazioni);
    }


    public function showMenu(){
        $this->requireRole('proprietario');
        $messages = UFlashMessage::getMessage();
        $view = new VProprietario($this->isLoggedIn(), $this->userRole, $messages);
        $prodotti = $this->persistent_manager->getAllActiveProduct();

        $search = UHTTPMethods::get('search') ?? '';
        $categoryFilter = UHTTPMethods::get('category') ?? 'all';

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
        usort($prodotti, function ($a, $b) {
            return $a->getCategoria()->getId() <=> $b->getCategoria()->getId(); // ordinamento crescente
        });
        $view->showMenu($prodotti);
    }

    public function showOrders(){
        $this->requireRole('proprietario');
        $messages = UFlashMessage::getMessage();
        $view = new VProprietario($this->isLoggedIn(), $this->userRole, $messages);
        $allOrders = $this->persistent_manager->getAllOrders();

        $search = UHTTPMethods::get('search') ?? '';
        $status = UHTTPMethods::get('status') ?? 'all';
        $sort = UHTTPMethods::get('sort') ?? 'newest';

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

    public function showCalendar(){
        $daysOrder =[
            'lunedì' => 1,
            'martedì' => 2,
            'mercoledì' => 3,
            'giovedì' => 4,
            'venerdì' => 5,
            'sabato' => 6,
            'domenica' => 7,
        ];
        $this->requireRole('proprietario');
        $messages = UFlashMessage::getMessage();
        $view = new VProprietario($this->isLoggedIn(), $this->userRole, $messages);
        $giorniChiusuraSettimanali = $this->persistent_manager->getCalendar();
        usort($giorniChiusuraSettimanali, function ($a, $b) use ($daysOrder) {
            return $daysOrder[$a->getData()] <=> $daysOrder[$b->getData()];
        });
        $giorniChiusuraEccezionali = $this->persistent_manager->getExceptionClosedDays();
        $view -> showCalendar($giorniChiusuraSettimanali, $giorniChiusuraEccezionali);
    }

    public function showCreateAccount(){
        $this->requireRole('proprietario');
        $messages = UFlashMessage::getMessage();
        $chefs = $this->persistent_manager->getAllActiveChefs();
        $riders= $this->persistent_manager->getAllActiveRiders();
        $view = new VProprietario($this->isLoggedIn(), $this->userRole, $messages);
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
            $prodottiNonAttivi = $this->persistent_manager->getAllNonActiveProduct();
            $risultato = array_filter($prodottiNonAttivi, function($p) use ($nome) {
                return $p->getNome() === $nome;
            });
            $prodottoTrovato = reset($risultato);
            $prodotto = $prodottoTrovato ? $prodottoTrovato : new EProdotto();
        }

        $prodotto->setNome($nome)
            ->setCategoria($categoria)
            ->setDescrizione($descrizione)
            ->setCosto($costo)
            ->setAttivo(true);


        $this->persistent_manager->saveObj($prodotto);
        UFlashMessage::addMessage('success', 'Prodotto aggiunto con successo');
        header('Location: /Delivery/Proprietario/showMenu/'); 
            
    }

    public function deleteProduct(){
        $this->requireRole('proprietario');
        try{
            $prodottoId = UHTTPMethods::post('product_id');
            $prodotto = $this->persistent_manager->getObjOnAttribute(EProdotto::class, 'id', $prodottoId);
            $prodotto->setAttivo(false);
            $this->persistent_manager->updateObj($prodotto);
            UFlashMessage::addMessage('success', 'Prodotto rimosso con successo');
            header('Location: /Delivery/Proprietario/showMenu/'); 
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
        UFlashMessage::addMessage('success', 'Prodotto modificato con successo');
        header('Location: /Delivery/Proprietario/showMenu/'); 
        exit;
    }

    public function addExceptionDay() {
        $this->requireRole('proprietario');
        $data = UHTTPMethods::post('dataChiusura') ?? null;
        if (!$data) {
            die('Data mancante');
        }

        $giorno = new DateTime($data);
        $giorno->setTime(0, 0, 0);

        $eccezione = new EExceptionCalendar();
        $eccezione->setExceptionDate($giorno);
        $eccezione->setAperto(false);

        if ($this->persistent_manager->addExceptionDay($eccezione)) {
            UFlashMessage::addMessage('success', 'Giorno di chiusura eccezionale aggiunto con successo');
        } else {
            UFlashMessage::addMessage('error', 'Errore durante l\'aggiunta del giorno di chiusura eccezionale');
        }

        header("Location: /Delivery/Proprietario/showCalendar");
    }

    public function deleteExceptionDay() {
        $this->requireRole('proprietario');
        $data = UHTTPMethods::post('dataChiusura') ?? null;
        if (!$data) {
            die('Data mancante');
        }

        $giorno = new DateTime($data);
        $giorno->setTime(00, 00, 00);

        $eccezione = $this->persistent_manager->getObjOnAttribute(EExceptionCalendar::class, 'exceptionDate', $giorno);

        if ($eccezione) {
            if ($this->persistent_manager->deleteExceptionDay($eccezione)) {
                UFlashMessage::addMessage('success', 'Giorno di chiusura eccezionale rimosso con successo');
            } else {
                UFlashMessage::addMessage('error', 'Errore durante la rimozione del giorno di chiusura eccezionale');
            }
        } else {
            UFlashMessage::addMessage('error', 'Giorno di chiusura eccezionale non trovato');
        }

        header("Location: /Delivery/Proprietario/showCalendar");
    }

   public function editDay() {
        $this->requireRole('proprietario');

        $orari = UHTTPMethods::post('orari') ?? [];

        $data = UHTTPMethods::post('giorno');
        $apertura = $orari['apertura'] ?? null;
        $chiusura = $orari['chiusura'] ?? null;
        $stato = $orari['stato'];

        $giornoSettimanale = $this->persistent_manager->getObjOnAttribute(EWeeklyCalendar::class, 'data', $data);

        if ($stato=="chiuso") {
            $giornoSettimanale->setAperto(false);
            $giornoSettimanale->setOrarioApertura(null);
            $giornoSettimanale->setOrarioChiusura(null);


        } else {
            $giornoSettimanale->setAperto(true);

    
            $orarioApertura = DateTime::createFromFormat('H:i', $apertura); // ad esempio 04-07.2025 21:00:00
            $orarioChiusura = DateTime::createFromFormat('H:i', $chiusura);

            if($orarioApertura < $orarioChiusura){

                $giornoSettimanale->setOrarioApertura($orarioApertura);
                $giornoSettimanale->setOrarioChiusura($orarioChiusura);

            }

            else {
                UFlashMessage::addMessage('error', 'L\'orario di apertura deve essere precedente all\'orario di chiusura');
                header("Location: /Delivery/Proprietario/showCalendar");
                return;
            }
                



        }

        if ($this->persistent_manager->editDay($giornoSettimanale)) {
            UFlashMessage::addMessage('success', 'Giorno modificato con successo');
        } else {
            UFlashMessage::addMessage('error', 'Errore durante la modifica del giorno');
        }

        header("Location: /Delivery/Proprietario/showCalendar");
    }

}