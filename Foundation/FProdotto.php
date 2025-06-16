<?php

namespace Foundation;

use Entity\EProdotto;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '\..\Entity\EProdotto.php';

class FProdotto
{

    /**
     * @throws Exception
     * @return array
     * method which return all products
     */
    public static function getAllProducts(): array{
        return FEntityManager::getInstance()->getAll(EProdotto::class);
    }

}
