<?php
	//This file belongs to [prgmname here]. It create a list of files
	// which will be handled by generatemenu.php
	//
	//////////////////////////////////////////////////////////////////////////////////////
	//																					//
	//								PRECONFIGURABLE VARIABLES							//
	//																					//
	//			You can change them using vars.json in form: variable:value				//
	//																					//
	// Main folder with documentation													//
	$directory = "./doc";																//
	//																					//
	// Ignore dir name																	//
	$ignoredir = "ignore";																//
	//																					//
	// Settings dir name																//
	$settingsdir = "settings";															//
	//																					//
	//////////////////////////////////////////////////////////////////////////////////////
	//																					//
	//									OUTPUT FILES									//
	//																					//
	//			You shouldn't change them. They will be used later.						//
	//																					//
	// Preconfigurable variables above													//
	$variablefile =	 "variables.json";													//
	// Main dir list																	//
	$listfile =		 "list.json";														//
	// Statistic of documentation (early)												//
	$statfile = 	 "stats.json";													//
	//																					//
	//////////////////////////////////////////////////////////////////////////////////////
	//
	//									PRGM VARIABLES
	//
	// Used for sum:
	$dirsum = 0;		// of all dirs
	$diffsum = 0;		// files that not belong to documentation
	$filesum = 0;		// of all files
	//
	// Used for checking if these exist:
	$ignored = false;		// Ignored folder
	$settingsexist = false;		// Settings folder existence
	//
	//
	// List of:
	$listdirs = array();	// of folders
	$listfiles = array();	// of files
	//
	// Both give:
	$fulllist = array();	// A list of folders and files

	//
	$statlist = array();	// A list of stats
	//	$fullsettings = array();// Array with variables needed later
	// Variables
	//$settingsfolder;	// folder used for settings only if found later
	//
	//
	//////////////////////////////////////////////////////////////////////////////////////
	//
	//									CUSTOM VARIABLES
	//
	//				Use it when you want to change some preconfigurable variables
	//								DEFAULT FILE:	vars.json
	//
	// Add variables from vars.json
	if( file_exists("./vars.json"))
		extract( json_decode(file_get_contents("./vars.json")), EXTR_OVERVRITE);
	//
	//////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	//
	// Scan the directory and remove '.' and '..'
	$array = array_diff(scandir($directory), array('..', '.'));
	//
	// Check if directory is empty
	if(empty($array)) {
		echo "Directory is empty! Returning to [INSERT SHELL NAME HERE].";
		exit("\n");
	}
	//
	// Now sort all dirs and files.
	// Each dir will be added to $listdirs and each file to $listfiles.
	// Both will be summed
	foreach($array as $i => $i_value) {
		switch(filetype($directory.'/'.$array[$i])) {	// Check type of it
			case "dir":							// When dir
				$dirsum++;						// 
				if($array[$i] == $ignoredir){		// If ignoredir:
					$ignored = true;						// $ignored = true
					$diffsum++;
					break;
				}
				if($array[$i] == $settingsdir){		// If settingsfolder:
					$settingsexist = true;					// $settingsexist = true 
					$diffsum++;
					break;
				}
				$listdirs[] = $array[$i];// Add it to $listdirs array
				break;							//
			case "file":							// When file
		                $filesum++;					// sum it
				$listfiles[] = $array[$i];	// add it to array
				break;							//
		}
	}
	//
	// Return how many files and folders are found
	echo("Found ". $dirsum. " folders and ". $filesum. " files.\n");
	if($ignored == true)
		echo("1 folder was ignored.\n");
	if($ignored == false)
		echo("No folders were ignored.\n");
	//
	//
	// Check for $settingsfolder
	if( !$settingsexist ) {
		echo "You don't have any folder for settings! Create one named \"", $settingsdir, "\" .";
		exit("\n");
		}
	//
	// Else
	echo "Folder \"", $settingsdir, "\" is used for settings.\n";
	//
	//
	//Merges $listdirs and $listfiles
	$fulllist = array_merge($listdirs, $listfiles);
	//
	// Make variables array
	$fullsettings = array("directory" => $directory, "ignoredir" => $ignoredir ,"settingsdir" => $settingsdir,
				 		  "variablefile" => $variablefile, "listfile" => $listfile, "statfile" => $statfile);
	//
	// Make the statistical array
	$statlist = array("dirsum" => $dirsum, "diffsum" => $diffsum, "filesum" => $filesum);
	//
	// Now save the results
	//
	// First save the settings
	if( file_exists($directory.'/'.$settingsdir.'/'.$variablefile) ) {	// if variablefile exists
		unlink( $directory.'/'.$settingsdir.'/'.$variablefile);			 // delete it
	}
	$file = fopen($directory.'/'.$settingsdir.'/'.$variablefile, "w");	// open file
	fwrite( $file, json_encode($fullsettings));							//	write the json encoded array
	fclose($file);														// close file
	//
	// make a copy in main dir
	if( file_exists($variablefile) ) {	// if variablefile exists
		unlink( $variablefile);			 // delete it
	}
	$file = fopen($variablefile, "w");	// open file
	fwrite( $file, json_encode($fullsettings));							//	write the json encoded array
	fclose($file);

	// Save the list
	if( file_exists($directory.'/'.$settingsdir.'/'.$listfile) ) {
		unlink( $directory.'/'.$settingsdir.'/'.$listfile);
	}
	$file = fopen($directory.'/'.$settingsdir.'/'.$listfile, "w");
	fwrite( $file, json_encode($fulllist));
	fclose($file);
	//
	// Now save the stats
	if( file_exists($directory.'/'.$settingsdir.'/'.$statfile) ) {	// if variablefile exists
		unlink( $directory.'/'.$settingsdir.'/'.$statfile);			 // delete it
	}
	$file = fopen($directory.'/'.$settingsdir.'/'.$statfile, "w");	// open file
	fwrite( $file, json_encode($statlist));							//	write the json encoded array
	fclose($file);	
	//
	echo( "Generated files are located in ".$directory."/".$settingsdir.".\n");
//	function 
	//	Returns the array. Used only for bug-checking
			var_dump($fulllist);
	//		var_dump($fullsettings);


?>
