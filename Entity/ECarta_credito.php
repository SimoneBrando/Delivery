<?php

namespace Entity;
use Entity\EUtente;
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
     * @ORM\ManyToOne(targetEntity="Entity\ECliente", inversedBy="metodiPagamento")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $cliente;


    /**
     * @ORM\ManyToOne(targetEntity="Entity\EUtente", inversedBy="carta_credito")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $utente;


    public function __construct() {
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
    public function setNumeroCarta($numeroCarta) : ECarta_credito {
        $this->numeroCarta = $numeroCarta;
        return $this;
    }

    public function setNominativo($nomeCarta) : ECarta_credito {
        $this->nomeCarta = $nomeCarta;
        return $this;
    }

    public function setDataScadenza($dataScadenza) : ECarta_credito {
        $this->dataScadenza = $dataScadenza;
        return $this;
    }

    public function setCvv($cvv) : ECarta_credito {
        $this->cvv = $cvv;
        return $this;
    }
    
    public function setNomeIntestatario($nomeIntestatario) : ECarta_credito {
        $this->nomeIntestatario = $nomeIntestatario;
        return $this;
    }

    public function setUtente(EUtente $utente): ECarta_credito
    {
        $this->utente = $utente;
        return $this;
    }



}