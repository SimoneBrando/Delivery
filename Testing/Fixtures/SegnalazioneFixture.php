<?php

namespace Testing\Fixtures;

use Entity\ESegnalazione;
use Entity\EOrdine;
use Entity\EUtente;
use Entity\ECliente;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Faker\Factory;

class SegnalazioneFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');

        for ($i = 0; $i < 20; $i++) {
            $segnalazione = new ESegnalazione();
            $segnalazione
                ->setData($faker->dateTimeBetween('-1 month', 'now'))
                ->setDescrizione($faker->sentence())
                ->setTesto($faker->paragraph())
                ->setUtente($this->getReference('cliente_' . $i, ECliente::class))
                ->setOrdine($this->getReference('ordine_' . $i, EOrdine::class));

            $manager->persist($segnalazione);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
            OrdineFixture::class,
        ];
    }
}
