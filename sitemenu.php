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

/*		// Get custom variables 	// NOT NEEDED, done in prepare.php
	if( file_exists("./vars.json"))
		extract( json_decode(file_get_contents("./vars.json")), EXTR_OVERVRITE);
*/
	// We got:
	// $directory,$ignoredir,$settingsdir,$variablefile,$listfile,$statfile,$continuefile


	// Get the list of files/dirs
//	$array = json_decode(file_get_contents($directory.'/'.$settingsdir.'/'.$listfile), true);

	// Our html code:
	extract( json_decode(file_get_contents($settingspath.'/'."html.json"), true), EXTR_OVERWRITE);

	// And our list
	$array = json_decode(file_get_contents($settingspath.'/'.$listfile), true);

	// Add the addtional things
//	str_replace(array( "TITLE", "HEAD", "BODY"), array("Menu",     , $htmlbare, $html);;
//	$code = "";
	var_dump (GenerateMenu($array,$link));
	function GenerateMenu($array,$link){
		$code = "";
	//	$num  = "1";
		foreach ($array as $key1 => $value1) {
			$code = $code."<b>".$key1."</b>\n<br>\n";
			

			foreach ($value1 as $key2 => $value2) {
				$code = $code.str_replace(array("LINK", "NAME"), array( $key1."/".$value2 , $value2 ), $link."\n<br>\n");
			}
	//	$num = $num+1;
		}
		return $code;
	}
//	echo($init.$code.$end);
/* OLD
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
*/	