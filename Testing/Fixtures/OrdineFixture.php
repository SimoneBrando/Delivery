<?php


namespace Testing\Fixtures;

use Entity\ECliente;
use Entity\EOrdine;
use Entity\EProdotto;
use Entity\EUtente;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrdineFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');
        $statiPossibili = ['in_attesa', 'in_preparazione', 'pronto', 'consegnato', 'annullato'];

        for ($i = 0; $i < 20; $i++) {
            $ordine = new EOrdine();
            $ordine
                ->setNote($faker->sentence())
                ->setDataRicezione($faker->dateTimeBetween('-10 days', '-1 day'))
                ->setDataEsecuzione($faker->dateTimeBetween('-1 day', 'now'))
                ->setCosto($faker->randomFloat(2, 5, 100))
                ->setStato($faker->randomElement($statiPossibili))
                ->setCliente( $this->getReference('cliente_' . $i, ECliente::class));

            $prodotti = [];
            $numProdotti = $faker->numberBetween(1, 5);
            for ($j = 0; $j < $numProdotti; $j++) {
                $prodotto = $this->getReference('prodotto_' .$j , EProdotto::class); // supponendo 30 prodotti
                $prodotti[] = $prodotto;
            }
            $ordine->setProdotti($prodotti);


            $this->addReference('ordine_' . $i, $ordine);
            $manager->persist($ordine);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
            ProdottoFixture::class,
        ];
    }
}
