<?php
		$productid=$productname;
		$stmt = $db_con->prepare("SELECT * FROM stock WHERE productname=:productid");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        { 
        $qty= $row['qty'];
		$qty1= $row['qty1'];
		
		
		// end search
		
		$newqty=$qty-$quantity;
		$newqty1=$qty1+$quantity;
		$productid=$productname;
		
		$stmt = $db_con->prepare("UPDATE stock SET qty=:enqty, qty1=:enqty1 WHERE productname=:productid");
		$stmt->bindParam(":enqty", $newqty);
		$stmt->bindParam(":enqty1", $newqty1);
		
		if($stmt->execute())
		{
			//echo "Successfully updated";
		}
		else{
			echo "Query Problem";
		}
	//}
		//		
		}
		//catch(PDOException $e){
			// echo $e->getMessage();
		//}
		// search for product and update
		
		// search product and get current balance and add new qty
		
		
		
		// end stock update
	//}
	// summarize sales to revno
		//$invo=$invoiceno;
        //$cid=$custid;
        //$mdatex=$mdate;
        //$productname=$descp;
        //$userid1=$userid; 
		//$totalz=$gtotal;

			
			
		//	$stmt = $db_con->prepare("INSERT INTO recvno(invno,customer,mdate,total,description,userid) VALUES(:einvoiceno,:ecustid,:emdate,:etotall,:eproductname,:euserid)");
		//	$stmt->bindParam(":einvoiceno", $invoiceno);
		//	$stmt->bindParam(":ecustid", $cid);
		//	$stmt->bindParam(":emdate", $mdatex);
		//	$stmt->bindParam(":etotall",$totalz);
		//	$stmt->bindParam(":eproductname", $productname);		
		//	$stmt->bindParam(":euserid", $userid1);
			
		//	if($stmt->execute())
		
	//
// update invoiceno by add one (+1)

		$invoicenum=0;
		$invoicenum = ($invno+1);
		
		$stmt = $db_con->prepare("UPDATE invoiceno SET invno=:en");
		$stmt->bindParam(":en", $invoicenum);
		
		if($stmt->execute())
		{
			echo "Successfully updated";
		}
		else{
			echo "Query Problem";
		}
}
// Delete inv_temp table and refresh invoice page
	// print invoice options

//	
?>