<?php

namespace App\Foundation;

use App\Entity\EUtente;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EUtente.php';

class FUtente
{
    private static $table = "utente";
    private static $key = "id";

    public static function getObj($id) {
        try {
            $entityManager = FEntityManager::getInstance();
            return $entityManager->risvegliaObj(EUtente::class, $id);
        } catch (Exception $e) {
            error_log("Errore durante il recupero dell'utente: " . $e->getMessage());
            return null;
        }
    }

    public static function saveObj(EUtente $utente) {
        try {
            $result = FEntityManager::getInstance()->salvaObj($utente);
            return $result;
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio dell'utente: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteObj(EUtente $utente) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->eliminaObj($utente);
        } catch (Exception $e) {
            error_log("Errore durante l'eliminazione dell'utente: " . $e->getMessage());
            return false;
        }
    }

    public static function searchByAttribute($attribute, $value) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->risvegliaObjOnAttribute(EUtente::class, $attribute, $value);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca dell'utente: " . $e->getMessage());
            return [];
        }
    }

    public static function getAll() {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->selectAll(self::$table);
        } catch (Exception $e) {
            error_log("Errore durante il recupero degli utenti: " . $e->getMessage());
            return [];
        }
    }

    public static function exists($id) {
        try {
            $pm = FPersistentManager::getInstance();
            $utente = $pm->risvegliaObj(EUtente::class, $id);
            return $utente !== null;
        } catch (Exception $e) {
            error_log("Errore durante la verifica dell'utente: " . $e->getMessage());
            return false;
        }
    }

    public static function search($str, $attribute = 'username') {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->getRicerca(EUtente::class, $str, $attribute);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca degli utenti: " . $e->getMessage());
            return [];
        }
    }

    public static function updateObj(EUtente $utente) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->updateObj($utente);
        } catch (Exception $e) {
            error_log("Errore durante l'aggiornamento dell'utente: " . $e->getMessage());
            return false;
        }
    }
}
