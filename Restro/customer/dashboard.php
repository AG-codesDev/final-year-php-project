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
      justify-content: center;
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
    .logo-money{
      background-color:cyan ;
      border-radius:100%;
      padding: 15px;
      
    }
    .logo-orders{
      background-color:yellow ;
      border-radius:100%;
      padding: 15px;
      
    }
    .logo-items{
      background-color:greenyellow  ;
      border-radius:100%;
      padding: 15px;
      
    }
    .numbers{
      font-weight: 900;
    }
    thead{
      background-color:black;
    }

    </style>
  </head>
<body class="bg-dark">
  <!-- Sidenav -->
  <?php
  require_once('partials/_sidebar.php');
  ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php
    require_once('partials/_topnav.php');
    ?>
    <!-- Header -->
    <div style="background-image: url(https://media.istockphoto.com/id/656453072/photo/vintage-retro-grungy-background-design-and-pattern-texture.jpg?s=612x612&w=0&k=20&c=PiX0bt3N6Hqk7yO7g52FWCunpjqm_9LhjRA2gkbl5z8=); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
      <span class="mask opacity-8"></span>
      <div class="">
        <div class="header-body">
          <!-- Card stats -->

          <div class="card-container">
            <div class="single-card">
            <div class="inside-card">
              <span class="">AVAILABLE ITEMS</span>
              <span class="numbers numbers"><?php echo $products; ?></span>
            </div>
            <div class="logo-items">
            <i class="fas fa-utensils"></i>
            </div>
            </div>
            <div class="single-card">
            <div class="inside-card">
              <span class="">ORDERS</span>
              <span class="numbers numbers"><?php echo $orders; ?></span>
            </div>
            <div class="logo-orders">
            <i class="fas fa-shopping-cart"></i>
            </div>
            </div>
            <div class="single-card">
            <div class="inside-card">
              <span class="">Total Money Spend</span>
              <span class="numbers numbers"><?php echo $products; ?></span>
            </div>
            <div class="logo-money">
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
                  <tr class="">
                    <th class="text-secondary" scope="col">Code</th>
                    <th scope="col" class="text-secondary">Customer</th>
                    <th class="text-secondary" scope="col">Product</th>
                    <th scope="col" class="text-secondary">Unit Price</th>
                    <th class="text-secondary" scope="col">#</th>
                    <th scope="col" class="text-secondary">Total Price</th>
                    <th scop="co" class="text-secondary">Status</th>
                    <th class="text-secondary" scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $customer_id = $_SESSION['customer_id'];
                  $ret = "SELECT * FROM  rpos_orders WHERE customer_id = '$customer_id' ORDER BY `rpos_orders`.`created_at` DESC LIMIT 10 ";
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
                      <td><?php if ($order->order_status == '') {
                            echo "<span class='badge badge-danger text-secondary'>Not Paid</span>";
                          } else {
                            echo "<span class='badge badge-success text-secondary'>$order->order_status</span>";
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
                  <h3 class="mb-0">My Recent Payments</h3>
                </div>
                <div class="col text-right">
                  <a href="payments_reports.php" class="btn btn-sm btn-danger">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table bg-dark align-items-center table-flush">
                <thead class="">
                  <tr>
                    <th class="text-secondary" scope="col">Code</th>
                    <th scope="col" class="text-light">Amount</th>
                    <th class='text-secondary' scope="col">Order Code</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM   rpos_payments WHERE customer_id ='$customer_id'   ORDER BY `rpos_payments`.`created_at` DESC LIMIT 10 ";
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