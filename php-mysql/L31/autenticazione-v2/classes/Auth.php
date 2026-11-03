<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/classes/Connection.php';

class Auth extends Connection{

    private $urls = [
        'login' => null,  
        'register' => null,  
        'dashboard' => null 
    ];

    private $user = null;

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
            if(!isset($data[$f])) die('tutti i campi devono essere compilati');
            if(empty($data[$f])) die('tutti i campi devono essere compilati');

            $sanitized[$f] = trim(strip_tags($data[$f]));
        }

        return $sanitized;
    }

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


            header('Location ' . $this->urls['login']);

        }catch(PDOException $e){

            if($this->getConnection()->inTransaction()){
                $this->getConnection()->rollback();
            }

            if($e->errorInfo[1] == 1062){
                die("Utente già esistente");
            }
            
            die($e->getMessage());

        }
    }
    
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

            if(!password_verify($password,$utente['password_hash'])) die('password errata');

            //cambia l'ID dopo il login per impedire che un ID di sessione precedente venga riutilizzato
            session_regenerate_id(true);

            unset($utente['password_hash']);//rimuovo la password così da no0n salvarla nella sessione

            $_SESSION['user'] = $utente;
            $this->user =  $utente;

            header('Location: ' . BASE_URL . '/rotte-protette/dashboard.php');
            
        }catch(PDOException $e){

            die($e->getMessage());

        }
    }


    public function logout(string $redirectUrl){
        session_unset();
        session_destroy();

        $this->user = null;

        header('Location: ' . ($redirectUrl ?? BASE_URL));
    }

    public function isLoggedIn():bool{
        return $this->user !== null;
    }

    public function getCurrentUser():array|null{
        return $this->user;
    }

    public function getUserId():int|null{
        return $this->user['id'] ?? null;
    }

    public function getCurrentUserData(string $field):mixed{
        return $this->user[$field] ?? null;
    }


    public function requireLogin(){
        if(!$this->isLoggedIn()) header('location: ' . BASE_URL . '/login.php'); 
        }
        
    public function requireGuest(){
        if($this->isLoggedIn()) header('location: ' . BASE_URL . '/rotte-protette/dashboard.php');  
    }

}
