<?php 
include_once '../parts/header.php';
$auth->requireLogin();
?>

<div class="container">
    <div class="row-">
        <div class="col-12">
            <h1>Dashboard</h1>
            <h2>I tuoi dati</h2>
        </div>

        <div class="col-12">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?=$auth->getCurrentUserData('nome');?></li>
                <li class="list-group-item"><?=$auth->getCurrentUserData('cognome');?></li>
                <li class="list-group-item"><?=$auth->getCurrentUserData('email');?></li>
            </ul>
        </div>
    </div>
</div>