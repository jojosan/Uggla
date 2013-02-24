<?php

session_start();
include_once('../includes/connection.php');
if (isset($_SESSION['logged_in'])) {
	if (isset($_POST['title'], $_POST['content'])) {
		$title = $_POST['title'];
		$content = $_POST['content'];
		
		if (empty($title) or empty($content)) {
			$error = 'Alle Felder ausfüllen';	
		} else {
			$query = $pdo->prepare('INSERT INTO article (article_title, article_content, article_timestamp, article_author) VALUES (?, ?, ?, ?)');
			
			$query->bindValue(1, $title);
			$query->bindValue(2, nl2br($content));
			$query->bindValue(3, time());	
			$query->bindValue(4, $_SESSION['logged_in']);
			
			$query->execute();
			
			header('Location: index.php');
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
				<a href="index.php" id="logo">Dashboard</a>
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