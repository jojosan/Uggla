<?php
include_once('../includes/config.php');
include_once('../includes/connection.php');
include_once('../includes/article.php');
include_once('../includes/user.php');
$user = new User;
$article = new Article;

if($user->logged_in() && isset($_GET['id'])){
	$article->delete($_GET['id']);
	header("Location: index.php");
}else{
	header("Location: index.php");
	exit();
}
?>