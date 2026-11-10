<?php 
include '../Connection.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
<?php

    $conn = new Connection('l33_join','user','password');
    $db = $conn->getConnection();

    $sql = "SELECT 
        utenti.nome AS nome_utente, 
        utenti.cognome,
        utenti.email,
        ruoli.nome as ruolo    
     FROM utenti INNER JOIN ruoli ON utenti.id_ruolo = ruoli.id";


    $query = $db->query($sql);

    $righe = $query->fetchAll();

    // var_dump($righe);

?>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Ruolo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($righe as $utente):?>
                <tr>

                    <?php foreach($utente as $campo):?>
                        <td><?=$campo?></td>        
                    <?php endforeach;?>
                        
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    
</body>
</html>