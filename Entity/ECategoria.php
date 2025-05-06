<?php

class ECategoria {

    private $id;
    private $nome;
    private $piatti;

    public function __construct($id, $nome, $piatti) {
        $this->id = uniqid();
        $this->nome = $nome;
        $this->descrizione = $descrizione;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPiatti() {
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

}