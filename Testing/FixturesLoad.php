<?php

namespace Testing;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/bootstrap.php';
require_once __DIR__ . '/Fixtures/Carta_creditoFixture.php';
require_once __DIR__ . '/Fixtures/CategoriaFixture.php';
require_once __DIR__ . '/Fixtures/Elenco_prodottiFixture.php';
require_once __DIR__ . '/Fixtures/IndirizzoFixture.php';
require_once __DIR__ . '/Fixtures/OrdineFixture.php';
require_once __DIR__ . '/Fixtures/ProdottoFixture.php';
require_once __DIR__ . '/Fixtures/RecensioneFixture.php';
require_once __DIR__ . '/Fixtures/SegnalazioneFixture.php';
require_once __DIR__ . '/Fixtures/UtenteFixture.php';



use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Testing\Fixtures\UserFixture;
use Testing\Fixtures\SegnalazioneFixture;
use Testing\Fixtures\RiderFixture;
use Testing\Fixtures\RecensioneFixture;
use Testing\Fixtures\ProdottoFixture;
use Testing\Fixtures\OrdineFixture;
use Testing\Fixtures\IndirizzoFixture;
use Testing\Fixtures\ElencoProdottiFixture;
use Testing\Fixtures\CuocoFixture;
use Testing\Fixtures\ClienteFixture;
use Testing\Fixtures\CategoriaFixture;
use Testing\Fixtures\CartaCreditoFixture;


$loader = new Loader();
$loader->addFixture(new IndirizzoFixture());
$loader->addFixture(new UserFixture());
/*
$loader->addFixture(new ClienteFixture());
$loader->addFixture(new CuocoFixture());
$loader->addFixture(new RiderFixture());
*/
$loader->addFixture(new ElencoProdottiFixture());
$loader->addFixture(new CategoriaFixture());
$loader->addFixture(new ProdottoFixture());
$loader->addFixture(new OrdineFixture());
$loader->addFixture(new RecensioneFixture());
$loader->addFixture(new SegnalazioneFixture());
$loader->addFixture(new CartaCreditoFixture());




$entityManager = getEntityManager();

$purger = new ORMPurger();
$executor = new ORMExecutor($entityManager, $purger);

$executor->purge(); // opzionale: svuota le tabelle
$executor->execute($loader->getFixtures());

echo "✅ Fixture caricate con successo.\n";
