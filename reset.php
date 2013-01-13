<?php

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
			$mailet = mailmessage('<p>Hej'.$user['fname'].'!</p><p>Tråkigt att du glömde bort ditt lösenord. Men det är lugnt. Klicka på länken här nedan för att återställa lösenordet och välja ett nytt.</p><p>http://lithekoll.nu/reset.php?key='.$hash.'</p><p>Med vänliga hälsningar,<br />LiTHekoll-teamet</p><p>PS. Kompis, du kan inte svara på det här mailet. DS.</p>');
			$subject = 'Aktivera Lithekoll';
			$from = 'From: donotreply@lithekoll.nu';

			if (mail ($email, $subject, $mailet, MAILHEADER))
				$message = "<p class=\"hurra\">Hurra! Ett mail har skickats till den e-post du angav. Följ instruktionerna där så löser det sig!</p>";
			else
				$message = "<p class=\"error\">Tyvärr kunde mailet inte skickas, vi beklagar. Försök gärna igen senare!</p>";
		}
		else
			die(mysql_error());
	}
	else
		$message = "<p class=\"error\">Hittade inte den eposten!</p>";
}

if(isset ($_GET['key'])){
	// säkra $key för databasen
	$key = prep ($_GET['key']);

	// man kan bara återställa lösenordet om man begärt att få göra det
	if(strlen($key) < 20)
		die ('Invalid reset key.');

	// leta upp användare
	$finduser = mysql_query("SELECT email, fname FROM users WHERE hash='$key' AND active='1' LIMIT 1");

	// finns användaren?
	if(mysql_num_rows($finduser) !== 0)
	{
		// ta fram ett användarid
		$user = mysql_fetch_array($finduser);
		$email = $user['email'];

		// kolla om formuläret har skickats
		if(isset($_POST['changepassword']))
		{
			// stämmer lösenorden överens?
			if(($_POST['password'] == $_POST['confirm']) && strlen($_POST['password']) > 5)
			{
				// kryptera lösenordet
				$password = encrypt_password ($_POST['password']);

				// uppdatera lösenordet
				$updateq = mysql_query("UPDATE users SET password='$password' WHERE hash='$key' AND email='$email'");

				if($updateq)
				{
					$message = "<p class=\"hurra\">Ditt lösenord har uppdaterats. Du kan nu logga in här nedan. ";

					// fortsätt, skicka mail
					$mailet = mailmessage('<p>Hej '.$user['fname'].'!</p><p>Ditt lösenord har precis ändrats på ditt LiTHekoll-konto. Om du inte känner igen detta, hör av dig till oss på support@lithekoll.nu omedelbart så kan vi hjälpa dig få kontroll över ditt konto igen.</p><p>Tack för att du använder LiTHekoll!</p><p>Med vänliga hälsningar, <br />LiTHekoll-teamet</p><p>PS. Kompis, du kan inte svara på det här mailet.</p>');
					$subject = 'Ditt lösenord har ändrats på Lithekoll';

					if (mail ($email, $subject, $mailet, MAILHEADER))
						$message .= "Ett mail har skickats till dig för att bekräfta detta.</p>";
					else
						$message .= "Tyvärr kunde vi inte skicka ett mail till dig för att bekräfta detta.</p>";
				}
				else
				{
					$message = "Kunde inte uppdatera lösenordet.";
					$message .= "<script>console.log(\"".mysql_error()."\");</script>";
				}

				// säg tack och bock
				build_header();
				?>
				<div id="content" class="wrapper contentwrapper">
					<h1>Ändra lösenord</h1>
					<p class="hurra">
						<?php echo $message; ?>
					</p>
					<?php
					loginform('false');
					?>
				</div> <!-- #content -->
				<?php
				build_footer();
				die();
			}
			else
				$message = '<p class="error">Lösenorden stämmer inte överens eller är för korta.</p>';
		}
		build_header();
		?>
		<div id="content" class="wrapper contentwrapper">
			<h1>Ändra lösenord</h1>
			<?php
			echo isset ($_POST['changepassword'])
				? $message
				: '<p>Välj ett nytt lösenord här nedan. En bekräftelse kommer skickas till din e-postadress.</p>';
			?>
			<form action="reset.php?key=<?php echo $key; ?>" method="POST">
				<input type="password" name="password" id="password" placeholder="Lösenord" class="name" />
				<input type="password" name="confirm" id="confirm" placeholder="Upprepa lösenord" class="name" />
				<input type="submit" name="changepassword" id="changepassword" value="Ändra lösenord" />
			</form>
		</div> <!-- #content -->
		<?php
		build_footer();
		die();
	}
	else {
		$message = '<p class="error">Användaren hittades inte! Var god försök skicka ett nytt återställningsmail här nedan.</p>';
	}
}

// bygg sidan
build_header();
?>

<div id="content" class="wrapper contentwrapper">
	<h1>Glömt ditt lösenord?</h1>
	<?php
	if (isset ($_POST['submit']) || isset ($_GET['key'])){
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
