
		<div class="container">
				<a href="index.php" id="logo">Startseite</a> &ndash; <a href="../">Seite ansehen</a>
				<br />
				<?php echo $_SESSION['user']['name']; ?>
                <ol>
                	<li><a href="add.php">Artikel schreiben</a></li>
                    <li><a href="manage.php">Artikel verwalten</a></li>
                    <li><a href="logout.php">Abmelden</a></li>
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