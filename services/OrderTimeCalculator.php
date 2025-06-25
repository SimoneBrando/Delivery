<?php

namespace Services;

use DateTime;
use Entity\EOrdine;

require_once __DIR__ . "/../Entity/EOrdine.php";
require_once __DIR__ . '/../config/config.php';

class OrderTimeCalculator {
    private array $tempiPerCategoria = [
        'Antipasti' => 5,
        'Primi' => 10,
        'Secondi' => 10,
        'Dolci' => 5,
        'Bevande' => 0,
    ];

    private string $indirizzoRistorante = "Piazza Duomo 1, L'Aquila";
    private string $apiKey;

    public function __construct(){
        $this->apiKey = API_KEY;
    }

    public function timeCalculator(array $itemOrderList, int $ordiniInPreparazione = 0, string $indirizzoCliente = ""): int {
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

        if ($indirizzoCliente){
            $tempo += $this->tempoTrasportoCalculator($indirizzoCliente);
        } else {
            $tempo += 30;
        }

        return $tempo;
    }

    private function tempoTrasportoCalculator(string $indirizzoDestinazione): int {
        $origine = urlencode($this->indirizzoRistorante);
        $destinazione = urlencode($indirizzoDestinazione);
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origine&destinations=$destinazione&key={$this->apiKey}";
        $response = file_get_contents($url);
        if ($response === false) {
            return 30; // fallback in caso di errore
        }
        $data = json_decode($response, true);
        file_put_contents('api_response_debug.log', print_r($data, true));
        if (!isset($data['rows'][0]['elements'][0]['duration']['value'])) {
            return 30; // fallback in caso di struttura errata
        }
        $secondi = $data['rows'][0]['elements'][0]['duration']['value'];
        return (int)ceil($secondi / 60); // converti in minuti
    }
    
    public function orarioConsegnaCalculator(array $itemOrderList, int $ordiniInPreparazione = 0, string $indirizzoCliente = ""): DateTime  {
        $minuti = $this->timeCalculator($itemOrderList, $ordiniInPreparazione, $indirizzoCliente);
        return (new DateTime())->modify("+$minuti minutes");
    }
}