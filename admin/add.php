<?php

session_start();
require_once('../includes/config.php');
require_once('../includes/connection.php');
require_once('../includes/system.php');

$user = new User();

$articles = new Articles();

if ($user->logged_in()) {
	$error = $articles->create(htmlspecialchars(trim($_POST['title'])), htmlspecialchars(trim($_POST['content'])));
	
    if(!isset($error) && isset($_POST['title'], $_POST['content'])) {
        header("Location: index.php");
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
				<a href="index.php" id="logo">Dashboard</a> &ndash; <a href="../">Seite ansehen</a>
				<br />
                
                <h4>Artikel hinzufügen</h4>
                 <?php if (isset($error)) { ?>
                	<small style="color:#aa0000;">
                    	<?php echo $error; ?>
                     </small>
                <br /><br />
                <?php } ?>
                
                <form action="add.php" method="post">
                	<input type="text" name="title" placeholder="Titel" /><br /><br />
                    <textarea rows="15"	cols="50" placeholder="Artikel" name="content"></textarea><br /><br />
                    <input type="submit" value="Speichern" />
                </form>
      
		</div>
	</body>
</html>
    <?php
	
} else {
	header('Location: index.php');	
}
?>