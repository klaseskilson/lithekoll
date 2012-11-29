<?php
// vi vill ha felmeddelanden i PHP
ini_set('error_reporting', E_ALL);

include("includes/start.php");

build_header();
?>
<div id="block">
	<div  class="wrapper">
		<div class="alignment">
			<p>
				Hejhej hemskt mycket hej
			</p>
		</div><!-- .alignment -->
		<div class="alignment">
			<form action="signup.php" method="post" class="signup">
				<input type="text" name="fname" id="fname" placeholder="Förnamn" />
				<input type="text" name="sname" id="sname" placeholder="Efternamn" />
				<input type="email" name="email" id="email" placeholder="Email" />
				<input type="password" name="password" id="password" placeholder="Lösenord" />
				<input type="password" name="confirm" id="confirm" placeholder="Upprepa Lösenord" />
				<input type="submit" name="submit" id="submit" value="Bli medlem!" />
			</form>
		</div><!-- .alignment -->
	</div><!-- .wrapper -->
</div><!-- #block -->

<div id="content" class="wrapper">
</div> <!-- #content -->

<?php

build_footer();
?>
