<?php

namespace Services\Utility;
class UFlashMessage
{

    /**
     * Aggiunge un messaggio flash alla sessione.
     *
     * @param string $type    Il tipo di messaggio (es. 'success', 'error', ecc.).
     * @param string $message Il contenuto del messaggio da memorizzare.
     *
     * @return void
     */
    public static function addMessage(string $type, string $message): void
    {
        //Controlla l'esistenza dell'array 'flash' in sessione
        $messages = USession::isSetSessionElement('flash') ? USession::getSessionElement('flash') : [];
        //Crea l'array flash aggiungendo il messaggio
        $messages[$type][] = $message;
        //Aggiorna la sessione con il nuovo array
        USession::setSessionElement('flash', $messages);
    }

     /**
     * Recupera tutti i messaggi flash dalla sessione e li rimuove.
     *
     * @return array Un array di messaggi organizzati per tipo.
     */
    public static function getMessage(): array
    {
        //Controlla l'esistenza dell'array 'flash' in sessione
        if (!USession::isSetSessionElement('flash')) {
            return [];
        }
        //Recupera il messaggio ed elimina l'array 'flash' dalla sessione
        $messages = USession::getSessionElement('flash');
        USession::unsetSessionElement('flash');
        return $messages;
    }

    /**
     * Verifica se esistono messaggi flash nella sessione.
     *
     * @return bool True se esistono messaggi flash, false altrimenti.
     */
    public static function hasMessage(): bool
    {
        return USession::isSetSessionElement('flash');
    }
}
