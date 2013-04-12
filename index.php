<?php

require_once('includes/config.php');
require_once('includes/connection.php');
require_once('includes/system.php');

$articles = new Articles();
$template = new Template();
$user = new User;

require_once("template/home.php");

?>