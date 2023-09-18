<?php
error_reporting(0);
session_start();
date_default_timezone_set('Africa/Lagos'); 
$mdate2=date('Y/m/d');
$creditlimit="";


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
include_once 'initialize.php';

//include_once"layout.php";
require_once('../access_control.php');
$cqty=0;
$tot=0;
$dis=0;
$netot=0;
$vat=0;
$totz=0;
$net=0;
$sp=0;
$item2="";
$userid=$_SESSION['userid'];
$creditlimit=$_SESSION['msg'];
$sql2 = "DELETE FROM invoicet WHERE userid='$userid'";

if ($conn->query($sql2) === TRUE) {
    //echo "Record deleted successfully";
	} 
$sql3 = "DELETE FROM recvnot WHERE userid='$userid'";

if ($conn->query($sql3) === TRUE) {
    //echo "Record deleted successfully";
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
<script type="text/javascript">
  function redir2() {
    window.location = "save3.php";
  }
</script>
<script type="text/javascript">
  function suspense() {
    window.location = "suspense_pro.php";
  }
</script>
<script type="text/javascript">
  function redir3() {
    window.location = "waybill.php";
  }
</script>

<script type="text/javascript">
  function restore_sus() {
    window.location = "restore_suspend.php";
  }
</script>

<script>
function calc() {
      var txtFirstNumberValue = document.getElementById('amt_tender').value;
      var txtSecondNumberValue = document.getElementById('totl').value;    
      
      var result = (txtFirstNumberValue - txtSecondNumberValue);

       
    document.getElementById('change1').value = result;
      
}
</script>


</script>
<script type="text/javascript">
  function custredir() {
    window.location = "//localhost/kanti_plus/customer/index.php";
  }
</script>

<script>
$(window).on("load", onPageLoad);
 
function onPageLoad() {
	initListeners();
	restoreSavedValues();
}
 
// Add all listeners in this method
function initListeners() {
 
	$("#browsers").on("change", function() {
		var value = $(this).val();
		localStorage.setItem("browsers", value);
	});
 
	// Add other dropdowns and other inputs that you want to listen ...
 
}
 
// Restore all saved values in this method
function restoreSavedValues() {
 
	$("#your_dropdown").on("change", function() {
		var value = $(this).val();
		localStorage.setItem("browsers", value);
	});
 
	// Restore other values that were previously stored here ...
 
}
</script>
</head>

<body>
<form method="post" id="fsales">
<table cellspacing="0" style="width: 1000px" align="center" id="example" background="../dist/EEGOJA_INVOICE.gif">
<?php $res=mysqli_query($conn,"SELECT * FROM invoiceno");
			
while($row3 = mysqli_fetch_array($res))
	{
   		$invno=$row3['invno'];
                }
     ?>
     <tr>
	  <td colspan="3" align="left"></td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="2" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="2" align="center"></td>
	  <td colspan="2" align="center"></td>
    </tr>


    <tr>
	  <td colspan="14" align="center"><img src="../dist/invoice_header.png" width="1000" height="109" /></td>
    </tr>
     <tr>
	  <td colspan="14" align="center"><?php echo $creditlimit;?></td>
	  
    </tr>
     <tr>
	  <td colspan="3" align="left"></td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="2" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="2" align="center"></td>
	  <td colspan="2" align="center"></td>
    </tr>
	    
	<tr>
	  <td align="center">| No</td>
	  <td align="center">&nbsp; </td>
	  <form>
	  <td><input type=text id="suspenseid" name="suspenseid" list="brows" placeholder='Suspended id'>
	  	<datalist id="brows">
        <?php $result=mysqli_query($conn,"SELECT * FROM suspend_sales WHERE mdate='$mdate2'");
			
			while($row = mysqli_fetch_array($result))
			{?>
   			<option> <?php echo $row['transid']; ?>
                <?php }?>
		</datalist><input type="button" value="Restore" onclick="restore_sus();"</td>
	  </form>	
	  <td width="85" align="center"></td>
	  <td width="3" align="center">&nbsp;</td>
	  <td width="36" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="left">&nbsp;</td>
	  <td align="left">&nbsp;</td>
	  <td align="left">&nbsp;</td>
			  
	  <td align="right"><input type="button" value="+ Add Customer" onclick="custredir();"><td> 
     </tr>
     <tr>
	  <td align="center">|Inv.No</td>
	  <td align="center">&nbsp;</td>
	  <td><input type="text" id="inv" name="inv" value="<?php echo $invno;?>"></td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
	  <td width="200" align="center"></td>
			  
	  <td align="right"><input type="button" value="Suspend Transaction" onclick="suspense();"><td>		  
     </tr>
	 <tr>
	  <td colspan="3" align="left"></td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="2" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td colspan="2" align="center"></td>
	  <td colspan="2" align="center"></td>
    </tr>
	
    <tr>
	   <td colspan="12" align="center"><?php
	   $inv=0;
	   $w=0;
	   //$w=$_POST['inv'];
	   $totall=0;
	   $payoption2="";
	   
if (isset($_POST['submit']))
	{	   
	include 'db.php';
	if($userid==""){
		exit;
		//header("Location: //192.168.1.3/kanti_plus/index.php");
	}
	$discount=0;
	$inv=$_POST['inv'];

	$item=mysqli_real_escape_string($conn, $_POST['product']);
	$qtty=$_POST['qty'];
	$bcode="";
	$payoption=$_POST['payoption'];

	if($w==0){
				 mysqli_query($conn,"UPDATE paycat SET description ='$payoption', invno='$inv' WHERE label = 'yess'")or die(mysqli_error($conn)); 
				//echo "Saved!";
	}
	//		$dis=$_POST['discount'];
	//		if ($dis=='7%'){
	//			$dis2=7/100;
	//		}
	//		elseif ($dis=='10%'){
	//			$dis2=10/100;
	//		}
	//		elseif ($dis=='3%'){
	//			$dis2=3/100;
	//		}
	//		elseif ($dis='0%'){
	//			$dis2=0;
	//		}
		$barcode=$_POST['barcode'];	
		$cqty=0;	
			// open inventory table pick selling price//
			if($_POST['barcode']==""){
					$resultz=mysqli_query($conn,"SELECT * FROM stock WHERE productname='$item'");
					//$qte=$qtty;

			
			}
			elseif($_POST['product']=="") {
					
					$resultz=mysqli_query($conn,"SELECT productname, unitprice,cat,qty FROM stock WHERE FIND_IN_SET('$barcode',barcode)>0 ");
					
			}
				$qte=$qtty;
				while($test2= mysqli_fetch_array($resultz))
					{
						$item2=mysqli_real_escape_string($conn, $test2['productname']);
						$sp=$test2['unitprice'];
						$category=$test2['cat'];
						$cqty=$test2['qty'];
				//$bcode=$test['barcode'];
							
						$resultt=mysqli_query($conn,"SELECT * FROM pricelevel WHERE productid='$item2'");
						$t=mysqli_num_rows($resultt);
                		if($t>=1){	
						while($testt = mysqli_fetch_array($resultt))
						{

							if($qte>= $testt['qty']){
							$discount=$testt['rate'];
								if($qte>=$testt['qty']){
									$rqty=$testt['qty'];
									$qtez=($qte/$rqty);
									$totz=$discount*intval($qtez);

									$remainder = (($qte % $rqty) + abs($rqty)) % abs($rqty);
									$quotient = ($qte - $remainder) / $rqty;
									$toty=	$remainder*$sp;
									$totall=$totz+$toty;
								}
																
						        }
							else{

								$totz2=$qte*$sp;
								$totall=$totz2;
								$discount=0;
							}
						//if($qte>= $testt['qty'] AND $qte<=$testt['qty2']){
							//$discount=$testt['rate'];	
					
				}
						$dis2=$discount;
				     }
					
						elseif($t<=0){
						
						$totz2=$sp*$qtty;
						$totall=$totz2;
						
						}
				
			}
			
			$totz2=$sp*$qtty;
			
			$dix=$totz2-$totall;
			$net=$totz2-$dix;
			//
					if($_POST['discountz']){
					$total= $totz2;
					$dix=$_POST['discountz'];
					$net=$totz2-$dix;
					$netotal=$net;	
					}
					$customerid=$_POST['customerid'];
					
			 		$product=$item2;
					$qty= $_POST['qty'];
					$up= $sp;	
					$total= $totz2;
					$discount=$dix;
					$netotal=$net;
					$mdate=date("Y/m/d");

					$resut=mysqli_query($conn,"SELECT * FROM paycat WHERE invno='$inv'");
					while($row1= mysqli_fetch_array($resut)){
						$payoption2=$row1['description'];
					}
					
					$userid=$_SESSION['userid'];

																
		 mysqli_query($conn,"INSERT INTO inv_temp (customerid,invno,productname,qty,uprice,total,mdate,discount,netotal,payoption,userid,barcode,cqty) 
		 VALUES ('{$customerid}','{$inv}','{$product}','{$qty}','{$up}','{$totz2}','{$mdate2}','{$discount}','{$net}','{$payoption2}','{$userid}','{$barcode}','{$cqty}')");
		 $product="";
		 $item2="";
		 $barcode="";
		 $w=$w+1;
	        }
?></td>
    </tr>
    
</table>

<table cellspacing="0" style="width: 1000px" border="1" align="center" id="example" class="table table-striped table-hover table-responsive" class="table-editable">

			<?php
			include("db.php");
			echo "<tr>";	
				echo"<td><font color='black'>"."Productname"."</font></td>";
				echo"<td><font color='black'>"."Barcode"."</font></td>";
				echo"<td><font color='black'>"."Qty/No"."</font></td>";
				echo"<td><font color='black'>"."Rate"."</font></td>";
				echo"<td><font color='black'>"."Total"."</font></td>";
				echo"<td><font color='black'>"."Discount"."</font></td>";
				echo"<td><font color='black'>"."Net Total"."</font></td>";
				echo"<td><font color='black'>"."Current Qty"."</font></td>";
				echo"<td><font color='black'>"."Modify"."</font></td>";
				echo"<td><font color='black'>"."Delete"."</font></td>";
				echo"<td>"."</td";
				echo "</tr>";
				?>
		<tr>
		
		<td><input type=text id="product" name="product" list="browser" placeholder='Product/Services' class='form-control'>
		  <datalist id=browser >
        	<?php $result2=mysqli_query($conn,"SELECT * FROM stock");
			
			while($row2 = mysqli_fetch_array($result2))
			{?>
   			<option><?php echo $row2['productname']; ?>
                <?php }?>
		</datalist></option></td> 
		<td><input tabindex="0" type="text" name="barcode"  id="barcode" class='form-control' placeholder='Barcode'></td>     
		<td><input name="qty" type="text" id="qty" value="1" size="4" class='form-control' placeholder='Qty'/></td>
		<td></td>
		<td></td>
        <td><input name="discountz" id="discountz" placeholder='Discount' class='form-control'></td> 

        
		<td></td>
        <td></td>
        <td></td>
        
        <td><input type="submit" name="submit" value="+" /></td>
       </tr>
       
       
	  </form>
	  <script type="text/javascript" language="JavaScript">
		document.forms['fsales'].elements['barcode'].focus();
	</script>	

		<?php
			
				
			$result=mysqli_query($conn,"SELECT * FROM inv_temp  WHERE userid='$userid' ");
			
			while($test = mysqli_fetch_array($result))
			{
				$id = $test['id'];	
				echo "<tr>";	
				echo"<td><font color='black'>" .$test['productname']."</font></td>";
				echo"<td><font color='black'>" ."  "."</font></td>";
				echo"<td><font color='black'>". $test['qty']. "</font></td>";
				echo"<td><font color='black'>". $test['uprice']. "</font></td>";
				echo"<td><font color='black'>". $test['total']. "</font></td>";
				echo"<td><font color='black'>". $test['discount']. "</font></td>";
				echo"<td><font color='black'>". $test['netotal']. "</font></td>";
				echo"<td><font color='black'>". $test['cqty']. "</font></td>";
				echo"<td> <a href ='view.php?BookID=$id'>Edit</a>";
				echo"<td> <a href ='del.php?BookID=$id'>Delete</a>";
				echo"<td>"."</td";
				echo "</tr>";
				$tot=$tot+$test['total'];
				$dis=$dis+$test['discount'];
				$netot=$netot+$test['netotal'];
				$_SESSION['customerid']="";
			}
			echo "<tr>";
			echo "<td><font color='black'>"."TOTAL"."</font></td>";
			echo "<td>".""."</td>";
			echo "<td>".""."</td>";
			echo "<td>".""."</td>";
			echo "<td>".$tot."</td>";
			echo "<td>".$dis."</td>";
			echo "<td>".$netot."</td>";
			include 'displaytotal.php';
			echo "<td>".""."</td>";
			echo "<td>".""."</td>";

			

			
			?>
            <tr>
       		<form method="post" action="save2.php">
       		<td width="200" align="left">Customer:<input type=text id="customerid2" name="customerid2" list="browsers" placeholder='Customer ID' class='form-control'>
	  			<datalist id="browsers">
        		<?php $result=mysqli_query($conn,"SELECT * FROM customer");
			
					while($row = mysqli_fetch_array($result))
					{?>
   					<option> <?php echo $row['custname'];?>
                	<?php }?>
				</datalist></option></td>
			  
	  		<td align="left">Amount Due:<input width="200" type="text" id="totl" name="totl" value="<?php echo $netot;?>" class='form-control'></td>
	  		<td align="left">POS/Transfer_No<input width="200" type="text" id="posno" name="posno" class='form-control'></td>
	  		<td align="left">Cash/Pos:<input width="200" type="text" id="cashpos_amt" name="cashpos_amt" placeholder="POS Amount" class='form-control'></td>
	  		</tr>
	  		<tr>
	  			<td width="250" align="left">Pay Type <select name="payoption" id="payoption" class='form-control'>
  					<option>CASH</option>
  					<option>POS</option>
  					<option>TRANSFER</option>
  					<option>CREDIT</option>
  					<option>CASH/POS</option>
  					<option>CASH/TRANSFER</option>
  					<option>COMPLIMENTARY</option>
					</select></td>
				<td>Amount Paid:<input type="number" id ="amt_tender" name="amt_tender" value="<?php echo $netot;?>" onchange="calc();" class='form-control'></td>
				<td>Change:<input type="number" id ="change1" name="change1" class='form-control' ></td>
				<td>Cash/Transfer:<input type="text" id ="cashtransfer_amt" name="cashtransfer_amt" class='form-control' placeholder="Transfer Amount" ></td>
			<table cellspacing="0" style="width: 1000px" align="center" id="example" class="table table-striped table-hover table-responsive">
            <tr>
            	<td></td>
                <td>&nbsp;</td>
	  			<td>&nbsp;</td>
                <td>&nbsp;</td>
	  			<td>&nbsp;</td>
	  			<td>&nbsp;</td>
	  			<td>&nbsp;</td>
	  			<td>&nbsp;</td>
	  			<td align="center">&nbsp;</td>
	  			<td><button type="submit"/>Cash/Print</td>
	  			<td></td>
	  			
    		</tr>
    		</form>
    		<table cellspacing="0" style="width: 1000px" align="center" id="example" class="table table-striped table-hover table-responsive">
			<form method="POST" action="re_printout.php">
			<tr>
			
				<td><input type="text" name="invno" id='invno' class='form-control' placeholder='Invoice No to reprint' style="width:200px"><input type="submit" name="submit" value="Reprint"/></td>
		
			</tr>
			</form>	
			
		</table>
            </table>

            </table>
             
            <?php
            $_SESSION['userid']=$userid;
			mysqli_close($conn);
		?>
		
		<hr>
	
	

        
   
    
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery.popmenu.js"></script>
    <script>
        $(function(){
            $('#demo_box').popmenu();
            $('#demo_box_2').popmenu({'background':'#e67e22','focusColor':'#c0392b','borderRadius':'0'});
            $('#demo_box_3').popmenu({'width': '200px', 'background':'#223','focusColor':'#ee5','borderRadius':'10px', 'top': '70', 'left': '-40', 'color':'#1265fe','border':'3px solid #0035fe'});
        })
    </script>

		</table>
            
       </table>
       <div id="up1">
      
  			</div>   
</body>
</html>
            

