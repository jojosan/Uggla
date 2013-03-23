<?php

session_start();
include_once('../includes/config.php');
include_once('../includes/connection.php');
include_once('../includes/system.php');
$article = new Article();
$articles = $article->fetch_all("article_timestamp");
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Articles</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
	</head>

	<body>
		<div class="container">
				<a href="index.php" id="logo">Dashboard</a> &ndash; <a href="../">Seite ansehen</a>
                <h4>Artikel verwalten</h4>
                <?php
				echo "<ol>";
				foreach($articles as $articleinfo){
					echo "<li><a href='edit.php?id=".$articleinfo['article_id']."'>Bearbeite &quot;".$articleinfo['article_title']."&quot;</a>  oder <a href='delete.php?id=".$articleinfo['article_id']."' style='color:#aa0000;'>L&ouml;sche Ihn</a></li>";
				}
				echo "</ol>";
                ?>
		</div>
	</body>
</html>
