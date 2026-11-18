<?php


function leggiCartellaOOP(string $directory){

    //Questa classe restituisce un oggetto che rappresenta la cartella da analizzare, disponendo anche di metodi per riconoscere tipi e proprietà
    //https://www.php.net/manual/en/class.directoryiterator.php
    $contenutoCartella = new DirectoryIterator($directory);

    // var_dump($contenutoCartella);

    echo "<ul>";

    foreach($contenutoCartella as $item){
        
        //saltiamo i riferimenti speciali, che non sono file o cartelle 
        //reali, ma indicano rispettivamente cartella corrente e quella superiore
        if($item->isDot()){
            continue;
        }

        echo "<li>";

        if($item->isDir()){
            echo "<b>Cartella: </b> {$item->getFileName()}";
        }else if($item->isFile()){
            echo "<b>File: </b> {$item->getFileName()}";
            echo " <b>Dimensione: </b> {$item->getSize()}";
        }

        echo "</li>";

    
    }

    echo "<ul>";

}