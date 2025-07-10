<?php

namespace Foundation;

use Entity\ECuoco;
use Entity\ERider;
use Entity\EUtente;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EUtente.php';

class FCuoco{



    /**
     * @return array
     * @throws Exception
     * method which return all users who are chefs
     */
    public static function getAllChefs(): array
    {
        return FEntityManager::getInstance()->getAll(ECuoco::class);
    }

    public static function getAllActiveChefs(): array
    {
        return FEntityManager::getInstance()->getObjListOnAttribute(ECuoco::class, 'attivo', true);
    }












}
