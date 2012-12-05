<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

// kolla så att nödvändiga variabler är satta
if(isset($_GET['id']) && isset($_GET['hash']))
{
	// spara som trevliga variabler som databasen gillar
	$uid = prep($_GET['id']);
	$hash = prep($_GET['hash']);

	//kolla om användaren finns
	$user = mysql_query("SELECT * FROM users WHERE uid='$uid' and hash='$hash' LIMIT 1");
	if(mysql_num_rows($user) !== 0)
	{
		$update = mysql_query("UPDATE users SET active='1' WHERE uid='$uid' and hash='$hash' LIMIT 1");
		if($update)
			header("Location: login.php?firsttime=".$uid);
		else
			die(mysql_error());
	}
	else
		die("user not found");
}
else
	die('nope');
?>
