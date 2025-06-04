<?php

namespace Entity;
use Entity\EUtente;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="cuoco")
 */
class ECuoco extends EUtente{

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    private $codiceCuoco;

    public function __construct(){
        parent::__construct();
    }

    //Getter
    public function getCodiceCuoco(){
        return $this->codiceCuoco;
    }

    //Setter
    public function setCodiceCuoco($codiceCuoco) : ECuoco{
        $this->codiceCuoco = $codiceCuoco;
        return $this;
    }
    
}