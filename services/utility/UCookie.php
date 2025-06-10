<?php

namespace Services\Utility;
class UCookie
{

    public static function isSet($id){
        if (isset($_COOKIE[$id])){
            return true;
        } else{
            return false;
        }
    }

}