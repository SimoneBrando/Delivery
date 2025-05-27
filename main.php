<?php

require_once 'vendor/autoload.php';

use Doctrine\Common\Collections\ArrayCollection;
use App\Foundation\FEntityManager;
use App\Foundation\FPersistentManager;

use App\Entity\EProdotto;
use App\Entity\EOrdine; 
use App\Entity\ECategoria;
use App\Entity\EElenco_prodotti;
use App\Entity\EUtente;
use App\Entity\ECarta_credito;
use App\Entity\ERecensione;
use App\Entity\ECliente;

use App\Foundation\FProdotto;
use App\Foundation\FOrdine;
use App\Foundation\FUtente;
use App\Foundation\FCarta_credito;
use App\Foundation\FRecensione;

// Recupero del PersistentManager
try {
    $pm = FPersistentManager::getInstance();
    echo "✅ PersistentManager ottenuto correttamente.\n\n";
} catch (Exception $e) {
    die("❌ Errore nella creazione del PersistentManager: " . $e->getMessage());
}

// CREA E SALVA EElenco_prodotti E CATEGORIA
$elenco = new EElenco_prodotti();
$pm->salvaObj($elenco);
echo $elenco->getId() ? "✅ Elenco prodotti salvato. ID: " . $elenco->getId() . "\n" : "❌ Elenco prodotti non salvato.\n";

$categoria = new ECategoria();
$categoria->setNome("Pizze");
$categoria->setElencoProdotti($elenco);
$pm->salvaObj($categoria);
echo $categoria->getId() ? "✅ Categoria salvata. ID: " . $categoria->getId() . "\n" : "❌ Categoria non salvata.\n";

$elenco->addCategoria($categoria);

// CREA E SALVA PRODOTTO
$prodotto = new EProdotto(
    "Pizza Margherita",
    "Pizza classica con pomodoro, mozzarella e basilico",
    7.50,
    $categoria
);

if (FProdotto::saveObj($prodotto)) {
    echo "✅ Prodotto salvato con successo. ID: " . $prodotto->getId() . "\n";
} else {
    echo "❌ Errore nel salvataggio del prodotto.\n";
}

// RICERCA PRODOTTO PER ID
$idProdotto = $prodotto->getId();
$prodottoRecuperato = FProdotto::getObj($idProdotto);

if ($prodottoRecuperato) {
    echo "✅ Prodotto recuperato: " . $prodottoRecuperato->getNome() . "\n";
} else {
    echo "❌ Prodotto non trovato con ID: $idProdotto\n";
}


// CREA E SALVA UTENTE
$nome="";
$cognome="";
$email="";
$password="";
$utente = new ECliente($nome,$cognome,$email,$password); 
$utente->setNome("Lina");
$utente->setCognome("Rossi");
$utente->setEmail("lina.rossi@example.com");
$utente->setPassword("password123");

if (FUtente::saveObj($utente)) {
    echo "✅ Cliente salvato con successo. ID: " . $utente->getId() . "\n";
} else {
    echo "❌ Errore nel salvataggio del cliente.\n";
}

// VERIFICA UTENTE
$utenteRecuperato = FUtente::getObj($utente->getId());
if ($utenteRecuperato) {
    echo "✅ Utente recuperato: " . $utenteRecuperato->getEmail() . "\n";
} else {
    echo "❌ Utente non trovato con ID: " . $utente->getId() . "\n";
}

// CREA E SALVA ORDINE CON IL PRODOTTO
$dataEsecuzione = new DateTime();
$dataRicezione = (clone $dataEsecuzione)->modify('+30 minutes');
$note = "Consegna veloce, grazie!";
$costo = $prodotto->getCosto();

$ordine = new EOrdine(
    [$prodotto],
    $note,
    $dataEsecuzione,
    $dataRicezione,
    $costo
);

$ordine->setUtente($utente);

if (FOrdine::saveObj($ordine)) {
    echo "✅ Ordine salvato con successo. ID: " . $ordine->getId() . "\n";
} else {
    echo "❌ Errore nel salvataggio dell'ordine.\n";
}

// VERIFICA ESISTENZA ORDINE
$idOrdine = $ordine->getId();
if (FOrdine::exists($idOrdine)) {
    echo "✅ Ordine esistente con ID: $idOrdine\n";
} else {
    echo "❌ Ordine non esistente con ID: $idOrdine\n";
}

// RICERCA ORDINE PER NUMERO
$numero = $ordine->getId();
$ordini = FOrdine::search($numero);

if (!empty($ordini)) {
    echo "✅ Trovati " . count($ordini) . " ordini con numero simile a $numero\n";
} else {
    echo "❌ Nessun ordine trovato con numero simile a $numero\n";
}



// CREA E SALVA CARTA DI CREDITO COLLEGATA ALL’UTENTE
$numeroCarta="";
$nomeCarta="VISA";
$dataScadenza = new DateTime('2027-12-01');
$cvv="";
$nomeIntenstatario = "";
$carta = new ECarta_credito($numeroCarta, $nomeCarta, $dataScadenza, $cvv, $nomeIntenstatario, $utente);
$carta->setNumeroCarta("1237-5678-9012-3456");
$carta->setNomeIntestatario("Mario Rossi");
$carta->setCvv("098");



if (FCarta_credito::saveObj($carta)) {
    echo "✅ Carta di credito salvata. ID: " . $carta->getNumeroCarta() . "\n";
} else {
    echo "❌ Errore nel salvataggio della carta di credito.\n";
}

// CREA E SALVA RECENSIONE COLLEGATA A UTENTE
$descrizione = "Ottima pizza, molto buona!";
$voto = 5; 
$data = new DateTime(12-01-2012);
$recensione = new ERecensione($descrizione, $voto, $data, $utente);

if (FRecensione::saveObj($recensione)) {
    echo "✅ Recensione salvata. ID: " . $recensione->getId() . "\n";
} else {
    echo "❌ Errore nel salvataggio della recensione.\n";
}

// VERIFICA RECENSIONE
$recensioneRecuperata = FRecensione::getObj($recensione->getId());
if ($recensioneRecuperata) {
    echo "✅ Recensione recuperata. Testo: " . $recensioneRecuperata->getDescrizione() . "\n";
} else {
    echo "❌ Recensione non trovata con ID: " . $recensione->getId() . "\n";
}
