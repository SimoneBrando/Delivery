<?php

namespace Entity;
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
     * @ORM\ManyToOne(targetEntity="Entity\EUtente", inversedBy="segnalazione")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $utente;

    /**
     * *@ORM\OneToOne(targetEntity="Entity\EOrdine", inversedBy="segnalazione")
     * @ORM\JoinColumn(name="ordine_id", referencedColumnName="id", nullable=false)
     */
    private $ordine;

    public function __construct() {
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

    public function getUtente() : EUtente{
        return $this->utente;
    }

    // Setters
    public function setId($id) : ESegnalazione {
        $this->id = $id;
        return $this;
    }

    public function setData($data) : ESegnalazione {
        $this->data = $data;
        return $this;
    }

    public function setDescrizione($descrizione) : ESegnalazione {
        $this->descrizione = $descrizione;
        return $this;
    }

    public function setOra($ora) : ESegnalazione {
        $this->ora = $ora;
        return $this;
    }

    public function setTesto($testo) : ESegnalazione {
        $this->testo = $testo;
        return $this;
    }

    public function setUtente(EUtente $utente): ESegnalazione {
        $this->utente = $utente;
        return $this;
    }

    public function setOrdine(EOrdine $ordine): ESegnalazione {
        $this->ordine = $ordine;
        return $this;
    }




}