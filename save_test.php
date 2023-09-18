<?php
session_start();
date_default_timezone_set('Africa/Lagos');
require_once 'db2.php';
require_once 'dbconfig.php';
$_SESSION['role']="admin";
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
		//$dis_option=$_POST['radio'];
		$custid2="";

		//$custid2=mysqli_real_escape_string($conn,$_POST['customerid2']);
		$custid2="choice plaza";
		$paytyp2="CREDIT";
		$creamount=10000;
		if(ISSET($paytyp2))
{
			if($paytyp2=="CREDIT" AND $creamount>=10000){
				$resultu=mysqli_query($conn,"SELECT * FROM customer WHERE custname='$custid2' AND credit_limit='Approved'")or die(mysqli_error($conn));
				//header("Location: invoice.php");

				$ty=mysqli_num_rows($resultu);
					if($ty<1){
							//echo "Credit Limit Exceeded, Contact Manager for Approval ".$ty;
					//echo "Credit limit exceeded";
							header("Location: invoice.php");

					}
					else{
							$_SESSION['msg']="";
							echo "Customer Credit limit extension approved ".$ty;
			    		}
		}
}

			?>