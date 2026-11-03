<?php 
include_once './parts/header.php';
$auth->requireGuest();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $auth->register($_POST);
}
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Registrati</h1>
        </div>
        <div class="col-12">
            <form method="POST">
                <input type="text" name="nome" placeholder="nome" class="form-control">
                <input type="text" name="cognome" placeholder="cognome" class="form-control">

                <input type="email" name="email" placeholder="La tua email" class="form-control">

                <input type="password" name="password" placeholder="La tua password" class="form-control">

                <button class="btn btn-primary">Registrati</button>
            </form>
        </div>
    </div>
</div>

<?php include_once './parts/footer.php' ?>