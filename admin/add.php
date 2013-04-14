<?php

require_once('../includes/config.php');
require_once('../includes/connection.php');
require_once('../includes/system.php');

$user = new User();

$articles = new Articles();

if ($user->logged_in()) {
	if(isset($_POST['submit'])){
		$error = $articles->create(trim($_POST['title']),trim($_POST['content']));
	}
    if(!isset($error) && isset($_POST['title'], $_POST['content'])) {
        header("Location: index.php");
    }
 include('includes/header.php'); ?>
 <span class="dashbargly glyph new"></span><h4>Artikel hinzufügen</h4>
 </div>
				<a href="index.php" id="logo">Dashboard</a> &ndash; <a href="../">Seite ansehen</a>
				<br />
                
                 <?php if (isset($error)) { ?>
                	<small style="color:#aa0000;">
                    	<?php echo $error; ?>
                     </small>
                <br /><br />
                <?php } ?>
                
                <form action="add.php" method="post">
                	<input type="text" name="title" placeholder="Titel" /><br /><br />
                    <textarea placeholder="Artikel" name="content"></textarea><br /><br />
                    <input type="submit" value="Speichern" name="submit" />
                </form>
      
		
<?php
	include('includes/footer.php');
	} else {
		header('Location: index.php');	
	}
?>