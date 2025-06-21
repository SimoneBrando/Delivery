<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="item_ordine")
 */
class EItemOrdine {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Entity\EOrdine", inversedBy="ordineItems")
     * @ORM\JoinColumn(name="ordine_id", referencedColumnName="id", nullable=false)
     */
    private $ordine;

    /**
     * @ORM\ManyToOne(targetEntity="Entity\EProdotto")
     * @ORM\JoinColumn(name="prodotto_id", referencedColumnName="id", nullable=false)
     */
    private $prodotto;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantita;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prezzoUnitarioAlMomento;


    //Getters 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdine(): ?EOrdine
    {
        return $this->ordine;
    }

    public function getProdotto(): ?EProdotto
    {
        return $this->prodotto;
    }

    public function getQuantita(): int
    {
        return $this->quantita;
    }

    public function getPrezzoUnitarioAlMomento(): float
    {
        return (float)$this->prezzoUnitarioAlMomento;
    }

    public function getPrezzoTotale(): float
    {
        return $this->quantita * $this->getPrezzoUnitarioAlMomento();
    }

    // Setters
    public function setProdotto(EProdotto $prodotto): EItemOrdine
    {
        $this->prodotto = $prodotto;
        return $this;
    }

    public function setOrdine(?EOrdine $ordine): EItemOrdine
    {
        $this->ordine = $ordine;
        return $this;
    }

    public function setQuantita(int $quantita): EItemOrdine
    {
        $this->quantita = $quantita;
        return $this;
    }

    public function setPrezzoUnitarioAlMomento(float $prezzo): EItemOrdine
    {
        $this->prezzoUnitarioAlMomento = $prezzo;
        return $this;
    }

}
