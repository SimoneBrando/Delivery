<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\EOrdine;
use Entity\EProdotto;



/**
 * @ORM\Entity
 * @ORM\Table(name="categoria")
 */
class ECategoria {


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
     * @ORM\OneToMany(targetEntity="Entity\EProdotto", mappedBy="categoria")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=false)
     */
    private $piatti;

    /**
     * @ORM\ManyToOne(targetEntity="Entity\EElenco_prodotti", inversedBy="categorie")
     * @ORM\JoinColumn(name="elenco_prodotti_id", referencedColumnName="id", nullable=false)
     */
    private $elencoProdotti;

    public function __construct() {

    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPiatti() : Collection {
        return $this->piatti;
    }

    // Setters

    public function setNome($nome) : ECategoria {
        $this->nome = $nome;
        return $this;
    }

    public function setPiatti($piatti) : ECategoria {
        $this->piatti = $piatti;
        return $this;
    }

    public function getElencoProdotti() {
    return $this->elencoProdotti;
    }

    public function setElencoProdotti($elenco) : ECategoria {
        $this->elencoProdotti = $elenco;
        return $this;
    }



}