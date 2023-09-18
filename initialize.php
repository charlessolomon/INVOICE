<?php
	$initialize = "mode COM4: BAUD=9600 PARITY=N data=8 stop=1 XON=on TO=on";
		exec($initialize);
		$fp = fopen('COM4', 'w');
	if(!$fp){
		// echo"Port not accessible";
	}else{
		// echo"Port COM4 opened successfully";
	}

	$writtenBytes="";

  
$writtenBytes1 = fputs($fp, "\x0C");

$writtenBytes = fputs($fp, "\x1B\x51\x41"."Welcome - Kanti Plus"."\x0D");


fclose($fp);

?>