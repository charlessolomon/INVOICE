<?php

$fp = fopen('COM4', 'w');
	if(!$fp){
		// echo"Port not accessible";
	}else{
		// echo"Port COM4 opened successfully";
	}

	$writtenBytes="";

  
$writtenBytes1 = fputs($fp, "\x0C");


fclose($fp);

?>