<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="ordine")
 */

class EOrdine {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $note;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dataEsecuzione;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dataRicezione;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $costo;

    /**
     * @ORM\ManyToOne(targetEntity="Entity\EUtente", inversedBy="ordini")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $utente;

    /**
     * @ORM\ManyToMany(targetEntity="Entity\EProdotto")
     * @ORM\JoinTable(name="ordini_prodotti",
     *      joinColumns={@ORM\JoinColumn(name="ordine_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="prodotto_id", referencedColumnName="id")}
     * )
     */
    private $prodotti;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('in_attesa', 'in_preparazione', 'pronto' , 'consegnato', 'annullato')")
     */
    private $stato;

    public function __construct() {
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getProdotti() {
        return $this->prodotti;
    }

    public function getNote() {
        return $this->note;
    }

    public function getDataEsecuzione() {
        return $this->dataEsecuzione;
    }

    public function getDataRicezione() {
        return $this->dataRicezione;
    }

    public function getCosto() {
        return $this->costo;
    }
    public function getStato(){
        return $this->stato;
    }

    // Setters

    public function setProdotti($prodotti) : EOrdine {
        $this->prodotti = $prodotti;
        return $this;
    }

    public function setNote($note) : EOrdine {
        $this->note = $note;
        return $this;
    }

    public function setDataEsecuzione($dataEsecuzione) : EOrdine {
        $this->dataEsecuzione = $dataEsecuzione;
        return $this;
    }

    public function setDataRicezione($dataRicezione) : EOrdine {
        $this->dataRicezione = $dataRicezione;
        return $this;
    }
    
    public function setCosto($costo) : EOrdine{
        $this->costo = $costo;
        return $this;
    }
    public function setUtente($utente) : EOrdine{
        $this->utente = $utente;
        return $this;
    }
    public function setStato($stato) : EOrdine{
        $this->stato = $stato;
        return $this;
    }

}