<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

if(loginstatus())
	header("Location: dashboard.php");

build_header();
?>
<div class="fancyborder">
	<div class="wrapper">
		<div class="alignment">
			<p>
				Välkommen till LiTHekoll!
			</p>
			<p>
				Hen får gärna registrera sig och använda vår tjänst!
			</p>
			<p>
				Skaffa LiTHekoll idag!
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
