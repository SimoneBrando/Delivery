<?php

class EUtente{

    private $id;
    private $nome;
    private $cognome;
    private $email;
    private $password;
    private $telefono;
    private $dataNascita;

    public function __construct($nome, $cognome, $email, $password, $telefono, $dataNascita) {
        $this->id = uniqid();
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->telefono = $telefono;
        $this->dataNascita = $dataNascita;
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function getCognome() {
        return $this->cognome;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getTelefono() {
        return $this->telefono;
    }
    
    public function getDataNascita() {
        return $this->dataNascita;
    }

    // Setters
    public function setId($id) {
        $this->id = uniqid();
    }

    public function setNome($nome) {
        $this->nome = htmlspecialchars($nome);
    }

    public function setCognome($cognome) {
        $this->cognome = htmlspecialchars($cognome);
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = htmlspecialchars($email);
        } else {
            throw new Exception("Invalid email format");
        }
        
    }

    public function setPassword($password) {
        if (strlen($password) >= 8) {
            // Hash the password before storing it
            $this->password = password_hash($password, PASSWORD_BCRYPT);
        }
    }

    public function setTelefono($telefono) {
        $this->telefono = htmlspecialchars($telefono);
    }

    public function setDataNascita($dataNascita) {
        $date = DateTime::createFromFormat('Y-m-d', $dataNascita);
        if ($date && $date->format('Y-m-d') === $dataNascita) {
            $this->dataNascita = htmlspecialchars($dataNascita);
        } else {
            throw new Exception("Invalid date format");
        }
    }

}