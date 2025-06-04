
<?php
$entityManager = require_once "bootstrap.php"; // ⬅️ ora assegniamo ciò che bootstrap.php ritorna

use Doctrine\ORM\Tools\SchemaTool;
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

];

$schemaTool->dropDatabase();
$schemaTool->createSchema($classes);

echo "Database creato con successo.\n";
