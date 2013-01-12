<?php
//html startar i denna fil
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title><?php echo $before; ?>LiTHekoll<?php echo $after; ?></title>
		<link rel="icon"
      			type="image/png"
      			href="img/favicon.png">
<?php /*
		<!-- mobile friendly stuff -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
*/ ?>
		<!-- adaptive and regular style -->
		<link rel="stylesheet" href="css/reset.css" media="all">
		<link rel="stylesheet" href="css/main.css" media="all">
		<link rel="stylesheet" href="css/mobile.css" media="only screen and (max-width: 480px)">
	</head>
	<body>
		<div id="container">
			<div id="header" class="wrapper">
				<header>
					<a href="./">
						<h1>LiTHekoll</h1>
					</a>
				</header>
				<nav>
					<a href="./">Hem</a>
					<a href="./project.php">Projektet</a>
					<?php
						// kolla om användaren är inloggad
						echo (loginstatus() ? '<a href="account.php">Konto</a><a href="login.php?logout">Logga ut</a>' : '<a href="login.php">Logga in</a>');
					?>
				</nav>
			</div> <!-- #header -->
			<noscript>
				<div class="wrapper" id="noscript">
					<p class="error">
						ÖJ. LiTHekoll använder sig av JavaScript! Aktivera det aå funkar allt som det ska, vännen.
					</p>
				</div>
			</noscript>
