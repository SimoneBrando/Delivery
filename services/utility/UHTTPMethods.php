<?php 

namespace Utility;

use InvalidArgumentException;

class UHTTPMethods {
    
    public static function post($param, $default = null){
        return $_POST[$param] ?? $default;
    }

    /**
     * Recupera e valida una stringa dal metodo POST.
     *
     * - Elimina spazi iniziali e finali.
     * - Lancia un'eccezione se il campo è vuoto o supera la lunghezza massima specificata.
     * - Effettua l'escape HTML per prevenire XSS.
     *
     * @param string $key Nome del campo POST.
     * @param int|null $maxLength Lunghezza massima consentita (facoltativa).
     * @return string La stringa validata e sanificata.
     * @throws InvalidArgumentException Se il campo è assente, vuoto o troppo lungo.
     */
    public static function postString(string $key, ?int $maxLength = null): string {
        $value = trim($_POST[$key] ?? '');
        if ($value === '') {
            throw new InvalidArgumentException("Il campo '$key' è richiesto.");
        }
        if ($maxLength !== null && strlen($value) > $maxLength) {
            throw new InvalidArgumentException("Il campo '$key' supera la lunghezza massima.");
        }
        return $value;
    }

    /**
     * Recupera un intero da $_POST, con controlli su valore numerico e lunghezza.
     *
     * @param string $key La chiave dell'array $_POST.
     * @param int|null $min Valore minimo consentito.
     * @param int|null $max Valore massimo consentito.
     * @param int|null $minLength Numero minimo di cifre richieste.
     * @param int|null $maxLength Numero massimo di cifre permesse.
     * @return int Il valore intero validato.
     * @throws InvalidArgumentException Se il valore non è valido.
     */
    public static function postInt(string $key, ?int $minLength = null, ?int $maxLength = null, ?int $min = null, ?int $max = null,): int {
        if (!isset($_POST[$key]) || !is_numeric($_POST[$key])) {
            throw new InvalidArgumentException("Il campo '$key' deve essere un numero.");
        }

        $raw = trim($_POST[$key]);

        // Lunghezza in cifre
        $length = strlen($raw); // Usa abs per evitare problemi con numeri negativi

        if (($minLength !== null && $length < $minLength) || ($maxLength !== null && $length > $maxLength)) {
            throw new InvalidArgumentException("Il campo '$key' deve avere tra $minLength e $maxLength cifre. Valore fornito: $raw");
        }

        $intVal = (int)$raw;

        if (($min !== null && $intVal < $min) || ($max !== null && $intVal > $max)) {
            throw new InvalidArgumentException("Il campo '$key' è fuori dai limiti consentiti. Valore: $intVal");
        }

        return $intVal;
    }

    /**
     * Recupera e valida una data dal metodo POST.
     *
     * - Converte una stringa in oggetto DateTime usando il formato specificato.
     * - Controlla eventuali errori o warning nella creazione della data.
     *
     * @param string $key Nome del campo POST.
     * @param string $format Formato atteso della data (es. 'd/m/Y' o 'm/y').
     * @return DateTime L'oggetto data validato.
     * @throws InvalidArgumentException Se il formato è errato o la data non è valida.
     */
    public static function postDate(string $key, string $format): \DateTime {
        $value = $_POST[$key] ?? '';
        $date = \DateTime::createFromFormat($format, $value);
        $errors = \DateTime::getLastErrors();
        if (!$date || $errors['warning_count'] > 0 || $errors['error_count'] > 0) {
            throw new InvalidArgumentException("Data non valida per il campo '$key'.");
        }
        return $date;
    }

    /**
     * Recupera una stringa dal metodo POST e la valida usando una espressione regolare.
     *
     * - Elimina spazi iniziali e finali.
     * - Verifica che il valore rispetti il pattern specificato.
     *
     * @param string $key Nome del campo POST.
     * @param string $pattern Espressione regolare da applicare.
     * @return string La stringa validata.
     * @throws InvalidArgumentException Se il valore non corrisponde all'espressione regolare.
     */
    public static function postRegex(string $key, string $pattern): string {
        $value = trim($_POST[$key] ?? '');
        if (!preg_match($pattern, $value)) {
            throw new InvalidArgumentException("Il campo '$key' non rispetta il formato richiesto.");
        }
        return $value;
    }
}

