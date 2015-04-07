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


	// First get the path ($directory.$settingsdir)
	$directory = file_get_contents(".continue");

	// Now get the variables
	extract( json_decode(file_get_contents($directory.'/'."variables.json"), true), EXTR_OVERWRITE);


	// Get custom variables
	if( file_exists("./vars.json"))
		extract( json_decode(file_get_contents("./vars.json")), EXTR_OVERVRITE);


	// We got:
	// $directory,$ignoredir,$settingsdir,$variablefile,$listfile,$statfile,$continuefile

	//	Make statfilepath (it should be empty)
	$statfilepath = $directory.'/'.$settingsdir.'/'.$statfile;
	// $dirsum $diffsum $filesum

	// Now we need to get a filelist
//	$array =  array_diff(scandir($directory), array('..', '.'));
//var_dump($array);

	$dirsum = 0;
	$filesum = 0;
//global $settingsdir;

$fulllist = GetArrayFromDir($directory);
var_dump($fulllist);


foreach ($fulllist["dir"] as $i => $i_value) {
	echo($i." - ");
	echo($i_value."\n");
}

//echo(json_encode($fulllist));

	function GetArrayFromDir($path){
	global $settingsdir;
	global $dirsum;
	global $filesum; 
	$array = array_diff(scandir($path), array('..', '.'));
	$filearray = array();
	$dirarray = array();
	foreach($array as $i => $i_value) {
		switch(filetype($path.'/'.$array[$i])) {	// Check type of it
			case "dir":							// When dir
				if($array[$i] == $settingsdir)
					break;
				$dirsum++;
				$dirarray[$array[$i]] = GetArrayFromDir($path.'/'.$array[$i]);
				break;
			case "file":							// When file
		    	$filesum++;					// sum it
				$filearray[] = $array[$i];// = $array[$i];	// add it to array
				break;							//
		}
	}
	return /*array( "list" => */array_merge($dirarray, $filearray);//, "dirsum" => $dirsum, "filesum" => $filesum);
	}
?>