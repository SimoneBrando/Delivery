<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\EOrdine;
use App\Entity\EProdotto;



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
     * @ORM\OneToMany(targetEntity="App\Entity\EProdotto", mappedBy="categoria")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=false)
     */
    private $piatti;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EElenco_prodotti", inversedBy="categorie")
     * @ORM\JoinColumn(name="elenco_prodotti_id", referencedColumnName="id", nullable=false)
     */
    private $elencoProdotti;

    public function __construct() {
        $this->piatti = new ArrayCollection();
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
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPiatti($piatti) {
        $this->piatti = $piatti;
    }

    public function getElencoProdotti() {
    return $this->elencoProdotti;
    }

    public function setElencoProdotti($elenco) {
        $this->elencoProdotti = $elenco;
    }

}