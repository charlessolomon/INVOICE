<?php
session_start();
require_once 'db.php';
$idee =$_REQUEST['BookID'];
$role=$_SESSION['role'];
if ($role=='admin'){
  include_once"../layout.php";
}elseif ($role=='Cashier') {
  include_once"../layout_cashier.php";
}elseif ($role=='Account/Invoicing') {
  include_once"../layout_invoice.php";
}elseif ($role=='employee') {
  include_once"../layout_outdoor.php";
}
	
	if($invno>=1)
	{
		$result=mysqli_query($conn,"SELECT * FROM refund_approval WHERE idee='$idee'");
				
			while($row = mysqli_fetch_array($result))
			{	
				                
				

			$invoiceno= $row['invno'];
        		$custid=$row['customerid'];
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
        		$status="Approved";
				//$gtotal=$gtotal+$total;
				

				// inserting refunded invoice into refund_approval table
				mysqli_query($conn,"INSERT INTO refundz (customerid,invno,idee,productname,qty,uprice,total,mdate,discount,netotal,payoption,userid, status) 
		 VALUES ('$custid','$invoiceno','$idee','$product','$qty','$up','$total','$mdate','$discount','$netotal','$payoption','$userid','$status')")or die(mysqli_error($conn));

			// call out total from recvno
				$resulty=mysqli_query($conn,"SELECT * FROM recvno WHERE invno='$invoiceno'");
			
				while($rowy = mysqli_fetch_array($resulty))
				{
				
				$totall=$rowy['total']-$total;
				$ntotal=$rowy['netotal']-$netotal;
				}
			// stock update
			
				$result2=mysqli_query($conn,"SELECT * FROM inventory WHERE productname='$product'");
			
				while($row2 = mysqli_fetch_array($result2))
				{
					$qty= $row2['qty'];
					$qty1= $row2['stkout'];
					$mdate2=date("Y/m/d");

					$newqty=$qty+$quantity;
					$newqty1=$qty1+$quantity;
					$productid=$product;
					$qty_move=($quantity);
					$stockout=0;
					$reason="Refund Goods";
							
		// update stock table and invoice no +1
		 
		 		mysqli_query($conn,"UPDATE inventory SET qty ='$newqty',stkin='$newqty1' WHERE productname = '$productid'")or die(mysqli_error()); 
				//echo "Saved!";

				// save to inventory movement table
				mysqli_query($conn,"INSERT INTO stock_movement (productname,qty_moved,stockout,stockin,bal,mdate,reason,userid,transno) 
		 		VALUES ('$productid','$qty_move','$quantity','$stockin','$newqty','$mdate2','$reason','$userid','$invoiceno')"); 
			}

			}
			
	}
	$result=mysqli_query($conn,"DELETE FROM refund_approval WHERE idee='$idee'");
	$result3=mysqli_query($conn,"DELETE FROM invoice WHERE id='$idee' AND productname='$productid'");
	mysqli_query($conn,"UPDATE recvno SET total ='$totall',netotal='$ntotal' WHERE invno = '$invoiceno'")or die(mysqli_error()); 
	//$result4=mysqli_query($conn,"DELETE FROM recvno WHERE invno='$invno'");

	header("Location: refund_approval.php");

?>