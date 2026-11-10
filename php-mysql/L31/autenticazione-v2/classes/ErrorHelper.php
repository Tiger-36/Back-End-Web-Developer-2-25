<?php

/**
 * Gestisce i messaggi temporanei salvati nella sessione e la loro visualizzazione.
 */
class ErrorHelper{

    /**
     * Salva un messaggio di errore nella sessione e reindirizza, se previsto.
     *
     * @param string $message Testo dell'errore da mostrare.
     * @param string $redirectUrl URL di reindirizzamento.
     * @return void
     */
    public static function setError(string $message, string $redirectUrl = ''){
        $_SESSION['error'] = true;
        $_SESSION['message'] = $message;

        if($redirectUrl){
            header('Location: ' . $redirectUrl);
            die;
        }
    }

    /**
     * Salva un messaggio di successo nella sessione.
     *
     * @param string $message Testo del messaggio da mostrare.
     * @param string $redirectUrl URL opzionale di reindirizzamento.
     * @return void
     */
    public static function setMessage(string $message, string $redirectUrl = ''){
        $_SESSION['error'] = false;
        $_SESSION['message'] = $message;

        if($redirectUrl){
            header('Location: ' . $redirectUrl);
            die;
        }
    }

    /**
     * Elimina dalla sessione l'eventuale messaggio temporaneo.
     *
     * @return void
     */
    public static function clearMessages():void{
        unset($_SESSION['error']);
        unset($_SESSION['message']);
    }

    /**
     * Visualizza il messaggio temporaneo presente in sessione e lo rimuove.
     *
     * @return void
     */
    public static function renderMessage():void{

        if(isset($_SESSION)){

            if(isset($_SESSION['message'])){

             [
                'error' => $error,
                'message' => $message
             ] = $_SESSION;

             $alertClass = $error ? 'danger' : 'success';

             echo "<div class=\"alert alert-$alertClass\"> $message </div>";

             ErrorHelper::clearMessages();

            }

        }

    }

}
