<?php
  include("db.php");  

	$id =$_REQUEST['BookID'];
	
	
	// sending query
	mysqli_query($conn,"DELETE FROM inv_temp WHERE id = '$id'")
	or die(mysqli_error());  	
	
	header("Location: invoice.php");
?>