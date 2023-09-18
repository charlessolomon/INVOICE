<?php
          include 'db.php';
          $Nqty= $_POST['Nqty'];
          $sql="SELECT * FROM pricelevel WHERE qty=$Nqty";
          $result=mysqli_query($conn,$sql);
          if (mysqli_num_rows($result)>0) {
              while ($row=mysqli_fetch_assoc($result)) {

                  //echo $row['rate'];
                  $total=($row['rate']*$Nqty);
                  echo $total;

              }

          } else {
            echo "There no more names";
          }
      ?>