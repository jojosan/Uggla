<?php
	header("Contet-type: application/rss+xml");
	require_once("./includes/config.php");
	require_once("./includes/connection.php");
	require_once("./includes/system.php");
	$articles = new Articles();
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL =  str_replace("rss.php", "", $pageURL);
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
?>

<rss version="2.0">
	<channel>
    		<title><?php echo SITE_NAME; ?></title>
    		<link><?php echo $pageURL; ?></link>
    		<description>My awesome site</description>
    		<language>de-de</language>
    		<!--<copyright></copyright>-->
    		<pubDate><?php echo date("r"); ?></pubDate><?php
			$c = 0;
			foreach($articles->fetch_all("article_timestamp", "DESC") as $article){
				if($c == 10){ break; } ?>

		<item>
			<title><?php echo $article->title; ?></title>
			<description><![CDATA[<?php echo $article->content; ?>]]></description>
			<link><?php echo $pageURL."article.php?id=".$article->id; ?></link>
			<author><?php echo $article->author; ?></author>
			<guid><?php echo $pageURL."article.php?id=".$article->id; ?></guid>
			<pubDate><?php echo date("r", $article->timestamp); ?></pubDate>
		</item>
		<?php $c++; } ?>
	
	</channel>
</rss>
