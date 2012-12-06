<?php

ini_set('error_reporting', E_ALL);

include("includes/start.php");

build_header();
?>

	<div class="fancyborder">
	<div class="wrapper">
		<div class="alignment">
			<p>
				Detta är ett projekt i kursen TNMK30 på Linköpings Universitet
			</p>
			<p>
				LiTHekoll är en tjänst för att hålla koll på sin ekonomi, 
				hen får gärna registrera sig här till höger!
			</p>
			<p>
				Vi som har gjort sidan är Carl Englund, Klas Eskilsson, 
				Johan Henriksson, Mattias Palmgren och Petra Öhlin
			</p>
		</div><!-- .alignment -->
			<?php signupform(); ?>
	</div><!-- .wrapper -->
</div><!-- #block -->

<div id="content" class="wrapper">
</div> <!-- #content -->


<?php

build_footer();
?>