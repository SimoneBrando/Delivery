<?php

namespace Foundation;


use Entity\EIndirizzo;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EIndirizzo.php';

class FIndirizzo {

    /**
     * @return array
     * @throws Exception
     * method which return all addresses
     */
    public static function getAllAddresses(): array
    {
        return FEntityManager::getInstance()->getAll(EIndirizzo::class);
    }

    public static function getAllActiveAddresses(): array {
        return FEntityManager::getInstance()->getObjListOnAttribute(EIndirizzo::class, 'attivo', true);
    }

    public static function getAddressById(int $id): ?EIndirizzo
    {
        return FEntityManager::getInstance()->getObj(EIndirizzo::class, $id);
    }

    public static function getAddressByUserId(int $userId): array
    {
        return FEntityManager::getInstance()->getObjListOnAttribute(EIndirizzo::class, 'utente_id', $userId);
    }
    
}
