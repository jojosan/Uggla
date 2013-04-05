<?php	
try {	
	$pdo = new PDO('mysql:
	host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASS); // Siehe config.php Alle Daten findest du bei deinem Webspace Hoster.
} catch (PDOExeption $e) {
	exit('Database error.');
}

?>
