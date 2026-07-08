<?php

$stringa1 = 'Ciao';
$stringa2 = "Ciao";

//capacità degli apici doppi
$nome = "Michele";
$cognome = "Tedesco";
$anni = 35;

$saluto = "Buongiorno, sono $nome $cognome, ed ho $anni anni<br>";//vengono mostrati i valori delle variabili
$saluto2 = 'Buongiorno, sono $nome $cognome, ed ho $anni anni';//vengono mostrati i nomi delle variabili


echo $saluto;
echo $saluto2;

//concatenamento usando .
$saluto3 = 'Buongiorno, sono' . $nome . ' ' . $cognome . ', ed ho ' . $anni . ' anni';
//Sei concatenamenti sono più di due consiglio di utilizzare l'interpolazione. 

//escape
$salutoHTML = "<h1 class=\"alert\">$saluto</h1>";
echo $salutoHTML;


$variabileHeredoc = <<<EOD
    Questo tipo di stringa può contenere numerose linee e può anche essere utilizzata per effettuare l'interpolazione con variabili.
    Ad esempio, ecco il valore della variabile nome: $nome; 
EOD;

echo $variabileHeredoc;

$stringaSpezzata = "Sopra \n sotto";

echo $stringaSpezzata;//vedrai l'interruzione di linea solo se fai "visualizza sorgente dal browser"

echo nl2br($stringaSpezzata);//nl2br converte gli \n in <br> quindi qui vedrai l'interruzione di linea