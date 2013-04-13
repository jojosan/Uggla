
			<?php 
			$template->get("header.php");
			$posts = $articles->fetch_all("article_timestamp", "DESC");
			foreach($posts as $article){
				echo "<h2><a href='article.php?id=".$article->id."'>".$article->title."</a></h2>\n";
				echo $article->content;
			}			
			$template->get("footer.php");
			?>
