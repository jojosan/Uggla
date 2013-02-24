<?php

include_once('includes/connection.php');
include_once('includes/article.php');

$article = new Article;
$articles = $article->fetch_all();

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
				<ol>
					<?php foreach ($articles as $article) { ?>
						<li>
							<a href="article.php?id=<?php echo $article['article_id']; ?>">
								<?php echo $article['article_title']; ?>
							</a>
							- <small> 
								geschrieben am <?php echo date('j M Y', $article['article_timestamp'])?>
							</small>

						</li>
					<?php } ?>
				</ol>
                
                <br />
                
                <small><a href="admin">login</a></small>	
		</div>
	</body>
</html>