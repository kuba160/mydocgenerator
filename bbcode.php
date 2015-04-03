<?php
	// This file belongs to ........
	// It transform a bbcode file into a html file

	// For first change b,i,u,s

function bbcode_arrays(){
global $searchfor = array(	"[b]","[/b]",
				"[i]"."[/i]",
				"[u]","[/u]",
				"[s]","[/s]"
				);

global $replaceto = array(	"<b>","</b>",
				"<i>","</i>",
				"<u>","</u>",
				"<s>","</s>"
				);

}
	// These are used for testing now
	$pathfrom = "./doc/dir/a";
	$pathto = "./generated/dir/a";
	$name = "my.function";
//	bbcode_arrays();
//	bbcode_replace($pathfrom,$pathto);

	function bbcode_replace($pathfrom,$pathto, $name){
		// First prepare the data
		//$file = fopen($pathfrom,"r");
		$fcontent = file_get_contents($pathfrom, false);
		$replaced = str_replace($searchfor, $replaceto, $fcontent, $replaced);
		//fclose($file);

		// Now we can start the file
		// First init file
		$file = fopen($pathto,"w");


		// Now make headers
		fwrite( $file, "<!DOCTYPE html>\n<html lang=\"en-US\">\n");
		// Now <head>
		fwrite( $file, "<head>\n<title>".$name."</title>\n</head>\n");
		// Now <body>
		fwrite( $file, "<body>\n");
		// Now the transformed bbcode
		fwrite( $file,$replaced);
		// End body and html
		fwrite($file, "\n</body>\n</html>");
		// Close file
		fclose($file);
		return 0;
	}
