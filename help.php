<?php
include("includes/start.php");

$helpsections = array(
					'resetpassword' => 'Återställ lösenord',
					'activationmail' => 'Aktiveringsmail',
				);
$helptexts = array(
				'resetpassword' => '<p>Har du glömt bort till lösenord? <a href="reset.php">Klicka här</a> för att få ett återställningsmail till den e-postadress du angav när du blev medlem.</p>',
				'activationmail' => '<p>Har du inte fått aktiveringsmailet? <a href="resend.php">Klicka här</a> för att skicka det igen!</p>'
			);

build_header();
?>

<div id="content" class="wrapper contentwrapper">
	<h1>Hjälp & support
	<?php
	if(isset ($_GET['q']))
		echo ' > '.$helpsections[$_GET['q']].' <a href="#" onclick="history.go(-1); return false;" class="fright">&larr; Bakåt</a></h1>'.$helptexts[$_GET['q']];
	else
		echo '</h1><p class="ingress">Klicka på det du vill ha hjälp med i listan nedan, om du har frågor om något annat så kan du skicka iväg ett meddelande på kontaktsidan.</p>';
	?>
	<ul>
		<?php
		foreach ($helpsections as $key => $value)
			echo '<li><a href="?q='.$key.'">'.$value.'</a></li>';
		?>
	</ul>
</div> <!-- #content -->

<?php
build_footer();
?>
