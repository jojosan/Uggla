<?php

require_once('includes/config.php');
require_once('includes/connection.php');
require_once('includes/system.php');

$user = new User();
$template = new Template();
$articles = new Articles();

if(isset($_GET['id'])) {
	$id = htmlspecialchars(trim($_GET['id']));
	$article = new Article($id);

    require_once("./template/single.php");
}
else {
	header('Location: index.php');
	exit();
}

?>