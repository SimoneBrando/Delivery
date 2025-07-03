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
use Entity\EItemCarrello;
use Entity\EWeeklyCalendar;
use Entity\EExceptionCalendar;


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

//
////Demo per metodo che estrae tutti gli ordini di un certo utente fornendo l'id
//try {
//    $i = 0;
//    $user = FPersistentManager::getObj(ECliente::class, 241 );
//    $u = FPersistentManager::getOrdersByClient($user->getId());
//    foreach ($u as $rec) {
//        echo "\nId ordine: ".$rec->getId()."\n";
//        echo "\nId utente: ".$rec->getCliente()->getId()."\n";
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


////Demo per metodo che estrae tutti gli ordini giornalieri
//try {
//    $i=0;
//    $time = new \DateTime('2025-06-03');
//    $u = FPersistentManager::getDailyOrders($time);
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
//    echo "errore" . $e . "\n";
//}

////Demo per metodo che restituisce il menù
//try {
//    $u = FPersistentManager::getMenu();
//    print_r($u);
//
//} catch (Exception $e) {
//    echo "errore" . $e . "\n";
//}

////Demo per metodo che estrae tutte le carte di credito di un certo utente fornendo l'id
//try {
//    $u = FPersistentManager::getCreditCardByClientId(860);
//    foreach ($u as $carta) {
//        echo 'Numero: ' . $carta->getNumeroCarta() . PHP_EOL;
//        echo 'Intestatario: ' . $carta->getNomeIntestatario() . PHP_EOL;
//        echo 'Utente ID: ' . $carta->getNominativo() . PHP_EOL;
//    }
//
//} catch (Exception $e) {
//    echo "errore" . $e . "\n";
//}

////Demo per metodo che estrae tutti gli indirizzi di un certo cliente fornendo l'id
//try {
//    $u = FPersistentManager::getAddressByClientId(841);
//    foreach ($u as $indirizzo) {
//        echo 'id Indirizzo: ' . $indirizzo->getId() . PHP_EOL;
//        echo 'Via: ' . $indirizzo->getVia() . PHP_EOL;
//        echo 'Civico: ' . $indirizzo->getCivico() . PHP_EOL;
//        echo 'Città: ' . $indirizzo->getCitta() . PHP_EOL;
//    }
//
//} catch (Exception $e) {
//    echo "errore" . $e . "\n";
//}

////Demo per metodo che estrae tutte le segnalazioni di un certo utente fornendo l'id
//try {
//    $u = FPersistentManager::getWarningsByClientId(841);
//    foreach ($u as $segnalazione) {
//        echo 'id Indirizzo: ' . $segnalazione->getId() . PHP_EOL;
//        echo 'Descrizione: ' . $segnalazione->getDescrizione() . PHP_EOL;
//
//    }
//
//} catch (Exception $e) {
//    echo "errore" . $e . "\n";
//}

//
////Demo per metodo che estrae tutte le recensioni
//try {
//    $u = FPersistentManager::getAllReviews();
//    foreach ($u as $recensione) {
//        echo 'id Indirizzo: ' . $recensione->getId() . PHP_EOL;
//        echo 'Descrizione: ' . $recensione->getDescrizione() . PHP_EOL;
//
//    }
//
//} catch (Exception $e) {
//    echo "errore" . $e . "\n";
//}


////Demo per metodo che estrae tutte le recensioni di un certo cliente
//try {
//    $u = FPersistentManager::getReviewByClientId(860);
//    foreach ($u as $recensione) {
//        echo 'id Indirizzo: ' . $recensione->getId() . PHP_EOL;
//        echo 'Descrizione: ' . $recensione->getDescrizione() . PHP_EOL;
//
//    }
//
//} catch (Exception $e) {
//    echo "errore" . $e . "\n";
//}


/*
try {
    $u = FPersistentManager::getCartByClientId(1);

    if ($u) {
        echo "Carrello trovato per il cliente con ID 1.\n";

        
        // Aggiunta di 10 unità del prodotto 10
        $item = new EItemCarrello();
        $item->setProdotto(FPersistentManager::getObj(EProdotto::class, 10))
             ->setCarrello($u)
             ->setQuantita(10)
             ->setPrezzoUnitario(10.99);


        FPersistentManager::addOrUpdateItemToCart(1, $item);

        

        // Rimuovo 2 unità del prodotto 10
        $itemToRemove = new EItemCarrello();
        $itemToRemove->setProdotto(FPersistentManager::getObj(EProdotto::class, 10))
                     ->setQuantita(2);

        FPersistentManager::removeOrUpdateItemFromCart(1, $itemToRemove);

        // Verifica finale
        foreach ($u->getCarrelloItems() as $item) {
            echo "Prodotto: " . $item->getProdotto()->getNome() . ", Quantità: " . $item->getQuantita() . "\n";
        }

    } else {
        echo "Nessun carrello trovato per il cliente con ID 1.\n";
    }

} catch (Exception $e) {
    echo "Errore durante il recupero del carrello: " . $e->getMessage() . "\n";
}

*/

/*
$date = FPersistentManager::getInstance()->getWeeklyClosedDays();
if ($date) {
    echo "Giorni di chiusura settimanale:\n";
    foreach ($date as $day) {
        echo "- " . $day->getData() . ": " . ($day->isAperto() ? "Aperto" : "Chiuso") . "\n";
    }
} else {
    echo "Nessun giorno di chiusura settimanale trovato.\n";
}
    */


$date = FPersistentManager::getInstance()->getExceptionClosedDays();
if ($date) {
    echo "Giorni di chiusura eccezionale:\n";
    foreach ($date as $day) {
        echo "- " . $day->getExceptionDate()->format('Y-m-d H:i:s') . ": " . ($day->isAperto() ? "Aperto" : "Chiuso") . "\n";
    }
} else {
    echo "Nessun giorno di chiusura eccezionale trovato.\n";
}




