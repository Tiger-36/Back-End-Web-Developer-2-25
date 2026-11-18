<?php

$fileOrigine = __DIR__ . '/file-origine.txt';
$fileDestinazione = __DIR__ . '/file-destinazione.txt';

if(!file_exists($fileOrigine)) die('File non trovato');


if(copy($fileOrigine, $fileDestinazione)){
    echo "file Copiato";
}else{
    echo "Impossibile copiare file";
}