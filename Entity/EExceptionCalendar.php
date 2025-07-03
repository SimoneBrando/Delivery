<?php 



namespace Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="exception_calendar")
 */
class EExceptionCalendar {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $exceptionDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $orarioApertura;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $orarioChiusura;

    /**
     * @ORM\Column(type="boolean")
     */
    private $aperto;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $motivoChiusura;

    public function __construct() {}

    // Getter
    public function getExceptionDate(): ?\DateTime {
        return $this->exceptionDate;
    }

    public function getOrarioApertura(): ?\DateTime {
        return $this->orarioApertura;
    }

    public function getOrarioChiusura(): ?\DateTime {
        return $this->orarioChiusura;
    }

    public function isAperto(): bool {
        return $this->aperto;
    }

    // Setter
    public function setExceptionDate(\DateTime $data): EExceptionCalendar {
        $this->exceptionDate = $data;
        return $this;
    }

    public function setOrarioApertura(?\DateTime $orarioApertura): EExceptionCalendar {
        $this->orarioApertura = $orarioApertura;
        return $this;
    }

    public function setOrarioChiusura(?\DateTime $orarioChiusura): EExceptionCalendar {
        $this->orarioChiusura = $orarioChiusura;
        return $this;
    }

    public function setMotivoChiusura(?string $motivoChiusura): EExceptionCalendar {
        $this->motivoChiusura = $motivoChiusura;
        return $this;
    }

    public function setAperto(bool $aperto): EExceptionCalendar {
        $this->aperto = $aperto;
        return $this;
    }


}