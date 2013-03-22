
			<?php 
			$template->get("header.php");
			foreach($articles as $article){
				echo "<h2><a href='article.php?id=".$article['article_id']."'>".$article['article_title']."</a></h2>\n";
				echo "<p>".substr($article['article_content'], 0, 140)."[...]</p>";
			}			
			$template->get("footer.php");
			?>