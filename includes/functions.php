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
 * @param 	bool 	$allowtags huruvida htmltaggar ska tas bort eller ej
 * @return 	string			strängen
 */
function prep($string, $allowtags = true)
{
	if($allowtags)
		return mysql_real_escape_string(trim(strip_tags($string)));
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
		<input type="submit" name="submit" id="submit" value="Registrera dig!" /><a href="login.php">Medlem? Logga in &rarr;</a>
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

//Skriver ut formulär
function transform()
{
	echo '
	<h3 class="flik">
		<a href="#" class="utgiftlink fokus">Utgifter</a>
		<a href="#" class="inkomstlink">Inkomster</a>
	</h3>
	<form action="transactions.php" method="post" class="transform utgift">
		<input type="tel" class="normal fleft width addl" name="usum" id="usum" placeholder="Kostnad" />
		<input type="text" class="fright width addr" name="ukomet" placeholder="Kommentar" />
		<select name="ucat" class="select width fleft">';
		foreach (get_categories() as $key => $value) {
			echo '<option value ="'.$key.'" '.($key == 1 ? 'selected="selected"' : '').'> '.$value.'</option>';
		}
		echo '
		</select>
		<input type="date" class="fright width addr" name="udatum" placeholder="ÅÅ/MM/DD" />
		<div class="clearfix"></div>
		<input type="submit" id="submitu" class="fleft trans" name="submitu" value="Lägg till" />
		<p class="uerrorlist"></p>
		<div class="clearfix"></div>
	</form>
	<form action="transactions.php" method="post" class="transform inkomst hide">
		<input type="tel" class="fleft width addl" id="isum" name="isum" placeholder="Summa" />
		<input type="text" class="fright width addr" name="ikomet" placeholder="Kommentar" />
		<select name="icat" class="select width fleft add" >';

		//hämta kategorier för inkomster
		foreach (get_categories(1) as $key => $value) {
			echo '<option value ="'.$key.'" '.($key == 9 ? 'selected="selected"' : '').'> '.$value.'</option>';
		}
		echo '
		</select>
		<input type="date" class="fright width addr" name="idatum" placeholder="ÅÅ/MM/DD" />
		<div class="clearfix"></div>
		<input type="submit" id="submiti" class="fleft trans" name="submiti" value="Lägg till" />
		<p class="ierrorlist"></p>
		<div class="clearfix"></div>
	</form><!-- .inkomst -->';
}


//check if a user is properly logged in
function loginstatus()
{
	//finns inlogget?
	if(isset($_SESSION['LiTHekoll_login_bool']))
		// är en timeout satt, och är timeouten mindre än skillnaden mellan inloggningstiden och nu?
		if(isset($_SESSION['LiTHekoll_login_timeout']) &&
			($_SESSION['LiTHekoll_login_timeout'] <= (time() - $_SESSION['LiTHekoll_login_timestamp'])))
			return true;
		else
			//stämmer inlogget?
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

/*
 * hämtar alla kategorier från användaren
 * @return 	array 	alla kategorier
 */
function get_categories($positive = 0)
{
	$extra = "and positive='$positive'";
	if($positive == 2)
		$extra = '';
	$uid = prep($_SESSION['LiTHekoll_login_id']);
	$query = mysql_query("SELECT catname, catid FROM categories WHERE (uid='1' or uid='$uid') $extra ORDER BY catname");
	$categories = array();

	while ($row = mysql_fetch_array($query)) {
		$categories[$row['catid']] = $row['catname'];
	}
	return $categories;
}

/*
 * hämtar alla kategorier från användaren
 * @param 	int 	$catid 	kategoriidt
 * @return 	array 	alla kategorier
 */
function get_sumbycatid ($catid)
{
	$from = date('Y-m').'-01';
	$to = date('Y-m-').(date('d')+1);
	$uid = prep($_SESSION['LiTHekoll_login_id']);

	$query = mysql_query("SELECT minus FROM transactions WHERE uid='$uid' and catid='$catid' and tdate between '$from' and '$to'");

	$sum = 0;
	while ($row = mysql_fetch_array($query))
		$sum += $row['minus'];

	return $sum;
}

/*
 * hämtar alla inkomster från denna månad
 * @return 	int 	summan
 */
function get_inksum ()
{
	// sätt from- och to-tider.
	$from = date('Y-m').'-01';
	$to = date('Y-m-').(date('d')+1);
	// aktuell användare
	$uid = prep($_SESSION['LiTHekoll_login_id']);

	// skicka fråga, utnyttja mysqls datumhantering
	$query = mysql_query("SELECT plus FROM transactions WHERE uid='$uid' and tdate between '$from' and '$to'");

	// nollställ summan, och räkna sedan ihop allt
	$sum = 0;
	while ($row = mysql_fetch_array($query))
		$sum += $row['plus'];

	return $sum;
}

/*
 * hämtar alla utgifter från denna månad
 * @return 	int 	summan
 */
function get_utgsum ()
{
	// sätt from- och to-tider.
	$from = date('Y-m').'-01';
	$to = date('Y-m-').(date('d')+1);
	// aktuell användare
	$uid = prep($_SESSION['LiTHekoll_login_id']);

	$query = mysql_query("SELECT minus FROM transactions WHERE uid='$uid' and tdate between '$from' and '$to'") or die(mysql_error());

	$sum = 0;
	while ($row = mysql_fetch_array($query))
		$sum += $row['minus'];

	return $sum;
}

/*
 * hämtar alla transaktioner för användaren
 * @param 	array 	$categories 	kategorier som ska hämtas
 * @param 	int 	$positive 	vad som ska hämtas. 0 för alla, 1 för postiva, 2 för negativa
 * @param 	int 	$limit 	gräns för hur många som ska hämtas
 * @param 	int 	$ofset 	vilken rad vi ska börja på
 * @return 	array 	alla kategorier
 */
function get_transactions ($categories = '', $positive = 0, $limit = 15, $offset = 0)
{
	$uid = prep($_SESSION['LiTHekoll_login_id']);

	$addextra = '';

	if(is_array($categories))
	{
		$addextra .= 'AND (';
		foreach ($categories as $key => $value)
			$addextra .= "catid='".$value."' OR";
		$addextra .= ' catid=\'0\')';
	}

	$query = mysql_query("SELECT * FROM transactions WHERE uid='$uid' $addextra ORDER BY tdate DESC LIMIT $offset, $limit");

	$i = 0;
	$transactions = array();
	while ($row = mysql_fetch_array($query))
	{
		$transactions[$i] = $row;
		$i++;
	}

	return $transactions;
}

/*
 * hämtar all info om en specifik transaktion
 * @param 	int 	$transid 	transaktions-id
 * @return 	array 	all info, samtliga kolumner
 */
function get_transaction ($transid)
{
	$uid = prep($_SESSION['LiTHekoll_login_id']);

	$query = mysql_query("SELECT * FROM transactions WHERE uid='$uid' and transid='$transid'");
	$transaction = mysql_fetch_array($query);

	return $transaction;
}


?>
