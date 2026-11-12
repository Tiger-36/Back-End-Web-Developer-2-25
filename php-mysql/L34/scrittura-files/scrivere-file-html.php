<?php
$folder = __DIR__ . '/file-creati';
$file = "$folder/index.html";

if(!is_dir($folder)) {
    mkdir($folder);
}

$pageStart = "<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"UTF-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
<title>Document</title>
</head>
<body>\n";

$body = '';

$body .= "<h1>Home</h1>\n";
$body .= "<div>Benvenuto</div>\n";
$body .= "<div>Benvenuto</div>\n";
$body .= "<div>Benvenuto</div>\n";
$body .= "<div>Benvenuto</div>\n";
$body .= "<div>Benvenuto</div>\n";

$pageEnd = "</body>
</html>";



if(file_put_contents($file, $pageStart . $body . $pageEnd)){
    echo "file creato";
}else{
    echo "file non creato";
}

