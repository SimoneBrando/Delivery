<?php


namespace Testing\Fixtures;

use Entity\ECliente;
use Entity\EIndirizzo;
use Entity\EUtente;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class IndirizzoFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');

        for ($i = 0; $i < 20; $i++) {
            $indirizzo = new EIndirizzo();
            $indirizzo->setVia($faker->streetName())
                ->setCivico($faker->buildingNumber())
                ->setCap($faker->postcode())
                ->setCitta($faker->city());

            $manager->persist($indirizzo);
            $this->addReference('indirizzo_' . $i, $indirizzo);
        }

        $manager->flush();
    }

}
