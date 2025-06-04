<?php


namespace Testing\Fixtures;

use Entity\ECategoria;
use Entity\EElenco_prodotti;
use Entity\EIndirizzo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoriaFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {

        // Categorie standard per un ristorante
        $nomiCategorie = ['Antipasti', 'Primi', 'Secondi', 'Dolci', 'Bevande'];
        $menu = $this->getReference('menu_0', EElenco_prodotti::class);

        foreach ($nomiCategorie as $nomeCategoria) {
            $categoria = new ECategoria();
            $categoria->setNome($nomeCategoria);
            $menu -> addCategoria($categoria);
            $this->addReference('categoria_' . $nomeCategoria, $categoria);
            $manager->persist($categoria);
        }

        $manager->flush();
    }

    public function getDependencies() : array{
        return [
            ElencoProdottiFixture::class,
        ];
    }

}
