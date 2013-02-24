<?php	
	try {	
$pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', 'root');
} catch (PDOExeption $e) {
	exit('Database error.');

}

?>
