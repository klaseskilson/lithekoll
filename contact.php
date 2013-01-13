<?php

ini_set('error_reporting', E_ALL);

include("includes/start.php");


build_header();
?>
<!-- Kontaktformulär -->
<div id="content">
	<div class="wrapper contentwrapper" id="content">
		<h1>
			Kontakt
		</h1>
		<p class="ingress">
			Här kan du lämna ett meddelande till LiTHekoll-teamet, frågor eller kommentarer allt är välkommet! 
		</p>
		<form action="MAILTO:petraohlin8@gmail.com" method="post" enctype="text/plain">
			<input type="text" name="name" placeholder="Namn">
			<input type="email" name="mail" placeholder="Email"><br>
			<textarea id="styled" name="comment" placeholder="Ditt meddelande" rows="4" cols="49"></textarea><br>
			<input type="submit" class="submittran" value="Skicka">
		</form>
	</div><!-- .wrapper -->
</div><!-- #content -->

<?php

build_footer();
?>
