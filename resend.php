<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

// logik om användaren skickat formuläret
if(isset($_POST['submit']))
{
	$email = prep($_POST['email']);
	$emailquery = mysql_query("SELECT email, hash FROM users where email='".$email."' LIMIT 1");

	if(mysql_num_rows($emailquery) !== 0)
	{
		$user = mysql_fetch_array($emailquery);
		$mailet = 'Hej'.$fname.'!\n\nVälkommen till LiTHekoll! Ditt konto är alldeles strax klart för att användas. Allt du behöver göra är att klicka på länken här nedan så kommer ditt konto aktiveras.\n\nhttp://lithekoll.nu/activate.php?hash='.$user['hash'].'&email='.$user['email'].'\n\nMed vänliga hälsningar\nLiTHekoll-teamet\n\n\nPS. Kompis, du kan inte svara på det här mailet. DS.';
		$subject = 'Aktivera Lithekoll';
		$from = 'From: donotreply@lithekoll.nu';

		if (mail ($email, $subject, $mailet, $from))
			$message = "<p class=\"hurra\">Ett mail har skickats till din mail med en aktiveringslänk. Klicka på den och börja lithekolla!</p>";
		else
			$message = "<p class=\"error\">Tyvärr kunde mailet inte skickas, vi beklagar. Försök gärna igen senare!</p>";
	}
	else
		$message = "<p class=\"error\">Hittade inte den eposten!</p>";
}

// bygg sidan
build_header();
?>

<div id="content" class="wrapper">
	<h1>Begär nytt aktiveringsmail</h1>
	<?php
	if (isset ($_POST['submit'])){
		echo $message;
	}
	else {
		?>
		<p>
			Här kan du skicka ett nytt aktiveringsmail om det tidigare försvann ut i cybervärlden.
		</p>
		<?php
	}
	?>
	<form action="resend.php" method="POST">
		<input type="email" name="email" id="email" placeholder="E-post"/>
		<input type="submit" name="submit" id="submit" value="Skicka mail!" />
	</form>
</div> <!-- #content -->

<?php
build_footer();
?>
