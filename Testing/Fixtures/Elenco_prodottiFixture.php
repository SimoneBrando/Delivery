<?php


namespace Testing\Fixtures;

use Entity\EElenco_prodotti;
use Entity\ECategoria;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ElencoProdottiFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');

        // Creo un elenco prodotti
        $elencoProdotti = new EElenco_prodotti();





        $manager->persist($elencoProdotti);
        $manager->flush();

        $this->addReference('menu_0', $elencoProdotti);
    }


}


