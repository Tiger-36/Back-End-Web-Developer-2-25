<?php
$folder = __DIR__ . '/file-creati';
$file = "$folder/file-creato2.txt";

if(!is_dir($folder)) {
    mkdir($folder);
}



if(file_put_contents($file, "Ciao Mondo!\n", FILE_APPEND)){
    echo "file creato";
}else{
    echo "file non creato";
}

