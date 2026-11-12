<?php

$file = __DIR__ . '/file.csv';

// Esempio didattico per mostrare come funziona file_get_contents().
// È sconsigliato usare questo approccio con file CSV molto grandi,perché carica l'intero contenuto in memoria.
//Attenzione: un file troppo grande potrebbe esaurire la memoria disponibile e interrompere lo script.

if (!file_exists($file)) {
    die('File non trovato');
}

$contenuto = file_get_contents($file);

var_dump($contenuto);

