<?php

	

	function SaveFile($pathtofile, $content){
		if( file_exists($pathtofile) )
		{
			unlink( $pathtofile);			
		}
		$file = fopen($pathtofile, "w");
		fwrite( $file, $content);
		fclose($file);	
		return 0;
	}
	function SaveJson($pathtofile, $content){
		if( file_exists($pathtofile) )
		{ 
			unlink( $pathtofile);		
		}	
		$file = fopen($pathtofile, "w");
		fwrite( $file, json_encode($content) );
		fclose($file);	
		return 0;
	}


?>