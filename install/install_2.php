<?php

include_once('../includes/connection.php');

/* Erstelle Datenbank Tabelle beim Aufrufen der Seite*/
	$users = $pdo->prepare('CREATE TABLE IF NOT EXISTS users (
	  user_id int(11) NOT NULL AUTO_INCREMENT,
	  user_name varchar(20) NOT NULL,
	  user_password varchar(255) NOT NULL,
	  user_email varchar(40) NOT NULL,
	  user_group varchar(40) NOT NULL,
	  PRIMARY KEY (user_id)
	)');
	$users->execute();

/*  Wenn SUBMIT dann erstelle users Tabelle*/
if (isset($_POST['Submit'])) {
	//Daten aus Form in Tabelle config eintragen
	$user_name = htmlspecialchars(trim($_POST['user_name']));
	$user_mail = htmlspecialchars(trim($_POST['user_mail']));
	$user_password = htmlspecialchars(trim($_POST['user_password']));
	$user_salt = md5(md5(md5(time().sha1($user_name))));
	
	if (empty($user_name) or empty($user_password)) $error = 'Alle Felder ausfüllen';
	else {
		$query = $pdo->prepare('INSERT INTO users (user_name, user_mail, user_password, user_salt) VALUES (?, ?, ?, ?)');
		
		$query->bindValue(1, $pdo->real_escape_string($user_name));
		$query->bindValue(2, $pdo->real_escape_string($user_mail));
		$query->bindValue(3, crypt($user_password, '$6$rounds=131134$'.$user_salt.'$'));
		$query->bindValue(4, $pdo->real_escape_string($user_salt));
		
		$query->execute();
		if (mysql_errno() == 0) {
			$error = 'Weiter zum dritten Schritt';
			header('Location: install_3.php');	
		}
		else $error = 'Fehler bei der Benutzer-Tabelle ". mysql_errno() .":". mysql_error()."';
	}
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Installation</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
	</head>

	<body>
    <div class="installbar" style="width: 66%;"></div>
    <div id="schritt" style="left: 45%;">Schritt <strong>1/2</strong></div>
		<div class="container">
        	<div id="installation">
                <h1>Installation</h1>
                <?php if (isset($error)) { ?>
                	<small style="color:#d96d55;">
                    	<?php echo $error; ?>
                     </small>
                <br /><br />
                <?php } ?>
                     <form id="install" action="install_2.php" method="post">       
                        <input type="text" name="user_name" placeholder="Name des Admin Kontos"/><br />
                        <input type="text" name="user_mail" placeholder="Deine E-Mail Adresse" /><br />
                        <input type="password" name="user_passsword" placeholder="Dein Passwort" /><br />
                        <input type="submit" name="Submit" id="Submit" value="Speichern" />
                    </form>	
             </div>
		</div>
	</body>
</html>