<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

build_header();
?>
<div class="fancyborder">
	<div class="wrapper">
		<div class="alignment">
			<p>
				Hejhej hemskt mycket hej
			</p>
			<p>
				Använd vår tjänst
			</p>
			<p>
				SPARA TILL EN PONNY förihelvete
			</p>
		</div><!-- .alignment -->
		<div class="alignment">
			<?php signupform(); ?>
		</div><!-- .alignment -->
	</div><!-- .wrapper -->
</div><!-- #block -->

<div id="content" class="wrapper">
</div> <!-- #content -->

<?php

build_footer();
?>
