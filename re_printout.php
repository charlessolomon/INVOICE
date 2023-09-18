<?php session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Receipt Re-Print</title>
<?php
require_once './dbconfig.php';

$invno1=$_POST['invno'];
//$custid=$_SESSION['customerid'];
$stmt = $db_con->prepare("SELECT * FROM recvno WHERE recvno.invno=$invno1");
        $stmt->execute();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    
    $custid= $row['customer'];
    $mdate= $row['mdate'];
  }

//$userid=$_SESSION['userid'];
?>
<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
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
  <div style="background-color:blue;padding:1px;display:table;">

<center><table width="100" border="0"  id="tbl_print" style="font-family:Tahoma, Geneva, sans-serif", bgcolor="#CCCCCC" style="font-size:7px ">
  <tr>
    <td colspan="5"><div align="center"><img src="../dist/logo_receipt.png" width="165" height="65" /></div></td>
  </tr>
  <tr>
    <td colspan="6"><div align="center">
      <h2><strong>Sales Receipt</strong></h2>    
      <div>Kastina Road Kaduna</div>
      
      <div>Phone:08035394484</div>
      <p align="right">No:<?php echo $invno1; ?></p>
      <div align="left">ID:<?php echo $custid; ?></div>
      <div align="left">Date:<?php echo $mdate;?></div>
      <div>========================</div>
    </div>    </tr>
  <tr>
    <td><strong>S/No.</strong></td>
    <td><strong>Desc</strong></td>
    <td><strong>Qty</strong></td>
    <td><strong>Unit</strong></td>
    <td><strong>Total</strong></td>
  </tr>
  
   <?php
	$sno=1;
        
        $tot=0;
 
        $stmt = $db_con->prepare("SELECT * FROM invoice WHERE invno=$invno1");
        $stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
		?>
  <tr>
    <td><?php echo $sno; ?></td>
    <td><?php echo $row['productname']; ?></td>
    <td><?php echo $row['qty']; ?></td>
    <td><?php echo $row['uprice']; ?></td>
    <td><?php echo $row['total']; ?></td>
    <?php $sno=$sno+1;?>
    <?php $tot=$tot+$row['total'];?>
    <?php $userid=$row['userid'];?>
   <?php }?>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Total</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo $tot;?></td>
  </tr>
  <tr>
    <td colspan="5"><div align="center">
      <hr />
      <p>Thanks for your Patronage</p>
    </div></td>
  </tr>
  <tr>
    <td colspan="5"><div align="center">Cashier:<?php echo $userid;?></div></td>
  </tr>
  <tr>
    <td colspan="5"><div align="center">Goods purchased in good condition are not refundable</div></td>
  </tr>
</table>
</div>
<div >
<p>
  <input type="submit" name="print_btn" id="print_btn" value="Print Receipt" />
</p></div>
</body>
</html>