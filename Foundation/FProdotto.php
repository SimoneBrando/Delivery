<?php

namespace App\Foundation;

use App\Entity\EProdotto; 

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '\..\Entity\EProdotto.php';

class FProdotto
{
    private static $table = "prodotto";
    private static $key = "id";

    /**
     * Metodo per ottenere un prodotto dal database tramite ID
     * @param int $id ID del prodotto
     * @return EProdotto|null
     */
    public static function getObj($id) {
        try {
            $entityManager = FEntityManager::getInstance();
            return $entityManager->risvegliaObj(EProdotto::class, $id);
        } catch (Exception $e) {
            error_log("Errore durante il recupero del prodotto: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Metodo per salvare un prodotto nel database
     * @param EProdotto $prodotto L'oggetto prodotto da salvare
     * @return bool
     */
    public static function saveObj(EProdotto $prodotto) {
        try {
            $result = FEntityManager::getInstance()->salvaObj($prodotto);
            return $result;
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio del prodotto: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Metodo per eliminare un prodotto dal database
     * @param EProdotto $prodotto L'oggetto prodotto da eliminare
     * @return bool
     */
    public static function deleteObj(EProdotto $prodotto) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->eliminaObj($prodotto);
        } catch (Exception $e) {
            error_log("Errore durante l'eliminazione del prodotto: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Metodo per cercare prodotti in base a un attributo
     * @param string $attribute Attributo per la ricerca
     * @param mixed $value Valore da cercare
     * @return array|EProdotto|null
     */
    public static function searchByAttribute($attribute, $value) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->risvegliaObjOnAttribute(EProdotto::class, $attribute, $value);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca del prodotto: " . $e->getMessage());
            return [];
        }
    }

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
