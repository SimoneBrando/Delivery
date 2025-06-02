<?php

namespace App\Entity;
use App\Entity\EUtente;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="rider")
 */
class ERider extends EUtente{

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    private $codiceRider;


    public function __construct($nome, $cognome, $email, $password, $codiceRider){
        parent::__construct($nome, $cognome, $email, $password);
        $this->codiceRider = $codiceRider;
    }

    //Getter
    public function getCodiceRider(){
        return $this->codiceRider;
    }

    //Setter
    public function setCodiceRider($codiceRider){
        $this->codiceRider = $codiceRider;
    }
    
}