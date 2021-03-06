<?php
if(isset($_POST['db_server'], $_POST['db_name'], $_POST['db_user'], $_POST['db_password'], $_POST['site_name'], $_POST['install'])){
	try{
		$pdo = new PDO("mysql:dbname=".$_POST['db_name'].";host=".$_POST['db_server']."", $_POST['db_user'], $_POST['db_password']);
	}catch(PDOException $e) {
    	exit("Datenbankfehler.");
	}
	$rows = $pdo->exec("CREATE TABLE IF NOT EXISTS `article` ( 
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) NOT NULL,
  `article_content` text NOT NULL,
  `article_timestamp` int(11) NOT NULL,
  `article_author` varchar(255) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ");



	$rows = $pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ");



	$rows = $pdo->exec("CREATE TABLE IF NOT EXISTS `users_logged` (
  `user_name` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

	file_put_contents("../includes/config.php", "<?php\n /*DB*/\n define('DB_SERVER', '".$_POST['db_server']."');\n  define('DB_NAME', '".$_POST['db_name']."');\n define('DB_USER', '".$_POST['db_user']."');\n define('DB_PASS', '".$_POST['db_password']."');\n /*Site Info*/\n define('SITE_NAME', '".$_POST['site_name']."');\n ?>");
	header('Location: steptwo.php');
	
}else{
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8"/>
		<title>Installiere Pina</title>
		<link rel="stylesheet" href="../assets/style.css"/>
	</head>
	<body>
	<div class="installbar" style="width: 50%;"></div>
    <div id="schritt" style="left: 10%;">Schritt <strong>1/2</strong></div>
		<div class="container">
			<div id="install">
				<h1>Yeah, es geht los mit Pina!</h1>
				<p>
					<small>
						Erstelle eine leere Mysql-Datenbank & hole dir die Zugangsdaten.</br>
						Stelle sicher das die <code>includes/config.php</code> beschreibbar ist.</br>
					</small>
					<div class="error">
						<?php
							$filename = '../includes/config.php';
							if (is_writable($filename)) {
								echo "";
							} else {
								echo "Die Datei kann <strong>nicht</strong> beschrieben werden, bitte ändere ihre Rechte auf <strong>777</strong>!";
							}
						?>
					</div>
				</p>
				<form action="index.php" method="post">
					<h2>Datenbank</h2>
					<input type="text" name="db_server" placeholder="Mysql-Server"/>
					<input type="text" name="db_name" placeholder="Datenbankname"/><br />
					<input type="text" name="db_user" placeholder="Mysql-Benutzer"/>
					<input type="password" name="db_password" placeholder="Mysql-Passwort"/><br />
					<h2>Meta</h2>
					<input type="text" name="site_name" placeholder="Seitenname"/><br />
					<input type="submit" value="Installieren" name="install"/>
				</form>
			</div>
		</div>
	</body>
</html>
<?php } ?>