<?php

session_start();
include_once('../includes/config.php');
include_once('../includes/connection.php');
include_once('../includes/system.php');

$user = new User;


if ($user->logged_in() && isset($_GET['id'])){
	$article = new Article("");
	if(isset($_POST['title'], $_POST['content'])){
		$error = $article->update($_GET['id'], $_POST['title'], $_POST['content']);
		if(!isset($error)){
			header("Location: index.php");
			exit();
		}
	}
	$toedit = new Article($_GET['id']);

?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>CMS</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
	</head>

	<body>
		<div class="container">
				<a href="index.php" id="logo">Dashboard</a> &ndash; <a href="../">Seite ansehen</a>
				<br />
                
                <h4>Artikel editieren</h4>
                 <?php if (isset($error)) { ?>
                	<small style="color:#aa0000;">
                    	<?php echo $error; ?>
                     </small>
                <br /><br />
                <?php } ?>
                
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post">
                	<input type="text" name="title" placeholder="Titel" value="<?php echo $toedit->title; ?>"/><br /><br />
                    <textarea rows="15"	cols="50" placeholder="Artikel" name="content"><?php echo str_replace("<br />", "", $toedit->content);?></textarea><br /><br />
                    <input type="submit" value="&Auml;nderungen speichern" />
                    
                </form>
      
		</div>
	</body>
</html>
<?php } else {
	header('Location: index.php');	
}
?>