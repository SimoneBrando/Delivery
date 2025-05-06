<?php

class ERider extends EUtente{

    private $id;

    public function __construct($id, $nome, $cognome, $email, $password){
        parent::__construct($nome, $cognome, $email, $password);
        $this->id = $id;
    }

    //Getter
    public function getId(){
        return $this->id;
    }

    //Setter
    public function setId($id){
        $this->id = $id;
    }
    
}