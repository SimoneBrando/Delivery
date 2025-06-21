<?php


namespace Testing\Fixtures;

use Entity\ECliente;
use Entity\EItemOrdine;
use Entity\EOrdine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Entity\ECarta_credito;
use Entity\EIndirizzo;
use Entity\EProdotto;
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
                ->setStato($faker->randomElement($statiPossibili))
                ->setCliente( $this->getReference('cliente_' . $i, ECliente::class))
                ->setIndirizzoConsegna($this->getReference('indirizzo_'.$faker->numberBetween(0, 19),EIndirizzo::class))
                ->setMetodoPagamento($this->getReference('metodo_'.$faker->numberBetween(0, 19),ECarta_credito::class));
            $costoTotale = 0;
            $numItemOrdine = $faker->numberBetween(1, 5);
            for ($j = 0; $j < $numItemOrdine; $j++) {
                $itemOrdine = new EItemOrdine();
                $prodotto = $this->getReference('prodotto_'.$faker->numberBetween(0, int2: 99),EProdotto::class);
                $itemOrdine->setProdotto($prodotto)
                    ->setQuantita($faker->numberBetween(1, 5))
                    ->setPrezzoUnitarioAlMomento($prodotto->getCosto())
                    ->setOrdine($ordine); // Collegamento all'ordine
                $ordine->addItemOrdine($itemOrdine);
                $costoTotale += $itemOrdine->getPrezzoUnitarioAlMomento() * $itemOrdine->getQuantita();
                $manager->persist($itemOrdine);
            }
            $ordine->setCosto($costoTotale);

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
            IndirizzoFixture::class,
            CartaCreditoFixture::class,
        ];
    }
}
