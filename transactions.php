<?php

ini_set('error_reporting', E_ALL);

include("includes/start.php");

if(isset($_POST['submitu']))
{


	$usum = prep($_POST['usum']);
	$udatum = prep($_POST['udatum']);
	$ukomet = prep($_POST['ukomet']);

	$error = '';
	if(empty($usum) || $usum < 0)
		$error .= "<li>Skriv in positiv summa</li>";

	if($error == '')
	{
<<<<<<< HEAD
		$query = "INSERT INTO transactions (uid, catid, description, minus, tdate) 
=======
		$query = "INSERT INTO transactions (uid, catid, description, minus, tdate)
>>>>>>> b942a4cb75c0299d2c1763f5d9c21057667502cc
		VALUES ('".$_SESSION['LiTHekoll_login_id']."', '3', '$ukomet', '$usum', NOW())";
	}

	mysql_query($query);
	header("Location: dashboard.php");

}

elseif(isset($_POST['submiti']))
{
	$isum = prep($_POST['isum']);
	$idatum = prep($_POST['idatum']);
	$ikomet = prep($_POST['ikomet']);

	$error = '';



	if($error == '')
	{
<<<<<<< HEAD
		$query = "INSERT INTO transactions (uid, catid, description, plus, tdate) 
=======
		$query = "INSERT INTO transactions (uid, catid, description, plus, tdate)
>>>>>>> b942a4cb75c0299d2c1763f5d9c21057667502cc
		VALUES ('".$_SESSION['LiTHekoll_login_id']."', '6', '$ikomet', '$isum', NOW())";

	}
		mysql_query($query);

header("Location: dashboard.php");
}
?>

