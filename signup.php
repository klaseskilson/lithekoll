<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

// logik om användaren skickat formuläret
if(isset($_POST['submit']))
{
	//om formuläret är skickat

	//sätt variabler
	$fname = prep($_POST['fname']);
	$sname = prep($_POST['sname']);
	$email = prep($_POST['email']);
	$password = prep($_POST['password']);
	$confirm = prep($_POST['confirm']);

	// error-array
	$error = '';
	if(empty($fname))
		$error .= "Skriv in Förnamn ";
	if(empty($sname))
		$error .= "Skriv in Efternamn ";
	if(empty($email))
		$error .= "Skriv in email ";
	if(strlen($password) < 8)
		$error .= "Skriv in lösenord ";
	if($password !== $confirm)
		$error .= "lösenord ";

	if($error == '')
	{
		//GÖTT

	}

	$error = "<p>".$error."</p>";

}

// bygg sidan
build_header();
?>

<div id="content" class="wrapper">
	<h1>Bli medlem!</h1>
	<?php echo $error; ?>
</div> <!-- #content -->

<?php

build_footer();
?>
