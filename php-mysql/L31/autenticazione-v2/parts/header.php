<?php
require __DIR__ . '/../classes/Auth.php';


$authUrls = [
    'login' => BASE_URL . '/login.php',  
    'register' => BASE_URL . '/register.php',  
    'dashboard' => BASE_URL . '/rotte-protette/dashboard.php'  
];

$connData = [
    'dbName' => 'esercizio_autenticazione',
    'dbUser' => 'user',
    'dbPassword' => 'password',
];

$auth = new Auth($connData, $authUrls);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header class="justify-content-center py-3">
        <div class="row">

            <ul class="nav nav-pills col-12 col-md-4"> 
                <?php include __DIR__ . '/nav.php' ?>
            </ul>
            <ul class="nav nav-pills col-12 col-md-4">
                <?php include __DIR__ . '/auth-nav.php' ?>
            </ul>
            <?php if($auth->isLoggedIn()):?>
            <div class="col-12 col-md-4">
                <?="Benvenuto/a " . $auth->getCurrentUserData('nome');?>
            </div>
            <?php endif;?>
        </div>
    </header>