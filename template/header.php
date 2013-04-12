<!doctype html>
<html lang="de">
	<head>
		<meta charset="utf-8"/>
		<title><?php echo SITE_NAME;  ?></title>
		<link rel="stylesheet" href="assets/style.css"/>
		<link rel="alternate" type="application/rss+xml" title="RSS" href="./rss.php" />
		
		<!-- WICHTIG; SOLLTE SPÄTER WIE BEI WORDPRESS ÜDER EINE FUNCTION EINGEBUNDEN WERDEN -->
		<script type="text/javascript" src="includes/lib/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			tinyMCE.init({
					language : "de",
					mode : "textareas"
					theme : "advanced",
					theme_advanced_buttons1 : "mymenubutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink",
					theme_advanced_buttons2 : "",
					theme_advanced_buttons3 : "",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "none",
			});
		</script>
	</head>
	<body>
		<div class="container">
			<h1><a href="./"><?php echo SITE_NAME; ?></a></h1>