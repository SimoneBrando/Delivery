<?php

namespace Foundation;

use Entity\ERider;
use Entity\EUtente;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EUtente.php';

class FRider
{


    /**
     * @return array
     * @throws Exception
     * method which return all users who are riders
     */
    public static function getAllRiders(): array
    {
        return FEntityManager::getInstance()->getAll(ERider::class);
    }


}