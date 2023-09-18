<?php
require("db.php");
error_reporting(0);
require_once("layout.php");
$id =$_REQUEST['BookID'];

$result = mysqli_query($conn,"SELECT * FROM inv_temp WHERE id  = '$id'");
$test = mysqli_fetch_array($result);
if (!$result) 
		{
		die("Error: Data not found..");
		}
				$product1=$test['productname'] ;
				$quantity1= $test['qty'] ;	
				$rate1= $test['uprice'] ;	
				//$total1= $test['netotal'] ;
				$net=$test['netotal'] ;	
				$disc=$test['discount'] ;	
				
				

if(isset($_POST['save']))
{	
	$product_save = $_POST['product'];
	$quantity_save = $_POST['quantity'];
	$rate_save = $_POST['rate'];
	$total_save =$_POST['quantity']*$_POST['rate'];
	$net_save=$total_save-$disc;
	
	mysqli_query($conn,"UPDATE inv_temp SET productname ='$product_save', qty ='$quantity_save',uprice='$rate_save', total='$total_save',netotal='$save_net' WHERE id = '$id'")
				or die(mysqli_error()); 
	//echo "Saved!";
	
	header("Location: invoice.php");			
}
mysqli_close($conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Invoice update</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> 
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
}
</style>
</head>

<body>
<form method="post">
<table align="center" cellspacing="0" style="width: 700px" id="example" class="table table-striped table-hover table-responsive">
	<tr>
		<td>Product:</td>
		<td><input name="product" type="text" value="<?php echo $product1 ?>" size="70"/></td>
	</tr>
	<tr>
		<td>Quantity:</td>
		<td><input name="quantity" type="text" value="<?php echo $quantity1 ?>" size="68"/></td>
	</tr>
	<tr>
		<td></td>
		<td><input name="rate" type="hidden" value="<?php echo $rate1 ?>" size="68"/></td>
	</tr>
	
	<tr>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="save" value="save" /></td>
  </tr>
	<tr>
		<td colspan="2" align="center"><a href="invoice.php">&lt;Return to Menu&gt;</a></td>
	</tr>
</table>

</body>
</html>