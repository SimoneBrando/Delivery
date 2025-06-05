<?php
namespace Foundation;

use Exception;

class FPersistentManager {

    private static $instance;

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

     /*
     private function getFoundationClassName($entityClassName) {
        $baseClassName = substr($entityClassName, strrpos($entityClassName, '\\') + 1); // EProdotto
        return 'App\\Foundation\\F' . substr($baseClassName, 1); // FProdotto
    }
     */
// CRUD METHODS FOR GENERIC OBJECTS
    public static function getObj($entityClass, $id) {
        return FEntityManager::getInstance()->getObj($entityClass,$id);
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
    public function getObjOnAttribute($class, $attribute, $value) {
        return FEntityManager::getInstance()->getObjOnAttribute($class, $attribute, $value);
    }
//

    //revisione
    public function getOrdByUserId($userId) {
        $foundationClass = $this->getFoundationClassName('EOrdine');
        return call_user_func([$foundationClass, 'getOrdiniByUserId'], $userId);
    }

    //revisione
    public function verifyUserEmail($email) {
        $foundationClass = $this->getFoundationClassName('EUtente');
        return call_user_func([$foundationClass, 'verifyUserEmail'], $email);
    }

    //revisione
    public function verifyUserUsername($username) {
        $foundationClass = $this->getFoundationClassName('EUtente');
        return call_user_func([$foundationClass, 'verifyUserUsername'], $username);
    }
}
