<?php

namespace Foundation;

use Entity\ERecensione;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/ERecensione.php';

class FRecensione
{

    /**
     * @throws Exception
     * method which return all reviews
     */
    public static function getAllReviews(): array
    {
        return FEntityManager::getInstance()->getAll(ERecensione::class);
    }
}
