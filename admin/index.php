<?php

require_once('../includes/config.php');
require_once('../includes/connection.php');
require_once('../includes/system.php');

$user = new User();

if($user->logged_in()) { ?>
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
						<p>Dashboard</p>
					</div>
				</li>
				<li>
					<div class="ugglasideright">
						<span class="profil glyph user"></span>
						<p>Profil</p>
					</div>
				</li>
				<li>
					<div class="ugglasideright">
						<span class="news glyph new"></span>
						<p>Beiträge</p>
					</div>
				</li>
			</ul>
		</div>
			<div class="ugglacontainer">
					<a href="index.php" id="logo">Startseite</a> &ndash; <a href="../">Seite ansehen</a>
					<br />
					<h1>Hej <?php echo $_SESSION['user']['name']; ?>, derzeit sind einige Dinge noch als Platzhalter eingesetzt!</br>
					Bitte nenne in der jetzigen Version <strong>keine</strong> Bugs, alle Fehler sind bekannt.</h1>
					<!-- TEST AUSGABEN<?php echo $_SESSION['user']['name']; ?> / <?php echo ADMIN_TEMPLATE; ?>-->
					<ol>
						<li><a href="add.php">Artikel schreiben</a></li>
						<li><a href="manage.php">Artikel verwalten</a></li>
					</ol>
				
			</div>
	</body>
</html>
    <?php } else {
		if(isset($_POST['submit'])){
			$error = $user->log_in(htmlspecialchars(trim($_POST['username'])), htmlspecialchars(trim($_POST['password'])), "index.php");
		}
	?>
    <!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />

		<title>CMS</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
	</head>

	<body>
		<div class="container">
				<a href="index.php" id="logo">Startseite</a> &ndash; <a href="../">Seite ansehen</a>
				<br /><br />
                
                <?php if (isset($error)) { ?>
                	<small style="color:#aa0000;">
                    	<?php echo $error; ?>
                       
                     </small>
                <br /><br />
                <?php } ?>
                <form action="index.php" method="post">
                	<input type="text" name="username" placeholder="Name" autocomplete="off"/>
                    <input type="password" name="password" placeholder="Passwort" autocomplete="off"/>
                    <input type="submit" value="Login" name="submit"/>
                </form>			
           
		</div>
	</body>
</html>
<?php
}

?>