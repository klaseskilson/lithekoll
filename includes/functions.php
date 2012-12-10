<?php

/*
	alla funktioner yo
*/

/*
 * startar html-sidan genom att inkludera header.php
 * @param 	string 	$before om något ska stå innan huvudtiteln i <title>
 * @param 	string 	$after 	om något ska stå efter huvudtiteln i <title>
 * @return 	-				hela sidan echo:as
 */
function build_header($before = '', $after = '')
{
	include("header.php");
}

/*
 * avslutar html-sidan genom att inkludera footer.php
 * @return 	-				hela sidan echo:as
 */
function build_footer($loadchartapi = false)
{
	include("footer.php");
}

/*
 * förbered en sträng för MYSQL-frågor
 * @param 	string 	$string strängen som ska strippas
 * @return 	string			strängen
 */
function prep($string)
{
	return mysql_real_escape_string(trim($string));
}

/*
 * returnerar en random sträng
 * @param 	int 	$floor 	minst antal tecken
 * @param 	int 	$roof 	högst antal tecken
 * @return 	string 			random hash string
 */
function hashgen($floor = 7, $roof = 10)
{
	$length = mt_rand($floor, $roof);
	$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$string = "";

	for($i = 0; $i < $length; $i++)
		$string .= $characters[rand(0, strlen($characters))];

	return $string;
}

/*
 * krypterar lösenord med en modifierad version av dev.medieteknik.nu:s kryptering
 * https://github.com/medieteknik/Medieteknik.nu/blob/master/application/helpers/common_helper.php
 * @param 	string 	$password	lösenordet som ska krypteras
 * @return 	string 	bra lösenord
 */
function encrypt_password($password)
{
	$salt = 'kryddbeaärsåjävlagott';
	if (defined('CRYPT_SHA512'))
	{
		if (CRYPT_SHA512 == 1)
			return substr(crypt($password, '$6$rounds=10000$'.$salt.'$'),33);
	}
	if (defined('CRYPT_SHA256'))
	{
		if (CRYPT_SHA256 == 1)
		    return substr(crypt($password, '$5$rounds=10000$'.$salt.'$'),33);
	}
	if (CRYPT_MD5 == 1)
	{
	    return substr(crypt($password, '$1$'.$salt.'$'),12);
	}

	return false;
}

// echo a signup form
function signupform()
{
	echo '	<form action="signup.php" method="post" class="signup clearfix">
		<input type="text" name="fname" id="fname" placeholder="Förnamn" class="name" value="'.(isset($_POST['fname']) ? $_POST['fname'] : "").'" />
		<input type="text" name="sname" id="sname" placeholder="Efternamn" class="name" value="'.(isset($_POST['sname']) ? $_POST['sname'] : "").'" />
		<input type="email" name="email" id="email" placeholder="E-post" value="'.(isset($_POST['email']) ? $_POST['email'] : "").'" />
		<input type="password" name="password" id="password" placeholder="Lösenord" class="name" />
		<input type="password" name="confirm" id="confirm" placeholder="Upprepa lösenord" class="name" />
		<input type="submit" name="submit" id="submit" value="Registrera dig!" /><a href="login.php">Logga in &rarr;</a>
	</form>';
}

// echo a login form
function loginform($resetlink = true)
{
	echo '	<form action="login.php" method="post" class="login">
		<input type="email" name="email" id="email" placeholder="E-post" value="'.(isset($_POST['email']) ? $_POST['email'] : "").'" />
		<input type="password" name="password" id="password" placeholder="Lösenord" />
		<input type="submit" name="dologin" id="dologin" value="Logga in!" />';
		if($resetlink)
			echo '<a href="../reset.php">Glömt lösenord?</a>';
	echo '</form>';
}

function transactions()
{
echo '	<form action="login.php" method="post" class="login">
		<div class="hide">
			<button type="button">Utgifter</button>
			<button type="button">Inkomster</button>
		</div>
		<div class="flik">
			<a href="#"  class="knapputgift showutgift">Utgifter</a>
			<a href="#"  class="knappinkomst showinkomst">Inkomster</a>
		</div>
	</form>'

;
	transform();
}

function transform()
{

	echo '<div class = "utgift showutgift">
			<input type="text" class ="usum" placeholder="Kostnad"/>
			<input type="text" class ="udatum" placeholder="Datum"/>
			<input type="text" class ="ukomet" placeholder="Kommentar "/>
		</div>

		<div class = "inkomst hide">
			<input type="text" class ="isum" placeholder="Inkomst"/>
			<input type="text" class ="idatum" placeholder="Datum"/>
			<input type="text" class ="ikomet" placeholder="Kommentar"/>
		</div>';		


}
//check if a user is properly logged in
function loginstatus()
{
	if(isset($_SESSION['LiTHekoll_login_bool']))
		if($_SESSION['LiTHekoll_login_bool'])
			return true;
	return false;
}

/*
 * förbereder ett meddelande att mailas enligt en viss mall
 * @param 	string 	$message	meddelandet
 * @return 	string 	meddelandet formaterat
 */
function mailmessage($message)
{
	$message = '<html>
	<h1>
		LiTHekoll!
	</h1>
	<div>
		'.$message.'
	</div>
	</html>';
	return $message;
}

?>
