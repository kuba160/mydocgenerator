<?php
	// This file belongs to ........
	// It transform a bbcode file into a html file
	$searchfor = array("[b]","[/b]");
	$replaceto = array("<b>","<b>");

	$pathfrom = "./doc/dir/a";
	$pathto = "./generated/dir/a";

	replacefile($pathfrom,$pathto);

	function replacefile($pathfrom,$pathto){
		//$file = fopen($pathfrom,"r");
		$fcontent = file_get_contents($pathfrom, false);
		$replaced = str_replace($searchfor, $replaceto, $fcontent, $replaced);
		//fclose($file);

		$file = fopen($pathto,"w");
		fwrite( $file,$replaced);
		fclose($file);
		return 0;
	}
