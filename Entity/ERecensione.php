<?php

namespace Entity;
use Entity\EUtente;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="recensione")
 */
class ERecensione{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $descrizione;
    /**
     * @ORM\Column(type="integer")
     */
    private $voto;
    /**
     * @ORM\Column(type="datetime")
     */
    private $data;
    /**
     * @ORM\ManyToOne(targetEntity="Entity\ECliente", inversedBy="recensione")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $cliente;

    public function __construct(){
    }

    //Getter
    public function getId(){
        return $this->id;
    }

    public function getDescrizione(){
        return $this->descrizione;
    }

    public function getVoto(){
        return $this->voto;
    }

    public function getData(){
        return $this->data;
    }
    
    public function getOrario(){
        return $this->data;
    }

    public function getCliente() : EUtente
    {
        return $this->cliente;
    }

    //Setter

    public function setDescrizione($descrizione) : ERecensione{
        $this->descrizione = $descrizione;
        return $this;
    }

    public function setVoto($voto) : ERecensione{
        $this->voto = $voto;
        return $this;
    }

    public function setData($data) : ERecensione{
        $this->data = $data;
        return $this;
    }

    public function setOrario($orario) : ERecensione{
        $this->data = $orario;
        return $this;
    }

    public function setCliente($cliente) : ERecensione
    {
        $this->cliente = $cliente;
        return $this;
    }

}