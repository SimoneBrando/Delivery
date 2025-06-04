<?php

namespace Testing\Fixtures;

use Entity\ECliente;
use Entity\ERecensione;
use Entity\EUtente;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RecensioneFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');

        for ($i = 0; $i < 20; $i++) {
            $recensione = new ERecensione();
            $recensione
                ->setDescrizione($faker->sentence(10))
                ->setVoto($faker->numberBetween(1, 5))
                ->setData($faker->dateTimeBetween('-1 year', 'now'))
                ->setUtente($this->getReference('cliente_' . $i, ECliente::class));

            $this->addReference('recensione_' . $i, $recensione);
            $manager->persist($recensione);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }
}

