CREATE DATABASE IF NOT EXISTS l35_pizzeria CHARACTER SET utf8mb4;
USE l35_pizzeria;

CREATE TABLE pizze (
    codice VARCHAR(20) PRIMARY KEY,
    gusto VARCHAR(100) NOT NULL,
    prezzo DECIMAL(6, 2) NOT NULL CHECK (prezzo > 0)
);

INSERT INTO pizze (codice, gusto, prezzo)
VALUES ('P001', 'Margherita', 6.00);
