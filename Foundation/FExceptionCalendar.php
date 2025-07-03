<?php



namespace Foundation;

use Entity\EExceptionCalendar;


require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EWeeklyCalendar.php';
require_once __DIR__ . '/../Entity/EExceptionCalendar.php';


class FExceptionCalendar
{


    public static function getExceptionClosedDays(){

        return FEntityManager::getInstance()->getObjListOnAttribute(EExceptionCalendar::class, 'aperto', false);


    }

}