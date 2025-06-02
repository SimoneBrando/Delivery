<?php

namespace App\Entity;
use App\Entity\EUtente;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\EUtente", inversedBy="recensione")
     * @ORM\JoinColumn(name="utente_id", referencedColumnName="id", nullable=false)
     */
    private $utente;

    public function __construct($descrizione, $voto, $data, $utente){
        $this->descrizione = $descrizione;
        $this->voto = $voto;
        $this->data = $data;
        $this->utente = $utente;
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
        return $this->orario;
    }

    //Setter
    public function setId($id){
        $this->id = $id;
    }

    public function setDescrizione($descrizione){
        $this->descrizione = $descrizione;
    }

    public function setVoto($voto){
        $this->voto = $voto;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function setOrario($orario){
        $this->orario = $orario;
    }

}