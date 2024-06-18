<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');
?>
<html>
  <head>
    <style>
      .thead{
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
        <div style="background-image: url(../admin/assets/img/theme/grocery-bg-2.jpg); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
        <span class=" bg-gradient-dark"></span>
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class=" mt--8">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header bg-info text-dark border-0">
                            Orders Records
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead">
                                    <tr>
                                        <th class="text-secondary" scope="col">Code</th>
                                        <th scope="col" class="text-light">Customer</th>
                                        <th class="text-secondary" scope="col">Product</th>
                                        <th scope="col" class="text-light">Unit Price</th>
                                        <th class="text-secondary" scope="col">#</th>
                                        <th scope="col" class="text-light">Total Price</th>
                                        <th scop="col" class="text-light">Status</th>
                                        <th class="text-secondary" scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  rpos_orders ORDER BY `created_at` DESC  ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($order = $res->fetch_object()) {
                                        $total = ($order->prod_price * $order->prod_qty);

                                    ?>
                                        <tr class="bg-dark text-light">
                                            <th class="text-secondary" scope="row"><?php echo $order->order_code; ?></th>
                                            <td><?php echo $order->customer_name; ?></td>
                                            <td class="text-secondary"><?php echo $order->prod_name; ?></td>
                                            <td>₹ <?php echo $order->prod_price; ?></td>
                                            <td class="text-secondary"><?php echo $order->prod_qty; ?></td>
                                            <td>₹ <?php echo $total; ?></td>
                                            <td><?php if ($order->order_status == '') {
                                                    echo "<span class='badge badge-danger'>Not Paid</span>";
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
            <!-- Footer -->
            <?php
            require_once('partials/_footer.php');
            ?>
        </div>
    </div>
    <!-- Argon Scripts -->
    <?php
    require_once('partials/_scripts.php');
    ?>
</body>

</html>