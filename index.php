<?php
// Imposta il timezone
date_default_timezone_set('Europe/Rome');


// Caricamento delle dipendenze
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/config_smarty.php';

require_once __DIR__ . '/Controller/CFrontController.php';

// Avvia il Front Controller
$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);