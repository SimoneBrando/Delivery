<?php

namespace Foundation;

use Entity\EProdotto;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '\..\Entity\EProdotto.php';

class FProdotto
{
    private static $table = "prodotto";
    private static $key = "id";


    /**
     * Metodo per ottenere tutti i prodotti
     * @return array
     */
    public static function getAll() {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->selectAll($table);
        } catch (Exception $e) {
            error_log("Errore durante il recupero dei prodotti: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Metodo per verificare l'esistenza di un prodotto
     * @param int $id ID del prodotto
     * @return bool
     */
    public static function exists($id) {
        try {
            $pm = FPersistentManager::getInstance();
            $prodotto = $pm->risvegliaObj(EProdotto::class, $id);
            return $prodotto !== null;
        } catch (Exception $e) {
            error_log("Errore durante la verifica del prodotto: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Metodo per cercare prodotti con una stringa in un attributo
     * @param string $str Stringa da cercare
     * @param string $attribute Attributo in cui cercare
     * @return array
     */
    public static function search($str, $attribute = 'nome') {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->getRicerca(EProdotto::class, $str, $attribute);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca dei prodotti: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Metodo opzionale per aggiornare un prodotto esistente
     * @param EProdotto $prodotto
     * @return bool
     */
    public static function updateObj(EProdotto $prodotto) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->updateObjStandard($prodotto);
        } catch (Exception $e) {
            error_log("Errore durante l'aggiornamento del prodotto: " . $e->getMessage());
            return false;
        }
    }
}
