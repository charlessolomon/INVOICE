<?php
<script>
 type="text/javascript"> 
window.onload=function(){self.print();} 
</script>

require_once 'dbconfig.php';

	
	//if($_POST)
//{
		$gtotal=0;
		$descp="";

		// open invoice no table

        
        $stmt = $db_con->prepare("SELECT * FROM invoiceno");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        { 
        $invno= $row['invno'];
		$_SESSION['invno']=$invno;

          }     
		// end invno

          // open invoice temp table to copy all entries to master invoice tbl
       $stmt2 = $db_con->prepare("SELECT * FROM inv_temp");
       $stmt2->execute();
        while($row=$stmt2->fetch(PDO::FETCH_ASSOC))
  	{ 
  		
        $invoiceno= $invno;
        $custid=$row['customerid'];
        $mdate=$row['mdate'];
        $productname=$row['productname'];
        $uprice=$row['uprice'];
        $qty=$row['qty'];
        $total=$row['total'];
        $userid=$row['userid']; 
		$gtotal=$gtotal+$total;
		$descp=$descp+","+$productname;
		
		
		$stmt = $db_con->prepare("INSERT INTO invoice(invno,customerid,productname,uprice,qty,total,mdate,userid) VALUES(:einvoiceno,:ecustid, :eproductname,:euprice,:equantity,:etotall,:emdate,:euserid)");
			$stmt->bindParam(":einvoiceno", $invoiceno);
			$stmt->bindParam(":ecustid", $custid);
			$stmt->bindParam(":eproductname", $productname);
			$stmt->bindParam(":euprice", $uprice);
			$stmt->bindParam(":equantity",$qty);
			$stmt->bindParam(":etotall",$total);
			$stmt->bindParam(":emdate",$mdate);
			$stmt->bindParam(":euserid", $userid);
			
			if($stmt->execute())
			{
				echo "Successfully Added";
			}
			else{
				echo "Query Problem";
			}
		//
	if($stmt2->execute())
		{
			echo "Successfully updated";
		}
	else{
			echo "Query Problem";
		}
	}
?>