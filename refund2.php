<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Receipt Refund</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">
                                                                                                                                                   
<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
  
<script src="assets/jquery-1.11.3-jquery.min.js"></script>

<center><div style="background-color:#CCC" padding:1px>
	<div align="center"><img src="../dist/img/logo2.gif" width="165" height="65" /></div>
	<div><h2><p>List of Approved Refunds</p></h2></div>
	<table cellspacing="0" style="width: 1000px" align="center" id="example" class="table table-striped table-hover table-responsive" class="table-editable">
	<thead>
<?php 
$tot=0;
$k=1;
?>
	
			<?php
			include("db.php");
			echo "<tr>";
					
				echo"<td><font color='black'>"."S/No"."</font></td>";
				echo"<td><font color='black'>"."Invoice No"."</font></td>";
				echo"<td><font color='black'>"."Customer"."</font></td>";
				echo"<td><font color='black'>"."Product"."</font></td>";
				echo"<td><font color='black'>"."Qty"."</font></td>";
				echo"<td><font color='black'>"."Rate"."</font></td>";
				echo"<td><font color='black'>"."Total"."</font></td>";
				echo"<td><font color='black'>"."Date"."</font></td>";
				echo"<td><font color='black'>"."Action"."</font></td>";
				echo "</tr>"; ?>
</thead>
			
<tbody align="center">	
<?php		
			//$result=mysqli_query($conn,"SELECT * FROM recvno");
			//$result=mysqli_query($conn,"SELECT * FROM Recvno WHERE mdate>=2018/2/20 AND <=2018/2/21");

				
					$result=mysqli_query($conn,"SELECT * FROM refund");
				
			while($test = mysqli_fetch_array($result))
			{
			
				echo "<tr>";	
				                
				echo"<td><font color='black'>" .$k."</font></td>";
				echo"<td><font color='black'>". $test['invno']. "</font></td>";
				echo"<td><font color='black'>". $test['customerid']. "</font></td>";
				echo"<td><font color='black'>". $test['productname']. "</font></td>";
				echo"<td><font color='black'>". $test['qty']. "</font></td>";
				echo"<td><font color='black'>". $test['uprice']. "</font></td>";
				echo"<td><font color='black'>". $test['total']. "</font></td>";
				echo"<td><font color='black'>". $test['mdate']. "</font></td>";
				echo"<td><font color='black'>". $test['status']. "</font></td>";
				echo "</tr>";
				$tot=$tot+$test['total'];
				$k=$k+1;
			}
			
			mysqli_close($conn);
			
		?>
            
</tbody>
        </table>
     
				<p>Total: <?php echo $tot; ?></p>
				
		
        </div></center>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/datatables.min.js"></script>
<script type="text/javascript" src="crud.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();

	$('#example')
	.removeClass( 'display' )
	.addClass('table table-bordered');
});
</script>

<table cellspacing="0" style="width: 1000px" align="center" id="example" class="table table-striped table-hover table-responsive">
			<form method="POST" action="refund_action.php">
			<tr>
			
				<td><input type="text" name="invno" id='invno' class='form-control' placeholder='Receipt No to refund' style="width:200px"><input type="submit" name="submit" value="Seek Approval"/></td>
		
			</tr>	
			</form>
</body>
</html>
