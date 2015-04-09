<?php
	// This file belongs to ..... project, author: kuba(_)160
	// It will make a structured list of each page (or something)
	//
	// To do:
	//	1. Get all variables
	//	2. Start html file
	//	For each folder:
	//		make a menu
	//		
	//  For each file:
	//		make an under-menu;

	// First get the path ($directory.$settingsdir)
	$settingspath = file_get_contents(".continue");

	// Now get the variables
	extract( json_decode(file_get_contents($settingspath.'/'."variables.json"), true), EXTR_OVERWRITE);

		// Get custom variables
	if( file_exists("./vars.json"))
		extract( json_decode(file_get_contents("./vars.json")), EXTR_OVERVRITE);

	// We got:
	// $directory,$ignoredir,$settingsdir,$variablefile,$listfile,$statfile,$continuefile

	// Get the list of files/dirs
	$array = json_decode(file_get_contents($directory.'/'.$settingsdir.'/'.$listfile), true);

	// Beginning of menu
	$init = 
"<!DOCTYPE html>
<html lang=\"en-US\">
<head>
<title>Menu</title>
</head>
<body>";
	// End of menu
	$end =
"</body>
</html>
";
	// Now generate the middle part of it
	$code = "";
	GenerateMenu($directory,0, $array);
	echo($init.$code.$end);

	function GenerateMenu($path,$tab,$array){
		global $code;
		foreach ($array as $i => $i_value) {
			switch(filetype($path.'/'.$array[$i_value])){
				case "dir":
					str_repeat("&nbsp;", $tab);
					GenerateMenu($path.$array[$i],$tab++,$array[$i]);

					break;
				case "file":
					str_repeat("&nbsp;", $tab);
					$code = $code."<h4><a href=\"/".$path.'/'.$array[$i]."\">".$array[$i]."</a></h4>";
					break;
			}
		}
		return 0;
	}