<?php
include("includes/start.php");

// kolla inloggning
if(!loginstatus())
	header("Location: login.php?loginfirst");

$uid = prep($_SESSION['LiTHekoll_login_id']);

// leta upp användarinfo
$query = mysql_query("SELECT email, fname, sname, password FROM users WHERE uid='$uid' and active='1' LIMIT 1");

// kolla så att vi hittade användaren
if(mysql_num_rows($query) == 0)
	die("Could not fetch user info.");

// sätt all info om användaren i en array
$user = mysql_fetch_array($query);

$fname = $user['fname'];
$sname = $user['sname'];
$email = $user['email'];


// kolla om formuläret är skickat
if(isset($_POST['edit']))
{
	// skriv över variablerna som står i rutorna nedan, så att användaren inte behöver skriva om allt
	$fname = $_POST['fname'];
	$sname = $_POST['sname'];
	$email = $_POST['email'];

	// sätt en tom $message för meddelanden til användaren
	$message = '';
	// sätt en tom $updatequery för frågehantering
	$updatequery = "UPDATE users SET uid='$uid'";

	// kontrollera
	if(encrypt_password($_POST['password']) == $user['password'])
	{
		// fortsätt ändra

		// förbered input för db
		$dbfname = prep($_POST['fname']);
		$dbsname = prep($_POST['sname']);
		$dbemail = prep($_POST['email']);
		$pwd = $_POST['newpassword'];
		$conf = $_POST['confirm'];

		// kolla vad som ska ändras
		if(!empty($pwd) && encrypt_password($pwd) !== $user['password'])
		{
			// har användaren angett samma lösenord?
			if($pwd == $conf && strlen($pwd) >= 5)
			{
				// bra, uppdatera lösenord
				$pwd = encrypt_password($pwd);
				$updatequery .= ", password='$pwd'";
			}
			else
			{
				$message .= '<p class="error"><em>Lösenorden du angav stämmer inte överens eller är för korta.</em>
							Försök skriva in dem igen. Lösenordet måste vara minst fem tecken.</p>';
			}
		}

		if($dbfname !== $user['fname'])
		{
			// kontrollera namnet
			if(!empty($dbfname))
				// bra, uppdatera förnamn
				$updatequery .= ", fname='$dbfname'";
			else
				$message .= '<p class="error"><em>Vänligen ange ett förnamn.</em></p>';
		}

		if($dbsname !== $user['sname'])
		{
			// kontrollera namnet
			if(!empty($dbsname))
				// bra, uppdatera förnamn
				$updatequery .= ", sname='$dbsname'";
			else
				$message .= '<p class="error"><em>Vänligen ange ett efternamn.</em></p>';
		}

		if($dbemail !== $user['email'])
		{
			// kontrollera epostadressen
			if(!empty($dbemail) && validate_email($dbemail))
			{
				// bra, uppdatera förnamn, maila även användaren info. Både till nya och gamla eposten.
				$mailmessage1 = mailmessage('<p>Hej '.$user['fname'].'!</p><p>Någon, förhoppningsvis du, har ändrat e-postadress för ditt konto på LiTHekoll. Den nya e-postadressen är '.$dbemail.'. Om detta inte stämmer, vänligen kontaka oss på support@lithekoll.nu omedelbart, så kan vi hjälpa dig återfå kontrollen över ditt konto.</p><p>Med vänliga hälsningar,<br />LiTHekoll-teamet</p><p>PS. Kompis, du kan inte svara på det här mailet. DS.</p>');
				$mailmessage2 = mailmessage('<p>Hej '.$user['fname'].'!</p><p>Någon, förhoppningsvis du, har ändrat e-postadress för ditt konto på LiTHekoll till den där du läser detta nu. Om detta inte är ditt konto, vänligen kontaka oss på support@lithekoll.nu omedelbart, så kan vi hjälpa dig reda ut eventuella oklarheter.</p><p>Med vänliga hälsningar,<br />LiTHekoll-teamet</p><p>PS. Kompis, du kan inte svara på det här mailet. DS.</p>');

				$subject = 'Ändrad e-postadress på LiTHekoll!';

				$mail1 = mail ($user['email'], $subject, $mailmessage1, MAILHEADER);
				$mail2 = mail ($dbemail, $subject, $mailmessage2, MAILHEADER);

				if($mail1 && $mail2)
				{
					$updatequery .= ", email='$dbemail'";
				}
				else
				{
					$message .= '<p class="error"><em>Kunde inte skicka meddelande om uppdaterad e-postadress.</em>
					Därför är din e-postadress oförändrad. Var god försök senare.</p>';
				}
			}
			else
				$message .= '<p class="error"><em>Vänligen ange ett giltig epostadress.</em></p>';
		}

		// lägg till sökkriterie på updatequery
		$updatequery .= " WHERE uid='$uid' LIMIT 1";

		// kör frågan
		if(mysql_query($updatequery))
		{
			$message .= '<p class="hurra"><em>Förändringarna gjorda!</em></p>';
			$_SESSION['LiTHekoll_login_fname'] = $dbfname;
		}
		else
			$message .= '<p class="error"><em>Kunde inte uppdatera användaren.</em>
						Ett databasfel uppstod. Var god försök igen senare.</p>';
	}
	else{
		$message = '<p class="error"><em>Lösenordet du angav stämmer inte.</em>
					Var god kontrollera att du skrev rätt och försök igen för att spara ändringarna.</p>';
	}
}

//Detta händer när du klickar på radera knappen
if(isset($_POST['radera']))
{
	// Kollar ifall lösenordet stämmer överrens med det som är i databasen
	if(encrypt_password($_POST['password2']) == $user['password'] && isset($_POST['delete']))
	{
		// förbered ta bort-frågor
		$delquery2 =  "DELETE FROM users WHERE uid='$uid'";
		$delquery =  "DELETE FROM transactions WHERE uid='$uid'";

		//Skickar frågorna
		if(mysql_query($delquery) && mysql_query($delquery2))
		{
			header("Location: goodbye.php");
			session_unset();
			session_destroy();
		}
		else
			$message .= '<p class="error"><em>Kunde inte ta bort användaren.</em>
						Ett databasfel uppstod. Var god försök igen senare.</p>'.mysql_error();

	}
	else
	{
		if(encrypt_password($_POST['password2']) !== $user['password'])
			$message .= '<p class="error"><em>Lösenordet du angav stämmer inte.</em></p>';
		if(!isset($_POST['delete']))
			$message .= '<p class="error"><em>Du måste kryssa i rutan för att kunna ta bort ditt konto.</em></p>';
	}
}

// bygg sidan
build_header();
?>

<div id="content">
	<div class="contentwrapper wrapper">
		<h1>Hantera konto</h1>
		<?php
		if(isset($_POST['edit']) && $message !== '' || isset($_POST['radera']) && $message !== '')
		{
			echo $message;
		}
		else
		{
			echo '<p>Här nedan kan du redigera din kontoinformation.</p>';
		}



		?>
	</div>
	<form action="account.php" method="post">
		<div class="wrapper">
			<div class="contentwrapper wrapper-50 fleft">
				<h2>
					Personlig information
				</h2>
				<p>
					<input type="text" value="<?php echo $fname; ?>" placeholder="Förnamn" name="fname" id="fname" />
					<label for="fname">Förnamn</label>
					<span class="clearfix"></span>
					<input type="text" value="<?php echo $sname; ?>" placeholder="Efternamn" name="sname" id="sname" />
					<label for="sname">Efternamn</label>
				</p>
				<p>
					<input type="email" value="<?php echo $email; ?>" placeholder="E-postadress" name="email" id="email" />
					<label for="email">E-postadress</label>
				</p>
			</div>
			<div class="contentwrapper wrapper-50 fright">
				<h2>
					Byt lösenord
				</h2>
				<p>
					<input type="password" name="newpassword" id="newpassword" placeholder="Nytt lösenord" />
					<input type="password" name="confirm" id="confirm" placeholder="Upprepa lösenord"/>
				</p>
			</div>
		</div><!-- .wrapper -->
		<div class="contentwrapper wrapper">
			<h2>
				Spara ändringar
			</h2>
			<p>
				Fyll i ditt lösenord och klicka på Spara för att uppdatera ditt konto.
			</p>
			<p>
				<input type="password" name="password" id="password" placeholder="Lösenord" />
			</p>
			<p>
				<input type="submit" name="edit" value="Spara" class="nomargin-left" />
				<label>eller <a href="/">avbryt</a>.</label>
			</p>
		</div><!-- .wrapper -->
	</form>
	<form action="account.php" method="post">
		<div class="contentwrapper wrapper">
			<h2>
				Radera konto
			</h2>
			<p>
				Fyll i ditt lösenord och klicka på Radera konto för att ta bort ditt konto och all tillhörande information.
			</p>
			<p>
				<input type="checkbox" id="delete" name="delete" /> <label for="delete">Ja, jag vill ta bort mitt konto och förstår att det inte går att ångra sig.</label>
			</p>
			<p>
				<input type="password" name="password2" id="password2" placeholder="Lösenord" />
			</p>
			<p>
				<input type="submit" name="radera" value="Radera konto" class="submitdel nomargin-left" />
				<label>eller <a href="/">avbryt</a>.</label>
			</p>
		</div><!-- .wrapper -->
	</form>
</div> <!-- #content -->

<?php

build_footer();
?>
