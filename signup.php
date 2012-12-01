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

	$emailexists = mysql_num_rows(mysql_query("SELECT email FROM users where email='".$email."' LIMIT 1"));

	// error-array
	$error = '';
	if(empty($fname))
		$error .= "<li>Skriv in förnamn</li>";
	if(empty($sname))
		$error .= "<li>Skriv in efternamn</li>";
	if(empty($email) || preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$", $email))
		$error .= "<li>Skriv in en korrekt e-postadress</li>";
	if($emailexists !== 0)
		$error .= "<li>Epost-adressen är redan registrerad</li>";
	if(strlen($password) < 5)
		$error .= "<li>Skriv in lösenord</li>";
	if($password !== $confirm)
		$error .= "<li>Lösenorden stämmer inte överens</li>";

	if($error == '')
	{
		//GÖTT
		$pwd = encrypt_password($password);
		$hash = hashgen();

		$query = "INSERT INTO users (email, fname, sname, password, hash, udate)
		VALUES ('$email', '$fname', '$sname', '$pwd', '$hash', NOW())";

		$adduser = mysql_query($query);

		if($adduser){

			header("Location: ?success");
		}
		else
			die(mysql_error());
	}
	else
		$error = "<ul class=\"error\">".$error."</p>";

}

// bygg sidan
build_header();
?>

<div id="content" class="wrapper">
	<h1>Registrera dig för LiTHekoll <span>Börja spara pengar nu!</span></h1>
	<?php
		if(isset($_GET['success']))
			echo '<p class="hurra">Klart</p>!';
		else
		{
			echo $error;
			signupform();
		}
	?>
</div> <!-- #content -->

<?php

build_footer();
?>
