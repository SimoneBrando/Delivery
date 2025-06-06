<?php

require_once 'vendor/autoload.php';

//use Doctrine\Common\Collections\ArrayCollection;
//use Foundation\FEntityManager;
use Entity\EUtente;
use Foundation\FPersistentManager;
use Entity\EProdotto;
use Entity\EOrdine;
use Entity\ECategoria;
use Entity\EElenco_Prodotti;
use Entity\ECarta_credito;
use Entity\ERecensione;
use Entity\ECliente;


// Recupero del PersistentManager
try {
    $pm = FPersistentManager::getInstance();
    echo "✅ PersistentManager ottenuto correttamente.\n\n";
} catch (Exception $e) {
    die("❌ Errore nella creazione del PersistentManager: " . $e->getMessage());
}

/*
try {
    // 🔍 getObj: recupera un prodotto con ID 1
    $prodotto = FPersistentManager::getObj(EProdotto::class, 1481);
    if ($prodotto) {
        echo "📦 Prodotto con ID 1481 trovato: " . $prodotto->getNome() . " - " . $prodotto->getCosto() . "€\n";
        // $pm->deleteObj($prodotto);
    } else {
        echo "⚠️ Nessun prodotto trovato con ID 1480.\n";
    }

   // 📋 getAll: recupera tutti i Products
  $Products = FPersistentManager::getAll(EProdotto::class);
   echo "\n📋 Tutti i Products nel database:\n ";
   foreach ($Products as $p) {
       echo "- " . $p->getNome() . " (" . $p->getCosto() . "€)\n";
   }

    // 🔍 getObjOnAttribute: trova Products con nome specifico
    $p = FPersistentManager::getInstance()->getObjOnAttribute(EProdotto::class, 'nome', 'aut');
    if($p){
        echo "\n🍕 Products con nome 'aut':\n ";
        echo "- " . $p->getDescrizione() . " - " . $p->getCosto() . "€\n";
}

} catch (Exception $e) {
    echo "❌ Errore durante l'esecuzione dei metodi: " . $e->getMessage() . "\n";
}
*/

//try{
//    $utente = FPersistentManager::getObj(EUtente::class, 841);
//    if($utente){
//        echo $utente->getNome() . "\n" . $utente->getCognome() . "\n" . $utente->getEmail() . "\n";
//    }
//
//    $result = FPersistentManager::VerifyUserEmail('rizzo1.costantino@example.com');
//    echo $result;
//} catch (Exception $e){
//    echo "errore";
//}



//try{
//    $Reviews = FPersistentManager::getAllReviews();
//    foreach($Reviews as $rec){
//        echo $rec->getDescrizione() . " - " . $rec->getVoto() . "\n" . $rec->getData()->format('Y-m-d H:i:s') . "\n" ;
//    }
//
//} catch (Exception $e){
//    echo "errore";
//}

//try{
//    $Warnings = FPersistentManager::getAllWarnings();
//    foreach($Warnings as $rec){
//        echo "\n\nDescrizione segnalazione: " . $rec->getDescrizione() . " \nTesto Segnalazione: " . $rec->getTesto() . "\n" . $rec->getData()->format('Y-m-d H:i:s') . "\n";
//        echo "Id Utente: " . $rec->getUtente()->getId();
//
//
//    }
//
//} catch (Exception $e){
//    echo "errore";
//}

//try{
//    $i=0;
//    $Orders = FPersistentManager::getAllOrders();
//    foreach($Orders as $rec){
//        echo "\nId ordine: ".$rec->getId()."\n";
//        echo "\nId utente: ".$rec->getUtente()->getId()."\n";
//        echo "\nNote: ".$rec->getNote()."\n";
//        echo "\nData Esecuzione: ".$rec->getDataEsecuzione()->format('Y-m-d H:i:s')."\n";
//        echo "\nData Ricezione: ".$rec->getDataRicezione()->format('Y-m-d H:i:s')."\n";
//        echo "\nCosto: " .$rec->getCosto()."\n";
//        echo "\nStato: ".$rec->getStato()."\n";
//        foreach($rec->getProducts() as $prodotto){
//            $i++;
//            echo "\nProdotto ".$i.": ".$prodotto->getNome()."\n";
//        }
//
//
//
//    }
//
//} catch (Exception $e){
//    echo "errore";
//}
//


//try{
//    $i=0;
//    $p = FPersistentManager::getAllProducts();
//    foreach($p as $rec){
//        echo"\nId Prodotto: ".$rec->getId()."\n";
//        echo"Nome: ".$rec->getNome()."\n";
//        echo"Costo: ".$rec->getCosto()."\n";
//        echo"Descrizione: ".$rec->getDescrizione()."\n";
//        echo"Categoria: ".$rec->getCategoria()->getNome()."\n";
//
//
//
//    }
//
//} catch (Exception $e){
//    echo "errore";
//}

//
//try{
//    $i=0;
//    $u = FPersistentManager::getAllUsers();
//    foreach($u as $rec){
//        echo "\nId utente:  " . $rec->getId() . "\n";
//        echo "Nome: " . $rec->getNome() . "\n";
//        echo "Cognome: " . $rec->getCognome() . "\n";
//        echo "Email: " . $rec->getEmail() . "\n";
//        echo"Password: " . $rec->getPassword() . "\n";
//        echo"Ruolo: " . $rec->getRuolo() . "\n";
//
//
//
//    }
//
//} catch (Exception $e){
//    echo "errore";
//}


//try{
//    $i=0;
//    $u = FPersistentManager::getAllRiders();
//    foreach($u as $rec){
//        echo "\nId utente:  " . $rec->getId() . "\n";
//        echo "Nome: " . $rec->getNome() . "\n";
//        echo "Cognome: " . $rec->getCognome() . "\n";
//        echo "Email: " . $rec->getEmail() . "\n";
//        echo"Password: " . $rec->getPassword() . "\n";
//        echo"Ruolo: " . $rec->getRuolo() . "\n";
//        echo"Codice Rider: " . $rec->getCodiceRider() . "\n";
//
//
//
//    }
//
//} catch (Exception $e){
//    echo "errore";
//}
//

//try{
//    $i=0;
//    $u = FPersistentManager::getAllChefs();
//    foreach($u as $rec){
//        echo "\nId utente:  " . $rec->getId() . "\n";
//        echo "Nome: " . $rec->getNome() . "\n";
//        echo "Cognome: " . $rec->getCognome() . "\n";
//        echo "Email: " . $rec->getEmail() . "\n";
//        echo"Password: " . $rec->getPassword() . "\n";
//        echo"Ruolo: " . $rec->getRuolo() . "\n";
//        echo"Codice Rider: " . $rec->getCodiceCuoco() . "\n";
//
//
//
//    }
//
//} catch (Exception $e){
//    echo "errore";
//}

//try {
//    $i = 0;
//    $u = FPersistentManager::getAllChefs();
//    foreach ($u as $rec) {
//        echo "\nId utente:  " . $rec->getId() . "\n";
//        echo "Nome: " . $rec->getNome() . "\n";
//        echo "Cognome: " . $rec->getCognome() . "\n";
//        echo "Email: " . $rec->getEmail() . "\n";
//        echo "Password: " . $rec->getPassword() . "\n";
//        echo "Ruolo: " . $rec->getRuolo() . "\n";
//        echo "Codice Rider: " . $rec->getCodiceCuoco() . "\n";
//
//
//    }
//
//} catch (Exception $e) {
//    echo "errore";
//}


////Demo per metodo che estrae tutti gli ordini di un certo utente fornendo l'id
//try {
//    $i = 0;
//    $user = FPersistentManager::getObj(ECliente::class, 842 );
//    $u = FPersistentManager::getOrdersByClient($user->getId());
//    foreach ($u as $rec) {
//        echo "\nId ordine: ".$rec->getId()."\n";
//        echo "\nId utente: ".$rec->getUtente()->getId()."\n";
//        echo "\nNote: ".$rec->getNote()."\n";
//        echo "\nData Esecuzione: ".$rec->getDataEsecuzione()->format('Y-m-d H:i:s')."\n";
//        echo "\nData Ricezione: ".$rec->getDataRicezione()->format('Y-m-d H:i:s')."\n";
//        echo "\nCosto: " .$rec->getCosto()."\n";
//        echo "\nStato: ".$rec->getStato()."\n";
//        foreach($rec->getProdotti() as $prodotto){
//            $i++;
//            echo "\nProdotto ".$i.": ".$prodotto->getNome()."\n";
//        }
//
//
//    }
//
//} catch (Exception $e) {
//    echo "errore";
//}
//
//

////Demo per metodo che estrae tutti gli ordini di un certo utente fornendo l'id
//try {
//    $i = 0;
//    $u = FPersistentManager::getOrdersByState('in_attesa');
//    foreach ($u as $rec) {
//        echo "\nId ordine: ".$rec->getId()."\n";
//        echo "\nId utente: ".$rec->getUtente()->getId()."\n";
//        echo "\nNote: ".$rec->getNote()."\n";
//        echo "\nData Esecuzione: ".$rec->getDataEsecuzione()->format('Y-m-d H:i:s')."\n";
//        echo "\nData Ricezione: ".$rec->getDataRicezione()->format('Y-m-d H:i:s')."\n";
//        echo "\nCosto: " .$rec->getCosto()."\n";
//        echo "\nStato: ".$rec->getStato()."\n";
//        foreach($rec->getProdotti() as $prodotto){
//            $i++;
//            echo "\nProdotto ".$i.": ".$prodotto->getNome()."\n";
//        }
//
//
//    }
//
//} catch (Exception $e) {
//    echo "errore";
//}
//


//Demo per metodo che estrae tutti gli ordini di un certo utente fornendo l'id
try {
    $i=0;
    $time = new \DateTime('2025-06-03');
    $u = FPersistentManager::getDailyOrders($time);
    foreach ($u as $rec) {
        echo "\nId ordine: ".$rec->getId()."\n";
        echo "\nId utente: ".$rec->getUtente()->getId()."\n";
        echo "\nNote: ".$rec->getNote()."\n";
        echo "\nData Esecuzione: ".$rec->getDataEsecuzione()->format('Y-m-d H:i:s')."\n";
        echo "\nData Ricezione: ".$rec->getDataRicezione()->format('Y-m-d H:i:s')."\n";
        echo "\nCosto: " .$rec->getCosto()."\n";
        echo "\nStato: ".$rec->getStato()."\n";
        foreach($rec->getProdotti() as $prodotto){
            $i++;
            echo "\nProdotto ".$i.": ".$prodotto->getNome()."\n";
        }


    }

} catch (Exception $e) {
    echo "errore" . $e . "\n";
}






