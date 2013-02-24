<?php

include_once('../includes/connection.php');

/* Erstelle Datenbank Tabelle beim Aufrufen der Seite*/
	$db = $pdo->prepare('CREATE TABLE IF NOT EXISTS config ( 
	  webseiten_name varchar(100) NOT NULL,
	  theme varchar(255) NOT NULL,
	  admin_name varchar(60) NOT NULL,
	  admin_mail varchar(100) NOT NULL,
	  admin_password varchar(255) NOT NULL
	)');
	$db->execute();	
	if (mysql_errno() == 0) {
		$error = 'Benutzer-Tabelle erfolgreich erstellt!';	
	}
	else{ // Wenn MySQL Fehler..
		$error = 'Fehler bei der Benutzer-Tabelle ". mysql_errno() .":". mysql_error()."';	
	}
/*  Wenn SUBMIT dann erstelle users Tabelle*/
if (isset($_POST['Submit'])) {
	//Daten aus Form in Tabelle config eintragen
		$webseiten_name = $_POST['webseiten_name'];
		$webseiten_untertitel = $_POST['webseiten_untertitel'];
		if (empty($webseiten_name) or empty($webseiten_untertitel)) {
			$error = 'Alle Felder ausfüllen';	
		} else {
	$user = $pdo->prepare('INSERT INTO config (webseiten_name, webseiten_untertitel) VALUES (?, ?)');
			
			$user->bindValue(1, $webseiten_name);
			$user->bindValue(2, $webseiten_untertitel);
			
			$user->execute();
				if (mysql_errno() == 0) {
		$error = 'Weiter zum zweiten Schritt';
		header('Location: install_2.php');	
	}
	else{ // Wenn MySQL Fehler..
		$error = 'Fehler bei der Benutzer-Tabelle ". mysql_errno() .":". mysql_error()."';	
	}
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
                     <form id="install" action="index.php" method="post">       
                        <input type="text" name="webseiten_name" placeholder="Name deiner Webseite"/><br />
                        <input type="text" name="webseiten_untertitel" placeholder="Der Untertitel deiner Seite" /><br />
                        <input type="submit" name="Submit" id="Submit" value="Speichern" />
                    </form>	
             </div>
		</div>
	</body>
</html>