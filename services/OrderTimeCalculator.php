<?php

namespace Services;



require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use DateTime;
use Foundation\FPersistentManager;



class OrderTimeCalculator {
    private array $tempiPerCategoria = [
        'Antipasti' => 5,
        'Primi' => 10,
        'Secondi' => 10,
        'Dolci' => 5,
        'Bevande' => 0,
    ];

    private string $indirizzoRistorante;
    private string $apiKey;

    public function __construct(){
        $this->apiKey = API_KEY;
        $this->indirizzoRistorante = INDIRIZZO_RISTORANTE;
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


    public function orarioConsegnaCalculator(
    array $itemOrderList, 
    int $ordiniInPreparazione = 0, 
    string $indirizzoCliente = ""
    ): DateTime {

        $minuti = $this->timeCalculator($itemOrderList, $ordiniInPreparazione, $indirizzoCliente);
        $orarioPrevisto = (new DateTime())->modify("+$minuti minutes");

        // Controlla e correggi orario di consegna per essere in un orario aperto
        return $this->trovaPrimoOrarioAperto($orarioPrevisto, $minuti);
    }


    /**
     * Controlla se la data/ora è in orario aperto,
     * altrimenti la sposta al prossimo orario di apertura.
     */
    private function trovaPrimoOrarioAperto(DateTime $orario, int $timePT): DateTime {

        do {
            $giornoSettimanaIT = $this->getNomeGiornoItaliano($orario);
            $eccezione = $this->getEccezionePerData($orario);
            $orarioSettimana = $this->getOrarioSettimanalePerGiorno($giornoSettimanaIT);

            // Se è giorno chiuso settimanale o eccezione aperto=false => passo al giorno successivo in apertura
            if (($orarioSettimana === null || !$orarioSettimana->isAperto()) || 
                ($eccezione !== null && !$eccezione->isAperto())) {

                $orario->modify('+1 day')->setTime(0, 0);
                continue;
            }

            // Ora controllo se orario corrente è in orario di apertura
            $apertura = clone $orario;
            $apertura->setTime((int)$orarioSettimana->getOrarioApertura()->format('H'), (int)$orarioSettimana->getOrarioApertura()->format('i'));

            $chiusura = clone $orario;
            $chiusura->setTime((int)$orarioSettimana->getOrarioChiusura()->format('H'), (int)$orarioSettimana->getOrarioChiusura()->format('i'));

            if ($orario < $apertura) {
                // Sposto l'orario all'apertura di quel giorno
                $orario = $apertura;
                $orario->modify("+ $timePT minutes"); // Aggiungo il tempo di preparazione e consegna stimato precedentemente
                break;
            } elseif ($orario > $chiusura) {
                // Oltre orario chiusura, passo al giorno successivo
                $orario->modify('+1 day')->setTime(0, 0);
                continue;
            } else {
                // L'orario è dentro l'orario di apertura: OK
                break;
            }

        } while (true);

        return $orario;
    }


    // Esempio di metodi che devi implementare, accedendo al DB tramite il tuo persistent manager

    private function getNomeGiornoItaliano(DateTime $date): string {
        $daysIT = [
            'Monday' => 'lunedì',
            'Tuesday' => 'martedì',
            'Wednesday' => 'mercoledì',
            'Thursday' => 'giovedì',
            'Friday' => 'venerdì',
            'Saturday' => 'sabato',
            'Sunday' => 'domenica',
        ];
        return $daysIT[$date->format('l')];
    }

    private function getEccezionePerData(DateTime $date) {
        $exceptionClosedDays = FPersistentManager::getInstance()::getExceptionClosedDays();
        foreach ($exceptionClosedDays as $exception) {
            if ($exception->getExceptionDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                return $exception; // Giorno con eccezione
            }
        }
        return null; // Nessuna eccezione per questa data
    }

    private function getOrarioSettimanalePerGiorno(string $giornoIT) {

        $weeklyClosedDays = FPersistentManager::getInstance()::getWeeklyClosedDays();
        $weeklyOpenDays = FPersistentManager::getInstance()::getWeeklyOpenDays();

        foreach ($weeklyClosedDays as $closedDay) {
            if ($closedDay->getData() === $giornoIT) {
                return null; // Giorno chiuso
            }
        }

        foreach ($weeklyOpenDays as $openDay) {
            if ($openDay->getData() === $giornoIT) {
                return $openDay; // Giorno aperto
            }
        }

    }

}