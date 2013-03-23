
			<?php 
			$template->get("header.php");
			$posts = $articles->fetch_all("article_timestamp", "ASC");
			foreach($posts as $article){
				echo "<h2><a href='article.php?id=".$article->id."'>".$article->title."</a></h2>\n";
				echo "<p>".substr($article->content, 0, 140)."[...]</p>";
			}			
			$template->get("footer.php");
			?>