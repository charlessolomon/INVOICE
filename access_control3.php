<?php
session_start();
error_reporting(0);
if(!isset($_SERVER['HTTP_REFERER'])){
	header('location:index.php');
	exit;
}

$role=$_SESSION['role'];
if ($role=='admin'){
  $usd=$_SESSION['userid'];
  $_SESSION['userid']=$usd;		
  include_once"layout.php";
}elseif ($role=='cashier') {
  $usd=$_SESSION['userid'];
  $_SESSION['userid']=$usd;
  include_once"layout_cashier.php";
}elseif ($role=='Account/Invoicing') {
  $usd=$_SESSION['userid'];
  $_SESSION['userid']=$usd;
  include_once"layout_invoice.php";
}elseif ($role=='employee') {
  $usd=$_SESSION['userid'];
  $_SESSION['userid']=$usd;
  include_once"layout_outdoor.php";
}
elseif ($role=='manager') {
  $usd=$_SESSION['userid'];
  $_SESSION['userid']=$usd;
  include_once"../layout_manager.php";
}
?>