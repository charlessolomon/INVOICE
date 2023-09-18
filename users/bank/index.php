<?php 
session_start();
$role=$_SESSION['role'];
if ($role=='admin'){
  include_once"../layout.php";
}elseif ($role=='employee') {
  include_once"../layout_outdoor.php";
}elseif ($role=='Regular') {
  include_once"../layout_account.php";
}
elseif ($role=='Vip') {
  include_once"../layout_vip.php";
}
elseif ($role=='Account') {
  include_once"../layout_account.php";
}
$userid=$_SESSION['userid'];
$_SESSION['userid']=$userid;?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bank</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$("#btn-view").hide();
	
	$("#btn-add").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('add_form.php');
			$("#btn-add").hide();
			$("#btn-view").show();
		});
	});
	
	$("#btn-view").click(function(){
		
		$("body").fadeOut('slow', function()
		{
			$("body").load('index.php');
			$("body").fadeIn('slow');
			window.location.href="index.php";
		});
	});
	
});
</script>

</head>

<body>
    


	<div class="container">
      
        <h2 class="form-signin-heading">Bank Registration</h2><hr />
        <button class="btn btn-info" type="button" id="btn-add"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Add Bank</button>
        <button class="btn btn-info" type="button" id="btn-view"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; View Bank</button>
        <hr />
        
        <div class="content-loader">
        
        <table cellspacing="0" style="width: 950px" align="center" id="example" class="table table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th>Bank ID</th>
        <th>Bank</th>
        <th>Act No</th>
        <th>Openning Bal</th>
        <th>Date</th>
        <th>edit</th>
        <th>delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once 'dbconfig.php';
        
        $stmt = $db_con->prepare("SELECT * FROM bankreg");
        $stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<tr>
			<td><?php echo $row['bank_id']; ?></td>
			<td><?php echo $row['bankname']; ?></td>
			<td><?php echo $row['actnum']; ?></td>
			<td><?php echo $row['openingbal']; ?></td>
			<td><?php echo $row['mdate']; ?></td>
			<td align="center">
			<a id="<?php echo $row['bank_id']; ?>" class="edit-link" href="#" title="Edit">
			<img src="edit.png" width="20px" /></a></td>
			<td align="center"><a id="<?php echo $row['bank_id']; ?>" class="delete-link" href="#" title="Delete"><img src="delete.png" width="20px" /></a></td>
			</tr>
			<?php }?>
        </tbody>
        </table>
        
        </div>

    </div>
    
    <br />
    
    <div class="container">
      
        <div class="alert alert-info">
        <a href="#" target="_blank">Kontec 2019</a>
        </div>

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