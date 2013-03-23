<?php
include_once('includes/config.php');
include_once('includes/connection.php');
include_once('includes/system.php');

$source = new Article;
$template = new Template;
$user = new User;
$articles = $source->fetch_all("article_timestamp");
include("template/home.php");
?>