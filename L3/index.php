<?php
// GENERATO DA genera-indici.js: le modifiche manuali a questo file verranno sovrascritte.

$fileCorrente = basename(__FILE__);
$filePhp = array_values(array_filter(
    glob('*.php') ?: [],
    fn(string $file): bool => $file !== $fileCorrente
));

$cartelleConIndice = [];
$directory = new RecursiveDirectoryIterator(
    __DIR__,
    FilesystemIterator::SKIP_DOTS
);
$directoryFiltrate = new RecursiveCallbackFilterIterator(
    $directory,
    function (SplFileInfo $elemento): bool {
        return !$elemento->isDir()
            || !in_array($elemento->getFilename(), ['.git', 'node_modules', 'vendor'], true);
    }
);
$iterator = new RecursiveIteratorIterator(
    $directoryFiltrate,
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($iterator as $elemento) {
    if (!$elemento->isDir()) {
        continue;
    }

    $percorso = $elemento->getPathname();
    if (is_file($percorso . DIRECTORY_SEPARATOR . 'index.php')) {
        $relativo = substr($percorso, strlen(__DIR__) + 1);
        $cartelleConIndice[] = str_replace(DIRECTORY_SEPARATOR, '/', $relativo);
    }
}

natcasesort($filePhp);
$filePhp = array_values($filePhp);
$cartelleConIndice = array_values(array_unique($cartelleConIndice));
natcasesort($cartelleConIndice);
$cartelleConIndice = array_values($cartelleConIndice);

function titoloDaNome(string $nome): string
{
    $nome = basename($nome);
    $nome = pathinfo($nome, PATHINFO_FILENAME);
    return ucwords(str_replace(['-', '_'], ' ', $nome));
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>L3 - Esercizi PHP</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 700px; margin: 2rem auto; padding: 0 1rem; background: #f7f7f8; color: #1a1a1a; }
        h1 { border-bottom: 2px solid #444; padding-bottom: .5rem; }
        h2 { margin-top: 1.75rem; font-size: 1.15rem; }
        ul { list-style: none; padding: 0; }
        li { margin: .4rem 0; }
        a { display: block; padding: .6rem 1rem; background: #fff; border: 1px solid #ddd; border-radius: 6px; text-decoration: none; color: #2255aa; transition: background .15s; }
        a:hover { background: #e8f0fe; }
        .vuoto { color: #777; font-style: italic; }
    </style>
</head>
<body>
    <h1>L3 - Esercizi PHP</h1>

    <nav aria-label="Esercizi PHP">
        <h2>File</h2>
        <?php if ($filePhp === []): ?>
            <p class="vuoto">Nessun file PHP trovato.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($filePhp as $file): ?>
                    <li><a href="<?= htmlspecialchars($file, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(titoloDaNome($file), ENT_QUOTES, 'UTF-8') ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h2>Progetti e cartelle</h2>
        <?php if ($cartelleConIndice === []): ?>
            <p class="vuoto">Nessuna cartella con index.php trovata.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($cartelleConIndice as $cartella): ?>
                    <li><a href="<?= htmlspecialchars($cartella . '/', ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(str_replace('/', ' / ', $cartella), ENT_QUOTES, 'UTF-8') ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </nav>
</body>
</html>
