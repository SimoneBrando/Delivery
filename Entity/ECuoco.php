<?php

namespace App\Entity;
use App\Entity\EUtente;
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

    public function __construct($nome, $cognome, $email, $password, $codiceCuoco){
        parent::__construct($nome, $cognome, $email, $password);
        $this->codiceCuoco = $codiceCuoco;
    }

    //Getter
    public function getCodiceCuoco(){
        return $this->codiceCuoco;
    }

    //Setter
    public function setCodiceCuoco($codiceCuoco){
        $this->codiceCuoco = $codiceCuoco;
    }
    
}