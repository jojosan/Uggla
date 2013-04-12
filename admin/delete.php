<?php

require_once('../includes/config.php');
require_once('../includes/connection.php');
require_once('../includes/system.php');

$user = new User();
$articles = new Articles();

if($user->logged_in() && isset($_GET['id'])) {
	$article = $articles->get(htmlspecialchars(trim($_GET['id'])));
	$article->delete();
	header("Location: index.php");
	exit();
} else {
	header("Location: index.php");
	exit();
}
?>