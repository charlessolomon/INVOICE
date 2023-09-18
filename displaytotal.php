<?php


		$msg=$netot;

$tot=0;

$initialize = "mode COM4: BAUD=9600 PARITY=N data=8 stop=1 XON=on TO=on";
		exec($initialize);
		$fp = fopen('COM4', 'w');
	if(!$fp){
		// echo"Port not accessible";
	}else{
		// echo"Port COM4 opened successfully";
	}

	$writtenBytes="";




  // $amount="This Sale : ".number_format($msg,2);


//$writtenBytes = fputs($fp, $amount);

$writtenBytes1 = fputs($fp, "\x0C");
$tot=$tot + $msg;
$amount="Total : N".number_format($tot,2);

$writtenBytes = fputs($fp, "\x1B\x51\x41"."Welcome - Kanti Plus"."\x0D");

$writtenBytes = fputs($fp, "\x1B\x51\x42".$amount. "\x0D");

fclose($fp);


//header("Location: logout.php");

?>