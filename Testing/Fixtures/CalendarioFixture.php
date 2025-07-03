<?php

namespace Testing\Fixtures;

use Entity\EWeeklyCalendar;
use Entity\EExceptionCalendar;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;


class CalendarioFixture extends AbstractFixture{


    
    private function randomDateTime(string $startDate, string $endDate): DateTime {
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

        return (new DateTime())->setTimestamp($randomTimestamp);
    }


    public function load(ObjectManager $manager): void {

        $giorni = ['lunedì', 'martedì', 'mercoledì', 'giovedì', 'venerdì', 'sabato', 'domenica'];

        for ($i = 0; $i < 7; $i++) {
            $calendario = new EWeeklyCalendar();
            if($giorni[$i] != 'lunedì'){
                $calendario->setData($giorni[$i])
                    ->setOrarioApertura(new \DateTime('19:00'))
                    ->setOrarioChiusura(new \DateTime('23:30'))
                    ->setAperto(true);
                $manager->persist($calendario);
            } else {
                $calendario->setData($giorni[0])
                    ->setAperto(false);
                $manager->persist($calendario);
            }
        }

        for($i = 0; $i < 7; $i++) {

            $calendario = new EExceptionCalendar();

            $randomDate = $this->randomDateTime('2025-07-01', '2025-12-31');

            $calendario->setExceptionDate($randomDate)
                ->setAperto(false)
                ->setMotivoChiusura('Chiuso per manutenzione');

            $manager->persist($calendario);

        }
        $manager->flush();

    }



}
