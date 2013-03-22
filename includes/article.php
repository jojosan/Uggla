<?php
	class Article {
		public function fetch_all($orderby) {
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM article ORDER BY ? ASC");
			$query->bindValue(1, $orderby);
			$query->execute();

			return $query->fetchAll();
		}

		public function fetch($article_id) {
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM article WHERE article_id = ?");
			$query->bindValue(1, $article_id);
			$query->execute();

			return $query->fetch();
		}
		public function create($title, $content/*, $user*/){
			global $pdo;
			if (isset($title, $content)) {
				if (empty($title) or empty($content)) {
					$error = 'Alle Felder ausfüllen';
					return $error;
				}else{
					$query = $pdo->prepare("INSERT INTO article (article_title, article_content, article_timestamp, article_author) VALUES (?, ?, ?, ?)");
			
					$query->bindValue(1, $title);
					$query->bindValue(2, nl2br($content));
					$query->bindValue(3, time());	
					$query->bindValue(4, $_SESSION['logged_in']);
			
					$query->execute();
				}
			}
			
		}
		public function update($article_id, $new_title, $new_content){
			global $pdo;
			if(isset($article_id, $new_title, $new_content)){
				if(empty($new_title) or empty($new_content) or empty($article_id)){
					$error = 'Alle Felder ausfüllen';
					return $error;
				}else{
					$query = $pdo->prepare("UPDATE article SET article_title = ? , article_content = ?, article_timestamp = ? WHERE article_id = ?");
					$query->bindValue(1, $new_title);
					$query->bindValue(2, nl2br($new_content));
					$query->bindValue(3, time());
					$query->bindValue(4, $article_id);
					
					$query->execute();
					if($query->rowCount() <= 0){
						$error = "Fehler mit der Datenbank";
						return $error;
					}
				}
			}
		}
		public function delete($article_id){
			global $pdo;
			$query = $pdo->prepare("DELETE FROM article WHERE article_id = ?");
			$query->bindValue(1, $article_id);
			$query->execute();
		}
	}
?>