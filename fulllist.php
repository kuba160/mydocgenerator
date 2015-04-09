<?php
	// This file belongs to ... project
	// It needs some values from prepare.php

	require 'functions_file.php';


	// First get the path ($directory.$settingsdir)
	$settingspath = file_get_contents(".continue");

	// Now get the variables
	extract( json_decode(file_get_contents($settingspath.'/'."variables.json"), true), EXTR_OVERWRITE);


	// Get custom variables
	if( file_exists("./vars.json"))
		extract( json_decode(file_get_contents("./vars.json")), EXTR_OVERVRITE);


	// We got:
	// $directory,$ignoredir,$settingsdir,$variablefile,$listfile,$statfile,$continuefile


	$dirsum  = 0;
	$filesum = 0;

	//global $settingsdir;

	$fulllist = GetArrayFromDir($directory);

	$statlist = array(	"dirsum"	=> $dirsum, 
						"filesum"	=> $filesum );
	
	// Save the list
	SaveJson($directory.'/'.$settingsdir.'/'.$listfile, $fulllist);
	// Save  the stats
	SaveJson($directory.'/'.$settingsdir.'/'.$statfile, $statlist);


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
		    		$filesum++;						// sum it
					$filearray[] = $array[$i];		// = $array[$i];	// add it to array
					break;							//
			}
		}
		return array_merge($dirarray, $filearray);
	}
?>