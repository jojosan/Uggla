<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />

		<title>Dashboard - <?php echo SITE_NAME; ?></title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/icons.css">
		<!-- WICHTIG; SOLLTE SPÄTER WIE BEI WORDPRESS ÜDER EINE FUNCTION EINGEBUNDEN WERDEN -->
		<script type="text/javascript" src="../includes/lib/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			language : "de",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "none",
			convert_urls : true,
			skin : "default",
			theme_advanced_fonts : "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n",
			theme_advanced_more_colors : true
		});
		</script>
		</head>

	<body>
		<div class="navbar">
			<div class="ugglalogo">
				<img src="../assets/img/ugglalogo.jpg">
			</div>
			<div class="ugglapanel">
				<ul class="ugglamenu">
								<li><a href="#">Hilfe</a></li>
								<li><a href="#">Einstellungen</a></li>
				</ul>
				<a href="">
					<div id="ugglaprofil">
						<div class="userava">
						<img src="http://www.gravatar.com/avatar/<?php
						echo md5( strtolower( trim( $_SESSION['user']['mail'] ) ) );					
						?>.png">					
						</div>
						<div class="username">
							<p><?php echo $_SESSION['user']['name']; ?> Nachname</p>
								<div class="ugglaop">
									<img src="../assets/img/ugglaop.jpg">
								</div>
						</div>
						<div class="uggladrop">
							<ul class="menu">
								<li><a href="../" target="_blank">Seite ansehen</a></li>
								<hr></hr>
								<li><a href="#">Profil bearbeiten</a></li>
								<li><a href="#">Passwort ändern</a></li>
								<li><a href="logout.php">Abmelden</a></li>
							</ul>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div id="ugglanav">
			<ul class="ugglaside">
			<?php
				if (strpos($_SERVER['PHP_SELF'], 'index.php'))
			{ ?>
				<li>
					<div class="ugglasideright">
						<span class="dash glyph dashboard"></span>
						<a href="index.php">Dashboard</a>
					</div>
				</li>
			<?php } else { ?>
				<li>
					<div class="ugglasideright">
						<span class="dashno glyph dashboard"></span>
						<a href="index.php">Dashboard</a>
					</div>
				</li>
			<?php } 
				if (strpos($_SERVER['PHP_SELF'], 'profil.php'))
			{ ?>
				<li>
					<div class="ugglasideright">
						<span class="profilactive glyph user"></span>
						<a href="profil.php">Profil</a>
					</div>
				</li>
			<?php } else { ?>
				<li>
					<div class="ugglasideright">
						<span class="profil glyph user"></span>
						<a href="profil.php">Profil</a>
					</div>
				</li>
			<?php } 
				if (strpos($_SERVER['PHP_SELF'], 'add.php'))
			{ ?>
				<li>
					<div class="ugglasideright">
						<span class="newsactive glyph new"></span>
						<a href="add.php">Beiträge</a>
					</div>
				</li>
			<?php } else { ?>	
				<li>
					<div class="ugglasideright">
						<span class="news glyph new"></span>
						<a href="add.php">Beiträge</a>
					</div>
				</li>
			<?php } ?>
			</ul>
		</div>
			<div class="ugglacontainer">
			<div class="dashbar">