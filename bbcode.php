<?php
	// This file belongs to ........
	// It transform a bbcode file into a html file
	$searchfor = array("[b]","[/b]");
	$replaceto = array("<b>","<b>");

	function replacefile($pathfrom,$pathto){
		$file = fopen($pathfrom,"r");
		$fcontent = file_get_contents($file, false);
		$replaced = str_replace($searchfor, $replaceto, $fcontent, $replaced);
		return $replaced;
	}
		
