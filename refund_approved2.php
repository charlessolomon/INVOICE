<?php
error_reporting(0);
// refund approvals
//$invno=$_POST['invno'];
$id=$_REQUEST['BookID'];

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
$res=mysqli_query($conn,"SELECT * FROM refund_approval WHERE id=$id")or die(mysqli_error($conn));
				
			while($rowy = mysqli_fetch_array($res))
			{
$invno=$rowy['invno'];
$item= mysqli_real_escape_string($conn, $rowy['productname']);

}

$result=mysqli_query($conn,"SELECT * FROM Invoice WHERE invno='$invno' AND productname='$item'")or die(mysqli_error($conn));
				
while($row = mysqli_fetch_array($result))
{	
				                
				

			//$invoiceno= $invno;
        		$custid=$row['customerid'];
			$id=$row['id'];
        		//$_SESSION['customerid']=$row['customerid'];
        		$mdate=$row['mdate'];
        		$product=mysqli_real_escape_string($conn, $row['productname']);
        		$up=$row['uprice'];
        		$quantity=$row['qty'];
        		$total=$row['total'];
        		$discount=$row['discount'];
        		$netotal=$row['netotal'];
        		$userid=$row['userid'];
        		$payoption= $row['payoption'];
				//$gtotal=$gtotal+$total;
}
//start stock update
// open stock table
mysqli_query($conn,"DELETE FROM invoice WHERE invno='$invno' AND productname='$item'")or die(mysqli_error());

mysqli_query($conn,"DELETE FROM refund_approval WHERE id=$id")or die(mysqli_error()); 


		 		$result2=mysqli_query($conn,"SELECT * FROM stock WHERE productname='$item'")or die(mysqli_error($conn));
			
				while($row2 = mysqli_fetch_array($result2))
				{
					$qty= $row2['qty'];
					$qty1= $row2['stkin'];

					$newqty=$qty+$quantity;
					$newqty1=$qty1+$quantity;
					$productid=$product;
					$qty_move=($quantity);
					$stockin=0;
					$reason="Refund";
					
							
		// update stock table and invoice no +1
		 
		 		mysqli_query($conn,"UPDATE stock SET qty ='$newqty',stkin='$newqty1' WHERE productname = '$product'")or die(mysqli_error($conn)); 
				//echo "Saved!";
				$dept="Sales";
				// save to inventory movement table
				mysqli_query($conn,"INSERT INTO stock_movement (productname,qty_moved,stockout,stockin,bal,mdate,reason,userid,transno,dept) 
		 		VALUES ('$item','$qty_move','$quantity','$stockin','$newqty','$mdate','$reason','$userid','$invno','$dept')")or die(mysqli_error($conn)); 
			}
//end stock update
	

			

header("Location: refund_approval.php");
?>
