<?php

require_once 'vendor/autoload.php';

//use Doctrine\Common\Collections\ArrayCollection;
//use Foundation\FEntityManager;
use Foundation\FPersistentManager;

use Entity\EProdotto;
//use Entity\EOrdine;
//use Entity\ECategoria;
//use Entity\EElenco_prodotti;
//use Entity\EUtente;
//use Entity\ECarta_credito;
//use Entity\ERecensione;
//use Entity\ECliente;
//
//use Foundation\FProdotto;
//use Foundation\FOrdine;
//use Foundation\FUtente;
//use Foundation\FCarta_credito;
//use Foundation\FRecensione;

// Recupero del PersistentManager
try {
    $pm = FPersistentManager::getInstance();
    echo "✅ PersistentManager ottenuto correttamente.\n\n";
} catch (Exception $e) {
    die("❌ Errore nella creazione del PersistentManager: " . $e->getMessage());
}

try {
    // 🔍 getObj: recupera un prodotto con ID 1
    $prodotto = FPersistentManager::getObj(EProdotto::class, 1481);
    if ($prodotto) {
        echo "📦 Prodotto con ID 1481 trovato: " . $prodotto->getNome() . " - " . $prodotto->getCosto() . "€\n";
        // $pm->deleteObj($prodotto);
    } else {
        echo "⚠️ Nessun prodotto trovato con ID 1480.\n";
    }

   // 📋 getAll: recupera tutti i prodotti
  $prodotti = FPersistentManager::getAll(EProdotto::class);
   echo "\n📋 Tutti i prodotti nel database:\n ";
   foreach ($prodotti as $p) {
       echo "- " . $p->getNome() . " (" . $p->getCosto() . "€)\n";
   }

    // 🔍 getObjOnAttribute: trova prodotti con nome specifico
    $p = FPersistentManager::getInstance()->getObjOnAttribute(EProdotto::class, 'nome', 'aut');
    if($p){
        echo "\n🍕 Prodotti con nome 'aut':\n ";
        echo "- " . $p->getDescrizione() . " - " . $p->getCosto() . "€\n";
}

} catch (Exception $e) {
    echo "❌ Errore durante l'esecuzione dei metodi: " . $e->getMessage() . "\n";
}



