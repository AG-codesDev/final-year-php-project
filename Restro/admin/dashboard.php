<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');
require_once('partials/_analytics.php');
?>
<html>
  <head>
   <style>
    .card-container{
      display: flex;
      margin: auto;
      /* border: 2px solid white; */
      align-items: center;
      justify-content: space-between;
      width: 50%;
      flex-wrap: wrap;
      gap: 20px;
      
      
    }

    .single-card{
      background-color: white;
      padding: 15px;
      border-radius: none;
      display: flex;
      gap: 15px;
      color: black;
      justify-content: space-between;
      align-items: center;
      border-radius: 5px;
      font-size: 17px;
      width: 15rem;
    }
    .inside-card{
      display: flex;
      flex-direction: column;
    }
    .logo-products{
      background-color:greenyellow ;
      border-radius:100%;
      padding: 15px;
    }
    .logo-customer{
      background-color:yellow ;
      border-radius:100%;
      padding: 15px;
    }
    .logo-orders{
      background-color:red ;
      border-radius:100%;
      padding: 15px;
    }
    .logo-sales{
      background-color:cyan ;
      border-radius:100%;
      padding: 15px;
      
    }
    .numbers{
      font-weight: 900;
      
    }
    thead{
      background-color:black;
    }
    .main-content{
      background-color:white;
    }
   
 
    </style>
  </head>
<body class="bg-dark">
  <!-- Sidenav -->
  <?php
  require_once('partials/_sidebar.php');
  ?>
  <!-- Main content -->
  <div class="main-content bg-dark">
    <!-- Top navbar -->
    <?php
    require_once('partials/_topnav.php');
    ?>
    <!-- Header -->
    <div style="background-image: url(assets/img/theme/grocery-bg-2.jpg); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
      <span class="mask opacity-8"></span>
      <div class="">
        <div class="header-body">
          <!-- Card stats -->

        <div class="card-container">

          <div class="single-card">
            <div class="inside-card">
              <span class="">CUSTOMERS</span>
              <span class="numbers"><?php echo $customers; ?></span>
            </div>
            <div class="logo-customer">
            <i class="fas fa-users"></i>
            </div>
          </div>

          <div class="single-card">
            <div class="inside-card">
              <span>PRODUCTS</span>
              <span class="numbers"><?php echo $products; ?></span>
            </div>
            <div class="logo-products">
            <i class="fas fa-utensils"></i>
            </div>
          </div>

          <div class="single-card">
            <div class="inside-card">
              <span>ORDERS</span>
              <span class="numbers"><?php echo $orders; ?></span>
            </div>
            <div class="logo-orders">
            <i class="fas fa-shopping-cart"></i>
            </div>
          </div>

          <div class="single-card">
            <div class="inside-card">
              <span>SALES</span>
              <span class="numbers"><?php echo $sales; ?></span>
            </div>
            <div class="logo-sales">
            <i class="fas fa-rupee-sign"></i>
            </div>
          </div>

        </div>

        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="">
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header bg-info border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Recent Orders</h3>
                </div>
                <div class="col text-right">
                  <a href="orders_reports.php" class="btn btn-sm btn-danger">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table bg-dark align-items-center table-flush">
                <thead class="">
                  <tr class="table-heading">
                    <th class="text-secondary" scope="col"><b>Code</b></th>
                    <th scope="col"><b class="text-light">Customer</b></th>
                    <th class="text-secondary" scope="col"><b class="">Product</b></th>
                    <th scope="col"><b class="text-light">Unit Price</b></th>
                    <th class="text-secondary" scope="col"><b>Qty</b></th>
                    <th scope="col"><b class="text-light">Total</b></th>
                    <th scop="col"><b class="text-light">Status</b></th>
                    <th class="text-secondary" scope="col"><b>Date</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  rpos_orders ORDER BY `rpos_orders`.`created_at` DESC LIMIT 7 ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($order = $res->fetch_object()) {
                    $total = ($order->prod_price * $order->prod_qty);

                  ?>
                    <tr>
                      <th class="text-secondary" scope="row"><?php echo $order->order_code; ?></th>
                      <td class="text-light"><?php echo $order->customer_name; ?></td>
                      <td class="text-secondary"><?php echo $order->prod_name; ?></td>
                      <td class="text-light">₹<?php echo $order->prod_price; ?></td>
                      <td class="text-secondary"><?php echo $order->prod_qty; ?></td>
                      <td class="text-light">₹<?php echo $total; ?></td>
                      <td class="text-secondary"><?php if ($order->order_status == '') {
                            echo "<span class='badge text-white badge-danger'>Not Paid</span>";
                          } else {
                            echo "<span class='badge text-white badge-success'>$order->order_status</span>";
                          } ?></td>
                      <td class="text-secondary"><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-xl-12">
          <div class="card shadow">
            <div class="card-header bg-info border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Recent Payments</h3>
                </div>
                <div class="col text-right">
                  <a href="payments_reports.php" class="btn btn-sm btn-danger">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table bg-dark align-items-center table-flush">
                <thead class="thead-secondary">
                  <tr>
                    <th class="text-secondary" scope="col"><b>Code</b></th>
                    <th scope="col"><b class="text-light">Amount</b></th>
                    <th class='text-secondary' scope="col"><b>Order Code</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM   rpos_payments   ORDER BY `rpos_payments`.`created_at` DESC LIMIT 7 ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($payment = $res->fetch_object()) {
                  ?>
                    <tr>
                      <th class="text-secondary" scope="row">
                        <?php echo $payment->pay_code; ?>
                      </th>
                      <td class="text-light">
                        ₹<?php echo $payment->pay_amt; ?>
                      </td>
                      <td class='text-secondary'>
                        <?php echo $payment->order_code; ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php require_once('partials/_footer.php'); ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>
</html>