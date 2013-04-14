<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />

		<title>Dashboard - <?php echo SITE_NAME; ?></title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/icons.css">
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
							<img src="https://fbcdn-sphotos-f-a.akamaihd.net/hphotos-ak-ash4/376665_4516891528513_11538084_n.jpg">
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
				<li>
					<div class="ugglasideright">
						<span class="dash glyph dashboard"></span>
						<a href="index.php">Dashboard</a>
					</div>
				</li>
				<li>
					<div class="ugglasideright">
						<span class="profil glyph user"></span>
						<a href="#">Profil</a>
					</div>
				</li>
				<li>
					<div class="ugglasideright">
						<span class="news glyph new"></span>
						<a href="#">Beiträge</a>
					</div>
				</li>
			</ul>
		</div>
			<div class="ugglacontainer">