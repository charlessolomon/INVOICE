<?php
require_once('../access_control.php');
date_default_timezone_set('Africa/Lagos'); 
include 'db.php';
$userid=$_SESSION['userid'];
$_SESSION['userid']=$userid;

$res=mysqli_query($conn,"SELECT * FROM suspenseno");
			
while($row3 = mysqli_fetch_array($res))
	{
   		$invno=$row3['invno'];
    }
  $newinvno=$invno+1;

  mysqli_query($conn,"UPDATE suspenseno SET invno =$newinvno WHERE invoiceno = 1")or die(mysqli_error($conn)); 
     
$result=mysqli_query($conn,"SELECT * FROM inv_temp WHERE userid='$userid'")or die(mysqli_error($conn));
			
	while($row = mysqli_fetch_array($result))
	{
				$invoiceno= $invno;
        		$custid=$row['customerid'];
        		//$_SESSION['customerid']=$row['customerid'];
        		$mdate=$row['mdate'];
        		$productname=mysqli_real_escape_string($conn,$row['productname']);
        		$uprice=$row['uprice'];
        		$quantity=$row['qty'];
        		$total=$row['total'];
        		$discount=$row['discount'];
        		$netotal=$row['netotal'];
        		$userid=$row['userid'];
        		$payoption= $row['payoption'];
				$disc1=$disc1+$discount;
				$descp=$descp." ".$productname;
				$gtotal=$gtotal+$netotal;
				$barcode=$row['barcode'];
				$cqty=$row['cqty'];

		 	mysqli_query($conn,"INSERT INTO inv_suspend (customerid,invno,productname,qty,uprice,total,mdate,discount,netotal,payoption,userid,barcode,cqty) 
		 VALUES ('{$custid}','{$invoiceno}','{$productname}','{$quantity}','{$uprice}','{$total}','{$mdate}','{$discount}','{$netotal}','{$payoption}','{$userid}','{$barcode}','{$cqty}')")or die(mysqli_error($conn));
}
				$curdate=date("Y/m/d");
				$transid=$invno."-"."N". $gtotal;
	     		mysqli_query($conn,"INSERT INTO suspend_sales (sno,total,mdate,transid)VALUES ('$invno','$gtotal','$mdate','$transid')")or die(mysqli_error($conn)); 

				$sql = "DELETE FROM inv_temp WHERE userid='$userid'";

				if ($conn->query($sql) === TRUE) {
    			//echo "Record deleted successfully";
					} else {
    			echo "Error deleting record: " . $conn->error;
				}

	     // end of delete   
			$_SESSION['invno']=$invoiceno;
			mysqli_close($conn);
			//header("Location: invoice.php");

?>		
<script>window.location="invoice.php";</script>	 		
