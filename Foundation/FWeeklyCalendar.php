<?php

namespace Foundation;

use Entity\EWeeklyCalendar;
use Entity\EExceptionCalendar;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EWeeklyCalendar.php';
require_once __DIR__ . '/../Entity/EExceptionCalendar.php';

class FWeeklyCalendar
{


    public static function getWeeklyClosedDays(){

        return FEntityManager::getInstance()->getObjListOnAttribute(EWeeklyCalendar::class, 'aperto', false);  

    }

    public static function getWeeklyOpenDays(){

        return FEntityManager::getInstance()->getObjListOnAttribute(EWeeklyCalendar::class, 'aperto', true);  

    }

}