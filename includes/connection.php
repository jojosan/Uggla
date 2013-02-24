<?php
	try {	
$pdo = new PDO('mysql:
host=localhost; 
dbname=cms', /* Der Name deiner Datenbank */
'root', /* Dein Benutzername der Datenbank */
'root'); /* Dein Passwort für die Datenbank. Alle Daten findest du bei deinem Webspace Hoster. */
} catch (PDOExeption $e) {
	exit('Database error.');

}


?>
