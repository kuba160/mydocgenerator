<?php
	//This file belongs to [prgmname here]. It create a list of files
	// which will be handled by generatemenu.php
	//
	// Here are the constants
	$dirsum = 0;
	$filesum = 0;
	$ignorefile = "ignore";
	$settingsfile = "settings";
	$ignored = 0;
	#settings = 0;
	//
	//File list
	$fulllist = array();
	$listfiles = array();
	$listdirs = array();
	$settingfolder;
	// Here are the variables
	//
	// Directory of documentation (DON'T USE ./)
	$directory = "./doc/";

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
	// Now cout all dirs and files to dir- and filesum
	// Make a filelist
	foreach($array as $i => $i_value) {
		switch(filetype($directory.'/'.$array[$i])) {
			case "dir":
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
				break;
			case "file":
		                $filesum++;
				$listfiles[] = array($array[$i] => "file");
				break;
		}
	}
	//
	// Return how many files and folders are found
	echo "Found ", $dirsum, " folders and ", $filesum, " files.\n$ignored folder(s) was/were ignored because of ignorefile.\n";
	//
	//
	echo "Folder \"", $settingfolder, "\" is used for settings.\n";
	// To be continued...
	//Makes a filelist
	$list = array_merge($listdirs, $listfiles);
	// 	Returns the encoded array in json
	//	echo(json_encode($array));
	//	Returns the array of directory. Used only for bug-checking
	//	var_dump($array);
	//	echo(json_encode($list));
		var_dump($list);
?>
