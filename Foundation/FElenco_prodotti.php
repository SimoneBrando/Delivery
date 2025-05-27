<?php

namespace App\Foundation;

use App\Entity\EElenco_prodotti;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EElenco_prodotti.php';

class FElenco_prodotti
{
    private static $table = "elenco_prodotti";
    private static $key = "id";

    public static function getObj($id) {
        try {
            $entityManager = FEntityManager::getInstance();
            return $entityManager->risvegliaObj(EElenco_prodotti::class, $id);
        } catch (Exception $e) {
            error_log("Errore durante il recupero dell'elenco prodotti: " . $e->getMessage());
            return null;
        }
    }

    public static function saveObj(EElenco_prodotti $elenco) {
        try {
            $result = FEntityManager::getInstance()->salvaObj($elenco);
            return $result;
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio dell'elenco prodotti: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteObj(EElenco_prodotti $elenco) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->eliminaObj($elenco);
        } catch (Exception $e) {
            error_log("Errore durante l'eliminazione dell'elenco prodotti: " . $e->getMessage());
            return false;
        }
    }

    public static function searchByAttribute($attribute, $value) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->risvegliaObjOnAttribute(EElenco_prodotti::class, $attribute, $value);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca dell'elenco prodotti: " . $e->getMessage());
            return [];
        }
    }

    public static function getAll() {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->selectAll(self::$table);
        } catch (Exception $e) {
            error_log("Errore durante il recupero degli elenchi prodotti: " . $e->getMessage());
            return [];
        }
    }

    public static function exists($id) {
        try {
            $pm = FPersistentManager::getInstance();
            $elenco = $pm->risvegliaObj(EElenco_prodotti::class, $id);
            return $elenco !== null;
        } catch (Exception $e) {
            error_log("Errore durante la verifica dell'elenco prodotti: " . $e->getMessage());
            return false;
        }
    }

    public static function search($str, $attribute = 'nome') {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->getRicerca(EElenco_prodotti::class, $str, $attribute);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca degli elenchi prodotti: " . $e->getMessage());
            return [];
        }
    }

    public static function updateObj(EElenco_prodotti $elenco) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->updateObj($elenco);
        } catch (Exception $e) {
            error_log("Errore durante l'aggiornamento dell'elenco prodotti: " . $e->getMessage());
            return false;
        }
    }
}
