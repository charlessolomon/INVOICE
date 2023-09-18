<?php
require_once 'dbconfig.php';

	
	if($_POST)
	{
		$bank_id=$_POST['bank_id'];
		$bankname = $_POST['bankname'];
		$actnum = $_POST['actnum'];
		$openingbal = $_POST['opening'];
		$mdate = $_POST['mdate'];
		
		try{
			
			$stmt = $db_con->prepare("INSERT INTO bankreg(bank_id,bankname,actnum,openingbal,mdate) VALUES(:sbank_id,:sbankname,:sactnum,:sopeningbal,:smdate)");
			$stmt->bindParam(":sbank_id", $bank_id);
			$stmt->bindParam(":sbankname", $bankname);
			$stmt->bindParam(":sactnum", $actnum);
			$stmt->bindParam(":sopeningbal", $openingbal);
			$stmt->bindParam(":smdate", $mdate);

			if($stmt->execute())
			{
				echo "Successfully Added";
			}
			else{
				echo "Query Problem";
			}	
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>