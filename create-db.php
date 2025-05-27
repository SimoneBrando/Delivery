<?php
$entityManager = require_once "bootstrap.php"; // ⬅️ ora assegniamo ciò che bootstrap.php ritorna

use Doctrine\ORM\Tools\SchemaTool;
use App\Entity\EUtente;
use App\Entity\EOrdine;
use App\Entity\EProdotto;
use App\Entity\ESegnalazione;
use App\Entity\ERecensione;
use App\Entity\ECarta_credito;
use App\Entity\EIndirizzo;
use App\Entity\ECliente;
use App\Entity\ERider;
use App\Entity\ECuoco;
use App\Entity\ECategoria;
use App\Entity\EElenco_prodotti;


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
