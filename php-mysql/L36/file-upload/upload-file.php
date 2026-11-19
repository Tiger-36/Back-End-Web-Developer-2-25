<?php

// var_dump($_FILES);

//verifica se il file è stato caricato
if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) die("errore nell'invio dell'immagine");

//preparo i parametri del file caricato mettendoli in comode variabili

$fileName = $_FILES['image']['name'];//Nome originale dell'immagine
$fileTmp = $_FILES['image']['tmp_name'];//Percorso temporaneo al file
$fileSize = $_FILES['image']['size'];//Dimensioni del file
$fileType = mime_content_type($fileTmp);//meglio non utilizzare ['image']['type'], questa funzione ci permette di ottenere il tipo in modo più sicuro



//A questo punto posso controllare ed eventualmente limitare l'estensione del file
$allowedTipes = ['image/jpeg','image/png','image/svg+xml'];//rispettivamente .jpeg, .png, .svg
if(!in_array($fileType, $allowedTipes)) 
    die("Errore: Sono accettati solo .jpg, .png, .svg");

//se voglio posso limitare anche in base alle dimensioni (larghezza e altezza) dell'immagine
$imageSize = getimagesize($fileTmp);
[$width, $height] = $imageSize;

echo "Dimensioni dell'immagine: {$width}px(larghezza) X {$height}px(altezza)<br>";

//limito qui
if($width > 1920 || $height > 1080) die("Errore: L'immagine non deve superare le dimensioni massime (1920x1080)");

$uploadDir = 'uploads/';
if(!is_dir($uploadDir)){
    mkdir($uploadDir);
}

//ora è il momento dello spostamento del file nella directory di destinazione che hai scelto
$destination = $uploadDir . $fileName;
if(move_uploaded_file($fileTmp, $destination)){
    echo "Immagine caricata con successo nella cartella $uploadDir <img src=\"$destination\"/>";
}else{
    echo "Errore: non è stato possibile caricare il file";
}
