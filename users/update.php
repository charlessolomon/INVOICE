<?php
require_once 'dbconfig.php';

	
	if($_POST)
	{
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		$email = $_POST['email'];
		$role = $_POST['role'];
		$password = $_POST['password'];
		
		$stmt = $db_con->prepare("UPDATE users SET userid=:en, email=:ed, role=:es, password=:ep WHERE emp_id=:id");
		$stmt->bindParam(":en", $userid);
		$stmt->bindParam(":ed", $email);
		$stmt->bindParam(":es", $role);
		$stmt->bindParam(":ep", $password);
		$stmt->bindParam(":id", $id);
		
		if($stmt->execute())
		{
			echo "Successfully updated";
		}
		else{
			echo "Query Problem";
		}
	}

?>