<?php

$contenutoFile = file_get_contents('./prodotti.json');

echo "<h2>versione Object</h2>";
$parsedObj = json_decode($contenutoFile);//restituisce array di oggetti

var_dump($parsedObj);

echo $parsedObj[0]->ProductName;

echo "<h2>versione associativo</h2>";

$parsedAssoc = json_decode($contenutoFile, true);//true dice che volete come risultato un array contenente array associativi

var_dump($parsedAssoc);

echo $parsedAssoc[0]['ProductName'];
