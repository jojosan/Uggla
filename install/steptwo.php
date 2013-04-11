<?php
include_once "../includes/config.php";
if(isset($_POST['site_user'], $_POST['site_password'], $_POST['site_mail'], $_POST['install'])){
	$rows = $pdo->exec("INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_mail`) VALUES(1, '".$_POST['site_user']."', '".md5($_POST['site_password'])."', '".$_POST['site_mail']."',)");
	echo 'Gut!';
	
}else{
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8"/>
		<title>Installiere Pina/ 2</title>
		<link rel="stylesheet" href="../assets/style.css"/>
	</head>
	<body>
	<div class="installbar" style="width: 50%;"></div>
    <div id="schritt" style="left: 30%;">Schritt <strong>2/3</strong></div>
		<div class="container">
			<div id="install">
				<h1>Dein erster User; das bist Du!</h1>
				<p>
					<small>Nehme dir bitte kurz Zeit & erstelle dein Profil, wir wollen nicht viel wissen!</small></br>
				</p>
				<form action="steptwo.php" method="post">
					<h2>Hej [unbekannter], wie dürfen wir dich nennen?</h2>
					<input type="text" name="site_user" placeholder="Adminaccountname"/>
					<h2>Sicher dich ab!</h2>
					<input type="password" name="site_password" placeholder="Passwort"/><br />
					<input type="password" name="site_password_2" placeholder="Wiederhole dein Passwort (keine Funktion)"/><br />
					<h2>Ok, wie können wir dich erreichen?</h2>
					<p>
						<small>Wir werden dir <strong>nie</strong> Werbung oder anderen nervigen Kram schicken, gebe aber zu deiner eigenen Sicherheit eine gültige E-Mail Adresse an.</small>
					</p>
					<input type="email" name="site_mail" placeholder="E-Mail Adresse"/>
					<input type="submit" value="Weiter" name="install"/>
				</form>
			</div>
		</div>
	</body>
</html>
<?php } ?>