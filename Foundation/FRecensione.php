<?php

namespace App\Foundation;

use App\Entity\ERecensione;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/ERecensione.php';

class FRecensione
{
    private static $table = "recensione";
    private static $key = "id";

    public static function getObj($id) {
        try {
            $entityManager = FEntityManager::getInstance();
            return $entityManager->risvegliaObj(ERecensione::class, $id);
        } catch (Exception $e) {
            error_log("Errore durante il recupero della recensione: " . $e->getMessage());
            return null;
        }
    }

    public static function saveObj(ERecensione $recensione) {
        try {
            $result = FEntityManager::getInstance()->salvaObj($recensione);
            return $result;
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio della recensione: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteObj(ERecensione $recensione) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->eliminaObj($recensione);
        } catch (Exception $e) {
            error_log("Errore durante l'eliminazione della recensione: " . $e->getMessage());
            return false;
        }
    }

    public static function searchByAttribute($attribute, $value) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->risvegliaObjOnAttribute(ERecensione::class, $attribute, $value);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca delle recensioni: " . $e->getMessage());
            return [];
        }
    }

    public static function getAll() {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->selectAll(self::$table);
        } catch (Exception $e) {
            error_log("Errore durante il recupero delle recensioni: " . $e->getMessage());
            return [];
        }
    }

    public static function exists($id) {
        try {
            $pm = FPersistentManager::getInstance();
            $recensione = $pm->risvegliaObj(ERecensione::class, $id);
            return $recensione !== null;
        } catch (Exception $e) {
            error_log("Errore durante la verifica della recensione: " . $e->getMessage());
            return false;
        }
    }

    public static function search($str, $attribute = 'testo') {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->getRicerca(ERecensione::class, $str, $attribute);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca delle recensioni: " . $e->getMessage());
            return [];
        }
    }

    public static function updateObj(ERecensione $recensione) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->updateObj($recensione);
        } catch (Exception $e) {
            error_log("Errore durante l'aggiornamento della recensione: " . $e->getMessage());
            return false;
        }
    }
}
