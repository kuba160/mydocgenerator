<?php
	//This file belongs to [prgmname here]. It create a list of files
	// which will be handled by generatemenu.php
	//
	// Here are the constants
	$dirsum = 0;
	$filesum = 1;
	//
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
	foreach($array as $i => $i_value) {
		if(filetype($directory.'/'.$array[$i]) == "dir"){
			$dirsum++;
		}
                else {
                        $filesum++;
		}
	}
	//
	// Return how many files and folders are found
	echo "Found ", $dirsum, " folders and ", $filesum, " files.\n";

	// To be continued...


	//	Returns the array of directory. Used only for bug-checking
	//	var_dump($array);
	//
?>
