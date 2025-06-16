<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="item_carrello")
 */
class EItemCarrello
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Entity\ECarrello", inversedBy="carrelloItems")
     * @ORM\JoinColumn(name="carrello_id", referencedColumnName="id", nullable=false)
     */
    private $carrello;

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
    private $prezzoUnitario;


    //Getters 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarrello(): ?ECarrello
    {
        return $this->carrello;
    }

    public function getProdotto(): ?EProdotto
    {
        return $this->prodotto;
    }

    public function getQuantita(): int
    {
        return $this->quantita;
    }

    public function getPrezzoUnitario(): float
    {
        return (float)$this->prezzoUnitario;
    }

    public function getPrezzoTotale(): float
    {
        return $this->quantita * $this->getPrezzoUnitario();
    }

    // Setters
    public function setProdotto(EProdotto $prodotto): EItemCarrello
    {
        $this->prodotto = $prodotto;
        return $this;
    }

    public function setCarrello(?ECarrello $carrello): EItemCarrello
    {
        $this->carrello = $carrello;
        return $this;
    }

    public function setQuantita(int $quantita): EItemCarrello
    {
        $this->quantita = $quantita;
        return $this;
    }

    public function setPrezzoUnitario(float $prezzo): EItemCarrello
    {
        $this->prezzoUnitario = $prezzo;
        return $this;
    }

}
