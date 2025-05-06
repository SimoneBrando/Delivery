<?php

class EProdotto {

    private $id;
    private $nome;
    private $descrizione;
    private $costo;

    public function __construct($id ,$nome, $descrizione, $costo) {
        $this->id = uniqid();
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->costo = $costo;
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

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }
    
    public function setCosto($costo) {
        $this->costo = $costo;
    }

}

?>