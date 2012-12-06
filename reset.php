<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

// logik om användaren skickat formuläret
if(isset($_POST['submit']))
{
	$email = prep($_POST['email']);
	$hash = hashgen(20, 40);

	$emailquery = mysql_query("SELECT uid, fname FROM users where email='".$email."' LIMIT 1");

	if(mysql_num_rows($emailquery) !== 0)
	{
		$user = mysql_fetch_array($emailquery);
		$uid = $user['uid'];

		$updateq = mysql_query("UPDATE users SET hash='$hash' WHERE uid='$uid' AND email='$email' LIMIT 1");

		if($updateq)
		{
			//fortsätt
			$mailet = 'Hej'.$user['fname'].'!\n\nVälkommen till LiTHekoll! Ditt konto är alldeles strax klart för att användas. Allt du behöver göra är att klicka på länken här nedan så kommer ditt konto aktiveras.\n\nhttp://lithekoll.nu/activate.php?hash='.$user['hash'].'&email='.$user['email'].'\n\nMed vänliga hälsningar\nLiTHekoll-teamet\n\n\nPS. Kompis, du kan inte svara på det här mailet. DS.';
			$subject = 'Aktivera Lithekoll';
			$from = 'From: donotreply@lithekoll.nu';

			if (mail ($email, $subject, $mailet, $from))
				$message = "<p class=\"hurra\">Hurra! Ett mail har skickats till den e-post du angav. Följ instruktionerna där och </p>";
			else
				$message = "<p class=\"error\">Tyvärr kunde mailet inte skickas, vi beklagar. Försök gärna igen senare!</p>";
		}
		else
			die(mysql_error());
	}
	else
		$message = "<p class=\"error\">Hittade inte den eposten!</p>";
}

// bygg sidan
build_header();
?>

<div id="content" class="wrapper contentwrapper">
	<h1>Glömt ditt lösenord?</h1>
	<?php
	if (isset ($_POST['submit'])){
		echo $message;
	}
	else {
		?>
		<p>
			Har du glömt ditt lösenord? Här kan du få ett nytt löesnord skickat till dig. Skriv i din e-postadress här nedan.
		</p>
		<?php
	}
	?>
	<form action="reset.php" method="POST">
		<input type="email" name="email" id="email" placeholder="E-post"/>
		<input type="submit" name="submit" id="submit" value="Återställ!" />
	</form>
</div> <!-- #content -->

<?php
build_footer();
?>
