<?php $template->get("header.php"); ?>
				<h2>
					<?php echo $article['article_title'];?> 
					- <small>
						geschrieben am <?php echo date('j M Y', $article['article_timestamp'])?>
					</small>
				</h2>	
				<p><?php echo $article['article_content'];?></p>
                <a href="index.php">&larr; Zurück</a>
<?php $template->get("footer.php"); ?>