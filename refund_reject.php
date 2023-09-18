<?php
session_start();
require_once 'db.php';
$id =$_REQUEST['BookID'];
	
	if($_POST)
	{
		$result=mysqli_query($conn,"SELECT * FROM refund_approval WHERE invno='$invno'");
				
			while($row = mysqli_fetch_array($result))
			{	
				                
				

				$invoiceno= $invno;
        		$custid=$row['customerid'];
        		//$_SESSION['customerid']=$row['customerid'];
        		$mdate=$row['mdate'];
        		$product=$row['productname'];
        		$up=$row['uprice'];
        		$qty=$row['qty'];
        		$total=$row['total'];
        		$discount=$row['discount'];
        		$netotal=$row['netotal'];
        		$userid=$row['userid'];
        		$payoption= $row['payoption'];
        		$status="Not Approved";
				//$gtotal=$gtotal+$total;
				

				// inserting refunded invoice into refund_approval table
				mysqli_query($conn,"INSERT INTO refund (customerid,invno,productname,qty,uprice,total,mdate,discount,netotal,payoption,userid, status) 
		 VALUES ('{$custid}','{$invoiceno}','{$product}','{$qty}','{$up}','{$total}','{$mdate}','{$discount}','{$netotal}','{$payoption}','{$userid}','{$status}')");

			}
			
	}
	$result=mysqli_query($conn,"DELETE FROM refund_approval WHERE invno='$invno'");
	header("Location: refund_approval.php");

?>