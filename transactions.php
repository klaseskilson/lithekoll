<?php

ini_set('error_reporting', E_ALL);

include("includes/start.php");

if(isset($_POST['submitu']))
{
	$usum = prep($_POST['usum']);
	$udatum = prep($_POST['udatum']);
	$ukomet = prep($_POST['ukomet']);
	$ucat = prep($_POST['ucat']);

	if($udatum !== '')
		$udatum = date('Y-m-d H:i:s', strtotime($udatum));
	else
		$udatum = date('Y-m-d H:i:s');

	$error = '';
	if(empty($usum) || $usum < 0)
		$error .= "<li>Skriv in positiv summa</li>";

	if($error == '')
	{
		$query = "INSERT INTO transactions (uid, catid, description, minus, tdate)
		VALUES ('".$_SESSION['LiTHekoll_login_id']."', '$ucat', '$ukomet', '$usum', '$udatum')";
	}

	mysql_query($query);
	header("Location: dashboard.php");

}

elseif(isset($_POST['submiti']))
{
	$isum = prep($_POST['isum']);
	$idatum = prep($_POST['idatum']);
	$ikomet = prep($_POST['ikomet']);
	$icat = prep($_POST['icat']);

	if($idatum !== '')
		$idatum = date('Y-m-d H:i:s', strtotime($idatum));
	else
		$idatum = date('Y-m-d H:i:s');

	$error = '';

	if($error == '')
	{
		$query = "INSERT INTO transactions (uid, catid, description, plus, tdate)
		VALUES ('".$_SESSION['LiTHekoll_login_id']."', '$icat', '$ikomet', '$isum', '$idatum')";
	}
	mysql_query($query);

	header("Location: dashboard.php");
}

elseif(isset($_GET['edit']))
{
	$transaction = get_transaction(prep($_GET['edit']));

	if(!is_array($transaction))
		die('Finns inte ju.');
		
	if(isset($_POST['submittran']))
	{
		$transsum = prep($_POST['transsum']);
		$transkomet = prep($_POST['transkomet']);
		$transcat = prep($_POST['transcat']);
		$transdatum = date('Y-m-d H:i:s', strtotime($_POST['transdatum']));
		$userid = prep($_SESSION['LiTHekoll_login_id']);
		$transid = prep($transaction['transid']);

		$error = '';
		if(empty($transsum) || $transsum < 0)
			$error .= "<li>Skriv in positiv summa</li>";
		
		if($error == '')
		{
			$query = "UPDATE transactions SET catid='$transcat', description='$transkomet', minus='$transsum', tdate='$transdatum' WHERE (uid='$userid' AND transid='$transid')";
		}
		mysql_query($query) or die(mysql_error());

		header("Location: dashboard.php");
	}

	build_header('Redigera transaktion - ');

	?>

<!-- Formulär för att ändra en transaktion -->
<div id="content" class="wrapper contentwrapper">
	<h1>Redigera transaktion <a href="#" onclick="history.go(-1); return false;" class="fright">&larr; Bakåt</a></h1>
	<form action="transactions.php?edit=<?php echo $_GET['edit']; ?>" method="post">
		<input type="text" id="transkomet" name="transkomet" value="<?php echo $transaction['description']; ?>" placeholder="Kommentar" />
		<input type="tel" id="transsum" name="transsum" value="<?php echo $transaction['minus'] == 0 ? $transaction['plus'] : $transaction['minus']; ?>" placeholder="Belopp" />
		<input type="date" id="transdatum" name="transdatum" value="<?php echo date('Y-m-d', strtotime($transaction['tdate'])); ?>" placeholder="ÅÅÅÅ-MM-DD" />
		<select id="transcat" name="transcat">
		<?php
			foreach (get_categories() as $key => $value) {
				echo '<option value ="'.$key.'" '.(($key == $transaction['catid']) ? 'selected="selected"' : '').'> '.$value.'</option>';
			}
		?>
		</select>

		<input type="submit" class="submittran" name="submittran" id="submittran" value="Ändra" />
	</form>

	<p>
	</p>
</div> <!-- #content -->


	<?php
	build_footer();
}

?>

