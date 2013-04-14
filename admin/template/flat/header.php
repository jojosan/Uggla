<?php

require_once('../../includes/config.php');
require_once('../../includes/connection.php');
require_once('../../includes/system.php');

$user = new User();

if($user->logged_in()) { ?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />

		<title>CMS</title>
		<link rel="stylesheet" type="text/css" href="../../assets/style.css">
	</head>

	<body>