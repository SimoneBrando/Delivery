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

    public static function getDayById(string $data): ?EWeeklyCalendar {

        return FEntityManager::getInstance()->getObjOnAttribute(EWeeklyCalendar::class, 'data', $data);

    }

    public static function getCalendar(): array {

        return FEntityManager::getInstance()->getAll(EWeeklyCalendar::class);

    }

    public static function editDay(EWeeklyCalendar $day): bool {

        try {
            FEntityManager::getInstance()->updateObj($day);
            return true;
        } catch (Exception $e) {
            echo "Errore: " . $e->getMessage();
            return false;
        }

    }
}