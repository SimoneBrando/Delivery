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
    $userId = $auth_manager->register(
        email: $email,
        password: $password,
        username: $email,
        callback: null);
    $user->setUserId($userId);
    FPersistentManager::getInstance()->saveObj($user);
    $user = new EProprietario();
    $user->setNome($nome)
        ->setCognome($cognome)
        ->setEmail($email)
        ->setPassword($password);
    $user = $user->setCodiceProprietario($userId);
    echo "✅ Admin creato con successo con email: $email";
} catch (\Delight\Auth\UserAlreadyExistsException $e) {
    die("⚠️  Utente già registrato con questa email.\n");
} catch (\Delight\Auth\InvalidEmailException $e) {
    die("⚠️  Invalid email address.\n");
} catch (\Delight\Auth\InvalidPasswordException $e) {
    die("⚠️  Invalid password.\n"); 
} catch (\Exception $e) {
    die ("Error: $e");
}
