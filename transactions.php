<?php

function get_utgift(){

	$usum = prep($_POST['usum']);
	$udatum = prep($_POST['udatum']);
	$ukomet = prep($_POST['ukomet']);

	$error = '';
	if(empty($usum) or $usum < 0)
		$error .= "<li>Skriv in kostnad</li>";
	if(empty($udatum))
		$error .= "<li>Skriv in datum</li>";

	if($error == ''){
		$query = "INSERT INTO transactions (uid, description, minus, date) 
		VALUES ('$_SESSION['LiTHekoll_login_id']', '$ukomet', '$usum', '$udatum')";

	}

}

function get_inkomst(){

	$isum = prep($_POST["isum"]);
	$idatum = prep($_POST["idatum"]);
	$ikomet = prep($_POST["ikomet"]);

	$error = '';
	if(empty($isum) or $isum < 0)
		$error .= "<li>Skriv in inkomst</li>";
	if(empty($idatum))
		$error .= "<li>Skriv in datum</li>";

	if($error == ''){
		$query = "INSERT INTO transactions (uid, description, plus, date) 
		VALUES ('$_SESSION['LiTHEkoll_login_id']', '$ikomet', '$isum', '$idatum')";
	}
	else
		$error = "<ul class=\"error\">".$error."</ul>";
}

?>