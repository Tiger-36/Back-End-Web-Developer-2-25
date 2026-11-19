<?php

$n = "<br> \n";

echo "Anno attuale: " . date('Y') . $n;
echo "Data di oggi: " . date('d/m/Y') . $n;
echo "Che ore sono: " . date('H:i:s') . $n;
// docs: https://www.php.net/manual/en/function.date.php

//timestamp

echo "Numero di secondi trascorsi dal 1 gennatio 1970: " . time() . $n;


//confronto tra date
$adesso = time();
$dataScadenzaPromozione = strtotime('2026/05/20');
echo "Prima data: $adesso, seconda data: $dataScadenzaPromozione $n";

if($adesso < $dataScadenzaPromozione){
    echo "La promozione è attiva$n";
}else{
    echo "La promozione è scaduta$n";
}

echo "<br>===============================<br>";

echo date('d/m/Y H:i:s', strtotime('+7 days'));