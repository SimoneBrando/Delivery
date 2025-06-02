<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\ECliente;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\ECliente", mappedBy="indirizziConsegna")
     */
    private $clienti;

    

    public function __construct()
    {
        $this->clienti = new ArrayCollection();
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getVia(): string
    {
        return $this->via;
    }

    public function setVia(string $via)
    {
        $this->via = $via;
    }

    public function getCivico(): string
    {
        return $this->civico;
    }

    public function setCivico(string $civico)
    {
        $this->civico = $civico;
    }

    public function getCap(): string
    {
        return $this->cap;
    }

    public function setCap(string $cap)
    {
        $this->cap = $cap;
    }

    public function getCitta(): string
    {
        return $this->citta;
    }

    public function setCitta(string $citta)
    {
        $this->citta = $citta;
    }
    public function getClienti(): Collection
    {
        return $this->clienti;
    }
    public function addCliente(ECliente $cliente)
    {
        if (!$this->clienti->contains($cliente)) {
            $this->clienti[] = $cliente;
            $cliente->addIndirizzoConsegna($this);
        }
    }
}
