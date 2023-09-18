<?php
session_start();
require_once 'db2.php';
require_once 'dbconfig.php';

		$newinvno=0;
		$gtotal=0;
		$descp="";
		$qty=0;
		$qty1=0;
		$newqty=0;
		$newqty1=0;
		$productid="";
		$prod="";
		$payoption="";
		$userid="";

		// open invoice no table
		$result3=mysqli_query($conn,"SELECT * FROM invoiceno");
		while($row3 = mysqli_fetch_array($result3))
		{
        
        $invno= $row3['invno'];
		$_SESSION['invno']=$invno;

        }     

	$result=mysqli_query($conn,"SELECT * FROM inv_temp");
			
	while($row = mysqli_fetch_array($result))
	{
				$invoiceno= $invno;
        		$custid=$row['customerid'];
        		$_SESSION['customerid']=$row['customerid'];
        		$mdate=$row['mdate'];
        		$productname=$row['productname'];
        		$uprice=$row['uprice'];
        		$quantity=$row['qty'];
        		$total=$row['total'];
        		$discount=$row['discount'];
        		$netotal=$row['netotal'];
        		$userid=$row['userid'];
        		$payoption= $row['payoption'];
				//$gtotal=$gtotal+$total;
				$descp=$descp.",".$productname;

				//if (isset($_POST['submit']))
				//{	   
				//include 'db.php';
				$result5=mysqli_query($conn,"SELECT * FROM stock WHERE productname='$productname'") or die(mysqli_error($conn));
			
				while($res = mysqli_fetch_array($result5))
					{
						$costp=$res['costprice'];	

					}
									
				$newinvno=$invno+1;		

		 		mysqli_query($conn,"INSERT INTO invoice (customerid,invno,productname,qty,uprice,total,userid,discount,netotal,mdate,payoption,cp) 
		 		VALUES ('$custid','$invoiceno','$productname','$quantity','$uprice','$total','$userid','$discount','$netotal','$mdate','$payoption','$costp')"); 
		// open stock table
		 		$result2=mysqli_query($conn,"SELECT * FROM stock WHERE productname='$productname'");
			
				while($row2 = mysqli_fetch_array($result2))
				{
					$qty= $row2['qty'];
					$qty1= $row2['qty1'];

					$newqty=$qty-$quantity;
					$newqty1=$qty1+$quantity;
					$productid=$productname;
					$qty_move=(-$quantity);
					$stockin=0;
					$reason="Product Sold";
							
		// update stock table and invoice no +1
		 
		 		mysqli_query($conn,"UPDATE stock SET qty ='$newqty',qty1='$newqty1' WHERE productname = '$productid'")or die(mysqli_error()); 
				echo "Saved!";

				// save to inventory movement table
				mysqli_query($conn,"INSERT INTO stock_movement (productname,qty_moved,stockout,stockin,bal,mdate,reason,userid,transno) 
		 		VALUES ('$productid','$qty_move','$quantity','$stockin','$newqty','$mdate','$reason','$userid','$invoiceno')"); 
			}

		// update invoice no
				mysqli_query($conn,"UPDATE invoiceno SET invno =$newinvno WHERE invoiceno = 1")
				or die(mysqli_error()); 
				echo "Saved!";

		//	
			$gtotal=$gtotal+$netotal;
			$prod=$prod.",".$productid;			
				
	        }
	     // add sales summary to sales/revenue table
	       
	        	$curdate=date("Y/m/d");
	     		mysqli_query($conn,"INSERT INTO recvno (customer,invno,description,mdate,total,userid,paytype) 
		 		VALUES ('$custid','$invno','$prod','$curdate','$gtotal','$userid','$payoption')")or die(mysqli_error()); 
	     //Delete temp invoice
	     		$sql = "DELETE FROM inv_temp";

				if ($conn->query($sql) === TRUE) {
    			echo "Record deleted successfully";
					} else {
    			echo "Error deleting record: " . $conn->error;
				}

	     // end of delete   
			
			mysqli_close($conn);
			header("Location: invoice_print.php");
			
			//$_SESSION['userid']="";

			?>