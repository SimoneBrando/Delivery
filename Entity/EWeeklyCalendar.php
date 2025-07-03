<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="weekly_calendar")
 */
class EWeeklyCalendar {
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $data;

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

    public function __construct() {}

    // Getter
    public function getData(): string {
        return $this->data;
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
    public function setData(string $data): EWeeklyCalendar {
        $this->data = $data;
        return $this;
    }   


    public function setAperto(bool $aperto): EWeeklyCalendar {
        $this->aperto = $aperto;
        return $this;
    }

    public function setOrarioApertura(?\DateTime $orarioApertura): EWeeklyCalendar {
        $this->orarioApertura = $orarioApertura;
        return $this;
    }

    public function setOrarioChiusura(?\DateTime $orarioChiusura): EWeeklyCalendar {
        $this->orarioChiusura = $orarioChiusura;
        return $this;
    }
}


