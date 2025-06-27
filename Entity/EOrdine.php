<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Foundation\FPersistentManager;

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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTime $dataConsegna;
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
     * @ORM\Column(type="string", columnDefinition="ENUM('in_attesa', 'in_preparazione', 'pronto' , 'in_consegna' , 'consegnato', 'annullato')")
     */
    private $stato;

    /**
     * @ORM\ManyToOne(targetEntity="Entity\EIndirizzo", inversedBy="ordini")
     * @ORM\JoinColumn(name="indirizzo_id", referencedColumnName="id", nullable=false)
     */
    private $indirizzoConsegna;

    /**
     * @ORM\ManyToOne(targetEntity="Entity\ECarta_credito", inversedBy="ordini")
     * @ORM\JoinColumn(name="numeroCarta", referencedColumnName="numeroCarta", nullable=false)
     */
    private $metodoPagamento;

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

    public function getIndirizzoConsegna(): EIndirizzo{
        return $this->indirizzoConsegna;
    }

    public function getMetodoPagamento(): ECarta_credito{
        return $this->metodoPagamento;
    }

    public function getDataConsegna(): \DateTime|null{
        return $this->dataConsegna;
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
    
    public function setDataConsegna($dataConsegna): EOrdine{
        $this->dataConsegna = $dataConsegna;
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

    public function setIndirizzoConsegna(EIndirizzo $indirizzo): self{
        $this->indirizzoConsegna = $indirizzo;
        return $this;
    }

    public function setMetodoPagamento(ECarta_credito $carta): self{
        $this->metodoPagamento = $carta;
        return $this;
    }

    public function addItemOrdine(EItemOrdine $item): self {
        if (!$this->itemOrdini->contains($item)) {
            $this->itemOrdini[] = $item;
            //$item->setOrdine($this);
        }
        return $this;
    }

    //Sbagliato dal punto di vista architetturale
    public function hasWarning(): bool{
        if (FPersistentManager::getWarningByOrderId($this->getId())){
            return true;
        }
        return false;
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