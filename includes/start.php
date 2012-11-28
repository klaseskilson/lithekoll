<?php
/*
	start.php
	tanken med denna fil är att den ska vara med i varje fil för att starta upp sidan för
	besökaren.
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

?>
