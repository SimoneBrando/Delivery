<?php

namespace App\Foundation;

use App\Entity\ECarta_credito;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/ECarta_credito.php';

class FCarta_credito
{
    private static $table = "carta_credito";
    private static $key = "id";

    public static function getObj($id) {
        try {
            $entityManager = FEntityManager::getInstance();
            return $entityManager->risvegliaObj(ECarta_credito::class, $id);
        } catch (Exception $e) {
            error_log("Errore durante il recupero della carta di credito: " . $e->getMessage());
            return null;
        }
    }

    public static function saveObj(ECarta_credito $carta) {
        try {
            $result = FEntityManager::getInstance()->salvaObj($carta);
            return $result;
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio della carta di credito: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteObj(ECarta_credito $carta) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->eliminaObj($carta);
        } catch (Exception $e) {
            error_log("Errore durante l'eliminazione della carta di credito: " . $e->getMessage());
            return false;
        }
    }

    public static function searchByAttribute($attribute, $value) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->risvegliaObjOnAttribute(ECarta_credito::class, $attribute, $value);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca della carta di credito: " . $e->getMessage());
            return [];
        }
    }

    public static function getAll() {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->selectAll(self::$table);
        } catch (Exception $e) {
            error_log("Errore durante il recupero delle carte di credito: " . $e->getMessage());
            return [];
        }
    }

    public static function exists($id) {
        try {
            $pm = FPersistentManager::getInstance();
            $carta = $pm->risvegliaObj(ECarta_credito::class, $id);
            return $carta !== null;
        } catch (Exception $e) {
            error_log("Errore durante la verifica della carta di credito: " . $e->getMessage());
            return false;
        }
    }

    public static function search($str, $attribute = 'numero') {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->getRicerca(ECarta_credito::class, $str, $attribute);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca delle carte di credito: " . $e->getMessage());
            return [];
        }
    }

    public static function updateObj(ECarta_credito $carta) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->updateObj($carta);
        } catch (Exception $e) {
            error_log("Errore durante l'aggiornamento della carta di credito: " . $e->getMessage());
            return false;
        }
    }
}
