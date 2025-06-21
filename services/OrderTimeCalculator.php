<?php

namespace Services;

use DateTime;
use Entity\EOrdine;

require_once __DIR__ . "/../Entity/EOrdine.php";

class OrderTimeCalculator {
    private array $tempiPerCategoria = [
        'Antipasti' => 5,
        'Primi' => 10,
        'Secondi' => 10,
        'Dolci' => 5,
        'Bevande' => 0,
    ];

    public function timeCalculator(array $itemOrderList, int $ordiniInPreparazione = 0): int
    {
        $tempo = 0;

        foreach ($itemOrderList as $item) {
            $categoria = $item->getProdotto()->getCategoria()->getNome();
            $quantita = $item->getQuantita();
            $tempoBase = $this->tempiPerCategoria[$categoria] ?? 0;
            $tempo += $tempoBase * $quantita;
        }

        // Aggiunta tempo per carico di lavoro
        if ($ordiniInPreparazione >= 8) {
            $tempo += 10;
        }

        // Tempo di consegna standard
        $tempo += 30;

        return $tempo;
    }

    public function orarioConsegnaCalculator(array $itemOrderList, int $ordiniInPreparazione = 0): DateTime
    {
        $minuti = $this->timeCalculator($itemOrderList, $ordiniInPreparazione);
        return (new DateTime())->modify("+$minuti minutes");
    }
}