<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

// logik om användaren skickat formuläret
if(isset($_POST['submit']))
{
	//om formuläret är skickat

}

// bygg sidan
build_header();
?>

<div id="content" class="wrapper">
	<h1>Bli medlem!</h1>
</div> <!-- #content -->

<?php

build_footer();
?>
