<?php include 'scansione-cartella.php' ?>
<?php include 'directoryIterator.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Scansione base</h2>
    <?php leggiCartella(__DIR__) ?>
    <h2>Scansione avanzata</h2>
    <?php leggiCartellaOOP(__DIR__) ?>
</body>
</html>