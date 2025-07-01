<?php
require_once "bootstrap.php";

use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
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
use Entity\EItemOrdine;

// Creazione tabelle di PHP-Auth
try {
    $dbAuth = getAuthDb(); // Connessione al database auth_db
    $sqlAuth = file_get_contents(__DIR__ . '/vendor/delight-im/auth/Database/MySQL.sql');
    $statements = array_filter(array_map('trim', explode(';', $sqlAuth)));
    $tablesToDrop = ['users', 'users_2fa', 'users_audit_log', 'users_confirmations', 'users_otps', 'users_remembered', 'users_resets', 'users_throttling'];

    foreach ($tablesToDrop as $table) {
        $dbAuth->exec("DROP TABLE IF EXISTS `{$table}`");
        echo "Tabella {$table} eliminata con successo.\n";
    }

    foreach ($statements as $stmt) {
        if ($stmt !== '') {
            $dbAuth->exec($stmt);
            echo "Tabella di PHP-Auth creata in auth_db.\n";
        }
    }
} catch (Exception $e) {
    die("Errore PHP-Auth: " . $e->getMessage());
}

// Configura Doctrine per gestire ENUM come string
$entityManager = getEntityManager();
$platform = $entityManager->getConnection()->getDatabasePlatform();
if (!$platform->hasDoctrineTypeMappingFor('enum')) {
    $platform->registerDoctrineTypeMapping('enum', 'string');
}

$entityManager->getConnection()->executeStatement('SET FOREIGN_KEY_CHECKS = 0');

// Generazione dello schema delle entità
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
    $entityManager->getClassMetadata(EItemOrdine::class),
    $entityManager->getClassMetadata(EProprietario::class),
];

$schemaTool->dropDatabase();
$schemaTool->createSchema($classes);

$entityManager->getConnection()->executeStatement('SET FOREIGN_KEY_CHECKS = 1');

echo "Database creato con successo, tutte le tabelle sono nello stesso database.\n";
