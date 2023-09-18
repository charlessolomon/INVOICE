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
require_once('../access_control2.php');
$tot=0;
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
<title>Sales Report</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
}
</style>
<script type="text/javascript">
  function custredir() {
    window.location = "csv_converter.php";
  }
</script>
<script type="text/javascript">

$(document).ready(function () {

        $('#print_btn').click(function () {
			$("#print_btn").hide();


			

            window.print();
            window.location.href = 'report2.php';

            return false;

        });
    });
</script>
</head>

<body>
<div class="container">
<form method="post">
<table cellspacing="0" style="width: 1000px" align="center" class="table table-striped table-hover table-responsive" class "table-editable">
	<tr>
    <td colspan="5"><div align="left"><img src="../dist/img/logo.png" width="100" height="100" /></div></td>
    <td colspan="6" align="right"><h2 align="right" class="form-signin-heading">Price Review</h2></td>
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
	  <td colspan="4" align="right"><input type="submit" name="print_btn" id="print_btn" value="Print Receipt" /></td>
    </tr>
	 	
        <td></td>
        <td colspan="3"><input type=text id="empid" name="empid" list="browser" placeholder='Product ID'>
		  <datalist id=browser >
        	<?php $result2=mysqli_query($conn,"SELECT * FROM stock");
			
			while($row2 = mysqli_fetch_array($result2))
			{?>
   			<option> <?php echo $row2['productname']; ?>
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
	
					//$a='2018/1/12';
					//$b='2018/1/12';
					$mdate=date("Y/m/d");
					//$a=$_POST['from_date'];
					//$b=$_POST['to_date'];
					//$_SESSION['a']=$_POST['to_date'];
					//$_SESSION['b']=$_POST['to_date'];
					$empid=$_POST['empid'];

		
	       
?></td>
    </tr>
    <tr>
		<td colspan="12" align="right">
	</tr>
</table>
</form>
<div class="content-loader">
<table cellspacing="0" style="width: 1000px" align="center" id="example" class="table table-striped table-hover table-responsive" class="table-editable">
<thead>
<?php 
$k=1;
?>
	
			<?php
			include("db.php");
			echo "<tr>";
					
				echo"<td><font color='black'>"."S/No"."</font></td>";
				echo"<td><font color='black'>"."Products"."</font></td>";
				echo"<td><font color='black'>"."Catogery"."</font></td>";
				echo"<td><font color='black'>"."Cost Price"."</font></td>";
				echo"<td><font color='black'>"."Selling Price"."</font></td>";
				echo"<td><font color='black'>"."Reviewed Price"."</font></td>";
				echo"<td><font color='black'>"."Stock-in Qty"."</font></td>";			
				echo"<td><font color='black'>"."Stock-out Qty"."</font></td>";
				echo"<td><font color='black'>"."Update"."</font></td>";
				echo "</tr>"; ?>

				
</thead>
			
<tbody>	
<?php		
			//$result=mysqli_query($conn,"SELECT * FROM recvno");
			//$result=mysqli_query($conn,"SELECT * FROM Recvno WHERE mdate>=2018/2/20 AND <=2018/2/21");

				if (isset($_POST['empid'])){ 
					$result=mysqli_query($conn,"SELECT * FROM stock WHERE productname='$empid'")or die(mysqli_error($conn));
				}
				else{
					$result=mysqli_query($conn,"SELECT * FROM stock")or die(mysqli_error($conn));
				}
			while($test = mysqli_fetch_array($result))
			{
			
				echo "<tr>";	
				                
				$id=$test['emp_id'];
				echo"<td><font color='black'>". $test['emp_id']. "</font></td>";
				echo"<td><font color='black'>". $test['productname']. "</font></td>";
				echo"<td><font color='black'>". $test['cat']. "</font></td>";
				echo"<td><font color='black'>". $test['costprice']. "</font></td>";
				echo"<td><font color='black'>". $test['unitprice']. "</font></td>";
				echo"<td><font color='black'>". $test['reviewedprice']. "</font></td>";
				echo"<td><font color='black'>". $test['stkin']. "</font></td>";
				echo"<td><font color='black'>". $test['stkout']. "</font></td>";
         		echo "<td><button id='butinfo_".$id."' class='btn btn-info userinfo'>Review Price</button></td>";?>
      <!-- <td><button type='button' id="<?php $test['productname']; ?>" class="btn btn-info userinfo" name="save" ><span>Check Result</span></button> -->


        <div class="modal modal-primary fade" id="empModal" role="dialog">
                <div class="modal-dialog">
                
                    <!-- Modal content-->

                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Price Review Form</h4>
                        </div>
                        <div class="modal-body">
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                  
                </div>
            </div>
				<?php
				echo "</tr>";
				
				$k=$k+1;
			}
			
			mysqli_close($conn);
}			
		?>
            
</tbody>
        </table>
        <script type='text/javascript'>
            $(document).ready(function(){

                $('.userinfo').click(function(){
                    var id = this.id;
                    var splitid = id.split('_');
                    var idy = splitid[1];


                    // AJAX request
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {id: idy},
                        success: function(response){ 
                            // Add response in Modal body
                            $('.modal-body').html(response); 
                    
                            // Display Modal
                            $('#empModal').modal('show'); 
                        }
                    });
                });
            });
            </script>
        </div>
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
</body>
</html>
