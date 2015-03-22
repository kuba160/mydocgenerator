<?php

	$directory = "./doc/";	// Directory of doc (cant be ./)


	$array = array_diff(scandir($directory), array('..', '.'));
	// scans for files in directory withoout dots

	if(empty($array)) {
		echo "Directory is empty! Returning to [INSERT SHELL NAME HERE].";
		exit("\n");
	}
	// returns when doc is empty

	$dirsum = 0;
	$filesum = 0;
	// 0ing

	foreach($array as $i => $i_value) {
		if(filetype($directory.'/'.$array[$i]) == "dir"){
			$dirsum++;
		}
                else {
                        $filesum++;
		}
	}
	// count foles and dirs
	echo "Found ", $dirsum, " folders and ", $filesum, " files.\n";



//	var_dump($array);
?>
