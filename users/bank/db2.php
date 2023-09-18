<?php  
	$conn = mysqli_connect('localhost', 'root', 'password');

	 if (!$conn)
    {
	 die('Could not connect: ' . mysqli_error());
	}
	mysqli_select_db($conn,"pos_db");
?>
