<?php

namespace App\Entity;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\EUtente", inversedBy="ordini")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $utente;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EProdotto")
     * @ORM\JoinTable(name="ordini_prodotti",
     *      joinColumns={@ORM\JoinColumn(name="ordine_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="prodotto_id", referencedColumnName="id")}
     * )
     */
    private $prodotti;

    public function __construct($prodotti, $note, $dataEsecuzione, $dataRicezione, $costo) {
        $this->prodotti = $prodotti;
        $this->note = $note;
        $this->dataEsecuzione = $dataEsecuzione;
        $this->dataRicezione = $dataRicezione;
        $this->costo = $costo;
        $this->prodotti = new ArrayCollection();
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

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setProdotti($prodotti) {
        $this->prodotti = $prodotti;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function setDataEsecuzione($dataEsecuzione) {
        $this->dataEsecuzione = $dataEsecuzione;
    }

    public function setDataRicezione($dataRicezione) {
        $this->dataRicezione = $dataRicezione;
    }
    
    public function setCosto($costo) {
        $this->costo = $costo;
    }
    public function setUtente($utente) {
        $this->utente = $utente;
    }

}