<?php
include("includes/start.php");

$helpsections = array(
					'resetpassword' => 'Återställ lösenord',
					'activationmail' => 'Aktiveringsmail'
				);
$helptexts = array(
				'resetpassword' => '<p>Hejhej hemskt mycket hej!</p>'
			);

build_header();
?>

<div id="content" class="wrapper contentwrapper">
	<h1>Hjälp & support
	<?php
	if(isset ($_GET['q']))
		echo ' > '.$helpsections[$_GET['q']].' <a href="#" onclick="history.go(-1); return false;" class="fright">&larr; Bakåt</a></h1>'.$helptexts[$_GET['q']];
	else
		echo '</h1><p class="ingress">Här står det en massa text som förklarar att man har kommit rätt om man vill ha hjälp.</p>';
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
