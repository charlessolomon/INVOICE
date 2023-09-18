<?php 
session_start();
date_default_timezone_set('Africa/Lagos');

include 'db.php';
require_once('../access_control.php');
$userid=$_SESSION['userid'];
$_SESSION['userid']=$userid;?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="tcal.js"></script> 

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bank</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
<style type="text/css">
<link rel="stylesheet" type="text/css" href="tcal.css" />
#dis{
	display:none;
}
</style>


	
    
    <div id="dis">
    <!-- here message will be displayed -->
	</div>
        
 	
	 <form method='post' id='emp-SaveForm' action="search.php">
 
  
    <table cellspacing="1" style="width: 500px" align="center" id="example" class="table table-striped table-hover table-responsive">
        <tr>
                <td align  ="center" ><img src="../dist/logo2.gif" /></td>
                <hr>
                
        </tr>            
        <tr>
             <strong><td align ="center">RESTORE SUSPENDED SALES</td></strong>   
 
        
        <tr>
            <td><input type=text id="productname" name="productname" list="browsers" placeholder='Product description' class='form-control'/>
          <datalist id="browsers" >
            <?php $result3=mysqli_query($conn,"SELECT * FROM stock");
            
            while($row3 = mysqli_fetch_array($result3))
            {?>
            <option><?php echo $row3['productname']; ?>
                <?php }?>
        </datalist></option></td> </td>
        </tr>
        
        <tr>
            <td><input id="userid" name="userid" value='<?php echo $_SESSION['userid'];?>' class='form-control'></td>
               
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save" id="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Search
			</button>  
            </td>
        </tr>
        <tr>
             <td></td>  
        </tr>
 
    </table>
</form>
     
