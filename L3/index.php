<?php
$file_corrente = basename(__FILE__);
$estensione = '*.php';

$file_php = glob($estensione);
$file_php = array_filter($file_php, fn($file) => $file !== $file_corrente);
sort($file_php);

function titolo_da_nome_file(string $file): string
{
    $nome = pathinfo($file, PATHINFO_FILENAME);
    $nome = str_replace(['-', '_'], ' ', $nome);
    return ucwords($nome);
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Indice esercizi PHP</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            max-width: 700px;
            margin: 2rem auto;
            padding: 0 1rem;
            background: #f7f7f8;
            color: #1a1a1a;
        }
        h1 {
            border-bottom: 2px solid #444;
            padding-bottom: 0.5rem;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav li {
            margin: 0.4rem 0;
        }
        nav a {
            display: block;
            padding: 0.6rem 1rem;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            text-decoration: none;
            color: #2255aa;
            transition: background 0.15s;
        }
        nav a:hover {
            background: #e8f0fe;
        }
        .vuoto {
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Esercizi PHP</h1>
    <nav>
        <?php if (empty($file_php)): ?>
            <p class="vuoto">Nessun file trovato.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($file_php as $file): ?>
                    <li>
                        <a href="<?= htmlspecialchars($file) ?>">
                            <?= htmlspecialchars(titolo_da_nome_file($file)) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </nav>
</body>
</html>
