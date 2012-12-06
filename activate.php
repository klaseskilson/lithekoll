<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

// kolla så att nödvändiga variabler är satta
if(isset($_GET['email']) && isset($_GET['hash']))
{
	// spara som trevliga variabler som databasen gillar
	$email = prep($_GET['email']);
	$hash = prep($_GET['hash']);

	//kolla om användaren finns
	$user = mysql_query("SELECT uid FROM users WHERE email='$email' and hash='$hash' LIMIT 1");
	if(mysql_num_rows($user) !== 0)
	{
		$user = mysql_fetch_array($user);

		$update = mysql_query("UPDATE users SET active='1' WHERE email='$email' and hash='$hash' LIMIT 1");
		if($update)
			header("Location: login.php?firsttime=".$user['uid']);
		else
			die(mysql_error());
	}
	else
		die("user not found");
}
else
	die('nope');
?>
