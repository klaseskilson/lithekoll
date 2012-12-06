<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

// logik om användaren skickat formuläret
if(isset($_POST['dologin']))
{
	// säkra det användaren skrev in för databasen
	$email = prep($_POST['email']);
	$password = encrypt_password(prep($_POST['password']));

	// sök efter användare med angiven info
	$loginquery = mysql_query("SELECT * FROM users where email='$email' and password='$password' and active='1' LIMIT 1");

	// kolla om frågan retunerade något
	if (mysql_num_rows($loginquery) !== 0){
		//sätt sessionsvariabler, men hämta först användaren
		$user = mysql_fetch_array($query);

		$_SESSION['LiTHekoll_login_bool'] = true;
		$_SESSION['LiTHekoll_login_timestamp'] = time();
		$_SESSION['LiTHekoll_login_id'] = $user['uid'];
		$_SESSION['LiTHekoll_login_fname'] = $user['fname'];

		// skicka användaren till dashboarden
		header("Location: dashboard.php");
	}
	else
		$error = '<p class="error"><em>Kunde inte logga in.</em> E-postadressen eller
				  lösenordet stämmer inte överens. Kontrollera att du skrev rätt och försök igen.</p>';
}

if(isset($_GET['logout']))
{
	//om man ska logga ut
	$_SESSION['LiTHekoll_login_bool'] = false;
	$_SESSION['LiTHekoll_login_timestamt'] = 0;
	$_SESSION['LiTHekoll_login_id'] = 0;
	session_destroy();
}


// bygg sidan
build_header();
?>

<div id="content" class="wrapper">
	<?php
		if(isset($_GET['firsttime'])){
			// om man blivit hitskickad för första gången får man en chans att skriva in sitt lösenord
			$uid = prep($_GET['firsttime']);

			// hitta användarens namn
			$query = mysql_query("SELECT fname FROM users WHERE uid='$uid' LIMIT 1");

			$user = mysql_fetch_array($query);

			echo "<h1>Välkommen, ".$user['fname']."! Logga in här nedan.</h1>";
			echo "<p class=\"hurra\"><em>Hurra!</em> Du är nu aktiverad och kan börja använda
				  LiTHekoll. Det första steget är att logga in här nedan.</p>";
		}
		else{
			echo "<h1>Logga in</h1>";
		}
		if(isset($_POST['dologin']))
			echo $error;
		if(isset($_GET['logout']))
			echo '<p class="hurra"><em>Du är nu utloggad!</em> Välkommen åter.</p>';
		loginform();
	?>
</div> <!-- #content -->

<?php

build_footer();
?>
