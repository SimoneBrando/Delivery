<?php
namespace Foundation;

use Doctrine\DBAL\LockMode;
use Entity\ECliente;
use Entity\EIndirizzo;
use Entity\EItemOrdine;
use Entity\EUtente;
use Entity\ECarrello;
use Entity\EProdotto;
use Entity\EItemCarrello;
use Entity\EExceptionCalendar;
use Entity\EWeeklyCalendar;
use Exception;

class FPersistentManager
{

    private static $instance;
    private $emORM;

    private function __construct()
    {
        $this->emORM = FEntityManager::getInstance()->getEntityManager();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function beginTransaction() {
        $this->emORM->getConnection()->beginTransaction();
    }

    public function isTransactionActive(): bool {
        return $this->emORM->getConnection()->isTransactionActive();
    }

    public function commit(){
        $this->emORM->getConnection()->commit();
    }

    public function rollback() {
        $this->emORM->getConnection()->rollBack();
    }

    public function flush(){
        $this->emORM->flush();
    }

    public function persist($obj){
        $this->emORM->persist($obj);
    }

    public function locking($entityClass, $id, int $lockMode = LockMode::PESSIMISTIC_WRITE){
        return $this->emORM->find($entityClass, $id, $lockMode);
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

    public static function getAllActiveAddresses(): array{
        return FIndirizzo::getAllActiveAddresses();
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
        return FSegnalazione::getAllWarnings();
    }
    
    public static function getWarningByOrderId($orderId){
        return FSegnalazione::getWarningByOrderId($orderId);
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

    public static function getOrdersByRider($riderId): array
    {
        return FOrdine::getOrdersByRider($riderId);
    }
    public static function getOrdersByStateNotMine($state, $userId): array
    {
        return FOrdine::getOrdersByStateNotMine($state, $userId);
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

    public static function getAllActiveProduct(): array{
        return FProdotto::getAllActiveProducts();
    }

    public static function getAllNonActiveProduct(): array{
        return FProdotto::getAllNonActiveProducts();
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

    public static function getAllActiveCreditCards(): array{
        return FCarta_credito::getAllActiveCreditCards();
    }

    public static function getCreditCardById($id): ?FCarta_credito{
        return FCarta_credito::getCreditCardById($id);
    }




    //<-----------------------MENU--------------------->//
    public static function getMenu(){
        return FElenco_prodotti::getMenu();
    }




    //<-----------------------CALENDAR--------------------->//
    public static function getWeeklyClosedDays(){

        return FWeeklyCalendar::getWeeklyClosedDays();
       
    }

    public static function getWeeklyOpenDays(){

        return FWeeklyCalendar::getWeeklyOpenDays();

    }

    public static function getExceptionClosedDays(){

        return FExceptionCalendar::getExceptionClosedDays();

    }

    public static function getDayById($dayName){

        return FWeeklyCalendar::getDayById($dayName);
        
    }

    public static function getCalendar(): array {

        return FWeeklyCalendar::getCalendar();

    }

    public static function editDay(EWeeklyCalendar $day): bool {

        return FWeeklyCalendar::editDay($day);

    }

    public static function addExceptionDay(EExceptionCalendar $day){

        return FExceptionCalendar::addExceptionDay($day);

    }

    public static function deleteExceptionDay(EExceptionCalendar $day){

        return FExceptionCalendar::deleteExceptionDay($day);

    }




}