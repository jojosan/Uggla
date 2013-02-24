<?php

include_once('includes/connection.php');

/* Erstelle Datenbank Tabelle beim Aufrufen der Seite*/
	$db = $pdo->prepare('CREATE TABLE IF NOT EXISTS db ( 
	  user_id int(11) NOT NULL AUTO_INCREMENT,
	  user_name varchar(20) NOT NULL,
	  user_password varchar(255) NOT NULL,
	  user_email varchar(40) NOT NULL,
	  user_group varchar(40) NOT NULL,
	  PRIMARY KEY (user_id)
	)');
	$db->execute();
	
/*  Wenn SUBMIT dann erstelle users Tabelle*/
if (isset($_POST['Submit'])) {
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
	}
	else{ // Wenn MySQL Fehler..
		$error = 'Fehler bei der Benutzer-Tabelle ". mysql_errno() .":". mysql_error()."';	
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
                        <input type="text" name="host" placeholder="localhost"/><br />
                        <input type="text" name="dbname" placeholder="Datenbankname" /><br />
                        <input type="text" name="dbuser" placeholder="Datenbank User" /><br />
                        <input type="text" name="dbpassswort" placeholder="Datenbank Passwort" /><br />
                        <input type="submit" name="Submit" id="Submit" value="Speichern" />
                    </form>	
             </div>
		</div>
	</body>
</html>