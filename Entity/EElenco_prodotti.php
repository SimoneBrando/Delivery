<?php

class EElenco_prodotti{
    
    private $id;
    private $categorie;

    public function __construct($id, $categorie) {
        $this->id = uniqid();
        $this->categorie = $categorie;
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

}