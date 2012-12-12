<?php

ini_set('error_reporting', E_ALL);

include("includes/start.php");

if(isset($_POST['submitu']))
{


	$usum = prep($_POST['usum']);
	$udatum = prep($_POST['udatum']);
	$ukomet = prep($_POST['ukomet']);
	$ucat = prep($_POST['ucat']);
	$udatum = date('Y-m-d H:i:s', strtotime($udatum));


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
	$idatum = date('Y-m-d H:i:s', strtotime($idatum));
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

	build_header('Redigera transaktion - ');

	?>


<div id="content" class="wrapper contentwrapper">
	<h1>Redigera transaktion</h1>
	<form action="transaction.php">
		<input type="text" value="<?php echo $transaction['description']; ?>" placeholder="Kommentar" />
		<input type="tel" value="<?php echo $transaction['minus'] == 0 ? $transaction['plus'] : $transaction['minus']; ?>" placeholder="Belopp" />
		<input type="date" value="<?php echo date('Y-m-d', strtotime($transaction['tdate'])); ?>" placeholder="ÅÅÅÅ-MM-DD" />
		<select name="cat">
		<?php
			foreach (get_categories() as $key => $value) {
				echo '<option value ="'.$key.'" '.(($key == $transaction['catid']) ? 'selected="selected"' : '').'> '.$value.'</option>';
			}
		?>
		</select>
	</form>
	<p>
	</p>
</div> <!-- #content -->


	<?php
	build_footer();
}

?>

