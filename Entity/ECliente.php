<?php

namespace App\Entity;
use App\Entity\EUtente;
use App\Entity\EOrdine;
use App\Entity\ECarta_credito;
use App\Entity\ESegnalazione;
use App\Entity\EIndirizzo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="cliente")
 */
class ECliente extends EUtente{

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ECarta_credito", mappedBy="utente")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $metodiPagamento;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EIndirizzo", inversedBy="clienti")
     * @ORM\JoinTable(name="clienti_indirizzi")
     */
    private $indirizziConsegna;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EOrdine", mappedBy="utente")
     */
    private $ordini;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ESegnalazione", mappedBy="cliente")
     * 
     */
    private $segnalazioni;

    public function __construct($nome, $cognome, $email, $password, $metodiPagamento = [], $indirizziConsegna = []) {
        parent::__construct($nome, $cognome, $email, $password);
        $this->indirizziConsegna = new ArrayCollection();
        $this->ordini = new ArrayCollection();
        $this->segnalazioni = new ArrayCollection();
        $this->metodiPagamento = new ArrayCollection();
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
    

    //Setters
    public function setMetodiPagamento($metodiPagamento) {
        $this->metodiPagamento = $metodiPagamento;
    }

    public function setIndirizziConsegna($indirizziConsegna) {
        $this->indirizziConsegna = $indirizziConsegna;
    }


    

}
    
    
