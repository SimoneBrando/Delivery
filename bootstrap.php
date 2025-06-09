<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Delight\Auth\Auth;
use Delight\Db\PdoDatabase;
use Delight\Db\PdoDsn;

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/config.php";

function getEntityManager(): EntityManager
{
    $isDevMode = true;

    $config = new Configuration();
    $driver = new AnnotationDriver(
        new AnnotationReader(),
        [__DIR__ . "/Entity"]
    );
    $config->setMetadataDriverImpl($driver);
    $config->setProxyDir(__DIR__ . "/var/proxies");
    $config->setProxyNamespace('Proxies');
    $config->setAutoGenerateProxyClasses(false);


    $conn = [
        'driver'   => DB_DRIVER,
        'host'     => DB_HOST,
        'port'     => DB_PORT,
        'dbname'   => DB_NAME,
        'user'     => DB_USER,
        'password' => DB_PASS,
        'charset'  => DB_CHARSET,
    ];

    return EntityManager::create($conn, $config);
}

function getAuth(): Auth
{
    $db = getAuthDb();
    return new Auth($db, throttling: false);
}

function getAuthDb(): PdoDatabase
{
    $dbName = DB_AUTH_NAME;
    $user = DB_USER;
    $password = DB_PASS;
    $port = DB_PORT;
    $host = DB_HOST;    
    $charset = DB_CHARSET; 

    return PdoDatabase::fromDsn(new PdoDsn(
        "mysql:dbname=$dbName;host=$host;charset=$charset",
        $user,
        $password,
    ));
}