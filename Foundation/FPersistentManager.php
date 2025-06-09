<?php
namespace Foundation;

use Entity\ECliente;
use Entity\EIndirizzo;
use Entity\EUtente;
use Exception;

class FPersistentManager
{

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


// <--------------------------CRUD METHODS FOR GENERIC OBJECTS---------------------------------->
    public static function getObj($entityClass, $id)
    {
        return FEntityManager::getInstance()->getObj($entityClass, $id);
    }

    /**
     * @throws Exception
     */
    public static function saveObj($obj): bool
    {
        return FEntityManager::getInstance()->saveObj($obj);
    }

    /**
     * @throws Exception
     */
    public static function deleteObj($obj): bool
    {
        return FEntityManager::getInstance()->deleteObj($obj);
    }

    public static function updateObj($obj): bool
    {
        return FEntityManager::getInstance()->updateObj($obj);
    }

    public static function getAll($class): array
    {
        return FEntityManager::getInstance()->getAll($class);
    }

    /**
     * @throws Exception
     */
    public function getObjOnAttribute($class, $field, $value)
    {
        return FEntityManager::getInstance()->getObjOnAttribute($class, $field, $value);
    }







//  ------------------------VERIFICATION METHODS-------------------------------------//
    /**
     * @param $email
     * @return bool|null
     * verify if exists an user with this email
     */
    public static function verifyUserEmail($email): ?bool
    {
        return FUtente::verify('email', $email);
    }

    /**
     * @param $username
     * @return bool|null
     * verify if exists an user with this username
     */
    public static function verifyUserUsername($username): ?bool
    {
        return FUtente::verify('username', $username);
    }

    /**
     * @throws Exception
     * @return array
     * method which return all users
     */
    public static function getAllUsers(): array
    {
        return FUtente::getAllUsers();
    }

    //<--------------------RIDER-------------------------------------->//
    /**
     * @throws Exception
     * @return array
     * method which return all users who are riders
     */
    public static function getAllRiders(): array
    {
        return FRider::getAllRiders();
    }

    //<-------------------CHEF-------------------------------------->//
    /**
     * @throws Exception
     * @return array
     * method which return all users who are riders
     */
    public static function getAllChefs(): array
    {
        return FCuoco::getAllChefs();
    }
// <-----------------------CLIENT------------------->

    /**
     * @throws Exception
     * @return array
     * method which return all users who are clients
     */
    public static function getAllClients(): array
    {
        return FCliente::getAllClients();
    }



    //<----------------ADDRESS------------------------->//
    /**
     * @return array
     * @throws Exception
     * method which return all addresses
     */
    public static function getAllAddresses(): array
    {
        return FEntityManager::getInstance()->getAll(EIndirizzo::class);
    }

// <--------------------------------REVIEW--------------------------------------------> //

    /**
     * @return array
     * @throws Exception
     * methods to get all of recensione
     */
    public static function getAllReviews(): array
    {
        return FRecensione::getAllReviews();
    }


    //<------------------------WARNING---------------------------------------------> //

    /**
     * @throws Exception
     * method which return all segnalazioni
     */
    public static function getAllWarnings(): array
    {
        return FSegnalazione::getAllWarnigns();
    }
    //<----------------------------ORDER------------------------------------------->//

    /**
     * @return array
     * @throws Exception
     * method which return all orders
     */
    public static function getAllOrders(): array
    {
        return FOrdine::getAllOrders();
    }
    /**
     * @throws Exception
     * @return array
     * method which return all orders made by a specified client
     */
    public static function getOrdersByClient($id): array
    {
        return FOrdine::getOrdersByClient($id);
    }
    /**
     * @throws Exception
     * @return array
     * method which return all orders made by a specified client
     */
    public static function getOrdersByState($value): array
    {
        return FOrdine::getOrdersByState($value);
    }
    public static function getOrdersByDate($value): array
    {
        return FOrdine::getOrdersByDate($value);
    }
    public static function getDailyOrders($time): array
    {
        return FOrdine::getDailyOrders($time);
    }

    //<----------------------PRODUCT------------------------>//

    /**
     * @throws Exception
     * @return array
     * method which return all products
     */
    public static function getAllProducts(): array{
        return FProdotto::getAllProducts();
    }

    //<-------------------------CREDIT CARD------------------------->//

    /**
     * @throws Exception
     * @return array
     * method which return all credit cards
     */
    public static function getAllCreditCards(): array{
        return FCarta_credito::getAllCreditCards();
    }




    //<-----------------------MENU--------------------->//
    public static function getMenu(){
        return FElenco_prodotti::getMenu();
    }
}