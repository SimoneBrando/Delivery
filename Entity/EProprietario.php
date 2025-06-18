<?php

namespace Entity;
use Entity\EUtente;
use Doctrine\ORM\Mapping as ORM;

require_once __DIR__ . "/EUtente.php";

/**
 * @ORM\Entity
 * @ORM\Table(name="admin")
 */
class EProprietario extends EUtente{
    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    private string $codiceProprietario;

    public function __construct(){
        parent::__construct();
    }

    public function getCodiceProprietario(): string{
        return $this->codiceProprietario;
    }

    public function setCodiceProprietario($codiceProprietario) : EProprietario{
        $this->codiceProprietario = $codiceProprietario;
        return $this;
    }
}