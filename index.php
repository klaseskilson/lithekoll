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
				Det här är en webbtjänst som hjälper dig hålla koll på din ekonomi.
				Registrera dig snabbt och enkelt här till höger.
				Ha en bra dag!
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
