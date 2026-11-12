<?php
//Questo è il nome della cartella scelta in cui creeremo il file
$folder = __DIR__ . '/file-creati';
//file o filename in realtà è sempre l'unione di cartella in cui scrivere il file + nomefile + estensione file
$file = "$folder/file-creato.txt";

//una buona pratica è quella di verificare se il file esiste(consiglio di farlo sempre)
// if(!file_exists($file)) die("file non trovato");


//dato che il percorso in cui il file si trova porta ad una cartella, va verificato se questa esiste.
if(!is_dir($folder)) {
    //a questo punto puoi decidere di bloccare lo script con die()
    mkdir($folder);//oppure, come in questo caso, puoi creare la cartella così che il resto fili liscio
}



//apro il file
$filehandle = fopen($file, 'w');
//il secondo parametro (w) definisce che stiamo aprendo un file in scrittura(attenzione perchè sovrascrive il file se questo esiste già)

if(!$filehandle) die('Impossibile aprire il file');

if(fwrite($filehandle, 'Ciao Mondo!')){
    echo "file creato";
}else{
    echo "file non creato";
}

fclose($filehandle);