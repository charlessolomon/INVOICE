<?php
$dbcnx=@mysql_connect('localhost','root','timothy77');
if(!$dbcnx){
	exit('<p>unable to connect to the database server at this time.</p>');
}
if (!@mysql_select_db('toluque')){
	exit('<p>Unable to locate the kontec database this time.</p>');
}
	$name1=$_POST['name'];
	$address1=$_POST['address'];
	$amt1=$_POST['amt'];
	$cardtype1=$_POST['cardtype'];
	$payment1=$_POST['payment'];
	$phone1=$_POST['phone'];
	$voucha1=$_POST['vchno'];
	$email1=$_POST['email'];
	$sql="INSERT INTO customer SET 
	name='$name1',
	address='$address1',
	amt='$amt1',
	payment='$payment1',
	phone='$phone1',
	voucha='$voucha1',
	email='$email1',
	cardtype='$cardtype1'";
	
	if(@mysql_query($sql)){
		echo '<p> Your new record has been added.</p>';
	} 
	else {
		echo '<p> Error Adding new record:'. mysql_error(). '</p>';
	}
    echo "Thank you for visiting our site, we shall get back to you as soon as possible.."; 
		header('Location:contactus.html');
	?>
    <font style="font-family:Verdana, Geneva, sans-serif"
	<br><a href="online.html"> Please click here to return </a>
    
    
    