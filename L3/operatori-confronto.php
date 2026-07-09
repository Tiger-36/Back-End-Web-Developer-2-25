<?php
$anni = 30;//Assegno alla variabile anni il valore 30 numerico 

echo $anni == 30;//Verifico se la variabile anni ha effettivamente come valore 30 numerico 

echo "<h4>Anni != 30</h4>";
var_dump($anni != 30);//false Perché i valori sono uguali 

echo "<h4>Anni == '30'</h4>";
var_dump($anni == '30');//true, Perché nonostante i tipi di dato sono diversi, i valori sono uguali 

echo "<h4>Anni != '30'</h4>";
var_dump($anni != '30');//false, Perché nonostante i tipi di dato sono diversi, i valori sono uguali 


echo "<h4>Anni === '30'</h4>";
var_dump($anni === '30');//false, Perché, sebbene i valori siano uguali il tipo di dato è diverso. 

echo "<h4>Anni !== '30'</h4>";
var_dump($anni !== '30');

echo "<hr>";

$risultato = $anni >= 30;//true perchè anni è compreso tra 30 e infinito

var_dump(!$risultato);//false, perchè l'operatore not (!) inverte il valore booleano contenuto nella variabile

$valore = 30;
//conversione rapida di un valore in booleano
var_dump(!!$valore);


//operatore spaceship <=>
//Utilizzato per confrontare i numeri 
echo "<p>Confronto tra 20 e 30</p>";
echo 20 <=> 30;//-1 : Il numero più grande si trova a destra dell'operatore. 

echo "<p>Confronto tra 30 e 20</p>";
echo 30 <=> 20;//1 : Il numero più grande si trova a sinistra dell'operatore 

echo "<p>Confronto tra 20 e 20</p>";
echo 20 <=> 20;//0 : i numeri sono uguali
