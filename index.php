<?php
include_once('includes/config.php');
include_once('includes/connection.php');
include_once('includes/article.php');
include_once('includes/user.php');
include_once('includes/template.php');

$source = new Article;
$template = new Template;
$articles = $source->fetch_all("article_timestamp");
include("template/home.php");
?>