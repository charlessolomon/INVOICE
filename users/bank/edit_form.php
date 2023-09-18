<?php
include_once 'dbconfig.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];	
	$stmt=$db_con->prepare("SELECT * FROM bankreg WHERE bank_id=:id");
	$stmt->execute(array(':id'=>$id));	
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<style type="text/css">
#dis{
	display:none;
}
	
    
    <div id="dis">
    
	</div>
        
 	
	 <form method='post' id='emp-UpdateForm' action='#'>
 
    <table class='table table-bordered'>
 		<input type='hidden' name='id' value='<?php echo $row['bank_id']; ?>' />
        <tr>
            <td>Bank Name</td>
            <td><input type='text' name='bankname' class='form-control' value='<?php echo $row['bankname']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Account No.</td>
            <td><input type='text' name='actnum' class='form-control' value='<?php echo $row['actnum']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Opening</td>
            <td><input type='text' name='opening' class='form-control' value='<?php echo $row['openingbal']; ?>' required></td>
        </tr>
        <tr>
            <td>Date</td>
            <td><input type='text' name='mdate' class='form-control' value='<?php echo $row['mdate']; ?>' required></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-update" id="btn-update">
    		<span class="glyphicon glyphicon-plus"></span> Save Updates
			</button>
            </td>
        </tr>
 
    </table>
</form>
     
