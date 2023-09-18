
<style type="text/css">
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
#dis{
	display:none;
}
</style>


	
    
    <div id="dis">
    <!-- here message will be displayed -->
	</div>
        
 	
	 <form method='post' id='emp-SaveForm' action="#">
 
  
    <table cellspacing="0" style="width: 500px" align="center" id="example">
 
        <tr>
            <td><input type='text' name='userid' class='form-control' placeholder='User id' required /></td>
        </tr>
        <tr>
            <td><input type='text' name='email' class='form-control' placeholder='E-mail' required></td>
        </tr>
        <tr>
            <td><input type='password' name='password' class='form-control' placeholder='Password' required></td>
        </tr>
        <tr>
            <td width="250">Role<select name="role" id="role" class='form-control'>
  		<option>admin</option>
  		<option>employee</option>
		<option>cashier</option>
  		<option>manager</option>
		</select></td>

        </tr>
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save" id="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Save this Record
			</button>  
            </td>
        </tr>
 
    </table>
</form>
     
