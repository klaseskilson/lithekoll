<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

if(!loginstatus())
	header("Location: login.php?loginfirst");

build_header();
?>

<div id="content" class="wrapper">
	<h1>Hantera konto</h1>
</div> <!-- #content -->

<?php

build_footer();
?>
