<?php
// refund approvals
$invno=$_POST['invno'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Refund Approval</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">
                                                                                                                                                   
<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
  
<script src="assets/jquery-1.11.3-jquery.min.js"></script>
<?php
include_once('db.php');

$result=mysqli_query($conn,"SELECT * FROM Invoice WHERE invno='$invno'");
				
			while($row = mysqli_fetch_array($result))
			{	
				                
				

			$invoiceno= $invno;
        		$custid=$row['customerid'];
			$id=$row['id'];
        		//$_SESSION['customerid']=$row['customerid'];
        		$mdate=$row['mdate'];
        		$product=mysqli_real_escape_string($conn, $row['productname']);
        		$up=$row['uprice'];
        		$qty=$row['qty'];
        		$total=$row['total'];
        		$discount=$row['discount'];
        		$netotal=$row['netotal'];
        		$userid=$row['userid'];
        		$payoption= $row['payoption'];
				//$gtotal=$gtotal+$total;

				// inserting refunded invoice into refund_approval table
				mysqli_query($conn,"INSERT INTO refund_approval (idee,customerid,invno,productname,qty,uprice,total,mdate,discount,netotal,payoption,userid) 
		 VALUES ('{$id}','{$custid}','{$invoiceno}','{$product}','{$qty}','{$up}','{$total}','{$mdate}','{$discount}','{$netotal}','{$payoption}','{$userid}')");

			}

			header("Location: refund.php");
?>