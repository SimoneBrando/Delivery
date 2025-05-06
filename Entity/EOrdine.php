<?php

class EOrdine {

    private $id;
    private $prodotti;
    private $note;
    private $dataEsecuzione;
    private $dataRicezione;
    private $costo;

    public function __construct($id, $prodotti, $note, $dataEsecuzione, $dataRicezione, $costo) {
        $this->id = uniqid();
        $this->prodotti = $prodotti;
        $this->note = $note;
        $this->dataEsecuzione = $dataEsecuzione;
        $this->dataRicezioni = $dataRicezione;
        $this->costo = $costo;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getProdotti() {
        return $this->prodotti;
    }

    public function getNote() {
        return $this->note;
    }

    public function getDataEsecuzione() {
        return $this->dataEsecuzione;
    }

    public function getDataRicezione() {
        return $this->dataRicezione;
    }

    public function getCosto() {
        return $this->costo;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setProdotti($prodotti) {
        $this->prodotti = $prodotti;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function setDataEsecuzione($dataEsecuzione) {
        $this->dataEsecuzione = $dataEsecuzione;
    }

    public function setDataRicezione($dataRicezione) {
        $this->dataRicezione = $dataRicezione;
    }
    
    public function setCosto($costo) {
        $this->costo = $costo;
    }

}