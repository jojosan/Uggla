<?php
include_once('includes/config.php');
include_once('includes/connection.php');
include_once('includes/system.php');

$user = new User;
$source = new Article;
$template = new Template;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$article = $source->fetch($id);
	include("./template/single.php");
} else {
	header('Location: index.php');
	exit();
}

?>