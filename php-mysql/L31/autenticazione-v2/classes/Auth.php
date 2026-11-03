<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/classes/Connection.php';
require_once BASE_PATH . '/classes/ErrorHelper.php';

/**
 * Gestisce la registrazione, l'autenticazione e la sessione dell'utente.
 */
class Auth extends Connection{

    /** @var array{login: string|null, register: string|null, dashboard: string|null} URL dell'applicazione. */
    private $urls = [
        'login' => null,  
        'register' => null,  
        'dashboard' => null 
    ];

    /** @var array<string, mixed>|null Dati dell'utente autenticato nella richiesta corrente. */
    private $user = null;

    /**
     * Inizializza la connessione al database e la sessione PHP.
     *
     * @param array{dbName: string, dbUser: string, dbPassword: string} $connData Credenziali del database.
     * @param array{login: string|null, register: string|null, dashboard: string|null} $urls URL di navigazione.
     */
    public function __construct(array $connData, array $urls){
        [
            'dbName' => $dbName,
            'dbUser' => $dbUser,
            'dbPassword' => $dbPassword
        ] = $connData;

        //lancio il constructor di parent (la classe parent è Connection)
        parent::__construct($dbName, $dbUser, $dbPassword, 'mysql');

        $this->urls = $urls;

        //controllo se c'è già una session e attiva, se non c'è la avvio
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        // Ripristina l'utente autenticato nelle richieste successive al login.
        $this->user = $_SESSION['user'] ?? null;
    }


    /**
     * @param array $fields lista delle chiavi attese. Esempio: ['nome','cognome','email','password']
     * @param array $data Dati da validare (es $_POST)
     * @param string $redirectUrl url per reindirizzare l'utente in caso di errori
     * @return array Dati sanitizzati
     */
    private function validateFields(array $fields, array $data, string $redirectUrl){
        $sanitized = [];

        foreach($fields as $f){
            if(!isset($data[$f])) ErrorHelper::setError('tutti i campi devono essere compilati', $redirectUrl);
            if(empty($data[$f])) ErrorHelper::setError('tutti i campi devono essere compilati', $redirectUrl);

            $sanitized[$f] = trim(strip_tags($data[$f]));
        }

        return $sanitized;
    }

    /**
     * Registra un nuovo utente e lo reindirizza alla pagina di login.
     *
     * @param array<string, mixed> $data Dati del modulo di registrazione.
     * @return void
     */
    public function register(array $data):void{

        [
            'nome' => $nome,
            'cognome' => $cognome,
            'email' => $email,
            'password' => $password
        ] = $this->validateFields(['nome','cognome','email','password'], $data, $this->urls['register']);

        //Preparo l'hash della password in modo che venga criptata
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        try{

            //Avvio una transazione in modo che, in caso di errore (per esempio con utente già esistente) le operazioni possano essere facilmente annullate
            $this->getConnection()->beginTransaction();

            $sql = "INSERT INTO utenti (nome, cognome, email, password_hash) VALUE (:nome, :cognome, :email, :password_hash)";

            $query = $this->getConnection()->prepare($sql);

            $query->bindParam(':nome',$nome);
            $query->bindParam(':cognome',$cognome);
            $query->bindParam(':email',$email);
            $query->bindParam(':password_hash',$passwordHash);

            $query->execute();


            $this->getConnection()->commit();


            ErrorHelper::setMessage('Utente registrato con successo!');

        }catch(PDOException $e){

            if($this->getConnection()->inTransaction()){
                $this->getConnection()->rollback();
            }

            if($e->errorInfo[1] == 1062){
                ErrorHelper::setError('Utente Già registrato', $this->urls['register']);
            }
            
            ErrorHelper::setError('Errore, riprovare più tardi', $this->urls['register']);

        }
    }
    
    /**
     * Effettua il login, memorizzando l'utente autenticato nella sessione.
     *
     * @param array<string, mixed> $data Dati del modulo di login.
     * @return void
     */
    public function login(array $data):void{
        [
            'email' => $email,
            'password' => $password
        ] = $this->validateFields(['email','password'], $data, $this->urls['login']);

        try{

            $sql = "SELECT * FROM utenti WHERE email = :email";
            $query = $this->getConnection()->prepare($sql);
            
            $query->bindParam(':email', $email);
            
            $query->execute();

            $utente = $query->fetch();

            if(!$utente || !password_verify($password, $utente['password_hash'])){
                ErrorHelper::setError('Email o password errata', $this->urls['login']);
            }

            //cambia l'ID dopo il login per impedire che un ID di sessione precedente venga riutilizzato
            session_regenerate_id(true);

            unset($utente['password_hash']);//rimuovo la password così da no0n salvarla nella sessione

            $_SESSION['user'] = $utente;
            $this->user =  $utente;

            header('Location: ' . $this->urls['dashboard']);
            
        }catch(PDOException $e){
            ErrorHelper::setError('Errore, riprovare più tardi', $this->urls['login']);

        }
    }


    /**
     * Chiude la sessione dell'utente e lo reindirizza.
     *
     * @param string $redirectUrl URL verso cui reindirizzare l'utente.
     * @return void
     */
    public function logout(string $redirectUrl){
        session_unset();
        session_destroy();

        $this->user = null;

        // Avvia una nuova sessione per mostrare il messaggio dopo il reindirizzamento.
        session_start();
        ErrorHelper::setMessage('Logout effettuato con successo', $redirectUrl);

        header('Location: ' . ($redirectUrl ?? BASE_URL));
    }

    /**
     * Verifica se è disponibile un utente autenticato.
     *
     * @return bool True se l'utente ha effettuato il login.
     */
    public function isLoggedIn():bool{
        return $this->user !== null;
    }

    /**
     * Restituisce i dati dell'utente autenticato.
     *
     * @return array<string, mixed>|null Dati utente o null in assenza di login.
     */
    public function getCurrentUser():array|null{
        return $this->user;
    }

    /**
     * Restituisce l'identificativo dell'utente autenticato.
     *
     * @return int|null ID utente oppure null se non disponibile.
     */
    public function getUserId():int|null{
        return $this->user['id'] ?? null;
    }

    /**
     * Legge un singolo campo dai dati dell'utente autenticato.
     *
     * @param string $field Nome del campo richiesto.
     * @return mixed Valore del campo oppure null se assente.
     */
    public function getCurrentUserData(string $field):mixed{
        return $this->user[$field] ?? null;
    }


    /**
     * Impedisce l'accesso agli utenti non autenticati.
     *
     * @param string|null $redirectUrl URL alternativo per il reindirizzamento.
     * @return void
     */
    public function requireLogin(?string $redirectUrl = null){
        if(!$this->isLoggedIn()){
            $redirectUrl = $redirectUrl ?? $this->urls['login'];
            ErrorHelper::setError('Devi effettuare il login per accedere a questa pagina', $redirectUrl);
        }
    }
        
    /**
     * Impedisce agli utenti autenticati di accedere alle pagine per ospiti.
     *
     * @param string|null $redirectUrl URL alternativo per il reindirizzamento.
     * @return void
     */
    public function requireGuest(?string $redirectUrl = null){
        if($this->isLoggedIn()){
            $redirectUrl = $redirectUrl ?? $this->urls['dashboard'];
            ErrorHelper::setError('Hai già effettuato il login', $redirectUrl);
        }
    }

}
