<?php 

require_once __DIR__ . "/../secrets.php";

//Dati per la connessione al database
define ('DB_HOST', '127.0.0.1');
define( 'DB_PORT', '3306');
define ('DB_NAME', 'delivery');
define ('DB_AUTH_NAME', 'auth_database');
define ('DB_USER', 'root');
define ('DB_PASS', '');
define ('DB_CHARSET', 'utf8mb4');
define ('DB_DRIVER', 'pdo_mysql');

define ("INDIRIZZO_RISTORANTE", "Piazza Duomo 1, L'Aquila");
define ("API_KEY", $API_KEY);

