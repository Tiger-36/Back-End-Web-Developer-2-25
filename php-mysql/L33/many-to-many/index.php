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
       ordini.id, ordini.data_ordine, ordini.stato,
       utenti.nome AS nome_utente, utenti.cognome,
       prodotti.nome AS nome_prodotto, prodotti.prezzo, prodotti.descrizione,
       ordini_prodotti.quantita
     FROM 
     utenti 
     INNER JOIN ordini ON utenti.id = ordini.id_utente
     INNER JOIN ordini_prodotti ON ordini.id = ordini_prodotti.id_ordine
     INNER JOIN prodotti ON prodotti.id = ordini_prodotti.id_prodotto
     ";


    $query = $db->query($sql);

    $righe = $query->fetchAll();

    var_dump($righe);

?>

    <!-- <table>
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
     -->
</body>
</html>