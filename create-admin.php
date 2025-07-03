<?php

use Delight\Auth\Auth;
use Entity\EProprietario;
use Foundation\FPersistentManager;

require_once "bootstrap.php";
require_once __DIR__ . '/Entity/EProprietario.php';

if (php_sapi_name() !== 'cli') {
    die("Questo script può essere eseguito solo da terminale.\n");
}

$options = getopt("", ["email:", "password:"]);
if (!isset($options['email'], $options['password'])) {
    echo "Usa: php create-admin.php --email=EMAIL --password=PASSWORD\n";
    exit(1);
}

$nome = 'Admin';
$cognome = 'Admin';
$email = $options['email'];
$password = $options['password'];

$auth_manager = getAuth();

try {
    // 1. Registra utente con Delight Auth
    $userId = $auth_manager->register(
        email: $email,
        password: $password,
        username: $email,
        callback: null
    );

    // 2. Crea l'oggetto EProprietario
    $user = new EProprietario();
    $user->setNome($nome)
         ->setCognome($cognome)
         ->setEmail($email)
         ->setPassword($password)
         ->setCodiceProprietario($userId)  // Settiamo lo userId
         ->setUserId($userId);             // Se esiste anche questo campo

    // 3. Salviamo nel DB
    FPersistentManager::getInstance()->saveObj($user);

    echo "✅ Admin creato con successo con email: $email\n";
} catch (\Delight\Auth\UserAlreadyExistsException $e) {
    die("⚠️  Utente già registrato con questa email.\n");
} catch (\Delight\Auth\InvalidEmailException $e) {
    die("⚠️  Indirizzo email non valido.\n");
} catch (\Delight\Auth\InvalidPasswordException $e) {
    die("⚠️  Password non valida.\n");
} catch (\Exception $e) {
    die("Errore: " . $e->getMessage() . "\n");
}
