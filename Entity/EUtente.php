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

    /**
     * @ORM\OneToMany(targetEntity="Entity\ERecensione", mappedBy="utente", cascade={"persist", "remove"})
     */
    private $recensione;

    /**
     * @ORM\OneToMany(targetEntity="Entity\ESegnalazione", mappedBy="utente", cascade={"persist", "remove"})
     */
    private $segnalazione;

    /**
     * @ORM\OneToMany(targetEntity="Entity\EOrdine", mappedBy="utente", cascade={"persist", "remove"})
     */
    private $ordini;

    /**
     * @ORM\Column(type="string")
     */



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

    //The class EUtente is an abstract class with InheritanceType(JOINED) and a DiscriminatorColumn called ruolo
    //So Doctrine saves automatically the role of the instance not using an attribute $ruolo, then we can't simply
    //return the value of the attribute, but we have to extrapolate the value from the class of the object
    public function getRuolo(): string
    {
        $className = get_class($this);         // Esempio: Entity\ECliente
        $parts = explode('\\', $className);    // ["Entity", "ECliente"]
        $roleClass = end($parts);              // "ECliente"

        // Rimuovi la "E" iniziale se vuoi solo "Cliente"
        return strtolower(substr($roleClass, 1)); // "cliente"
    }

}
?>