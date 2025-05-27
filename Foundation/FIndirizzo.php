<?php

namespace App\Foundation;

use App\Entity\EIndirizzo;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EIndirizzo.php';

class FIndirizzo
{
    private static $table = "indirizzo";
    private static $key = "id";

    public static function getObj($id) {
        try {
            $entityManager = FEntityManager::getInstance();
            return $entityManager->risvegliaObj(EIndirizzo::class, $id);
        } catch (Exception $e) {
            error_log("Errore durante il recupero dell'indirizzo: " . $e->getMessage());
            return null;
        }
    }

    public static function saveObj(EIndirizzo $indirizzo) {
        try {
            $result = FEntityManager::getInstance()->salvaObj($indirizzo);
            return $result;
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio dell'indirizzo: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteObj(EIndirizzo $indirizzo) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->eliminaObj($indirizzo);
        } catch (Exception $e) {
            error_log("Errore durante l'eliminazione dell'indirizzo: " . $e->getMessage());
            return false;
        }
    }

    public static function searchByAttribute($attribute, $value) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->risvegliaObjOnAttribute(EIndirizzo::class, $attribute, $value);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca degli indirizzi: " . $e->getMessage());
            return [];
        }
    }

    public static function getAll() {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->selectAll(self::$table);
        } catch (Exception $e) {
            error_log("Errore durante il recupero degli indirizzi: " . $e->getMessage());
            return [];
        }
    }

    public static function exists($id) {
        try {
            $pm = FPersistentManager::getInstance();
            $indirizzo = $pm->risvegliaObj(EIndirizzo::class, $id);
            return $indirizzo !== null;
        } catch (Exception $e) {
            error_log("Errore durante la verifica dell'indirizzo: " . $e->getMessage());
            return false;
        }
    }

    public static function search($str, $attribute = 'via') {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->getRicerca(EIndirizzo::class, $str, $attribute);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca degli indirizzi: " . $e->getMessage());
            return [];
        }
    }

    public static function updateObj(EIndirizzo $indirizzo) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->updateObj($indirizzo);
        } catch (Exception $e) {
            error_log("Errore durante l'aggiornamento dell'indirizzo: " . $e->getMessage());
            return false;
        }
    }
}
