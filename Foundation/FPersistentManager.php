<?php
namespace App\Foundation;

class FPersistentManager {

    private static $instance;

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function getFoundationClassName($entityClassName) {
        $baseClassName = substr($entityClassName, strrpos($entityClassName, '\\') + 1); // EProdotto
        return 'App\\Foundation\\F' . substr($baseClassName, 1); // FProdotto
    }

    public static function risvegliaObj($class, $id) {
        $foundationClass = (new self())->getFoundationClassName($class);
        return call_user_func([$foundationClass, 'getObj'], $id);
    }

    public function salvaObj($obj) {
        $foundationClass = $this->getFoundationClassName(get_class($obj));
        return call_user_func([$foundationClass, 'saveObj'], $obj);
    }

    public function eliminaObj($obj) {
        $foundationClass = $this->getFoundationClassName(get_class($obj));
        return call_user_func([$foundationClass, 'eliminaObj'], $obj);
    }

    public function updateObj($obj) {
        $foundationClass = $this->getFoundationClassName(get_class($obj));
        return call_user_func([$foundationClass, 'updateObj'], $obj);
    }

    public function selectAll($class) {
        $foundationClass = $this->getFoundationClassName($class);
        return call_user_func([$foundationClass, 'selectAll']);
    }

    public function risvegliaObjOnAttribute($class, $attribute, $value) {
        $foundationClass = $this->getFoundationClassName($class);
        return call_user_func([$foundationClass, 'risvegliaObjOnAttribute'], $class, $attribute, $value);
    }
}
