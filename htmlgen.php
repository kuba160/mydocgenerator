<?php
	// This file is written by kuba160

	// It will generate a html code
	// from documentation settings
	// otherwise it will generate
	// default settings located here

	// 1. Check for settings for html code
	// 2. If dosn't exist set default and transform it to a file

	// Default filetype: json

	// Functions:
	require "functions_file.php";

	// Let's go

	$settingspath = file_get_contents(".continue");
	// Get the variables
	extract( json_decode(file_get_contents($settingspath.'/'."variables.json"), true), EXTR_OVERWRITE);

	if( file_exists($settingspath."/".$htmlfile)){
		echo("HTML Code has been found, no need to generate.");
		exit("\n");
	}

	// HTML Code
	$htmlbare = // Replace later title, head and body; when not needed replace to \n
"<!DOCTYPE html>
<html lang=\"en-US\">
<head>
<title>TITLE</title>
HEAD
</head>
<body>
BODY
</body>
</html>
";

	$link = "<a href=\"LINK\">NAME</a>";

	$headmenuadd = ""; // Will be added in head of menu
	$bodymenuadd = ""; // ----||----

	$headpageadd = ""; // Will be added in head of pages
	$bodypageadd = ""; // Will be added in body of pages

	SaveJson($directory."/".$settingsdir."/".$htmlfile, array("htmlbare" => $htmlbare, "link" => $link, "headmenuadd" => $headmenuadd, "bodymenuadd" => $bodymenuadd, "headpageadd" => $headpageadd, "bodypageadd" => $bodypageadd));
	echo("Default HTML Code was generated.");
	exit("\n");