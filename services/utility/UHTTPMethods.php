<?php 

namespace Utility;

class UHTTPMethods {
    
    public static function post($param){
        return $_POST[$param];
    }
}

