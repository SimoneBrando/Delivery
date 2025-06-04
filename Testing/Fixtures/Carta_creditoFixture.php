<?php


namespace Testing\Fixtures;

use Entity\ECarta_credito;
use Entity\ECliente;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CartaCreditoFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Ad esempio, assegna carte ai primi 3 utenti
        for ($i = 0; $i < 20; $i++) {

            $cliente = $this->getReference('cliente_' . $i, ECliente::class);

            $carta = new ECarta_credito();
            $carta->setNumeroCarta('41111111111111' . str_pad($i, 2, '0', STR_PAD_LEFT))
                ->setNominativo('Carta n°' . ($i + 1))
                ->setDataScadenza(new \DateTime('+2 years'))
                ->setCvv('1' . $i . $i)
                ->setNomeIntestatario($cliente->getNome() . ' ' . $cliente->getCognome())
                ->setUtente($cliente); // Assicurati che il metodo esista

            $manager->persist($carta);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class, // Indica che questa fixture dipende da UserFixture
        ];
    }
}
