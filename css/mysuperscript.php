<?php
session_start();
$user=$_POST['username'];
$pass=$_POST['password'];
$dbcon="SELECT * FROM login WHERE username='$user'";
$con = mysql_connect('localhost','root','');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db('sec', $con);

$result = mysql_query($dbcon);
while($row = mysql_fetch_array($result))
  {
    $userid= $row['username'];
  	$pass1=$row['password'];
   }
mysql_close($con);



if ($_POST['password']==$pass1){
	if($userid=="Admin"){
		header("Location: index1.html");
	}
	else{
		header("Location: index2.html");
	}
}
else{
	$_SESSION['ans']="Login not successful";
	header("Location: index.php");
	//echo "Login not successful, please contact the Administrator for access.";
}
?>

