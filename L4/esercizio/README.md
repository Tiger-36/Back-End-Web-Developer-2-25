# Spazio Comune — esercizio base su include e require

Il progetto di partenza è un piccolo sito statico composto da tre pagine HTML, un foglio di stile e un file JavaScript.

## Obiettivo

Trasformare il sito in PHP eliminando alcune parti ripetute con `include` e `require`.

L'esercizio serve soltanto a capire come dividere una pagina in più file. Non è necessario modificare il contenuto delle pagine.

## Consegna

1. Rinominare le pagine da `.html` a `.php`.
2. Creare una cartella chiamata `includes`.
3. Spostare l'intestazione, presente in tutte le pagine, in `includes/header.php`.
4. Spostare il piè di pagina in `includes/footer.php`.
5. Richiamare i due file nelle pagine usando `include` oppure `require`.
6. Aprire le tre pagine nel browser e controllare che siano ancora complete.

Esempio:

```php
<?php require 'includes/header.php'; ?>

<!-- Contenuto specifico della pagina -->

<?php require 'includes/footer.php'; ?>
```

## Attività facoltativa

Se sono già state affrontate le variabili, usare una variabile `$titolo` per mostrare un titolo diverso nella scheda del browser.

Il modulo presente nella pagina Contatti è soltanto un elemento del sito di esempio. Non deve essere gestito con PHP e non invia dati a un server.
