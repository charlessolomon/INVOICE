
<html>
<!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Login</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
 <!-- sidebar menu: : style can be found in sidebar.less -->
       <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
            <li class="active"><a href="<?php echo $path;?>/dash.php"><i class="fa fa-circle-o"></i> Home</a></li>
            <li class="active"><a href="<?php echo $path;?>/index.php"><i class="fa fa-circle-o"></i> Sign Out</a></li>
             <li><a href="<?php echo $path;?>/db_backup/login.php"><i class="fa fa-circle-o"></i> Backup Utility</a></li>
      </ul>
        </li>
        <li class="treeview">
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i></a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i></a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i></a></li>
          </ul>
        </li>
        <li></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i><span>Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo $path;?>/users/index.php"><i class="fa fa-circle-o"></i> User Register</a></li>
              <li><a href="<?php echo $path;?>/inventory/inventory.php"><i class="fa fa-circle-o"></i> View Inventory</a></li>
	       <li><a href="<?php echo $path;?>/inventory/add_stock.php"><i class="fa fa-circle-o"></i> Create Inventory</a></li>	
              <li><a href="<?php echo $path;?>/bank/index.php"><i class="fa fa-circle-o"></i> Setup Bank</a></li>
              <li><a href="<?php echo $path;?>/customer/index.php"><i class="fa fa-circle-o"></i> Setup Customer</a></li>
              <li><a href="<?php echo $path;?>/suppliers/index.php"><i class="fa fa-circle-o"></i> Setup Vendor</a></li>
              <li><a href="<?php echo $path;?>/loyalty/index.php"><i class="fa fa-circle-o"></i> Setup Pricelevel</a></li>
              <li><a href="<?php echo $path;?>/inventory/price_review.php"><i class="fa fa-circle-o"></i> Price Review</a></li>
              <li><a href="<?php echo $path;?>/reports/report3.php"><i class="fa fa-circle-o"></i> Sales Reversal</a></li>
              <li><a href="<?php echo $path;?>/reports/individual_refund.php"><i class="fa fa-circle-o"></i> Reversal By Item</a></li>
	      <li><a href="<?php echo $path;?>/invoice/refund_approval.php"><i class="fa fa-circle-o"></i> Approve Refund</a></li>
        <li><a href="<?php echo $path;?>/close_cash.php"><i class="fa fa-circle-o"></i> Close Sales</a></li>
        <li><a href="<?php echo $path;?>/close_cash_receipt.php"><i class="fa fa-circle-o"></i> Close Sales Receipt</a></li>	

              </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i><span>Cashier</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo $path;?>/invoice/invoice.php"><i class="fa fa-circle-o"></i>Invoicing</a></li>
	          <li><a href="<?php echo $path;?>/invoice/Refund.php"><i class="fa fa-circle-o"></i>Refund Request</a></li>
            <li><a href="<?php echo $path;?>/reports/report2.php"><i class="fa fa-circle-o"></i>Sales Report</a></li>
            <li><a href="<?php echo $path;?>/payments/receipt.php"><i class="fa fa-circle-o"></i>Receipt/Payment</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Debtor</a></li>
            <li><a href="<?php echo $path;?>/account/expenses.php"><i class="fa fa-circle-o"></i>Expenditure</a></li>
            <li><a href="<?php echo $path;?>/customer/index.php"><i class="fa fa-circle-o"></i>Customer</a></li>
            <li><a href="<?php echo $path;?>/reports/stock_report.php"><i class="fa fa-circle-o"></i>Stock Sales Report</a></li>
            <li><a href="<?php echo $path;?>/account/exp_report.php"><i class="fa fa-circle-o"></i>Expense Report</a></li>
            <li><a href="<?php echo $path;?>/reports/stock_sales.php"><i class="fa fa-circle-o"></i>Sales By Category</a></li>
           
          </ul></li>
          
        <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Accountant/Store</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span>
          </a>
           <ul class="treeview-menu">
            <li><a href="<?php echo $path;?>/bank/index.php"><i class="fa fa-circle-o"></i>Setup Bank</a></li>
            <li><a href="<?php echo $path;?>/cash2bank/index.php"><i class="fa fa-circle-o"></i>Cash to Bank</a></li>
            <li><a href="<?php echo $path;?>/inventory/inventory.php"><i class="fa fa-circle-o"></i> Setup Inventory</a></li>
            <li><a href="<?php echo $path;?>/porder/invoice.php"><i class="fa fa-circle-o"></i>Purchases/Stockin </a></li>
            <li><a href="<?php echo $path;?>/bank/report.php"><i class="fa fa-circle-o"></i>Bank Report</a></li>
            <li><a href="<?php echo $path;?>//reports/stockmove.php"><i class="fa fa-circle-o"></i>Stock Movement </a></li>
            <li><a href="<?php echo $path;?>//reports/stocklist.php"><i class="fa fa-circle-o"></i>Stock Report</a></li>
            <li><a href="<?php echo $path;?>/store_issue/search_stock.php"><i class="fa fa-circle-o"></i>Store Maintenance</a></li>
            <li><a href="<?php echo $path;?>/reports/report2.php"><i class="fa fa-circle-o"></i> Sales Report</a></li>
            <li><a href="<?php echo $path;?>/reports/porder_report.php"><i class="fa fa-circle-o"></i> Purchase Report</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Refunds</a></li>
            <li><a href="<?php echo $path;?>/customer/index.php"><i class="fa fa-circle-o"></i>Customer</a></li>
          </ul>
        </li>
        
        <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span>
          </a>
           <ul class="treeview-menu">
            <li><a href="<?php echo $path;?>/reports/report2.php"><i class="fa fa-circle-o"></i>Sales Report </a></li>
            <li><a href="<?php echo $path;?>/reports/report_receipt.php"><i class="fa fa-circle-o"></i>Receipt Report </a></li>
            <li><a href="<?php echo $path;?>//reports/report2.php"><i class="fa fa-circle-o"></i>Payment Report </a></li>
            <li><a href="<?php echo $path;?>//reports/stocklist.php"><i class="fa fa-circle-o"></i>Stocklist Report </a></li>
            <li><a href="<?php echo $path;?>//reports/stockmove.php"><i class="fa fa-circle-o"></i>Stock Movement </a></li>
            <li><a href="<?php echo $path;?>/reports/porder_report.php"><i class="fa fa-circle-o"></i>Purchase Report</a></li>
            <li><a href="<?php echo $path;?>/reports/group_report.php"><i class="fa fa-circle-o"></i>Sales by Class</a></li>
	    <li><a href="<?php echo $path;?>/reports/stock_report.php"><i class="fa fa-circle-o"></i>Stock Sales</a></li>	
            <li><a href="<?php echo $path;?>/reports/stock_report2.php"><i class="fa fa-circle-o"></i>Stock Diary</a></li>
            <li><a href="<?php echo $path;?>/reports/stocklist.php"><i class="fa fa-circle-o"></i>Stock Values</a></li>
      <li><a href="<?php echo $path;?>/reports/stocklist_zero.php"><i class="fa fa-circle-o"></i>Zero Stock</a></li>
      <li><a href="<?php echo $path;?>/reports/stocklist_minus.php"><i class="fa fa-circle-o"></i>Minus Stock</a></li>

            <li><a href="<?php echo $path;?>//reports/stock_report.php"><i class="fa fa-circle-o"></i>
            Stock Report </a></li>
          </ul>
        </li>

        
                 

	     
	  
    
    <!-- /.sidebar -->
  </aside>
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
</li>
</li>
</ul>
</section>
</aside>
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
<!-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<!-- <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
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


</html>