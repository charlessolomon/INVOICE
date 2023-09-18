<?php
session_start();




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
include_once"layout.php";
$tot=0;
$tot=0;
$dis=0;
$netot=0;
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
<link href="assets/tables.css" rel="stylesheet" type="text/css">                                                                                                                                                   
<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>  
<script src="assets/jquery-1.11.3-jquery.min.js"></script>
<title>Sales Invoice</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
}
</style>
<script type="text/javascript">
  function redir() {
    window.location = "save2.php";
  }
</script>

<script>
function calc() {
      var txtFirstNumberValue = document.getElementById('qty').value;
      var txtSecondNumberValue = document.getElementById('up').value;    
      
      var result = (txtFirstNumberValue * txtSecondNumberValue);  
    document.getElementById('total').value = result;
      
}
function calc2() {
	var totalvalue = document.getElementById('total').value;
    var discountvalue = document.getElementById('discount').value;    
      
      var result = (totalvalue - discountvalue);  
    document.getElementById('netotal').value = result;
      
}

</script>
<script type="text/javascript">
  function custredir() {
    window.location = "//localhost/eegoja_gas/customer/index.php";
  }
</script>

<script>
      $(document).ready(function(){
          var qty=$('#qty').val();
          $("#qty").change (function(){
              qty=$('#qty').val();
              $("#up").load("pricelevel_data.php",{Nqty:qty});
            });
        });
  </script>
</head>

<body>
<form method="post">
<table cellspacing="0" style="width: 1000px" align="center" id="example" background="../dist/EEGOJA_INVOICE.gif">
<?php $res=mysqli_query($conn,"SELECT * FROM invoiceno");
			
while($row3 = mysqli_fetch_array($res))
	{
   		$invno=$row3['invno'];
                }
     ?>
	<tr>
	  <td colspan="3" align="left"><h2 align="left" class="form-signin-heading">Invoice</h2></td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="2" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="2" align="center"><input type="button" value="Save/Print" onclick="redir();" /></td>
	  <td colspan="2" align="center"><input type="button" value="Save/Print A4" onclick="redir();" /></td>
    </tr>
	<tr>
	  <td width="2" align="center">No</td>
	  <td width="20" align="center">&nbsp;</td>
	  <td width="73" align="center"><label for="inv"></label>
      <input name="inv" type="text" id="inv" size="6" value="<?php echo $invno;?>" /></td>
	  <td width="85" align="center">&nbsp;</td>
	  <td width="3" align="center">&nbsp;</td>
	  <td width="1" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td width="50" align="center">&nbsp;</td>
      <td width="50" align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
	  <td align="right"><input type=text id="customerid" name="customerid" list="browsers" placeholder='Customer ID' >
	  	<datalist id="browsers">
        <?php $result=mysqli_query($conn,"SELECT * FROM customer");
			
			while($row = mysqli_fetch_array($result))
			{?>
   			<option> <?php echo $row['custname']." ".$row['phone']; ?>
                <?php }?>
		</datalist></td>
			  
	  <td align="right"><input type="button" value="+" onclick="custredir();"></td>
     </tr>
     <tr>
     <tr>
	  <td width="2" align="center">&nbsp;</td>
	  <td width="20" align="center">&nbsp;</td>
	  <td width="73" align="center">&nbsp;</td>
	  <td width="85" align="center">&nbsp;</td>
	  <td width="3" align="center">&nbsp;</td>
	  <td width="1" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td width="76" align="center">&nbsp;</td>
	  <td align="center">Pay Type <select name="payoption" id="payoption">
  		<option>CASH</option>
  		<option>POS/CARD</option>
  		<option>E-TRANSFER</option>
		</select></td>
	  <td align="center">&nbsp;</td>		  
     </tr>
	 <tr>
		<td colspan="3"><input type=text id="product" name="product" list="browser" placeholder='Product'>
		  <datalist id=browser >
        	<?php $result2=mysqli_query($conn,"SELECT * FROM stock");
			
			while($row2 = mysqli_fetch_array($result2))
			{?>
   			<option> <?php echo $row2['productname']; ?>
                <?php }?>
		</datalist>        
		<td colspan="2">&nbsp;</td>
		<td width="36">&nbsp;</td>
		<td width="28"><input name="qty" type="value" id="qty" size="4" placeholder='Qty' onkeyup="calc()"/></td>
		
		<td width="67"><input name="up" type="value" id="up" size="6" placeholder='Rate' onkeyup="calc()"/></td>
		<td width="182"><input id="total" type="text" name="total" size="6" onchange="calc2()" /></td>
		<td width="182"><input id="discount" type="text" name="discount" size="6" placeholder='Discount' onkeyup="calc2()" /></td>
		<td width="182"><input id="netotal" type="text" name="netotal" size="6" /></td>
        <td><input type="submit" name="submit" value="+" /></td>
		<td>&nbsp;</td>
        <td>&nbsp;</td>
		
    </tr>
	
    <tr>
	   <td colspan="12" align="center"><?php
if (isset($_POST['submit']))
	{	   
	include 'db.php';
					$customerid=$_POST['customerid'];
					$inv=$_POST['inv'];
			 		$product=$_POST['product'];
					$qty= $_POST['qty'];
					$up= $_POST['up'];	
					$total= $_POST['total'];
					$discount=$_POST['discount'];
					$netotal=$_POST['netotal'];
					$mdate=date("Y/m/d");
					$payoption=$_POST['payoption'];
					$userid=$_SESSION['userid'];
																
		 //mysqli_query($conn,"INSERT INTO inv_temp (customerid,invno,productname,qty,uprice,total,mdate,discount,netotal) 
		 //VALUES ('$customerid','$inv','$product','$qty','$up','$total',$mdate,$discount,$netotal)")or mysqli_connect_error($conn);
	        
	
					//$customerid=$_POST['customerid'];
					//$inv=$_POST['inv'];
			 		//$product=$_POST['product'];
					//$qty= $_POST['qty'];
					//$up= $_POST['up'];	
					//$total= $_POST['total'];
					//$discount=$_POST['discount'];
					//$netotal=$_POST['netotal'];
					//$mdate=date("Y/m/d");
																
		 mysqli_query($conn,"INSERT INTO inv_temp (customerid,invno,productname,qty,uprice,total,mdate,discount,netotal,payoption,userid) 
		 VALUES ('{$customerid}','{$inv}','{$product}','{$qty}','{$up}','{$total}','{$mdate}','{$discount}','{$netotal}','{$payoption}','{$userid}')");
	        }
?></td>
    </tr>
    
</table>
</form>
<table cellspacing="0" style="width: 1000px" border="1" align="center" id="example" class="table table-striped table-hover table-responsive" class="table-editable">

			<?php
			include("db.php");
			echo "<tr>";	
				echo"<td><font color='black'>"."Productname"."</font></td>";
				echo"<td><font color='black'>"."Qty"."</font></td>";
				echo"<td><font color='black'>"."Rate"."</font></td>";
				echo"<td><font color='black'>"."Total"."</font></td>";
				echo"<td><font color='black'>"."Discount"."</font></td>";
				echo"<td><font color='black'>"."Net Total"."</font></td>";
				echo"<td><font color='black'>"."Modify"."</font></td>";
				echo"<td><font color='black'>"."Delete"."</font></td>";
				echo"<td>"."</td";
				echo "</tr>";
				?>
		<tr>
		
		<td><input type=text id="product" name="product" list="browser" placeholder='Product'>
		  <datalist id=browser >
        	<?php $result2=mysqli_query($conn,"SELECT * FROM stock");
			
			while($row2 = mysqli_fetch_array($result2))
			{?>
   			<option> <?php echo $row2['productname']; ?>
                <?php }?>
		</datalist></option></td>       
		<td><input name="qty" type="value" id="qty" size="4" placeholder='Qty' onkeyup="calc()"/></td>
		<td><input name="up" type="value" id="up" size="6" placeholder='Rate' onkeyup="calc()"/></td>
		<td><input id="total" type="text" name="total" size="6" /></td>
        <td><input type="submit" name="submit" value="+" /></td>
       </tr>
		<?php
				
			$result=mysqli_query($conn,"SELECT * FROM inv_temp");
			
			while($test = mysqli_fetch_array($result))
			{
				$id = $test['id'];	
				echo "<tr>";	
				echo"<td><font color='black'>" .$test['productname']."</font></td>";
				echo"<td><font color='black'>". $test['qty']. "</font></td>";
				echo"<td><font color='black'>". $test['uprice']. "</font></td>";
				echo"<td><font color='black'>". $test['total']. "</font></td>";
				echo"<td><font color='black'>". $test['discount']. "</font></td>";
				echo"<td><font color='black'>". $test['netotal']. "</font></td>";
				echo"<td> <a href ='view.php?BookID=$id'>Edit</a>";
				echo"<td> <a href ='del.php?BookID=$id'>Delete</a>";
				echo"<td>"."</td";
				echo "</tr>";
				$tot=$tot+$test['total'];
				$dis=$dis+$test['discount'];
				$netot=$netot+$test['netotal'];
			}
			echo "<tr>";
			echo "<td><font color='black'>"."TOTAL"."</font></td>";
			echo "<td>".""."</td>";
			echo "<td>".""."</td>";
			echo "<td>".$tot."</td>";
			echo "<td>".$dis."</td>";
			echo "<td>".$netot."</td>";
			echo "<td>".""."</td>";
			echo "<td>".""."</td>";
			echo "<td>".""."</td>";
			?>
			<table cellspacing="0" style="width: 1000px" align="center" id="example" class="table table-striped table-hover table-responsive">
            <?php
            echo "<tr>";
			echo "<td>"."</td>";
			echo "<td>".""."</td>";
			echo "<td>".""."</td>";
			echo "<td>"."VAT"."</td>";
			echo "<td>".$dis."</td>";
			echo "<td>"."Total"."</td>";
			echo "<td>".""."</td>";
			echo "<td>".""."</td>";
			echo "<td>".""."</td>";
			?>
            <tr>
            	<td></td>
                <td></td>
                <td>&nbsp;</td>
	  			<td>&nbsp;</td>
	  			<td>&nbsp;</td>
	  			<td>&nbsp;</td>
	  			<td>&nbsp;</td>
	  			<td align="center">&nbsp;</td>
	  			<td colspan="2" align="center"><input type="button" value="Save/Print" onclick="redir();" /></td>
	  			<td colspan="2" align="center"><input type="button" value="Save/Print A4" onclick="redir();" /></td>
    		</tr>
            </table>
                
            <?php
			mysqli_close($conn);
		?>
            
</table>
</body>
</html>
