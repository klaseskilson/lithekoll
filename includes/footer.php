			<div id="footer" class="wrapper">
				<nav>
					<a href="help.php">Hjälp & support</a>
					<a href="#">Villkor</a>
					<a href="#">Kontakt</a>
				</nav>
				<nav id="follow">
					<a href="http://www.facebook.com/lithekoll" target="_blank"><img src="/img/f_logo.png" width="20"></img></a>
					<a href="https://twitter.com/lithekoll" target="_blank"><img src="/img/t_logo.png" width="30"></img></a>
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
