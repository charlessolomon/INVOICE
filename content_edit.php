<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User Account Management</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
}
</style>
</head>

<body>
<form method="post">
<table align="center">

	<tr>
	  <td colspan="2" align="center">User Account Form</td>
    </tr>
	<tr>
		<td>Username:</td>
		<td><input name="title" type="text" size="70" /></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input name="author" type="password" value="" size="68" /></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="submit" value="add" /></td>
    </tr>
	<tr>
	  <td colspan="2" align="center"><a href="menu.html">Click here to Return Home</a></td>
    </tr>
	<tr>
		<td colspan="2" align="center"><?php
if (isset($_POST['submit']))
	{	   
	include 'db.php';
	
			 		$title=$_POST['title'] ;
					$author= $_POST['author'] ;					
																
		 mysqli_query($conn,"INSERT INTO login (username,password) 
		 VALUES ('$title','$author')"); 
		//
		 
		//		
				
	        }
?></td>
	</tr>
</table>
</form>
<table border="1" align="center">
	
			<?php
			include("db.php");
			
				
			$result=mysqli_query($conn,"SELECT * FROM login");
			
			while($test = mysqli_fetch_array($result))
			{
				$id = $test['username'];	
				echo "<tr>";	
				echo"<td><font color='black'>" .$test['username']."</font></td>";
				echo"<td><font color='black'>". $test['password']. "</font></td>";
				echo"<td> <a href ='view.php?BookID=$id'>Edit</a>";
				echo"<td> <a href ='del.php?BookID=$id'><center>Delete</center></a>";
				echo "</tr>";
			}
			mysqli_close($conn);
			?>
</table>

</body>
</html>
