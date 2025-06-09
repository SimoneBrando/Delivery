<?php

namespace Foundation;


use Entity\ECliente;
use Entity\EIndirizzo;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EIndirizzo.php';

class FIndirizzo
{


    /**
     * @return array
     * @throws Exception
     * method which return all addresses
     */
    public static function getAllAddresses(): array
    {
        return FEntityManager::getInstance()->getAll(EIndirizzo::class);
    }

    /**
     * Retrieve an address from the db
     * @param int $id
     * @return EIndirizzo|null
     */
    public static function getAddressById(int $id): ?EIndirizzo
    {
        return FEntityManager::getInstance()->getObj(EIndirizzo::class, $id);
    }

    /**
     * Retrieve all of client's addresses from the db
     * @param int $clientId
     * @return array
     * @throws Exception
     */
    public static function getAddressByClientId(int $clientId): array
    {
        $client = FEntityManager::getInstance()->getObjOnAttribute(ECliente::class,'id',$clientId);
        if(!$client)
            return [];
        else
            return $client->getIndirizziConsegna()->toArray();
    }
}
