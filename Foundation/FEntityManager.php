<?php 



namespace Foundation; 

use Doctrine\ORM\Exception\NotSupported;
use Exception;

require_once 'bootstrap.php';

class FEntityManager{
    
    private static $instance;
    private static $entityManager;
    
    private function __construct() {
        self::$entityManager = getEntityManager(); // ottiene l'entity manager        
    }
    
    /**
     * Metodo per ottenere l'istanza della classe
     */
    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new self(); //crea un'istanza della classe
        }
        return self::$instance;
    }

    public static function getEntityManager(){
        return self::$entityManager;
    }

    /**
     * Metodo per recuperare un oggetto a partire da una classe e un id
     * @param string $class Nome della classe
     * @param int $id ID dell'oggetto da recuperare
     * @return object || null  
     */
    public static function getObj($class,$id): ?object
    {
        try{
            return self::$entityManager->find($class, $id);
        }
        catch (Exception $e){
            echo "Errore: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Metodo per recuperare un oggetto a partire da una classe e un id
     * @param string $class Nome della classe
     * @param string $field attributo dell'oggetto da recuperare
     * @param mixed $value valore dell'attributo dell'oggetto da recuperare
     * @return object || null  
     * @throws Exception
     */
    public static function getObjOnAttribute($class, $field, $value): ?object
    {
        try{
            echo "Cerca in $class dove $field = $value\n";
            return self::$entityManager->getRepository($class)->findOneBy([$field => $value]);
        }
        catch (Exception $e){
            echo "Errore: " . $e->getMessage();
            return null;
        }
    }

    public static function getObjListOnAttribute($table, $field, $value): array
    {
        try{
            return self::$entityManager->getRepository($table)->findBy([$field => $value]);

        } catch(Exception $e){
            echo "Errore: " . $e->getMessage();
            return [];
        }
    }

    public static function getObjListBetween($table, $field, $value): array{
            try {
                $qb = self::$entityManager->createQueryBuilder();
                $qb->select('e')
                    ->from($table, 'e')
                    ->where($qb->expr()->between("e.$field", ':start', ':end'))
                    ->setParameter('start', $value[0])
                    ->setParameter('end', $value[1]);

                return $qb->getQuery()->getResult();

            } catch (\Exception $e) {
                echo "Errore: " . $e->getMessage();
                return [];
            }
    }
    /**
     * Metodo per verificare se un oggetto esiste nel db
     * @param int $id id dell'oggetto
     * @param string $table nome della tabella
     * @param mixed $value valore dell'attributo da verificare
     * @param string $field attributo da verificare
     * @return bool true se l'oggetto esiste, false altrimenti
     * @throws Exception
     */
    public function verificaEsistenza($id, $table, $value, $field){
        try{
            $stmt = "SELECT u.id" . $id . " FROM " . $table . "u WHERE u." . $field . " = :value";
            $query = self::$entityManager->createQuery($stmt);
            $query->setParameter(':value', $value);
            $result = $query->getResult();
            if (count($result) > 0){
                return true;
            }
            else{
                return false;
            }
        } catch (Exception $e){
            echo "Errore: " . $e->getMessage();
            return false;
        }
    }

    public function getRicerca($entityClass, $str, $field){
        try{
            $stmt = "SELECT e FROM " . $entityClass . " e WHERE e." . $field . " LIKE :ricerca";
            $query = self::$entityManager->createQuery($stmt);
            $query->setParameter(':ricerca','%' .  $str . '%');
            $result = $query->getResult();
            if (count($result) > 0){
                return $result;
            }
            else{
                return [];
            }
        } catch (Exception $e){
            echo "Errore: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Metodo per salvare un oggetto nel db 
     * @param object $obj oggetto da salvare
     * @return bool true se l'oggetto è stato salvato, false altrimenti
     * @throws Exception
     */
    public static function saveObj(object $obj): bool
    {
        try{
            self::$entityManager->getConnection()->beginTransaction(); 
            self::$entityManager->persist($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }
        catch (Exception $e){
            echo "Errore: " . $e->getMessage();
            return false; 
        }
    }

    /**
     * Metodo per aggiornare un oggetto Doctrine gestito dal contesto
     * @param object $obj Oggetto già modificato da salvare
     * @return bool true se aggiornato correttamente, false altrimenti
     */
    public static function updateObj(object $obj): bool
    {
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->persist($obj); // opzionale se l’oggetto è già gestito
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e){
            echo "Errore: " . $e->getMessage();
            self::$entityManager->getConnection()->rollBack();
            return false;
        }
    }

    /**
     * Metodo per eliminare un oggetto dal db 
     * @param object $obj oggetto da eliminare
     * @return bool true se l'oggetto è stato eliminato, false altrimenti
     * @throws Exception
     */
    public static function deleteObj(object $obj): bool
    {
        try{
            self::$entityManager->getConnection()->beginTransaction(); 
            self::$entityManager->remove($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }
        catch (Exception $e){
            echo "Errore: " . $e->getMessage();
            return false; 
        }
    }

    /**
     * Metodo per recuperare tutti gli oggetti di una classe
     * @param string $table Nome della tabella del db
     * @return array array di oggetti
     * @throws Exception
     */
    public static function getAll(string $table): array
    {
        try{
            $query = self::$entityManager->createQuery("SELECT e FROM  $table e");
            $result = $query->getResult();
            return $result;
        } catch (Exception $e){
            echo "Errore: " . $e->getMessage();
            return [];
        }
    }

    public static function verifyAttributes ($table, $field, $value): ?bool
    {
        try{
            $dql = "SELECT u.id FROM " . $table . " u WHERE u." . $field . " = :value";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('value', $value);

            $result = $query->getResult();
            if(count($result) > 0)
                return true;
            else
                return false;
        } catch (Exception $e){
            echo "Errore: " . $e->getMessage();
            return null;
        }
    }







    
}