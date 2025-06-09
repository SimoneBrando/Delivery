<?php

namespace Foundation;

use Entity\ECarta_credito;
use Entity\ECliente;
use Entity\EUtente;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/ECarta_credito.php';

class FCarta_credito
{

    /**
     * @throws Exception
     * @return array
     * method which return all credit cards
     */
    public static function getAllCreditCards(): array
    {
        return FEntityManager::getInstance()->getAll(ECarta_credito::class);
    }

    /**
     * Retrieve a credit card with a specific ID
     * @param int $id
     * @return ECarta_credito|null
     */
    public static function getCreditCardById(int $id): ?ECarta_credito
    {
        return FEntityManager::getInstance()->getObj(ECarta_credito::class, $id);
    }

    /** Retrieve all of client's credit cards
     * @param int $clientId
     * @return array
     */
    public static function getCreditCardByClientId(int $clientId): array
    {
        $client = FEntityManager::getInstance()->getObj(ECliente::class, $clientId);
        return $client -> getMetodiPagamento()->toArray();
    }
}
