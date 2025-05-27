<?php

class USession {
    private static $istance;

    public static function getInstance(){
        if (self::$istance == null){
            self::$istance = new USession();
        }
    }
    public static function destroySession(){
        session_destroy();
    }
    public static function unsetSession(){
        session_unset();
    }

    public static function getSessionElement($id){
        return $_SESSION[$id];
    }
    public static function unsetSessionElement($id){
        unset($_SESSION[$id]);
    }
    public static function setSessionElement($id, $value){
        $_SESSION[$id] = $value;
    }
    public static function isSetSessionElement($id){
        if(isset($_SESSION[$id])){
            return true;
        } else {
            return false;
        }
    }

}