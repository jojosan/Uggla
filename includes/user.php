<?php
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
	//Auf der Agenda
	public function create($user_name, $user_password){
		
	}
	public function update($user_id, $new_name, $new_password){
		
	}
	public function log_in($user_name, $user_password, $location){
		global $pdo;
		if (isset($user_name, $user_password)) {
			$user_password = md5($user_password);
			if (empty($user_name) or empty($user_password)) {
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
					$query = $pdo->prepare("INSERT INTO users_logged (user_name, user_ip, timestamp, status) VALUES (?, ?, ?, ?)");
				
					$query->bindValue(1, $username);
					$query->bindValue(2, getenv('REMOTE_ADDR'));
					$query->bindValue(3, time());
					$query->bindValue(4, 'erfolgreich');	
				
					$query->execute();
			
					$_SESSION['logged_in'] = true;
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
	public function logged_in(){
		session_start();
		if(isset($_SESSION['logged_in'])){
			return true;
		}else{
			return false;
		}
	}
	public function log_out(){
		session_start();
		session_destroy();
	}
}
?>