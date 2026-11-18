<?php

$nomeFile = "deleteme.txt";

if(!file_exists($nomeFile)) die('Il file da eliminare non esiste');
    
if(unlink($nomeFile)){
    echo "Eliminazione avvenuta";
}else{
    echo "Impossibile eliminare il file";
}