
<?php session_start();


// actions
// open invoice no table call -out the invoice no and apply to all entries
// save to recvno,invoice history, inventory table
//recvno fields: mdate,id,invno,customer,description,total and userid
//inventory fields: id, product,qty,rate,userid,QTY_IN,QTY_OUT,RE-ORDER_LEVEL, MIN_STOCK
//history: mdate,id,invno,customer,description,total and userid

require_once 'dbconfig.php';

	
	if($_POST)
{
		$emp_name = $_POST['customerid'];
		$emp_dept = $_POST['productname'];
		$emp_salary = $_POST['uprice'];
		$quantity= $_POST['quantity'];
		$total= $_POST['total'];
		$mdate=$_POST['mdate'];

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
       $stmt2 = $db_con->prepare("SELECT * FROM invoiceno");
       $stmt2->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
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
		try{	
		$stmt = $db_con->prepare("INSERT INTO invoice(invno,customerid,productname,uprice,quantity,total,mdate,userid) VALUES(:einvoiceno,:ecustid, :eproductname,:euprice,:equantity,:etotall,:emdate,:euserid)");
			$stmt->bindParam(":einvoiceno", $invoiceno);
			$stmt->bindParam(":ecustid", $custid);
			$stmt->bindParam(":eproductname", $productname);
			$stmt->bindParam(":euprice", $uprice);
			$stmt->bindParam(":equantity",$quantity);
			$stmt->bindParam(":etotall",$total);
			$stmt->bindParam(":emdate",$mdate);
			$stmt->bindParam(":euserid", $userid);
			
			if($stmt->execute())
			{
				//echo "Successfully Added";
			}
			else{
				echo "Query Problem";
			}	
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
		// search for product and update
		
		// search product and get current balance and add new qty
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
	}
		
		
		// end stock update
	}
	// summarize sales to revno
		$invoiceno= $invno;
        $custid=$row['customerid'];
        $mdate=$row['mdate'];
        $productname=$descp;
        $userid=$row['userid']; 
		$totalz=$gtotal;
		
			
			$stmt = $db_con->prepare("INSERT INTO recvno(invno,customer,mdate,total,description,userid) VALUES(:einvoiceno,:ecustid,:emdate,:etotall,:eproductname,:euserid)");
			$stmt->bindParam(":einvoiceno", $invoiceno);
			$stmt->bindParam(":ecustid", $custid);
			$stmt->bindParam(":emdate", $mdate);
			$stmt->bindParam(":etotall",$totalz);
			$stmt->bindParam(":eproductname", $productname);		
			$stmt->bindParam(":euserid", $userid);
			
			if($stmt->execute())
		
	//
// update invoiceno by add one (+1)

		$invoicenum = ($invoiceno+1);
		
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

	// print invoice options

//	
?>


