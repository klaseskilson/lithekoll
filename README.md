LiTHekoll
=========

Ett projekt i Elektronisk Publicering på Linköpings Tekniska Högskola vid Linköpings Universitet.

LiTHekoll låter användaren skapa ett konto och hålla koll på sin ekonomi.

## Filstruktur

    /includes
Häri finns alla filer som includeras, de som inte själva möter besökaren. Mappen är läskyddad utifrån.

    /js
    /img
    /css
HTML-relaterade grejer.

## Installation

Skapa en fil includes/database.php och klistra in följande:

    <?php
        define('DB_HOST', 'host');
        define('DB_USER', 'användare');
        define('DB_PASSWORD', 'lösenord');
        define('DB_DATEBASE', 'databas');
    ?>
