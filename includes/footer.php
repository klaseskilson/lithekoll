			<div id="footer" class="wrapper">
				<nav>
					<a href="help.php">Hjälp & support</a>
					<a href="terms.php">Villkor</a>
					<a href="contact.php">Kontakt</a>
				</nav>
				<nav id="follow">
					<a href="https://facebook.com/lithekoll" target="_blank"><img src="./img/f_logo.png" alt="Facebook" width="20" /></a>
					<a href="https://twitter.com/lithekoll" target="_blank"><img src="./img/t_logo.png" alt="Twitter" width="30" /></a>
				</nav>
			</div>
		</div><!-- #container -->

	<!-- load jQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>

	<script type="text/javascript" src="js/script.js"></script>
<?php
	if($loadchartapi)
		echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
?>
</body>
</html>
