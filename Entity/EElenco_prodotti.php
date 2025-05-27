<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\ECategoria;


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
     * @ORM\OneToMany(targetEntity="App\Entity\ECategoria", mappedBy="elencoProdotti", cascade={"persist"})
     */
    private $categorie;

    public function __construct() {
        
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getCategorie() {
        return $this->categorie;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    public function addCategoria(ECategoria $categoria) {
        $this->categorie[] = $categoria;
        $categoria->setElencoProdotti($this);
    }

}