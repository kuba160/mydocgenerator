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
	// Generated documentation															//
	$generateddir = "./generated";														//
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
//	// Main dir list																	//
	$listfile =		 "list.json";														//
//	// Statistical data of documentation (will be expanded)								//
	$statfile = 	 "stats.json";														//
	// File with Directory variable														//
	$continuefile =  ".continue";		// Tells where the settings are					//
	//																					//
	//////////////////////////////////////////////////////////////////////////////////////
	//
	//									  FUNCTIONS
	//
	//
	//	Handle files
	require  'functions_file.php';
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
	//
	// Check if directory is empty
	if(empty($array)) {
		echo "Directory is empty! Returning to [INSERT SHELL NAME HERE].";
		exit("\n");
	}
	//
	echo("\nFolder with source documentation: ".$directory."\n\n");
	//
	echo("Folder with generated documentation: ".$generateddir."\n\n\n");
	//
	// Check for $settingsdir
	if( !file_exists($directory.'/'.$settingsdir) ) {
		echo "You don't have any folder for settings! Create one named \"", $settingsdir, "\" .";
		exit("\n");
		}
	// Else
//	echo "Folder \"", $settingsdir, "\" is used for settings.\n";
	//
	//
	//
	// Make variables array
	$fullsettings = array(	"directory"		=> $directory,
							"generateddir"		=> $generateddir,
							"ignoredir" 	=> $ignoredir,
							"settingsdir" 	=> $settingsdir,
				 			"variablefile" 	=> $variablefile,
				 			"listfile" 		=> $listfile,
				 			"statfile" 		=> $statfile,
				 			"continuefile" 	=> $continuefile );

	


	// Save everything we need:
	//
	// 	- Continuefile (Tells where to find directory/settingsdir)
	SaveFile($continuefile, $directory.'/'.$settingsdir);
	//	- Settings
	SaveJson($directory.'/'.$settingsdir.'/'.$variablefile, $fullsettings);
	//
	//	- We don't have any stats, so just create it
	touch($directory.'/'.$settingsdir.'/'.$statfile);

	echo( "Generated settings are located in ".$directory."/".$settingsdir.".\n");
	echo( "File ./".$continuefile." was modified.\n")

	//	Returns the array. Used only for bug-checking
	//		var_dump($fulllist);
	//		var_dump($fullsettings);


?>
