<?php 
session_start();

include 'db.php';
//include_once"layout.php";
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
<link href="assets/tables.css" rel="stylesheet" type="text/css">                                                                                                                                                   
<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
  
<script src="assets/jquery-1.11.3-jquery.min.js"></script>
<title>Refund Approval</title>

</head>				
			<table cellspacing="0" style="width: 900px" align="center" id="example" class="table table-striped table-hover table-responsive" class="table-editable">
	          <center><thead>
	          <tr>
    		  <td colspan="5"><div align="left"><img src="../dist/logo.png" width="65" height="65" /></div></td>
    		  <td colspan="6" align="right"><h2 align="right" class="form-signin-heading">Refund Approval</h2></td>
    		  <td width="35">&nbsp;</td>
  			  </tr>		
<?php
				echo "<tr>";
echo"<td><font color='black'>"."Serial No"."</font></td>";	

				echo"<td><font color='black'>"."Invoice No"."</font></td>";	
				echo"<td><font color='black'>"."Productname"."</font></td>";
				echo"<td><font color='black'>"."Qty"."</font></td>";
				echo"<td><font color='black'>"."Rate"."</font></td>";
				echo"<td><font color='black'>"."Total"."</font></td>";
				echo"<td><font color='black'>"."Discount"."</font></td>";
				echo"<td><font color='black'>"."Net Total"."</font></td>";
				echo"<td><font color='black'>"."Reject"."</font></td>";
				echo"<td><font color='black'>"."Approved"."</font></td>";
				echo"<td>"."</td";
				echo "</tr>";
				?>
			</thead></center>	
			<?php
				$result=mysqli_query($conn,"SELECT * FROM refund_approval");
			
				while($test = mysqli_fetch_array($result))
			{
				
				
			
				$id = $test['id'];	
				echo "<tr>";
echo"<td><font color='black'>" .$test['id']."</font></td>";
				echo"<td><font color='black'>" .$test['invno']."</font></td>";	
				echo"<td><font color='black'>" .$test['productname']."</font></td>";
				echo"<td><font color='black'>". $test['qty']. "</font></td>";
				echo"<td><font color='black'>". $test['uprice']. "</font></td>";
				echo"<td><font color='black'>". $test['total']. "</font></td>";
				echo"<td><font color='black'>". $test['discount']. "</font></td>";
				echo"<td><font color='black'>". $test['netotal']. "</font></td>";
				echo"<td> <a href ='refund_reject.php?BookID=$id'>Reject</a>";
				echo"<td> <a href ='refund_approved2.php?BookID=$id'>Approved</a>";
				echo"<td>"."</td";
				echo "</tr>";
				}
				?>

			</table>
			


				
				
			

		
</body>
</html>