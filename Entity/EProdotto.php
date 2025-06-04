<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection; 

/**
 * @ORM\Entity
 * @ORM\Table(name="prodotto")
 */


class EProdotto {

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
    private $descrizione;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $costo;
    /**
     * @ORM\ManyToMany(targetEntity="Entity\EOrdine", mappedBy="prodotti")
     */
    private $ordini;
    /**
     * @ORM\ManyToOne(targetEntity="Entity\ECategoria", inversedBy="piatti")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=false)
     */
    private $categoria;

    public function __construct() {

    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescrizione() {
        return $this->descrizione;
    }

    public function getCosto() {
        return $this->costo;
    }
    public function getCategoria() {
        return $this->categoria;
    }

    // Setters
    public function setId($id) : EProdotto{
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) : EProdotto{
        $this->nome = $nome;
        return $this;
    }

    public function setDescrizione($descrizione) : EProdotto {
        $this->descrizione = $descrizione;
        return $this;
    }
    
    public function setCosto($costo) : EProdotto {
        $this->costo = $costo;
        return $this;
    }
    public function setCategoria($categoria) : EProdotto {
        $this->categoria = $categoria;
        return $this;
    }

}

?>