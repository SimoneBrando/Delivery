<?php

namespace Foundation;

use Entity\ECliente;
use Entity\EOrdine;
use Entity\ESegnalazione;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/ESegnalazione.php';

/**
 * Class FSegnalazione - Foundation layer for ESegnalazione entities
 *
 * Provides data access and business logic methods for ESegnalazione entities
 * Handles all database operations related to warnings
 */
class FSegnalazione
{
    /**
     * Retrieves all warning reports from the database
     *
     * @return ESegnalazione[] Array of all report entities
     * @throws Exception If database access fails or query execution errors occur
     */
    public static function getAllWarnings(): array
    {
        return FEntityManager::getInstance()->getAll(ESegnalazione::class);
    }

    /**
     * Retrieve all warnings of a specified client
     * @param $clientId
     * @return array
     */
    public static function getWarningsByClientId($clientId): array
    {
        $client = FEntityManager::getInstance()->getObj(ECliente::class, $clientId);
        return $client->getSegnalazioni()->toArray();
    }

    public static function getWarningByOrderId($orderId)  {
        $warning = FEntityManager::getInstance()->getObjOnAttribute(ESegnalazione::class, 'ordine',$orderId);
        return $warning;
    }
}