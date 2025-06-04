<?php
// src/Entity/EUtente.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;



/**
 * @ORM\Entity
 * @ORM\Table(name="utente")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="ruolo", type="string")
 * @ORM\DiscriminatorMap({
 *     "cliente" = "Entity\ECliente",
 *     "rider" = "Entity\ERider",
 *     "cuoco" = "Entity\ECuoco"
 * })
 */
class EUtente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     * @ORM\Column(type="string")
     */
    private $cognome;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;



    // Costruttore
    public function __construct(){

    }

    // Getter e Setter
    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): EUtente
    {
        $this->nome = $nome;
        return $this;
    }

    public function getCognome(): string
    {
        return $this->cognome;
    }

    public function setCognome(string $cognome): EUtente
    {
        $this->cognome = $cognome;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): EUtente
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): EUtente
    {
        $this->password = $password;
        return $this;
    }


}
?>