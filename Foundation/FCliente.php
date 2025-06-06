<?php

namespace Foundation;

use Entity\ECliente;
use Entity\EOrdine;
use Exception;

class FCliente
{
    /**
     * @return array
     * @throws Exception
     * method which return all users who are clients
     */
    public static function getAllClients(): array
    {
        return FEntityManager::getInstance()->getAll(ECliente::class);
    }




}