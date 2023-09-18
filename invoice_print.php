<?php session_start();
$invno1=$_SESSION['invno'];
$custid=$_SESSION['customerid'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sales Order</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">
                                                                                                                                                   
<script type="text/javascript" src="../salesorder/assets/jquery-1.11.3-jquery.min.js"></script>
  
<script src="../salesorder/assets/jquery-1.11.3-jquery.min.js"></script>
</head>
<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {

        $('#print_btn').click(function () {
			$("#print_btn").hide();

            var tbl = $('#tbl_print').html();

            var w = window.open('', 'Print', 'width:800,height:400');

            w.document.write(tbl);
			

            w.print();
            window.location.href = 'invoice.php';

            return false;

        });
    });
</script>
<?php 
include_once"layout.php";
require_once 'dbconfig.php';
?>
<body>
<div class="container">
<table border="0" align="center" cellspacing="0" id="tbl_print" class="table table-striped table-hover table-responsive" id="example" style="width: 800px">
  <tr id="example">
    <td colspan="5"><p><img src="../dist/pos_invoice2.png" width="900" height="140" /></p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td width="232" id="example"><p>Customer ID:<?php echo $custid; ?></p>
    <p>Invoice No:<?php echo $invno1; ?></p></td>
    <td width="270">&nbsp;</td>
    <td width="103">&nbsp;</td>
    <td colspan="2"><p></p>
    <p></p>
    <p>Date:<?php echo date("d/m/y");?></p></td>
  </tr>
  <tr>
    <td id="example"><strong>S/N</strong></td>
    <td><strong>DESCRIPTION</strong></td>
    <td><strong>QTY</strong></td>
    <td width="124"><strong>RATE</strong></td>
    <td width="155"><strong>TOTAL</strong></td>
  </tr>
  <tr id="example" style="background-color:#CCC">
    <td colspan="5">&nbsp;</td>
  </tr>
  
  <?php
	$sno=1;
        
    $totl=0;
		$tot=0;
        $stmt = $db_con->prepare("SELECT * FROM recvno INNER JOIN invoice ON invoice.invno=recvno.invno WHERE recvno.invno=$invno1");
        $stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
		?>
  
   <tr>
    <td id="example"><?php echo $sno; ?></td>
    <td><?php echo $row['productname']; ?></td>
    <td><?php echo $row['qty']; ?></td>
    <td><?php echo $row['uprice']; ?></td>
    <td><?php echo $row['total']; ?></td>
    <?php $sno=$sno+1;?>
    <?php $tot=$row['total'];?>
    <?php $totl=$totl+$tot;?>
    <?php $userid=$row['userid'];?>
   <?php }?>
    
    <p>&nbsp;</p></td>
  </tr>
  <tr>
     <td id="example">Total</td>
     <td>&nbsp;</td>
     <td><strong></strong></td>
     <td>&nbsp;</td>
     <td><strong><?php echo $totl;?></strong></td>
  </tr>
  <tr id="example">
    <td colspan="5"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><?php $userid; ?></p>
      <p>_____________________________</p>
      <p>  Management Signature</p>
      <center><p>... New Concepts new Ideology</p></center>
    <p>&nbsp;</p></td>
    
      
  </tr>
</table>
<p>
  <input type="submit" name="print_btn" id="print_btn" value="Print Invoice" />
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
<p></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>