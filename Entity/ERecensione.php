<?php

class ERecensione{

    private $id;
    private $descrizione;
    private $voto;
    private $data;
    private $orario;

    public function __construct($id, $descrizione, $voto, $data, $orario){
        $this->id = $id;
        $this->descrizione = $descrizione;
        $this->voto = $voto;
        $this->data = $data;
        $this->orario = $orario;
    }

    //Getter
    public function getId(){
        return $this->id;
    }

    public function getDescrizione(){
        return $this->descrizione;
    }

    public function getVoto(){
        return $this->voto;
    }

    public function getData(){
        return $this->data;
    }
    
    public function getOrario(){
        return $this->orario;
    }

    //Setter
    public function setId($id){
        $this->id = $id;
    }

    public function setDescrizione($descrizione){
        $this->descrizione = $descrizione;
    }

    public function setVoto($voto){
        $this->voto = $voto;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function setOrario($orario){
        $this->orario = $orario;
    }

}