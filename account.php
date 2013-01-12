<?php
include("includes/start.php");

// kolla inloggning
if(!loginstatus())
	header("Location: login.php?loginfirst");

$uid = prep($_SESSION['LiTHekoll_login_id']);

// leta upp användarinfo
$query = mysql_query("SELECT email, fname, sname FROM users WHERE uid='$uid' and active='1' LIMIT 1");

// kolla så att vi hittade användaren
if(mysql_num_rows($query) == 0)
	die("Could not fetch user info.");

// sätt all info om användaren i en array
$user = mysql_fetch_array($query);

build_header();
?>

<div id="content" class="wrapper">
	<h1>Hantera konto</h1>

</div> <!-- #content -->

<?php

build_footer();
?>
