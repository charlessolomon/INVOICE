<?php
session_start();
include("db2.php");
include("dbconfig.php");

//error_reporting(0); 


$id=$_SESSION['pid'];
$rprice=$_SESSION['uprice'];
$sname=$_SESSION['sname'];





if(isset($_POST['send2'])){

	//$cardno = $_POST['cardno'];
   // $name = $_POST['name'];
	

	$nprice=$_POST['nprice'];



     //$query=mysqli_query($conn,"insert into vitals_tb (cardno,name,bp,height,weight,pulse,sugar,temperature) values ('$cardno','$sname','$bp','$height','$weight','$pulse','$sugar','$temp')");

     $query= mysqli_query($conn, "UPDATE stock SET unitprice='$nprice', reviewedprice='$rprice' WHERE productname='$id'");

     //$query2= mysqli_query($conn, "DELETE FROM nurse_tb WHERE cardno='$cardno'");


     	

		if($query)
		{
			echo "Successfully updated";
		}
		else{
			echo "Query Problem";
		}


     //$sql= "UPDATE doc_queue SET status='Seen' WHERE cardno='$cardno'";
           // $stmt= $db_con->prepare($sql);
            //$stmt->execute();

     header('Location: price_review.php');

}



?>

