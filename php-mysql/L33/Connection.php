<?php

class Connection{

    private $db;

    public function __construct(string $dbName, string $dbUser = '', string $dbPassword, string $host = 'mysql'){

        try {
                $this->db = new PDO(
                    "mysql:host=$host;dbname=$dbName;charset=utf8mb4",
                    $dbUser,
                    $dbPassword,
                    [
                        // In caso di errore PDO genera un'eccezione, che possiamo intercettare nel catch.
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        // Le query restituiscono le righe come array associativi: es. $utente['email'].
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die('Connessione al database non riuscita: ' . $e->getMessage());
            }

    }

    public function getConnection():PDO{
        return $this->db;
    }

}

// $conn = new Connection('esercizio_autenticazione','user','password');

// $conn->getConnection();