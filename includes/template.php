<?php
class Template{
	public function get($file){
		include("./template/".$file);
	}
}
?>