<?php

namespace Foundation;

use Entity\ECarta_credito;
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
}
