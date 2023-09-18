<?php
session_start();

include "db2.php";

$ide = $_POST['id'];
//$id=4;

$sql = "select * from stock where emp_id=".$ide;
$result = mysqli_query($conn,$sql);



$response = "<table border='0' width='100%'>";
while( $row = mysqli_fetch_array($result) ){
$_SESSION['pid']= $row['productname'];
$_SESSION['uprice'] = $row['unitprice'];
$_SESSION['rprice'] = $row['reviewedprice'];
$_SESSION['pcategory'] = $row['cat'];
//$_SESSION['labresult'] = $row['labresult'];
  
    
    $response .= "<tr>";
    $response .= "<td>Product Name : </td><td>".$_SESSION['pid']."</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td>Product Category : </td><td>".$_SESSION['pcategory']."</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td>Last Reviewed Retail Price : </td><td>".$_SESSION['rprice']."</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td>Current Retail Price : </td><td>".$_SESSION['uprice']."</td>";
    $response .= "</tr>";
    $response .= "</table>";


    

//$response2 .= "<button type='submit' name='send' class='btn btn-success'>" 'Send' "</button>";
    $response .= "<form method='post' action='rprice.php' autocomplete='off'>";
    $response .= "<hr>";
    $response .= "<h5 class='modal-title'><strong> Review Retail Price</strong></h5>";
    $response .= "<input type='text' name='nprice' class='form-control' placeholder='New Retail Price'> <br>";
    $response .= "<button type='submit' name='send2' class='btn btn-success'> Update</button>";
    $response .="</form>";



   
}
    echo $response;
    //echo $response2;

   // echo '<hr>';
    //$response2 .= "<form method='post'>";
   // $response2 .= "<input type='text' class='form-control' placeholder='Treatment'>";
    //$response2 .= "</form>";


    //echo $response2;


//echo '<hr>';
//echo '<h5 class="modal-title"><strong> Give Prescribtion </strong></h5>';

//$response2 .= "<button type='submit' name='send' class='btn btn-success'>" 'Send' "</button>";
//$response2 .= "<form method='post'>";
//$response2 .= "<input type='text' class='form-control' placeholder='Treatment'>";
//$response2 .="</form>";

//echo $response2;

exit;

?>