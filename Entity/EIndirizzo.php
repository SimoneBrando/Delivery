<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\ECliente;

/**
 * @ORM\Entity
 * @ORM\Table(name="indirizzo")
 */
class EIndirizzo
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
    private $via;

    /**
     * @ORM\Column(type="string")
     */
    private $civico;

    /**
     * @ORM\Column(type="string")
     */
    private $cap;

    /**
     * @ORM\Column(type="string")
     */
    private $citta;

    /**
     * @ORM\ManyToMany(targetEntity="Entity\ECliente", mappedBy="indirizziConsegna")
     */
    private $clienti;

    

    public function __construct(){
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getVia(): string
    {
        return $this->via;
    }

    public function setVia(string $via) : EIndirizzo
    {
        $this->via = $via;
        return $this;
    }

    public function getCivico(): string
    {
        return $this->civico;
    }

    public function setCivico(string $civico) : EIndirizzo
    {
        $this->civico = $civico;
        return $this;
    }

    public function getCap(): string
    {
        return $this->cap;
    }

    public function setCap(string $cap) : EIndirizzo
    {
        $this->cap = $cap;
        return $this;
    }

    public function getCitta(): string
    {
        return $this->citta;
    }

    public function setCitta(string $citta) : EIndirizzo
    {
        $this->citta = $citta;
        return $this;
    }
    public function getClienti(): Collection
    {
        return $this->clienti;
    }

    public function setClienti(Collection $clienti) : EElenco_prodotti
    {
        $this->clienti = $clienti;
        return $this;
    }
    public function addCliente(ECliente $cliente)
    {
        if (!$this->clienti->contains($cliente)) {
            $this->clienti[] = $cliente;
            $cliente->addIndirizzoConsegna($this);
        }
    }
}
