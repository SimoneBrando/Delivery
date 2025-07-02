<?php

namespace Services\Utility;
class UFlashMessage
{
    public static function addMessage(string $type, string $message): void
    {
        //Controlla l'esistenza dell'array 'flash' in sessione
        $messages = USession::isSetSessionElement('flash') ? USession::getSessionElement('flash') : [];
        //Crea l'array flash aggiungendo il messaggio
        $messages[$type][] = $message;
        //Aggiorna la sessione con il nuovo array
        USession::setSessionElement('flash', $messages);
    }

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

    public static function hasMessage(): bool
    {
        //Controlla l'esistenza dell'array 'flash' in sessione
        return USession::isSetSessionElement('flash');
    }
}
