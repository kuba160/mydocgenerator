<?php

	$directory = "./doc/";	// Directory of doc (cant be ./)


	$array = array_diff(scandir($directory), array('..', '.'));
	// scans for files in directory withoout dots

	if(empty($array)) {
		echo "Directory is empty! Returning to [INSERT SHELL NAME HERE].";
		exit("\n");
	}
	var_dump($array);
?>
