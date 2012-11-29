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
function build_footer()
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

?>
