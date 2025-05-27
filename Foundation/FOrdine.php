<?php 


namespace App\Foundation;
use App\Entity\EOrdine; 

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '\..\Entity\EOrdine.php';


class FOrdine{

    private static $table = "ordine";
    private static $key = "id";

    public static function getTable() {
        return self::$table;
    }

    public static function getKey() {
        return self::$key;
    }



    
    /**
     * Metodo per ottenere un ordine dal database tramite ID
     * @param int $id ID dell'ordine
     * @return EOrdine|null
     */
    public static function getObj($id) {
        try {
            $entityManager = FEntityManager::getInstance();
            return $entityManager->risvegliaObj(EOrdine::class, $id);
        } catch (Exception $e) {
            error_log("Errore durante il recupero dell'ordine: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Metodo per salvare un ordine nel database
     * @param EOrdine $ordine L'oggetto ordine da salvare
     * @return bool
     */
    public static function saveObj(EOrdine $ordine) {
        try {
            $result = FEntityManager::getInstance()->salvaObj($ordine);
            return $result;
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio dell'ordine: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Metodo per eliminare un ordine dal database
     * @param EOrdine $ordine L'oggetto ordine da eliminare
     * @return bool
     */
    public static function deleteObj(EOrdine $ordine) {
        try {
            $pm = FPersistenManager::getInstance();
            return $pm->eliminaObj($ordine);
        } catch (Exception $e) {
            error_log("Errore durante l'eliminazione dell'ordine: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Metodo per cercare ordini in base a un attributo
     * @param string $attribute Attributo per la ricerca
     * @param mixed $value Valore da cercare
     * @return array
     */
    public static function searchByAttribute($attribute, $value) {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->risvegliaObjOnAttribute(EOrdine::class, $attribute, $value);
        } catch (Exception $e) {
            error_log("Errore durante la ricerca dell'ordine: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Metodo per ottenere tutti gli ordini
     * @return array
     */
    public static function getAll() {
        try {
            $pm = FPersistentManager::getInstance();
            return $pm->selectAll($table);
        } catch (Exception $e) {
            error_log("Errore durante il recupero degli ordini: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Metodo per verificare l'esistenza di un ordine
     * @param int $id ID dell'ordine
     * @return bool
     */
    public static function exists($id) {
        try {
            $pm = FPersistentManager::getInstance();
            $ordine = $pm->risvegliaObj(EOrdine::class, $id);
            return $ordine !== null;
        } catch (Exception $e) {
            error_log("Errore durante la verifica dell'ordine: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Metodo per cercare ordini con una stringa in un attributo
     * @param string $str Stringa da cercare
     * @param string $attribute Attributo in cui cercare
     * @return array
     */
    public static function search($str, $attribute = 'id') {
        try {
            $result = FEntityManager::getInstance()->getRicerca(EOrdine::class, $str, $attribute);
            return $result; 
        } catch (Exception $e) {
            error_log("Errore durante la ricerca degli ordini: " . $e->getMessage());
            return [];
        }
    }

    public static function updateObj(EOrdine $ordine) {
    try {
        $pm = FPersistentManager::getInstance();
        return $pm->updateObj($ordine);
    } catch (Exception $e) {
        error_log("Errore durante l'aggiornamento dell'ordine: " . $e->getMessage());
        return false;
    }
}

}






