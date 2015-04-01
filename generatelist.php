<?php
	//This file belongs to [prgmname here]. It create a list of files
	// which will be handled by generatemenu.php
	//
	//
	$directory = "./doc";	// Main folder with documentation
	// Here are the constants
	$dirsum = 0;		// Will be a sum of all dirs
	$filesum = 0;		// Will be a sum of all files
	$ignored = 0;		// Will be a sum of all ignored dirs (containing $ignorefile)
	$settings = 0;		// Will be a sum of all folders with settings
	//
	//Here are the special files
	$ignorefile = "ignore";		// Will ignore any folder with that file
	$settingsfile = "settings";	// That folder will be used for settings
	//
	// Arrays
	$fulllist = array();	// Array with all files which will be : $listdirs and $listfiles
	$listfiles = array();	// Will be a list of files
	$listdirs = array();	// Will be a list of dirs
	//
	// Variables
	$settingfolder;	// Here will be the folder used for settings
	//
	// LET'S ROLL
	//
	// Now it will scan the directory without '.' and '..'
	$array = array_diff(scandir($directory), array('..', '.'));
	//
	// Message if directory is empty
	if(empty($array)) {
		echo "Directory is empty! Returning to [INSERT SHELL NAME HERE].";
		exit("\n");
	}
	//
	// Now cout all dirs and files.
	// Each dir will be added to $listdirs and each file to $listfiles.
	foreach($array as $i => $i_value) {
		switch(filetype($directory.'/'.$array[$i])) {
			case "dir":							// When dir
				$dirsum++;
				if(file_exists($directory.'/'.$array[$i].'/'.$ignorefile)){
					$ignored++;
					break;
				}
				if(file_exists($directory.'/'.$array[$i].'/'.$settingsfile)){
					$settingfolder = $array[$i];
					$listdirs[] = array($array[$i] => "settings");
					break;
				}
				$listdirs[] = array($array[$i] => "dir");
				break;							//
			case "file":							// When file
		                $filesum++;
				$listfiles[] = array($array[$i] => "file");
				break;							//
		}
	}
	//
	// Return how many files and folders are found
	echo "Found ", $dirsum, " folders and ", $filesum, " files.\n$ignored folder(s) was/were ignored because of ignorefile.\n";
	//
	// Check for $settingsfolder
	if(empty($settingfolder)){
		echo "You don't have any folder for settings! Create one and add a file called \"", $settingsfile, "\" .";
		exit("\n");
		}
	//
	echo "Folder \"", $settingfolder, "\" is used for settings.\n";
	//
	//Merges $listdirs and $listfiles
	$list = array_merge($listdirs, $listfiles);

	// 	Returns the encoded array in json
	echo(json_encode($list));
	//	Returns the array. Used only for bug-checking
	//	var_dump($list);

	// THE END?

	function 



?>
