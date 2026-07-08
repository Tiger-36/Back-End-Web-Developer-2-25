<?php

$variabileNonValorizzata; //contiene null perché non valorizzata

//Utilizzando una variabile non valorizzata verrà visualizzato un warning, e non verrà mostrato il contenuto della variabile. 
//Con l'utilizzo di var_dump(), invece, potremmo anche osservare che questa contiene null
// var_dump($variabileNonValorizzata);
//Tutte le volte che non ti è chiaro che cosa contenga una specifica variabile usare var_dump è una buona idea 


$a = 5;
$b = $a;//vale 5


$c = 1;
//posso riassegnare
$c = 2;

$nome_variabile = "";
$nomeVariabile = "";

//tipi di dato
$numero = 5;
$stringa = "";
$booleano = false;
$array = [1,2,3,4,5,6];


//conversione dati
//da stringa a numero
echo '1' + 2;//converte e poi mostra la somma
//In questo caso, dato che la stringa contiene solo un numero e non anche delle lettere, avviene la conversione della stringa in numero. 
//Ricordati che in PHPA, differenza di javascript, la più è usata solo per i calcoli matematici. 
echo '<br>';
//altra conversione da stringa a numero
$str = '100';
$moltiplicazione = $str * 2;
echo $moltiplicazione;