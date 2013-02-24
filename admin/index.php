<?php

session_start();
include_once('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
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
				<a href="index.php" id="logo">Startseite</a>
				<br />
                
                <ol>
                	<li><a href="add.php">Artikel schreiben</a></li>
                    <li><a href="delete.php">Artikel verwalten</a></li>
                    <li><a href="logout.php">Abmelden</a></li>
                </ol>
                	
            
		</div>
	</body>
</html>
    <?php
} else {
	if (isset($_POST['username'], $_POST['password'])) {
		$username = mysql_real_escape_string($_POST['username']);	
		$password = md5($_POST['password']);
		
		if (empty($username) or empty($password)) {
			$error = 'Bitte alle Felder ausfüllen!';
		} else {
			$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
			
			$query->bindValue(1, $username);
			$query->bindValue(2, $password);
			
			$query->execute();
			
			$num = $query->rowCount();
			
			if($num == 1) {
				//JA
				$query = $pdo->prepare("INSERT INTO users_logged (user_name, user_ip, timestamp, status) VALUES (?, ?, ?, ?)");
				
				$query->bindValue(1, $username);
				$query->bindValue(2, getenv('REMOTE_ADDR'));
				$query->bindValue(3, time());
				$query->bindValue(4, 'erfolgreich');	
				
				$query->execute();
			
				$_SESSION['logged_in'] = true;
				header('Location: index.php');
				exit();
			} else {
				//NEIN
				$query = $pdo->prepare("INSERT INTO users_logged (user_name, user_ip, timestamp, status) VALUES (?, ?, ?, ?)");
				
				$query->bindValue(1, $_POST['username']);
				$query->bindValue(2, getenv('REMOTE_ADDR'));
				$query->bindValue(3, time());
				$query->bindValue(4, 'gescheitert');	
				
				$query->execute();
				$error = 'Falsche Daten!';
			}
		}
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
				<a href="index.php" id="logo">Startseite</a>
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
                    <input type="submit" value="Login" />
                </form>			
           
		</div>
	</body>
</html>
    <?php	
}

?>