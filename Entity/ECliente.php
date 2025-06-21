<?php

namespace Entity;
use Entity\EUtente;
use Entity\EOrdine;
use Entity\ECarta_credito;
use Entity\ESegnalazione;
use Entity\EIndirizzo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="cliente")
 */
class ECliente extends EUtente{

    /**
     * @ORM\OneToMany(targetEntity="Entity\ECarta_credito", mappedBy="cliente")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $metodiPagamento;

    /**
     * @ORM\ManyToMany(targetEntity="Entity\EIndirizzo", inversedBy="clienti")
     * @ORM\JoinTable(name="clienti_indirizzi")
     */
    private $indirizziConsegna;

    /**
     * @ORM\OneToMany(targetEntity="Entity\EOrdine", mappedBy="cliente")
     */
    private $ordini;

    /**
     * @ORM\OneToMany(targetEntity="Entity\ESegnalazione", mappedBy="cliente")
     * 
     */
    private $segnalazioni;

    /**
     * @ORM\OneToMany(targetEntity="Entity\ERecensione", mappedBy="cliente", cascade={"persist", "remove"})
     */
    private $recensioni;

    public function __construct() {
        parent::__construct();
    }

    //Getters


    public function getMetodiPagamento(): Collection {
        return $this->metodiPagamento;
    }

    public function getIndirizziConsegna(): Collection {
        return $this->indirizziConsegna;
    }

    public function getOrdini(): Collection
    {
        return $this->ordini;
    }
    public function getSegnalazioni(): Collection
    {
        return $this->segnalazioni;
    }

    public function getRecensioni(): Collection
    {
        return $this->recensioni;
    }
    

    //Setters
    public function setMetodiPagamento($metodiPagamento) : ECliente {
        $this->metodiPagamento = $metodiPagamento;
        return $this;
    }

    public function setIndirizziConsegna($indirizziConsegna) : ECliente {
        $this->indirizziConsegna = $indirizziConsegna;
        return $this;
    }

    public function addIndirizzoConsegna(EIndirizzo $indirizzo) : ECliente {
        $this->indirizziConsegna[] = $indirizzo;
        return $this;
    }


    

}
    
    
