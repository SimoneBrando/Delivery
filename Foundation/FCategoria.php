<?php

namespace App\Foundation;

use App\Entity\ECategoria;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/ECategoria.php';

class FCategoria
{
    private static $table = "categoria";
    private static $key = "id";

    public static function getObj($id) {
        try {
            $entityManager = FEntityManager::getInstance();
            return $entityManager->risvegliaObj(ECategoria::class, $id);
        } catch (Exception $e) {
            error_log("Errore durante il recupero della categoria: " . $e->getMessage());
            return null;
        }
    }

    public static function saveObj(ECategoria $categoria) {
        try {
            $result = FEntityManager::getInstance()->salvaObj($categoria);
            return $result;
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio della categoria: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteObj(ECategoria $categoria) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->eliminaObj($categoria);
        } catch (Exception $e) {
            error_log("Errore durante l'eliminazione della categoria: " . $e->getMessage());
            return false;
        }
    }

    public static function searchByAttribute($attribute, $value) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->risvegliaObjOnAttribute(ECategoria::class, $attribute, $value);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca della categoria: " . $e->getMessage());
            return [];
        }
    }

    public static function getAll() {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->selectAll(self::$table);
        } catch (Exception $e) {
            error_log("Errore durante il recupero delle categorie: " . $e->getMessage());
            return [];
        }
    }

    public static function exists($id) {
        try {
            $pm = FPersistentManager::getInstance();
            $categoria = $pm->risvegliaObj(ECategoria::class, $id);
            return $categoria !== null;
        } catch (Exception $e) {
            error_log("Errore durante la verifica della categoria: " . $e->getMessage());
            return false;
        }
    }

    public static function search($str, $attribute = 'nome') {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->getRicerca(ECategoria::class, $str, $attribute);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca delle categorie: " . $e->getMessage());
            return [];
        }
    }

    public static function updateObj(ECategoria $categoria) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->updateObj($categoria);
        } catch (Exception $e) {
            error_log("Errore durante l'aggiornamento della categoria: " . $e->getMessage());
            return false;
        }
    }
}
