<?php $template->get("header.php"); ?>
				<h2>
					<?php echo $article->title;?> 
					- <small>
						geschrieben am <?php echo date('j M Y', $article->timestamp)?>
					</small>
				</h2>	
				<p><?php echo $article->content;?></p>
                <a href="index.php">&larr; Zurück</a>
<?php $template->get("footer.php"); ?>