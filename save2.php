<?php
session_start();
date_default_timezone_set('Africa/Lagos');

require_once 'db2.php';
require_once 'dbconfig.php';
//error_reporting(0);
$custid2="";

if(ISSET($_POST['payoption'])){
	$custid2=mysqli_real_escape_string($conn,$_POST['customerid2']);
	$paytyp2=$_POST['payoption'];
	$creamount=$_POST['totl'];
	if($paytyp2=="CREDIT" AND $creamount>10000 ){
				$resultu=mysqli_query($conn,"SELECT * FROM customer WHERE custname='$custid2' AND credit_limit='Approved'")or die(mysqli_error($conn));
				//header("Location: invoicet.php");

				$ty=mysqli_num_rows($resultu);
				if($ty<1){
					$_SESSION['msg']="Credit Limit Exceeded, Contact Manager for Approval";
					//echo "Credit limit exceeded";
					header("Location: invoice.php");

				}
				if($ty>=1){
						$_SESSION['msg']="";
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
						$dis_option="";
						$costp=0;
						$disc1=0;
						$netotal=0;
						$posno=0;

		// open invoicet no table
						$result3=mysqli_query($conn,"SELECT * FROM invoiceno");
						while($row3 = mysqli_fetch_array($result3))
						{
						$invno3=$row3['invno'];		
						$_SESSION['invno']=$invno3;
						$credit=0;
						$userid=$_SESSION['userid'];
						$amtender=$_POST['amt_tender'];
						$change=$_POST['change1'];
						$posno=$_POST['posno'];
						$pos_amt=$_POST['cashpos_amt'];
						$trans_amt=$_POST['cashtransfer_amt'];

						
				   		

						}
						$newinvno=$invno+1;

						mysqli_query($conn,"UPDATE invoiceno SET invno =$newinvno WHERE invoiceno = 1")or die(mysqli_error($conn)); 


						$result=mysqli_query($conn,"SELECT * FROM inv_temp WHERE userid='$userid'");
								
						while($row = mysqli_fetch_array($result))
						{
						
		        		$custid=$row['customerid'];
		        		$_SESSION['customerid']=$row['customerid'];
		        		$mdate=$row['mdate'];
		        		$productname=mysqli_real_escape_string($conn,$row['productname']);
		        		$uprice=$row['uprice'];
		        		$quantity=$row['qty'];
		        		$total=$row['total'];
		        		$discount=$row['discount'];
		        		$netotal=$row['netotal'];
		        		$userid=$row['userid'];

		        		//delete temp invoice
		        		

		        		//

		        		$resultp=mysqli_query($conn,"SELECT * FROM users WHERE userid='$userid'") or die(mysqli_error($conn));
					
						while($resp = mysqli_fetch_array($resultp))
							{
								$invno=$resp['emp_id'].$invno3;	

							}
							$invoicetno= $invno;
							$_SESSION['invno']=$invno;
		        		$payoption= $_POST['payoption'];
						$disc1=$disc1+$discount;
						$descp=$descp." ".$productname;

						//if (isset($_POST['submit']))
						//{	   
						//include 'db.php';
						$result5=mysqli_query($conn,"SELECT * FROM stock WHERE productname='$productname'") or die(mysqli_error($conn));
					
						while($res = mysqli_fetch_array($result5))
							{
								$costp=$res['costprice'];	

							}
											
						//$newinvno=$invno+1;		

				 		mysqli_query($conn,"INSERT INTO invoicet (customerid,invno,productname,qty,uprice,total,userid,netotal,mdate,payoption,cp,discount) 
				 		VALUES ('$custid2','$invoicetno','$productname','$quantity','$uprice','$total','$userid','$netotal','$mdate','$payoption','$costp','$discount')");
				 		
				 		mysqli_query($conn,"INSERT INTO invoice (customerid,invno,productname,qty,uprice,total,userid,netotal,mdate,payoption,cp,discount) 
				 		VALUES ('$custid2','$invoicetno','$productname','$quantity','$uprice','$total','$userid','$netotal','$mdate','$payoption','$costp','$discount')");

				 		$porqty=0;
				 		$transtype="Sales invoice";	
				 		mysqli_query($conn,"INSERT INTO stockhistory (customerid,invno,productname,qty,mdate,pqty,transtype) 
				 		VALUES ('$custid2','$invoicetno','$productname','$quantity','$mdate','$porqty','$transtype')");  
				// open stock table
				 		$result2=mysqli_query($conn,"SELECT * FROM stock WHERE productname='$productname'");
					
						while($row2 = mysqli_fetch_array($result2))
						{
							$qty= $row2['qty'];
							$qty1= $row2['stkout'];

							$newqty=$qty-$quantity;
							$newqty1=$qty1+$quantity;
							$productid=mysqli_real_escape_string($conn,$productname);
							$qty_move=(-$quantity);
							$stockin=0;
							$reason="Product Sold";
						}			
				// update stock table and invoicet no +1
				 
				 		mysqli_query($conn,"UPDATE stock SET qty ='$newqty',stkout='$newqty1' WHERE productname = '$productid'")or die(mysqli_error()); 
						//echo "Saved!";

						// save to inventory movement table
						mysqli_query($conn,"INSERT INTO stock_movement (productname,qty_moved,stockout,stockin,bal,mdate,reason,userid,transno) 
				 		VALUES ('$productid','$qty_move','$quantity','$stockin','$newqty','$mdate','$reason','$userid','$invoicetno')"); 

				 		// update item qty
				 		$balz=$qty-$quantity;
						$result2=mysqli_query($conn,"SELECT * FROM stocktrans WHERE productname='$productname' AND mdate='$mdate'")or die(mysqli_error($conn));
					     $t=mysqli_num_rows($result2);
						if($t>=1){
							mysqli_query($conn,"DELETE FROM stocktrans WHERE productname = '$productname'AND mdate='$mdate'") or die(mysqli_error($conn)); 
							mysqli_query($conn,"INSERT INTO stocktrans (productname,balance,mdate,remark) 
				 		VALUES ('$productid','$balz','$mdate','$userid')")or die(mysqli_error($conn));
						}
						else{
							mysqli_query($conn,"INSERT INTO stocktrans (productname,balance,mdate,remark) 
				 		VALUES ('$productid','$balz','$mdate','$userid')")or die(mysqli_error($conn));
						}

					
						$gtotal=$gtotal+$netotal;
						$prod=$prod."/".$productid;			
						
			   	}
			   		// start receipt

			   			//$prod=$prod."/".$productid;			
						$posdiff=$gtotal-$pos_amt;
						$transferdiff=$gtotal-$trans_amt;
    	
			    		$curdate=date("Y/m/d");
			    		$debit=0;
			    		$credit=0;
			    		$descp1="Sales invoicet";
		    			$descp="Payment Receipt";
			    		mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
					 		VALUES ('$custid2','$invno','$descp1','$curdate','$gtotal','$userid','$debit')")or die(mysqli_error($conn)); 

				       
			 
					 $resultv=mysqli_query($conn,"SELECT * FROM receiptno");
			    	while($rowv = mysqli_fetch_array($resultv))
			    	{
			      		$recno=$rowv['recno'];
			    	}

			    	$newrec= $recno+1;     
			    	mysqli_query($conn,"UPDATE receiptno SET recno =$newrec WHERE label = 1")
			        or die(mysqli_error($conn)); 		
					
				if($payoption=="CASH/TRANSFER")	{
					$credit=0;
					$pay="CASH";
					$pay2="TRANSFER";
					$payy="CASH"."(".number_format($cashtrans).")"."/Transfer"."(".number_format($trans_amt).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$cashtrans}','{$pay}','{$userid}')")or die(mysqli_error($conn)); 

				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$trans_amt}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 	
				}
				if($payoption=="CASH/POS")	{
					$credit=0;
					$pay="CASH";
					$pay2="POS";
					$payy="CASH"."(".number_format($cashpos).")"."/POS"."(".number_format($pos_amt).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$cashpos}','{$pay}','{$userid}')")or die(mysqli_error($conn)); 

				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$pos_amt}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 	
				}
				if($payoption=="CASH") {
					$credit=0;
					//$pay2="CASH";="CASH"."(".
				$pay="CASH";	
				$payy="CASH"."(".number_format($gtotal).")";

				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$gtotal}','{$pay}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 

				}
				if($payoption=="POS") {
				$pay2="POS";
				$credit=0;
				$payy="POS"."(".number_format($gtotal).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$gtotal}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 

				}
				if($payoption=="TRANSFER") {
				$pay2="TRANSFER";
				$credit=0;
				$payy="TRANSFER"."(".number_format($gtotal).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$gtotal}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 

				}
				if($payoption=="COMPLIMENTARY") {
				$pay2="COMPLIMENTARY";
				$credit=0;
				$amtdue=0;
				$payy="COMPLIMENTARY"."(".number_format($gtotal).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$amtdue}','{$amtdue}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$amtdue')")or die(mysqli_error($conn)); 

				}
				if($payoption=="CREDIT") {
				$pay2="CREDIT";
				$credit=0;
				$payy="CREDIT"."(".number_format($gtotal).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$gtotal}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				
				}

			       	//	end receipt
			        	$curdate=date("Y/m/d");
					$descpp="Sales invoicet";
			     		mysqli_query($conn,"INSERT INTO recvnot (customer,invno,description,mdate,total,userid,paytype,amtender,change1,discount,netotal,transferid,paydesc) 
				 		VALUES ('$custid2','$invno','$descpp','$curdate','$gtotal','$userid','$payoption','$amtender','$change','$disc1','$netotal','$posno','$payy')")or die(mysqli_error($conn)); 

			     		mysqli_query($conn,"INSERT INTO recvno (customer,invno,description,mdate,total,userid,paytype,amtender,change1,discount,netotal,transferid,paydesc) 
				 		VALUES ('$custid2','$invno','$descpp','$curdate','$gtotal','$userid','$payoption','$amtender','$change','$disc1','$netotal','$posno','$payy')")or die(mysqli_error($conn));


			     		$sql = "DELETE FROM inv_temp WHERE userid='$userid'";

						if ($conn->query($sql) === TRUE) {
		    			//echo "Record deleted successfully";
							} else {
		    			echo "Error deleting record: " . $conn->error;
						}

			     // end of delete   
					$_SESSION['invno']=$invoicetno;
					mysqli_close($conn);
					header("Location: printout.php");

					    }
		 }
    
//if($paytyp2=="CASH" OR $paytyp2=="POS" OR $paytyp2=="TRANSFER" )
else{
		$_SESSION['msg']="";
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
		$dis_option="";
		$costp=0;
		$disc1=0;
		$netotal=0;
		$posno=0;
		//$dis_option=$_POST['radio'];

		

		// open invoicet no table
		$result3=mysqli_query($conn,"SELECT * FROM invoiceno");
		while($row3 = mysqli_fetch_array($result3))
			{
				$invno3=$row3['invno'];		
				//$_SESSION['invno']=$invno2;
				
				$userid=$_SESSION['userid'];
				$amtender=$_POST['amt_tender'];
				$change=$_POST['change1'];
				$pos_amt=$_POST['cashpos_amt'];
				$trans_amt=$_POST['cashtransfer_amt'];


				$posno=$_POST['posno'];

				

		   		

			}
				$newinvno=$invno3+1;

				mysqli_query($conn,"UPDATE invoiceno SET invno =$newinvno WHERE invoiceno = 1")or die(mysqli_error($conn)); 


	$result=mysqli_query($conn,"SELECT * FROM inv_temp WHERE userid='$userid'");
			
	while($row = mysqli_fetch_array($result))
	{
				//$invoicetno= $invno;
        		$custid=$row['customerid'];
        		$_SESSION['customerid']=$row['customerid'];
        		$mdate=$row['mdate'];
        		$productname=mysqli_real_escape_string($conn,$row['productname']);
        		$uprice=$row['uprice'];
        		$quantity=$row['qty'];
        		$total=$row['total'];
        		$discount=$row['discount'];
        		$netotal=$row['netotal'];
        		$userid=$row['userid'];
        		$payoption= $_POST['payoption'];
				$disc1=$disc1+$discount;
				$descp=$descp." ".$productname;

				

				$resultp=mysqli_query($conn,"SELECT * FROM users WHERE userid='$userid'") or die(mysqli_error($conn));
					
					while($resp = mysqli_fetch_array($resultp))
						{
							$invno=$resp['emp_id'].$invno3;	

						}
						$invoicetno= $invno;
						$_SESSION['invno']=$invno;
				//if (isset($_POST['submit']))
				//{	   
				//include 'db.php';
				$result5=mysqli_query($conn,"SELECT * FROM stock WHERE productname='$productname'") or die(mysqli_error($conn));
			
				while($res = mysqli_fetch_array($result5))
					{
						$costp=$res['costprice'];	

					}
									
				//$newinvno=$invno+1;		

		 		mysqli_query($conn,"INSERT INTO invoicet (customerid,invno,productname,qty,uprice,total,userid,netotal,mdate,payoption,cp,discount) 
		 		VALUES ('$custid2','$invoicetno','$productname','$quantity','$uprice','$total','$userid','$netotal','$mdate','$payoption','$costp','$discount')");

		 		mysqli_query($conn,"INSERT INTO invoice (customerid,invno,productname,qty,uprice,total,userid,netotal,mdate,payoption,cp,discount) 
		 		VALUES ('$custid2','$invoicetno','$productname','$quantity','$uprice','$total','$userid','$netotal','$mdate','$payoption','$costp','$discount')");

		 		$porqty=0;
		 		$transtype="Sales invoice";	
		 		mysqli_query($conn,"INSERT INTO stockhistory (customerid,invno,productname,qty,mdate,pqty,transtype) 
		 		VALUES ('$custid2','$invoicetno','$productname','$quantity','$mdate','$porqty','$transtype')");  
		// open stock table
		 		$result2=mysqli_query($conn,"SELECT * FROM stock WHERE productname='$productname'");
			
				while($row2 = mysqli_fetch_array($result2))
				{
					$qty= $row2['qty'];
					$qty1= $row2['stkout'];

					$newqty=$qty-$quantity;
					$newqty1=$qty1+$quantity;
					$productid=mysqli_real_escape_string($conn,$productname);
					$qty_move=(-$quantity);
					$stockin=0;
					$reason="Product Sold";
				}			
		// update stock table and invoicet no +1
		 
		 		mysqli_query($conn,"UPDATE stock SET qty ='$newqty',stkout='$newqty1' WHERE productname = '$productid'")or die(mysqli_error()); 
				//echo "Saved!";

				// save to inventory movement table
				mysqli_query($conn,"INSERT INTO stock_movement (productname,qty_moved,stockout,stockin,bal,mdate,reason,userid,transno) 
		 		VALUES ('$productid','$qty_move','$quantity','$stockin','$newqty','$mdate','$reason','$userid','$invoicetno')"); 

		 		// update item qty
		 		$balz=$qty-$quantity;
				$result2=mysqli_query($conn,"SELECT * FROM stocktrans WHERE productname='$productname' AND mdate='$mdate'")or die(mysqli_error($conn));
			     $t=mysqli_num_rows($result2);
				if($t>=1){
					mysqli_query($conn,"DELETE FROM stocktrans WHERE productname = '$productname'AND mdate='$mdate'") or die(mysqli_error($conn)); 
					mysqli_query($conn,"INSERT INTO stocktrans (productname,balance,mdate,remark) 
		 		VALUES ('$productid','$balz','$mdate','$userid')")or die(mysqli_error($conn));
				}
				else{
					mysqli_query($conn,"INSERT INTO stocktrans (productname,balance,mdate,remark) 
		 		VALUES ('$productid','$balz','$mdate','$userid')")or die(mysqli_error($conn));
				}
	
			$gtotal=$gtotal+$netotal;
			$prod=$prod."/".$productid;
		}
			$cashpos=$gtotal-$pos_amt;
			$cashtrans=$gtotal-$trans_amt;				

		    	
		    		$curdate=date("Y/m/d");
		    		$debit=0;
		    		$credit=0;
		    		$descp1="Sales invoicet";
		    		$descp="Payment Receipt";
		    		mysqli_query($conn,"INSERT INTO customer_ledger (customer,	description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$descp1','$curdate','$gtotal','$userid','$debit')")or die(mysqli_error($conn)); 

			       
		 
				 $resultv=mysqli_query($conn,"SELECT * FROM receiptno");
		    	while($rowv = mysqli_fetch_array($resultv))
		    	{
		      		$recno=$rowv['recno'];
		    	}

		    	$newrec= $recno+1;     
		    	mysqli_query($conn,"UPDATE receiptno SET recno =$newrec WHERE label = 1")
		        or die(mysqli_error($conn)); 		
				
				if($payoption=="CASH/TRANSFER")	{
					$credit=0;
					$pay="CASH";
					$pay2="TRANSFER";
					$payy="CASH"."(".number_format($cashtrans).")"."/Transfer"."(".number_format($trans_amt).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$cashtrans}','{$pay}','{$userid}')")or die(mysqli_error($conn)); 

				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$trans_amt}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 	
				}
				if($payoption=="CASH/POS")	{
					$credit=0;
					$pay="CASH";
					$pay2="POS";
					$payy="CASH"."(".number_format($cashpos).")"."/POS"."(".number_format($pos_amt).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$cashpos}','{$pay}','{$userid}')")or die(mysqli_error($conn)); 

				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$pos_amt}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 	
				}
				if($payoption=="CASH") {
					$credit=0;
					//$pay2="CASH";="CASH"."(".
				$pay="CASH";	
				$payy="CASH"."(".number_format($gtotal).")";

				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$gtotal}','{$pay}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 

				}
				if($payoption=="POS") {
				$pay2="POS";
				$credit=0;
				$payy="POS"."(".number_format($gtotal).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$gtotal}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 

				}
				if($payoption=="TRANSFER") {
				$pay2="TRANSFER";
				$credit=0;
				$payy="TRANSFER"."(".number_format($gtotal).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$gtotal}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$gtotal')")or die(mysqli_error($conn)); 

				}
				if($payoption=="COMPLIMENTARY") {
				$pay2="COMPLIMENTARY";
				$credit=0;
				$amtdue=0;
				$payy="COMPLIMENTARY"."(".number_format($gtotal).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$amtdue}','{$amtdue}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				mysqli_query($conn,"INSERT INTO customer_ledger (customer,invno,description,mdate,credit,userid,debit) 
				 		VALUES ('$custid2','$invno','$descp','$curdate','$credit','$userid','$amtdue')")or die(mysqli_error($conn)); 

				}
				if($payoption=="CREDIT") {
				$pay2="CREDIT";
				$credit=0;
				$payy="CREDIT"."(".number_format($gtotal).")";
				mysqli_query($conn,"INSERT INTO receipt (invno,recno,customerid,mdate,pay_desc,total,amount_paid,payment_type,userid) VALUES ('{$invno}','{$recno}','{$custid2}','{$curdate}','{$descp}','{$gtotal}','{$gtotal}','{$pay2}','{$userid}')")or die(mysqli_error($conn));

				
				}


			// end receipt		
				
	   

	        	$curdate=date("Y/m/d");
	     		mysqli_query($conn,"INSERT INTO recvnot (customer,invno,description,mdate,total,userid,paytype,amtender,change1,discount,netotal,transferid,paydesc) 
		 		VALUES ('$custid2','$invno','$descp','$curdate','$gtotal','$userid','$payoption','$amtender','$change','$disc1','$netotal','$posno','$payy')")or die(mysqli_error($conn)); 

	     		mysqli_query($conn,"INSERT INTO recvno (customer,invno,description,mdate,total,userid,paytype,amtender,change1,discount,netotal,transferid,paydesc) 
		 		VALUES ('$custid2','$invno','$descp','$curdate','$gtotal','$userid','$payoption','$amtender','$change','$disc1','$netotal','$posno','$payy')")or die(mysqli_error($conn));

	     //Delete temp invoicet
	     		$sql = "DELETE FROM inv_temp WHERE userid='$userid'";

				if ($conn->query($sql) === TRUE) {
    			//echo "Record deleted successfully";
					} else {
    			echo "Error deleting record: " . $conn->error;
				}

	     // end of delete   
			$_SESSION['invno']=$invno;
			mysqli_close($conn);
			header("Location: printout.php");
			
			//$_SESSION['userid']="";
		}
}

			?>