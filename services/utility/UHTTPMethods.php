<?php 

namespace Utility;

class UHTTPMethods {
    
    public static function post($param, $default = null){
        return $_POST[$param] ?? $default;
    }
}

