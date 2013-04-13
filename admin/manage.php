<?php

session_start();

require_once('../includes/config.php');
require_once('../includes/connection.php');
require_once('../includes/system.php');

//$article = new Article();
$articles = new Articles();
$articles = $articles->fetch_all("article_timestamp", "DESC");
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Artikel verwalten</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
	</head>

	<body>
		<div class="container">
				<a href="index.php" id="logo">Dashboard</a> &ndash; <a href="../">Seite ansehen</a>
                <h4>Artikel verwalten</h4>
                <?php
				echo "<ol>";
				foreach($articles as $article){
					echo "<li><a href='edit.php?id=".$article->id."'>Bearbeite &quot;".$article->title."&quot;</a>  oder <a href='delete.php?id=".$article->id."' style='color:#aa0000;'>L&ouml;sche Ihn</a></li>";
				}
				echo "</ol>";
                ?>
		</div>
	</body>
</html>
