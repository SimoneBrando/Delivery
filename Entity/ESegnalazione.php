<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="segnalazione")
 */
class ESegnalazione {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="datetime")
     */
    private $data;
    /**
     * @ORM\Column(type="string")
     */
    private $descrizione;
    /**
     * @ORM\Column(type="string")
     */
    private $testo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EUtente", inversedBy="segnalazione")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $utente;

    /**
     * *@ORM\OneToOne(targetEntity="App\Entity\EOrdine", inversedBy="segnalazione")
     * @ORM\JoinColumn(name="ordine_id", referencedColumnName="id", nullable=false)
     */
    private $ordine;

    public function __construct($id, $data, $descrizione, $testo, $utente, $ordine) {
        $this->id = uniqid();
        $this->data = $data;
        $this->descrizione = $descrizione;
        $this->testo = $testo;
        $this->utente = $utente; 
        $this->ordine = $ordine;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getData() {
        return $this->data;
    }

    public function getDescrizione() {
        return $this->descrizione;
    }

    public function getOra() {
        return $this->ora;
    }

    public function getTesto() {
        return $this->testo;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    public function setOra($ora) {
        $this->ora = $ora;
    }

    public function setTesto($testo) {
        $this->testo = $testo;
    }
    
   

}