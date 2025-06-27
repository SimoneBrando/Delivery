<?php

namespace Testing\Fixtures;

use Delight\Auth\AuthError;
use Delight\Auth\InvalidPasswordException;
use Entity\ECliente;
use Entity\ECuoco;
use Entity\EIndirizzo;
use Entity\ERider;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Delight\Auth\Auth;

class UserFixture extends AbstractFixture
{
    private const NUM_CLIENTI = 20;
    private const NUM_CUOCHI = 10;
    private const NUM_RIDER = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');
        $pdo = new \PDO('mysql:host=localhost;dbname=auth_database;charset=utf8mb4', DB_USER, DB_PASS);
        $auth = new Auth($pdo);

        // Creazione clienti
        for ($i = 0; $i < self::NUM_CLIENTI; $i++) {
            $cliente = new ECliente();
            $email = $faker->unique()->safeEmail();
            $password = 'ValidPass#2025';
            try {
                // Crea utente senza conferma email e senza inviare mail
                $userId = $auth->admin()->createUser($email, $password, $email);
            } catch (\Delight\Auth\InvalidEmailException $e) {
                echo "Email non valida: $email\n";
            } catch (\Delight\Auth\UserAlreadyExistsException $e) {
                echo "Utente già esistente: $email\n";
            } catch (\Delight\Auth\TooManyRequestsException $e) {
                echo "Troppe richieste, attendi...\n";
            } catch (AuthError|InvalidPasswordException $e) {
                echo "Password non valida: " . $email . " errore:" . $e->getMessage() ." \n ";
            }
            $cliente->setNome($faker->firstName())
                ->setCognome($faker->lastName())
                ->setEmail($email)
                ->setPassword(password_hash($password , PASSWORD_BCRYPT)) // Password fissa per testing
                ->setUserId("$userId")
                ->addIndirizzoConsegna($this->getReference('indirizzo_'.$i, EIndirizzo::class));

            $this->addReference('cliente_' . $i, $cliente);
            $manager->persist($cliente);
        }


        // Creazione cuochi
        for ($i = 0; $i < self::NUM_CUOCHI; $i++) {
            $cuoco = new ECuoco();
            $userId=$i+20;
            $email = $faker->unique()->safeEmail();
            $password = 'ValidPass#2025';
            try {
                // Crea utente senza conferma email e senza inviare mail
                $userId = $auth->admin()->createUser($email, $password, $email);
            } catch (\Delight\Auth\InvalidEmailException $e) {
                echo "Email non valida: $email\n";
            } catch (\Delight\Auth\UserAlreadyExistsException $e) {
                echo "Utente già esistente: $email\n";
            } catch (\Delight\Auth\TooManyRequestsException $e) {
                echo "Troppe richieste, attendi...\n";
            } catch (AuthError|InvalidPasswordException $e) {
                echo "Password non valida: $email\n";
            }
            $cuoco->setCodiceCuoco('CUOCO-' . strtoupper($faker->bothify('##??')))
                ->setNome($faker->firstName())
                ->setCognome($faker->lastName())
                ->setEmail($email)
                ->setPassword(password_hash($password , PASSWORD_BCRYPT))
                ->setUserId("$userId");

            $this->addReference('cuoco_' . $i, $cuoco);
            $manager->persist($cuoco);
        }

        // Creazione rider
        for ($i = 0; $i < self::NUM_RIDER; $i++) {
            $rider = new ERider();
            $userId=$i+30;
            $email = $faker->unique()->safeEmail();
            $password = 'ValidPass#2025';
            try {
                // Crea utente senza conferma email e senza inviare mail
                $userId = $auth->admin()->createUser($email, $password, $email);
            } catch (\Delight\Auth\InvalidEmailException $e) {
                echo "Email non valida: $email\n";
            } catch (\Delight\Auth\UserAlreadyExistsException $e) {
                echo "Utente già esistente: $email\n";
            } catch (\Delight\Auth\TooManyRequestsException $e) {
                echo "Troppe richieste, attendi...\n";
            } catch (AuthError|InvalidPasswordException $e) {
                echo "Password non valida: $email\n";
            }
            $rider->setCodiceRider('RIDER-' . strtoupper($faker->bothify('##??')))
                ->setNome($faker->firstName())
                ->setCognome($faker->lastName())
                ->setEmail($email)
                ->setPassword(password_hash($password , PASSWORD_BCRYPT))
                ->setUserId("$userId");


            $this->addReference('rider_' . $i, $rider);
            $manager->persist($rider);
        }


        $manager->flush();
    }
}