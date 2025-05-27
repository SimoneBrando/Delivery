<?php

namespace App\Foundation;

use App\Entity\ESegnalazione;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/ESegnalazione.php';

class FSegnalazione
{
    private static $table = "segnalazione";
    private static $key = "id";

    public static function getObj($id) {
        try {
            $entityManager = FEntityManager::getInstance();
            return $entityManager->risvegliaObj(ESegnalazione::class, $id);
        } catch (Exception $e) {
            error_log("Errore durante il recupero della segnalazione: " . $e->getMessage());
            return null;
        }
    }

    public static function saveObj(ESegnalazione $segnalazione) {
        try {
            $result = FEntityManager::getInstance()->salvaObj($segnalazione);
            return $result;
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio della segnalazione: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteObj(ESegnalazione $segnalazione) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->eliminaObj($segnalazione);
        } catch (Exception $e) {
            error_log("Errore durante l'eliminazione della segnalazione: " . $e->getMessage());
            return false;
        }
    }

    public static function searchByAttribute($attribute, $value) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->risvegliaObjOnAttribute(ESegnalazione::class, $attribute, $value);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca della segnalazione: " . $e->getMessage());
            return [];
        }
    }

    public static function getAll() {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->selectAll(self::$table);
        } catch (Exception $e) {
            error_log("Errore durante il recupero delle segnalazioni: " . $e->getMessage());
            return [];
        }
    }

    public static function exists($id) {
        try {
            $pm = FPersistentManager::getInstance();
            $segnalazione = $pm->risvegliaObj(ESegnalazione::class, $id);
            return $segnalazione !== null;
        } catch (Exception $e) {
            error_log("Errore durante la verifica della segnalazione: " . $e->getMessage());
            return false;
        }
    }

    public static function search($str, $attribute = 'oggetto') {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->getRicerca(ESegnalazione::class, $str, $attribute);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca delle segnalazioni: " . $e->getMessage());
            return [];
        }
    }

    public static function updateObj(ESegnalazione $segnalazione) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->updateObj($segnalazione);
        } catch (Exception $e) {
            error_log("Errore durante l'aggiornamento della segnalazione: " . $e->getMessage());
            return false;
        }
    }
}
