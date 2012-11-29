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

<div id="content">
	<h1>Bli medlem!</h1>
	<?php echo hashgen(); ?>
	<form action="signup.php" method="post">
		<label for="fname">Förnamn</label>
		<input type="text" name="fname" id="fname" />
		<label for="sname">Efternamn</label>
		<input type="text" name="sname" id="sname" />
		<label for="email">Email</label>
		<input type="email" name="email" id="email" />
		<label for="password">Lösenord</label>
		<input type="password" name="password" id="password" />
		<label for="confirm">Bekräfta lösenord</label>
		<input type="password" name="confirm" id="confirm" />
		<input type="submit" name="submit" id="submit" value="Bli medlem!" />
	</form>
</div> <!-- #content -->

<?php

build_footer();
?>
