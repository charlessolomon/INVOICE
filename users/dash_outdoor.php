<?php
session_start();
$role=$_SESSION['role'];

include_once"layout_outdoor.php";

$userid=$_SESSION['userid'];
$_SESSION['userid']=$userid;
date_default_timezone_set('Africa/Lagos');
if(!isset($_SESSION['userid'])){
  ?>
  <script>
    window.location="./"
  </script>
<?php }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UltimateERP | Employee Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
    <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<div class="wrapper">

  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Welcome to Cashier dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php
                include 'db.php';
                $total=0;
                $a=DATE('Y/m/d');
                $result=mysqli_query($conn,"SELECT sum(total) AS stotal FROM recvno WHERE mdate='$a' AND paytype='CREDIT'")or die(mysqli_error($conn));
      
                while($test = mysqli_fetch_array($result))
                {
                  $total = $test['stotal'];  
                }
                echo "N".$total;?><sup style="font-size: 20px"></sup></h3>

              <p>Credit Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="//192.168.1.3/kanti_plus/reports/report2.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php
                include 'db.php';
                $total=0;
                $a=DATE('Y/m/d');
                $result=mysqli_query($conn,"SELECT sum(total) AS stotal FROM recvno WHERE mdate='$a' AND paytype='CASH'")or die(mysqli_error($conn));
      
                while($test = mysqli_fetch_array($result))
                {
                  $total = $test['stotal'];  
                }
                echo "N";?><sup style="font-size: 20px"></sup></h3>

              <p>Cash Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="//192.168.1.3/kanti_plus/reports/report2.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
                include 'db.php';
                $total=0;
                $a=DATE('Y/m/d');
                $result=mysqli_query($conn,"SELECT sum(total) AS stotal FROM recvno WHERE mdate='$a' AND paytype='POS'")or die(mysqli_error($conn));
      
                while($test = mysqli_fetch_array($result))
                {
                  $total = $test['stotal'];  
                }
                echo "N"?><sup style="font-size: 20px"></sup></h3>


              <p>POS/E-Transfer Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="//192.168.1.3/kanti_plus/reports/report2.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
 
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php
                include 'db.php';
                $total=0;
                $a=DATE('Y/m/d');
                $result=mysqli_query($conn,"SELECT sum(total) AS stotal FROM recvno WHERE mdate='$a'")or die(mysqli_error($conn));
      
                while($test = mysqli_fetch_array($result))
                {
                  $total = $test['stotal'];  
                }
                echo "N".$total;?><sup style="font-size: 20px"></sup></h3>

              <p>Gross Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="//192.168.1.3/kanti_plus/reports/report2.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!--st
          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          

      <!--
     
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2018 <a href="https://adminlte.io">Kontec Digital System</a>.</strong> All rights
    reserved.
  </footer>



<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
