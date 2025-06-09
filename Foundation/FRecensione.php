<?php

namespace Foundation;

use Entity\ECliente;
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

    /**
     * Retrieve a review from the db using his ID
     * @param int $idRecensione
     * @return ERecensione
     */
    public static function getReviewById(int $idRecensione): ERecensione
    {
        return FEntityManager::getInstance()->getObj(ERecensione::class, $idRecensione);
    }

    /**
     * Retrieve all of client's reviews from the db using the idClient
     * @param int $idClient
     * @return array
     */
    public static function getReviewByClientId(int $idClient) : array
    {
        $client = FEntityManager::getInstance()->getObj(ECliente::class, $idClient);
        return $client->getRecensioni()->toArray();

    }
}
