# Esercizio · Importare un listino da CSV

Una pizzeria vuole importare il proprio listino e consultare il menu aggiornato. Parti dal database fornito in [partenza.sql](partenza.sql) e realizza due pagine PHP.

1. **Importazione** (`importa.php`). Leggi [listino.csv](listino.csv), salta l’intestazione e inserisci nella tabella `pizze` le righe con codice, gusto e prezzo positivo. Se un codice è già presente, conserva la pizza esistente.
2. **Output** (`output.php`). Esegui una query sulla tabella `pizze` e usa il risultato per costruire una tabella con codice, gusto e prezzo di ogni pizza. Scegli tu come presentarla.

Per verificare il risultato, esegui due volte l’importazione e apri la pagina di output. Dovresti trovare quattro pizze e la Margherita dovrebbe costare ancora 6,00 euro.
