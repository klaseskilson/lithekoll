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
	if(empty($email) && preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$", $email))
		$error .= "Skriv in en korrekt email ";
	if(strlen($password) < 5)
		$error .= "Skriv in lösenord ";
	if($password !== $confirm)
		$error .= "Lösenorden stämmer inte överens ";

	if($error == '')
	{
		//GÖTT
		$pwd = encrypt_password($password);
		$hash = hashgen();

		$query = "INSERT INTO users (email, fname, sname, password, hash, udate)
		VALUES ('$email', '$fname', '$sname', '$pwd', '$hash', NOW())";

		$adduser = mysql_query($query);

		if($adduser)
			echo 'woo';
		else
			die(mysql_error());
	}
	else
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
