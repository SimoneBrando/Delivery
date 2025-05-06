<?php

class ESegnalazione {

    private $id;
    private $data;
    private $descriz;
    private $ora;
    private $testo;

    public function __construct($id, $data, $descrizione, $ora, $testo) {
        $this->id = uniqid();
        $this->data = $data;
        $this->descrizione = $descrizione;
        $this->$ora = $ora;
        $this->testo = $testo;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getData() {
        return $this->data;
    }

    public function getDescrizione() {
        return $this->descrizione;
    }

    public function getOra() {
        return $this->ora;
    }

    public function getTesto() {
        return $this->testo;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    public function setOra($ora) {
        $this->ora = $ora;
    }

    public function setTesto($testo) {
        $this->testo = $testo;
    }
    
   

}