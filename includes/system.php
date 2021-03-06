<?php
	class Article {
		public function __construct($id){
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM article WHERE article_id = ?");
			$query->bindValue(1, $id);
			$query->execute();
			
			$article = $query->fetch();
			$this->id = $article['article_id'];
			$this->title = str_replace("\\\"", "\"", str_replace("\\'", "'", $article['article_title']));
			$this->content = str_replace("\\\"", "\"", str_replace("\\'", "'", $article['article_content']));
			$this->timestamp = $article['article_timestamp'];
			$this->author = $article['article_author'];
		}
		public function update($new_title, $new_content){
			global $pdo;
			if(isset($new_title, $new_content)) {
				if(empty($new_title) || empty($new_content)) {
					$error = 'Alle Felder ausfüllen';
					return $error;
				} else {
					$query = $pdo->prepare("UPDATE article SET article_title = ? , article_content = ?, article_timestamp = ? article_author = ? WHERE article_id = ?");
					$query->bindValue(1, $new_title);
					$query->bindValue(2, nl2br($new_content));
					$query->bindValue(3, time());
					if(isset($_SESSION['logged_in'])){
						$query->bindValue(4, $_SESSION['user']['name']);
					}else{
						$query->bindValue(4, "Pina");
					}
					$query->bindValue(5, $this->id);
					
					$query->execute();
					if($query->rowCount() <= 0){
						$error = "Fehler mit der Datenbank";
						return $error;
					}
				}
			}
		}
		public function delete(){
			global $pdo;
			$query = $pdo->prepare("DELETE FROM article WHERE article_id = ?");
			$query->bindValue(1, $this->id);
			$query->execute();
		}
	}
	
	/*########
	#Articles#
	########*/
	
	class Articles{
		public function fetch_all($orderby, $ascordesc){
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM article ORDER BY ".$orderby." ".$ascordesc);
			$query->execute();

			$ids = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach($ids as $id){
				$article = new Article($id['article_id']);
				$articles[] = clone $article;
				$article = null;
			}
			return $articles;
		}
		public function get($id){
			return new Article($id);
		}
		public function create($title, $content){
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
					if(isset($_SESSION['logged_in'])){
						$query->bindValue(4, $_SESSION['user']['name']);
					}else{
						$query->bindValue(4, "Pina");
					}
			
					$query->execute();
				}
			}
		}
	}
	/*########
	## User ##
	########*/
	
	class User{
		public function fetch($user_id){
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
			$query->bindValue(1, $user_id);
			$query->execute();

			return $query->fetch();
		}
		public function fetch_all($orderby){
			global $pdo;

			$query = $pdo->prepare("SELECT * FROM users ORDER BY ? ASC");
			$query->bindValue(1, $orderby);
			$query->execute();

			return $query->fetchAll();
		}
		public function create($user_name, $user_password, $user_mail){
			global $pdo;
			if ((empty($user_name) or empty($user_password) or empty($user_mail)) or !isset($user_name, $user_password, $user_mail)) {
				$error = 'Nicht alle Daten angegeben!';
				return $error;
			} else {
				$query = $pdo->prepare("INSERT INTO users(user_name, user_password, user_mail) VALUES(?, ?, ?)");
				$query->bindValue(1, $user_name);
				$query->bindValue(2, md5($user_password));
				$query->bindValue(3, $user_mail);
				$query->execute();
			}
		}
		public function update($user_id, $new_name, $new_password, $new_mail){
			global $pdo;
			if((empty($title) or empty($content)) and isset($user_name, $user_password, $user_mail)) {
				$error = 'Alle Nicht alle Daten angegeben!';
					return $error;
			} else {
				$query = $pdo->prepare("UPDATE article SET user_name = ? , user_password = ?, user_mail = ? WHERE user_id = ?");
				$query->bindValue(1, $new_name);
				$query->bindValue(2, md5($new_password));
				$query->bindValue(3, $new_mail);
				$query->bindValue(4, $user_id);
				$query->execute();

				if($query->rowCount() <= 0) {
					$error = "Fehler mit der Datenbank";
					return $error;
				}
			}
		}
		public function log_in($user_name, $user_password, $location){
			global $pdo;
			if(isset($user_name, $user_password)) {
				$user_password = md5($user_password);
				if(empty($user_name) or empty($user_password)) {
					$error = 'Bitte alle Felder ausfüllen!';
					return $error;
				} else {
					$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
			
					$query->bindValue(1, $user_name);
					$query->bindValue(2, $user_password);
			
					$query->execute();
			
					$num = $query->rowCount();
			
					if($num == 1) {
						//JA
						$user = $query->fetch();
						$query = $pdo->prepare("INSERT INTO users_logged (user_name, user_ip, timestamp, status) VALUES (?, ?, ?, ?)");
						
						$query->bindValue(1, $username);
						$query->bindValue(2, getenv('REMOTE_ADDR'));
						$query->bindValue(3, time());
						$query->bindValue(4, 'erfolgreich');	
				
						$query->execute();
			
						$_SESSION['logged_in'] = true;
						$_SESSION['user']['id'] = $user['user_id'];
						$_SESSION['user']['name'] = $user['user_name'];
						$_SESSION['user']['mail'] = $user['user_mail'];
						header('Location: '.$location.'');
						exit();
					} else {
						//NEIN
						$query = $pdo->prepare("INSERT INTO users_logged (user_name, user_ip, timestamp, status) VALUES (?, ?, ?, ?)");
				
						$query->bindValue(1, $_POST['username']);
						$query->bindValue(2, getenv('REMOTE_ADDR'));
						$query->bindValue(3, time());
						$query->bindValue(4, 'gescheitert');	
				
						$query->execute();
						$error = 'Falsche Daten!';
						return $error;
					}
				}
			}
		}
		public function logged_in() {
			session_start();
			if(isset($_SESSION['logged_in'])) {
				return true;
			} else {
				return false;
			}
		}
		public function current_user() {
			if($this->logged_in()) {
				return $_SESSION['user'];
			} else {
				return false;
			}
		}
		public function log_out() {
			session_start();
			session_destroy();
		}
	}
	
	/*########
	Template##
	########*/
	
	class Template{
		public function get($file){
			require_once("./template/".$file);
		}
	}
?>
