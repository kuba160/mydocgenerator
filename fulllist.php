<?php
	// This file belongs to ... project
	// It needs some values from prepare.php

	// What to do:
	// get list from prepare
	//	scan every entry
	// to each folder
	// 		make a list from that folder
	// functions?
	// ??? make an array from folder ???

	$dirarray = array();
	$filearray = array();
	$variablefile = "variables.json";
	// OK, time to get variables
	// Now get the content
	if( file_exists("./variables.json"))
		extract( json_decode(file_get_contents($variablefile), true), EXTR_OVERWRITE);
	else
		exit("We don't have variables.json!\nHave you ran prepare.php first?\n");

// Now


	// Now we (should) have $directory $ignoredir and $settingsdir variables
	// $variablefile $statfile $listfile
	$statfilepath = $directory.'/'.$settingsdir.'/'.$statfile;
	if( file_exists($statfilepath))
		extract( json_decode(file_get_contents($statfilepath), true), EXTR_OVERWRITE);
	else
		exit("We don't have stats.json!\nHave you ran prepare.php first?\n");
	// $dirsum $diffsum $filesum

	// Now we need to get a filelist
	$array = json_decode(file_get_contents($directory.'/'.$settingsdir.'/'."list.json"), true);
var_dump($array);
	// Now each root dir

	foreach ($array as $i => $i_value) {
		switch(filetype($directory.'/'.$array[$i])) {
			case "dir":
					$dirarray[] = GetArrayFromDir($directory, $array[$i]);
					break;
			case "file":
					$filearray[] = $array[$i];
					break;
	}
}

var_dump(array_merge($dirarray, $filearray));


	function GetArrayFromDir($path, $file){
	$array = array_diff(scandir($path.'/'.$file), array('..', '.'));
	foreach($array as $i => $i_value) {
		switch(filetype($path.'/'.$Array[$i])) {	// Check type of it
			case "dir":							// When dir
				$dirarray[] = GetArrayFromDir($path, $array[$i]);
				break;
			case "file":							// When file
		    	$filesum++;					// sum it
				$listfiles[] = array($array[$i]);	// add it to array
				break;							//
		}
	}

	}
?>