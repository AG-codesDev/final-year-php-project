<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
require_once('partials/_head.php');
?>

<head>
   <style>

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
        <span class="mask"></span>
            <div class="">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="mt--8">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header bg-warning text-dark border-0">
                            Orders Records
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="">
                                    <tr class="">
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
                                <tbody class="bg-dark">
                                    <?php
                                    $customer_id = $_SESSION['customer_id'];
                                    $ret = "SELECT * FROM  rpos_orders WHERE customer_id ='$customer_id' ORDER BY `created_at` DESC  ";
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
                                            <td class="text-light">₹ <?php echo $order->prod_price; ?></td>
                                            <td class="text-secondary"><?php echo $order->prod_qty; ?></td>
                                            <td class="text-light">₹ <?php echo $total; ?></td>
                                            <td><?php if ($order->order_status == '') {
                                                    echo "<span class='badge text-white badge-danger'>Not Paid</span>";
                                                } else {
                                                    echo "<span class='badge badge-success text-white'>$order->order_status</span>";
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