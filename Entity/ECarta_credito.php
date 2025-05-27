<?php

namespace App\Entity;
use App\Entity\EUtente;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="carta_credito")
 */

class ECarta_credito{

    /**
    * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $numeroCarta;
    /**
     * @ORM\Column(type="string")
     */
    private $nomeCarta;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dataScadenza;
    /**
     * @ORM\Column(type="string", length=3)
     */
    private $cvv;
    /**
     * @ORM\Column(type="string")
     */
    private $nomeIntestatario;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EUtente", inversedBy="carta_credito")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $utente;


    public function __construct($numeroCarta, $nomeCarta, $dataScadenza, $cvv, $nomeIntestatario, $utente) {
        $this->numeroCarta = $numeroCarta;
        $this->nomeCarta = $nomeCarta;
        $this->dataScadenza = $dataScadenza;
        $this->cvv = $cvv;
        $this->nomeIntestatario = $nomeIntestatario;
        $this->utente = $utente;
    }

    //Getter
    public function getNumeroCarta(){
        return $this->numeroCarta;
    }

    public function getNominativo(){
        return $this->nomeCarta;
    }

    public function getDataScadenza(){
        return $this->dataScadenza;
    }

    public function getCvv(){
        return $this->cvv;
    }

    public function getNomeIntestatario(){
        return $this->nomeIntestatario;
    }

    //Setter
    public function setNumeroCarta($numeroCarta){
        $this->numeroCarta = $numeroCarta;
    }

    public function setNominativo($nomeCarta){
        $this->nomeCarta = $nomeCarta;
    }

    public function setDataScadenza($dataScadenza){
        $this->dataScadenza = $dataScadenza;
    }

    public function setCvv($cvv){
        $this->cvv = $cvv;
    }
    
    public function setNomeIntestatario($nomeIntestatario){
        $this->nomeIntestatario = $nomeIntestatario;
    }

    
}