<?php

namespace Testing\Fixtures;

use Entity\ECliente;
use Entity\ECuoco;
use Entity\EIndirizzo;
use Entity\ERider;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixture extends AbstractFixture
{
    private const NUM_CLIENTI = 20;
    private const NUM_CUOCHI = 10;
    private const NUM_RIDER = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');

        // Creazione clienti
        for ($i = 0; $i < self::NUM_CLIENTI; $i++) {
            $cliente = new ECliente();
            $userId=$i;
            $cliente->setNome($faker->firstName())
                ->setCognome($faker->lastName())
                ->setEmail($faker->unique()->safeEmail())
                ->setPassword(password_hash('password123', PASSWORD_BCRYPT)) // Password fissa per testing
                ->setUserId("$userId")
                ->addIndirizzoConsegna($this->getReference('indirizzo_'.$i, EIndirizzo::class));

            $this->addReference('cliente_' . $i, $cliente);
            $manager->persist($cliente);
        }

        // Creazione cuochi
        for ($i = 0; $i < self::NUM_CUOCHI; $i++) {
            $cuoco = new ECuoco();
            $userId=$i+20;
            $cuoco->setCodiceCuoco('CUOCO-' . strtoupper($faker->bothify('##??')))
                ->setNome($faker->firstName())
                ->setCognome($faker->lastName())
                ->setEmail($faker->unique()->safeEmail())
                ->setPassword(password_hash('password123', PASSWORD_BCRYPT))
                ->setUserId("$userId");

            $this->addReference('cuoco_' . $i, $cuoco);
            $manager->persist($cuoco);
        }

        // Creazione rider
        for ($i = 0; $i < self::NUM_RIDER; $i++) {
            $rider = new ERider();
            $userId=$i+30;
            $rider->setCodiceRider('RIDER-' . strtoupper($faker->bothify('##??')))
                ->setNome($faker->firstName())
                ->setCognome($faker->lastName())
                ->setEmail($faker->unique()->safeEmail())
                ->setPassword(password_hash('password123', PASSWORD_BCRYPT))
                ->setUserId("$userId");


            $this->addReference('rider_' . $i, $rider);
            $manager->persist($rider);
        }

        $manager->flush();
    }
}