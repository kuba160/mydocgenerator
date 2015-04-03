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
	$ignoredir = "ignore";		// Will ignore any folder with that file
	$settingsdir = "settings";	// That folder will be used for settings

	$variablefile = "variables.json";
	$listfile = "list.json";
	//
	// Arrays
	$fulllist = array();	// Array with all files which will be : $listdirs and $listfiles
	$fullsettings = array();// Array with variables needed later

	$listfiles = array();	// Will be a list of files
	$listdirs = array();	// Will be a list of dirs
	$listsettings = array();
	//
	// Variables
	$settingsfolder;	// Here will be the folder used for settings
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
				if($array[$i] == $ignoredir){
					$ignored++;
					break;
				}
				if($array[$i] == $settingsdir){
					$settingsfolder = $array[$i];
					break;
				}
				$listdirs[] = array($array[$i]);
				break;							//
			case "file":							// When file
		                $filesum++;
				$listfiles[] = array($array[$i]);
				break;							//
		}
	}
	//
	// Return how many files and folders are found
	echo "Found ", $dirsum, " folders and ", $filesum, " files.\n$ignored folder(s) was/were ignored because of ignorefile.\n";
	//
	// Check for $settingsfolder
	if( empty($settingsfolder) ) {
		echo "You don't have any folder for settings! Create one and add a file called \"", $settingsdir, "\" .";
		exit("\n");
		}
	//
	echo "Folder \"", $settingsdir, "\" is used for settings.\n";
	//
	//Merges $listdirs and $listfiles
	$fulllist = array_merge($listdirs, $listfiles);
	//
	//
	$fullsettings = array_merge( array("root" => $directory), array("settings" => $settingsdir) );
	// 	Returns the encoded array in json
//	echo(json_encode($fulllist));
	//	Returns the array. Used only for bug-checking
//		var_dump($fulllist);
//		var_dump($fullsettings);
	// THE END?


	if( file_exists($directory.'/'.$settingsdir.'/'.$variablefile) ) {
		unlink( $directory.'/'.$settingsdir.'/'.$variablefile);
	}
	$file = fopen($directory.'/'.$settingsdir.'/'.$variablefile, "w");
	fwrite( $file, json_encode($fullsettings));
	fclose($file);
	//
	//
	if( file_exists($directory.'/'.$settingsdir.'/'.$listfile) ) {
		unlink( $directory.'/'.$settingsdir.'/'.$listfile);
	}
	$file = fopen($directory.'/'.$settingsdir.'/'.$listfile, "w");
	fwrite( $file, json_encode($fulllist));
	fclose($file);

	echo( $variablefile." and ".$listfile." are located in ".$directory."/".$settingsdir.".\n");
//	function 



?>
