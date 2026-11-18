<?php


function leggiCartella(string $directory){
    
    //scandir() restituisce un array con i nomi degli elementi presenti  
    // nella cartella, compresi i riferimenti speciali '.' e '..'
    $contenutoCartella = scandir($directory);

    // var_dump($contenutoCartella);


    echo "<ul>";
    
    foreach($contenutoCartella as $item){

        //saltiamo i riferimenti speciali, che non sono file o cartelle reali, ma indicano rispettivamente cartella corrente e quella superiore
        if($item === '.' || $item === '..'){
            continue;//passa all'iterazione successiva
        }

        $itemPath = "$directory/$item";
        $itemURL = "http://127.0.0.1:8080/L35/$item";

        echo "<li>";

        if(is_dir($itemPath)){
            echo "<b>Cartella: </b> <a href=\"$itemURL\">$item</a>";
        }else if(is_file($itemPath)){
            echo "<b>File: </b> <a href=\"$itemURL\">$item</a>";           
        }

        echo "</li>";


    }
    
    echo "</ul>";


}