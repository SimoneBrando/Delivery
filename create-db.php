
<?php
require_once "bootstrap.php";


use Doctrine\ORM\Tools\SchemaTool;
use Entity\EProprietario;
use Entity\EUtente;
use Entity\EOrdine;
use Entity\EProdotto;
use Entity\ESegnalazione;
use Entity\ERecensione;
use Entity\ECarta_credito;
use Entity\EIndirizzo;
use Entity\ECliente;
use Entity\ERider;
use Entity\ECuoco;
use Entity\ECategoria;
use Entity\EElenco_prodotti;
use Entity\ECarrello;
use Entity\EItemCarrello;

try {
    $dbAuth = getAuthDb(); // Connessione al database auth_db
    $sqlAuth = file_get_contents(__DIR__ . '/vendor/delight-im/auth/Database/MySQL.sql');
    $statements = array_filter(array_map('trim', explode(';', $sqlAuth)));
    foreach ($statements as $stmt) {
        if ($stmt !== '') {
            $dbAuth->exec($stmt);
            echo "Tabella di PHP-Auth creata in auth_db.\n";
        }
    }
} catch (Exception $e) {
    die("Errore PHP-Auth: " . $e->getMessage());
}

$entityManager = getEntityManager(); // ottieni l'EntityManager


$schemaTool = new SchemaTool($entityManager);
$classes = [
    $entityManager->getClassMetadata(EUtente::class),
    $entityManager->getClassMetadata(EOrdine::class),
    $entityManager->getClassMetadata(EProdotto::class),
    $entityManager->getClassMetadata(ESegnalazione::class),
    $entityManager->getClassMetadata(ERecensione::class),
    $entityManager->getClassMetadata(ECarta_credito::class),
    $entityManager->getClassMetadata(EIndirizzo::class),
    $entityManager->getClassMetadata(ECliente::class),
    $entityManager->getClassMetadata(ERider::class),
    $entityManager->getClassMetadata(ECuoco::class),
    $entityManager->getClassMetadata(ECategoria::class),
    $entityManager->getClassMetadata(EElenco_prodotti::class),
    $entityManager->getClassMetadata(ECarrello::class),
    $entityManager->getClassMetadata(EItemCarrello::class),
    $entityManager->getClassMetadata(EProprietario::class),

];

$schemaTool->dropDatabase();
$schemaTool->createSchema($classes);

echo "Database creato con successo.\n";
