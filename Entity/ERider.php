<?php

namespace Entity;
use Entity\EUtente;
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


    public function __construct(){
        parent::__construct();
    }

    //Getter
    public function getCodiceRider(){
        return $this->codiceRider;
    }

    //Setter
    public function setCodiceRider($codiceRider) : ERider{
        $this->codiceRider = $codiceRider;
        return $this;
    }
    
}