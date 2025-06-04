<?php

namespace Testing\Fixtures;

use Entity\EProdotto;
use Entity\ECategoria;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProdottoFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');
        $productCounter = 0; // Contatore globale per i prodotti

        $categorie = [
            'categoria_Antipasti',
            'categoria_Primi',
            'categoria_Secondi',
            'categoria_Dolci',
            'categoria_Bevande'
        ];

        // Genera un certo numero di prodotti per ciascuna categoria
        foreach ($categorie as $refCategoria) {
            $categoria = $this->getReference($refCategoria, ECategoria::class);

            for ($i = 0; $i < 20; $i++) {
                $prodotto = new EProdotto();
                $prodotto
                    ->setNome($faker->word())
                    ->setDescrizione($faker->sentence())
                    ->setCosto($faker->randomFloat(2, 3, 25))
                    ->setCategoria($categoria);

                $manager->persist($prodotto);
                $this->addReference('prodotto_'. $productCounter, $prodotto);
                $productCounter++;
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoriaFixture::class,
        ];
    }
}