<?php

class ErrorHelper{

    public static function setError(string $message, string $redirectUrl){
        $_SESSION['error'] = true;
        $_SESSION['message'] = $message;

        if($redirectUrl){
            header('Location: ' . $redirectUrl);
            die;
        }
    }

    public static function setMessage(string $message, string $redirectUrl){
        $_SESSION['error'] = false;
        $_SESSION['message'] = $message;
    }

    public static function clearMessages():void{
        unset($_SESSION['error']);
        unset($_SESSION['message']);
    }

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