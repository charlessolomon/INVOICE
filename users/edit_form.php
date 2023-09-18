<?php
include_once 'dbconfig.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];	
	$stmt=$db_con->prepare("SELECT * FROM users WHERE emp_id=:id");
	$stmt->execute(array(':id'=>$id));	
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<style type="text/css">
#dis{
	display:none;
}
</style>


	
    
    <div id="dis">
    
	</div>
        
 	
	 <form method='post' id='emp-UpdateForm' action='#'>
 
    <table class='table table-bordered'>
 		<input type='hidden' name='id' value='<?php echo $row['emp_id']; ?>' />
        <tr>
            <td>User ID/Name</td>
            <td><input type='text' name='userid' class='form-control' value='<?php echo $row['userid']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='text' name='email' class='form-control' value='<?php echo $row['email']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Previlege</td>
            <td><input type='text' name='role' class='form-control' value='<?php echo $row['role']; ?>' required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type='text' name='password' class='form-control' value='<?php echo $row['password']; ?>' required></td>
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
     
