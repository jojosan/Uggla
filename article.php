<?php

include_once('includes/connection.php');
include_once('includes/article.php');

$article = new Article;

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$data = $article->fetch_data($id);
	?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />

		<title>CMS</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css">
	</head>

	<body>
		<div class="container">
				<a href="index.php" id="logo">Startseite</a>
				<h4>
					<?php echo $data['article_title'];?> 
					- <small>
						geschrieben am <?php echo date('j M Y', $data['article_timestamp'])?>
					</small>
				</h4>	
				<p><?php echo $data['article_content'];?></p>
                <a href="index.php">&larr; Zurück</a>
		</div>
	</body>
</html>
	<?php
} else {
	header('Location: index.php');
	exit();
}

?>