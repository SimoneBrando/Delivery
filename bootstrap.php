<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/config.php";

function getEntityManager(): EntityManager
{
    $isDevMode = true;

    $config = new Configuration();
    $driver = new AnnotationDriver(
        new AnnotationReader(),
        [__DIR__ . "/src/Entity"]
    );
    $config->setMetadataDriverImpl($driver);
    $config->setProxyDir(__DIR__ . "/proxies");
    $config->setProxyNamespace('Proxies');
    $config->setAutoGenerateProxyClasses($isDevMode);

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
