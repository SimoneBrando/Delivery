<?php

class ECliente extends EUtente{

    private $metodi_pagamento;
    private $indirizzi_consegna;

    public function __construct($id, $nome, $cognome, $email, $password, $metodi_pagamento = [], $indirizzi_consegna = []) {
        parent::__construct($id, $nome, $cognome, $email, $password);
        $this->metodi_pagamento = $metodi_pagamento;
        $this->indirizzi_consegna = $indirizzi_consegna;
    }

    //Getters
    public function getMetodiPagamento() {
        return $this->metodi_pagamento;
    }

    public function getIndirizziConsegna() {
        return $this->indirizzi_consegna;
    }

    //Setters
    public function setMetodiPagamento($metodi_pagamento) {
        $this->metodi_pagamento = $metodi_pagamento;
    }

    public function setIndirizziConsegna($indirizzi_consegna) {
        $this->indirizzi_consegna = $indirizzi_consegna;
    }

    //Metodi
    public function addMetodoPagamento($metodo) {
        $this->metodi_pagamento[] = $metodo;
    }
}