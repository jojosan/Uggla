<?php

include_once('includes/connection.php');

/* Erstelle Datenbank Tabelle beim Aufrufen der Seite*/
	$db = $pdo->prepare('CREATE TABLE IF NOT EXISTS config ( 
	  webseiten_name varchar(100) NOT NULL,
	  theme varchar(255) NOT NULL,
	  admin_name varchar(60) NOT NULL,
	  admin_mail varchar(100) NOT NULL,
	  admin_password varchar(255) NOT NULL
	)');
	$db->execute();	

	$users = $pdo->prepare('CREATE TABLE IF NOT EXISTS users (
	  user_id int(11) NOT NULL AUTO_INCREMENT,
	  user_name varchar(20) NOT NULL,
	  user_password varchar(255) NOT NULL,
	  user_email varchar(40) NOT NULL,
	  user_group varchar(40) NOT NULL,
	  PRIMARY KEY (user_id)
	)');
	$users->execute();
	if (mysql_errno() == 0) {
		$error = 'Benutzer-Tabelle erfolgreich erstellt!';	
		/* header('Location: install_2.php');*/
	}
	else{ // Wenn MySQL Fehler..
		$error = 'Fehler bei der Benutzer-Tabelle ". mysql_errno() .":". mysql_error()."';	
	}
/*  Wenn SUBMIT dann erstelle users Tabelle*/
if (isset($_POST['Submit'])) {
	//Daten aus Form in Tabelle config eintragen
		$webseiten_name = $_POST['webseiten_name'];
		$admin_name = $_POST['admin_name'];
		$admin_mail = $_POST['admin_mail'];
		$admin_password = @$_POST['admin_password'];
		if (empty($webseiten_name) or empty($admin_name)) {
			$error = 'Alle Felder ausfüllen';	
		} else {
	$query = $pdo->prepare('INSERT INTO config (webseiten_name, admin_name, admin_mail, admin_password) VALUES (?, ?, ?, ?)');
			
			$query->bindValue(1, $webseiten_name);
			$query->bindValue(2, $admin_name);
			$query->bindValue(3, $admin_mail);	
			$query->bindValue(4, md5($admin_password));
			
			$query->execute();
}
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />

		<title>Installation</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css">
	</head>

	<body>
    <div class="installbar" style="width: 33%;"></div>
    <div id="schritt" style="left: 10%;">Schritt <strong>1/3</strong></div>
		<div class="container">
        	<div id="installation">
                <h1>Installation</h1>
                <?php if (isset($error)) { ?>
                	<small style="color:#d96d55;">
                    	<?php echo $error; ?>
                     </small>
                <br /><br />
                <?php } ?>
                     <form id="install" action="install.php" method="post">       
                        <input type="text" name="webseiten_name" placeholder="Name deiner Webseite"/><br />
                        <input type="text" name="admin_name" placeholder="Name des Admin Accounts" /><br />
                        <input type="text" name="admin_mail" placeholder="Deine E-Mail Adresse" /><br />
                        <input type="password" name="admin_passsword" placeholder="Dein Passwort" /><br />
                        <input type="submit" name="Submit" id="Submit" value="Speichern" />
                    </form>	
             </div>
		</div>
	</body>
</html>