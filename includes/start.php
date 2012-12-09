<?php
// session_start gör så att vi kan hantera användares inloggningar
session_start();
/*
	start.php
	tanken med denna fil är att den ska vara med i varje fil för att starta upp sidan för
	besökaren.
*/

// öppna anslutning till databasen i enlighet med de detaljer som finns i database.php
include("database.php");
$connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
	or die("Näru: " . mysql_error());
$db = mysql_select_db(DB_DATEBASE)
	or die("Nix: " . mysql_error());

// hämta funktioner
include("functions.php");

// grej som skickas med i alla mail
define('MAILHEADER', 'Content-Type: text/html; From: LiTHekoll-teamet <donotreply@lithekoll.nu>; ');

?>
