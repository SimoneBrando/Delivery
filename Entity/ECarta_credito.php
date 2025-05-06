<?php

class ECarta_credito{

    private $numero_carta;
    private $nominativo;
    private $data_scadenza;
    private $cvv;
    private $nome_intestatario;

    public function __construct($numero_carta, $nominativo, $data_scadenza, $cvv, $nome_intestatario){
        $this->numero_carta = $numero_carta;
        $this->nominativo = $nominativo;
        $this->data_scadenza = $data_scadenza;
        $this->cvv = $cvv;
        $this->nome_intestatario = $nome_intestatario;
    }

    //Getter
    public function getNumeroCarta(){
        return $this->numero_carta;
    }

    public function getNominativo(){
        return $this->nominativo;
    }

    public function getDataScadenza(){
        return $this->data_scadenza;
    }

    public function getCvv(){
        return $this->cvv;
    }

    public function getNomeIntestatario(){
        return $this->nome_intestatario;
    }

    //Setter
    public function setNumeroCarta($numero_carta){
        $this->numero_carta = $numero_carta;
    }

    public function setNominativo($nominativo){
        $this->nominativo = $nominativo;
    }

    public function setDataScadenza($data_scadenza){
        $this->data_scadenza = $data_scadenza;
    }

    public function setCvv($cvv){
        $this->cvv = $cvv;
    }
    
    public function setNomeIntestatario($nome_intestatario){
        $this->nome_intestatario = $nome_intestatario;
    }

    
}