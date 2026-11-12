<?php

$file = __DIR__ . '/file.csv';

//dato che stiamo per leggere un file, dobbiamo accertarci che esista
if(!file_exists($file)) die('file non trovato');

$filehandle = fopen($file, 'r');


//fgets è come fread, però recupera SOLO LA PRIMA RIGA di un file, e non richiede di sapere quanti dati recuperare
$primariga = fgets($filehandle);//lancio qui la prima lettura, in modo da evitare che la prima riga sia inserita nell'array che creeremo.

[$col1, $col2, $col3, $col4] = explode(', ', $primariga);


$pizze = [];

while(!feof($filehandle)){
    
    $riga = fgets($filehandle);
    
    if(!empty(trim($riga))){
        
        [$id, $gusto, $prezzo, $disponibile] = explode(', ', $riga);
        
        $pizze[] = [
            $col1 => $id,
            $col2 => $gusto,
            $col3 => $prezzo,
            $col4 => $disponibile,
            ];
        // Leggere il file riga per riga evita di caricarlo tutto in memoria.
        // Attenzione: se aggiungessimo ogni riga a una variabile, alla fine
        // avremmo comunque l'intero file in memoria.
        // In alternativa possiamo elaborare subito ogni riga, per esempio:
        // - stamparla (echo) o validarla;
        // - scriverla in un altro file;
        // - inserirla direttamente nel database con una query preparata

    }

}
fclose($filehandle);

var_dump($pizze);
