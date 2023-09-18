<?php
require_once 'dbconfig.php';

	
	if($_POST)
	{
		
		
		$stmt = $db_con->prepare("UPDATE bankreg SET emp_name=:sbank_id, emp_dept=:sbankname, emp_salary=:sactnum,openingbal=:sopeningbal,mdate=:smdate WHERE bank_id=:id");
		$stmt->bindParam(":sbank_id", $bank_id);
		$stmt->bindParam(":sbankname", $bankname);
		$stmt->bindParam(":sactnum", $actnum);
		$stmt->bindParam(":sopeningbal", $openingbal);
		$stmt->bindParam(":smdate", $mdate);
		
		if($stmt->execute())
		{
			echo "Successfully updated";
		}
		else{
			echo "Query Problem";
		}
	}

?>