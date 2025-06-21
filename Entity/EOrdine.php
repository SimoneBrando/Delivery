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
     * @ORM\ManyToOne(targetEntity="Entity\ECliente", inversedBy="ordini")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $cliente;

    /**
     * @ORM\OneToMany(targetEntity="Entity\EItemOrdine", mappedBy="ordine", cascade={"persist", "remove"})
     */
    private $itemOrdini;

    /**
     * @ORM\OneToOne(targetEntity="Entity\ESegnalazione", mappedBy="ordine")
     */
    private $segnalazione;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('in_attesa', 'in_preparazione', 'pronto' , 'consegnato', 'annullato')")
     */
    private $stato;

    public function __construct() {
        $this->itemOrdini = new ArrayCollection();
    }

    // Getters
    public function getId() {
        return $this->id;
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

    public function getCliente() : ECliente{
        return $this->cliente;
    }

    public function getItemOrdini() {
        return $this->itemOrdini;
    }

    // Setters
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
    public function setCliente($cliente) : EOrdine{
        $this->cliente = $cliente;
        return $this;
    }
    public function setStato($stato) : EOrdine{
        $this->stato = $stato;
        return $this;
    }

    public function addItemOrdine(EItemOrdine $item): self {
        if (!$this->itemOrdini->contains($item)) {
            $this->itemOrdini[] = $item;
            //$item->setOrdine($this);
        }
        return $this;
    }

    /*
    public function removeItemOrdine(EItemOrdine $item): self {
        if ($this->itemOrdini->contains($item)) {
            $this->itemOrdini->removeElement($item);
            if ($item->getOrdine() === $this) {
                $item->setOrdine(null);
            }
        }
        return $this;
    }
    */

}