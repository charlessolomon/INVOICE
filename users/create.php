<?php
require_once 'dbconfig.php';


	
	if($_POST)
	{
		$userid = $_POST['userid'];
		$role = $_POST['role'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		try{
			
			$stmt = $db_con->prepare("INSERT INTO users(userid,role,email,password) VALUES(:euserid, :erole, :eemail, :epassword)");
			$stmt->bindParam(":euserid", $userid);
			$stmt->bindParam(":erole", $role);
			$stmt->bindParam(":eemail", $email);
			$stmt->bindParam(":epassword", $password);
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