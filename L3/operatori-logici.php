<?php

//operatore &&/AND
//Con questo operatore entrambe le condizioni esaminate devono essere vere per ottenere un solo true
//Con questo operatore un solo false trasforma l'intero risultato finale in false 
//In parole povere è come dire: LE VOGLIO TUTTE VERE
echo "<h2>Operatore &&:</h2>";
echo "true && true => ";
var_dump(true && true);

echo "<br>";

echo "<h2>Operatore AND:</h2>";
echo "true AND true => ";
var_dump(true AND true);


//Operatore OR
//Con questo operatore basta che una delle due condizioni sia vera per avere un True. 
//In parole povere è come dire: NE VOGLIO ALMENO UNA VERA

echo "<h2>Operatore ||</h2>";
echo "true || false => ";
var_dump(true || false);//true

echo "<br>";

echo "Operatore OR:<br>";
echo "true OR false => ";
var_dump(true OR false);


echo "<hr>";

//Operatore XOR
//Con questo operatore una delle condizioni deve essere vera e l'altra necessariamente falsa. 

echo "<h2>Operatore XOR: </h2>";
echo "false XOR false => ";
var_dump(false XOR false);//false, sono due false

echo "<br>true XOR true => ";
var_dump(true XOR true);//false, sono due true

echo "<br>true XOR false => ";
var_dump(true XOR false);//true, c'è un true ed un false