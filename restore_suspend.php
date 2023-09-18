<?php
session_start(); 
date_default_timezone_set('Africa/Lagos');      
if( strcasecmp($_SERVER['REQUEST_METHOD'],"POST") === 0) {
  $_SESSION['postdata'] = $_POST;
  header("Location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
  exit;
}
if( isset($_SESSION['postdata'])) {
  $_POST = $_SESSION['postdata'];
  unset($_SESSION['postdata']);
}
include 'db.php';
require_once('../access_control2.php');
$tot=0;
$mdate2=date('Y/m/d');
$userid=$_SESSION['userid'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">
                                                                                                                                                   
<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
  
<script src="assets/jquery-1.11.3-jquery.min.js"></script>
<title>SSuspend</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
}
</style>
<script type="text/javascript">
  function custredir() {
    window.location = "invoice.php";
  }
</script>
<script type="text/javascript">

$(document).ready(function () {

        $('#print_btn').click(function () {
			$("#print_btn").hide();


			

            window.print();
            window.location.href = 'invoice.php';

            return false;

        });
    });
</script>
</head>

<body>
<div class="container">
<form method="post" autocomplete="off">
<table cellspacing="0" style="width: 1000px" align="center" class="table table-striped table-hover table-responsive" class "table-editable">
	<tr>
    <td colspan="5"><div align="left"><img src="../dist/img/logo.png" width="100" height="100" /></div></td>
    <td colspan="6" align="right"><h2 align="right" class="form-signin-heading">Suspended Sales</h2></td>
    <td width="35">&nbsp;</td>
  	</tr>		
	<tr>
	  
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="2" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="4" align="right"><input type="submit" name="print_btn" id="print_btn" value="Return to Invoice" onclick="custredir();" /></td>
    </tr>
	 	
        <td></td>
        <td colspan="3"><input type=text id="empid" name="empid" list="browser" placeholder='Product ID'>
		  <datalist id=browser >
        	<?php $result=mysqli_query($conn,"SELECT * FROM suspend_sales WHERE mdate='$mdate2'");
			
			while($row = mysqli_fetch_array($result))
			{?>
   			<option> <?php echo $row['transid']; ?>
                <?php }?>
		</datalist> 
		<td width="16">&nbsp;</td>
		<td><input type="submit" name="submit" value="Filter" class="btn btn-info"/></td>
		
    </tr>
	
    <tr>
	   <td colspan="12" align="center"><?php
if (isset($_POST['submit']))
	{	   
	include 'db.php';
					$empid=$_POST['empid'];
					$resulty=mysqli_query($conn,"SELECT * FROM suspend_sales WHERE transid='$empid'");
					while($testy = mysqli_fetch_array($resulty))
					{

						$invno=$testy['sno'];

					}
					$mdate=date("Y/m/d");
					$result=mysqli_query($conn,"SELECT * FROM inv_suspend WHERE invno='$invno'")or die(mysqli_error($conn));
			$sql = "DELETE FROM inv_temp WHERE userid='$userid'";

				if ($conn->query($sql) === TRUE) {
    			//echo "Record deleted successfully";
					} else {
    			echo "Error deleting record: " . $conn->error;
				}
			
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

				

		 	mysqli_query($conn,"INSERT INTO inv_temp (customerid,invno,productname,qty,uprice,total,mdate,discount,netotal,payoption,userid,barcode,cqty) VALUES ('{$custid}','{$invoiceno}','{$productname}','{$quantity}','{$uprice}','{$total}','{$mdate}','{$discount}','{$netotal}','{$payoption}','{$userid}','{$barcode}','{$cqty}')")or die(mysqli_error($conn));

		 	
					
}
	header("Location: invoice.php");		
}	       
?>
		
</td>
    </tr>
    <tr>
		<td colspan="12" align="right">
	</tr>
</table>
</form>
</html>
