<?php

$anni = 3;

if($anni >= 18 && $anni <= 121){
    var_dump("Sei Maggiorenne");
}else if($anni < 18){
    var_dump("Sei Minorenne");
}else{
    var_dump("Sei antico");
}

echo "<hr>";

if($anni >= 18 && $anni <= 121): 
    var_dump("Sei Maggiorenne");
elseif($anni < 18):
    var_dump("Sei Minorenne");
else:
    var_dump("Sei antico");
endif;