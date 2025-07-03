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

    public static function addExceptionDay(EExceptionCalendar $day): bool {

        try {
            FEntityManager::getInstance()->saveObj($day);
            return true;
        } catch (Exception $e) {
            echo "Errore: " . $e->getMessage();
            return false;
        }

    }

    public static function deleteExceptionDay(EExceptionCalendar $day): bool {

        try {
            FEntityManager::getInstance()->deleteObj($day);
            return true;
        } catch (Exception $e) {
            echo "Errore: " . $e->getMessage();
            return false;
        }

    }

}