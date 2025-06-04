<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\ECategoria;


/**
 * @ORM\Entity
 * @ORM\Table(name="elenco_prodotti")
 */
class EElenco_prodotti{
 
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\OneToMany(targetEntity="Entity\ECategoria", mappedBy="elencoProdotti", cascade={"persist"})
     */
    private $categorie;

    public function __construct() {
        
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    public function setId($id) : EElenco_prodotti {
        $this->id = $id;
        return $this;

    }
    public function getCategorie() {
        return $this->categorie;
    }

    // Setters

    public function setCategorie($categorie) : EElenco_prodotti{
        $this->categorie = $categorie;
        return $this;
    }

    public function addCategoria(ECategoria $categoria) {
        $this->categorie[] = $categoria;
        $categoria->setElencoProdotti($this);
    }

}