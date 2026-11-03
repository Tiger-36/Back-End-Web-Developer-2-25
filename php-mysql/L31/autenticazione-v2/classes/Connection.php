<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/classes/ErrorHelper.php';

/**
 * Crea e rende disponibile la connessione PDO al database MySQL.
 */
class Connection{

    /** @var PDO Connessione attiva al database. */
    private $db;

    /**
     * Inizializza la connessione al database.
     *
     * In caso di errore salva un messaggio flash in sessione e reindirizza
     * alla pagina principale dell'applicazione.
     *
     * @param string $dbName Nome del database.
     * @param string $dbUser Nome utente del database.
     * @param string $dbPassword Password del database.
     * @param string $host Host del server MySQL.
     * @return void
     */
    public function __construct(string $dbName, string $dbUser, string $dbPassword, string $host = 'mysql'){

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
                if(session_status() === PHP_SESSION_NONE){
                    session_start();
                }

                ErrorHelper::setError('Connessione al database non riuscita. Riprova più tardi.', BASE_URL);
            }

    }

    /**
     * Restituisce la connessione PDO attiva.
     *
     * @return PDO Connessione al database.
     */
    public function getConnection():PDO{
        return $this->db;
    }

}
