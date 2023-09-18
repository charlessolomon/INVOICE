
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
            <td><input type='text' name='bank_id' class='form-control' placeholder='id' required /></td>
        </tr>
        <tr>
            <td><input type='text' name='bankname' class='form-control' placeholder='Bank Name' required></td>
        </tr>
        <tr>
            <td><input type='text' name='actnum' class='form-control' placeholder='Bank Account No' required></td>
        </tr>
        <tr>
            <td><input type='text' name='opening' class='form-control' placeholder='Opening Balance' required></td>
        </tr>
        <tr>
        <td id="mdate" class="input-group date" data-date-format="mm-dd-yyyy" style="width: 300px"><input id="mdate" name="mdate" value="<?php echo htmlspecialchars($b); ?>" class="form-control" type="date" required />
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span></td>
        <td></td>
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
     
