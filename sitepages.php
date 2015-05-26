<?php
	// This file belongs to ...... project
	// It needs a list with all bbcode files
	// Every file on that list will be transformed into html in other folder

	$settingspath = file_get_contents(".continue");
	// Get the variables
	extract( json_decode(file_get_contents($settingspath.'/'."variables.json"), true), EXTR_OVERWRITE);

	// Get the array