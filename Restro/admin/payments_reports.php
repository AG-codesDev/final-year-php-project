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
    <!-- Sidenav --><!-- For more projects: Visit codeastro.com  -->
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
                            Payment Reports
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead text-secondary">
                                    <tr>
                                        <th class="text-light" scope="col">Payment Code</th>
                                        <th scope="col">Payment Method</th>
                                        <th class="text-light" scope="col">Order Code</th>
                                        <th scope="col">Amount Paid</th>
                                        <th class="text-light" scope="col">Date Paid</th>
                                    </tr>
                                </thead><!-- For more projects: Visit codeastro.com  -->
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  rpos_payments ORDER BY `created_at` DESC ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($payment = $res->fetch_object()) {
                                    ?>
                                        <tr class="bg-dark text-secondary">
                                            <th class="text-light" scope="row">
                                                <?php echo $payment->pay_code; ?>
                                            </th>
                                            <th scope="row">
                                                <?php echo $payment->pay_method; ?>
                                            </th>
                                            <td class="text-light">
                                                <?php echo $payment->order_code; ?>
                                            </td>
                                            <td>
                                                $ <?php echo $payment->pay_amt; ?>
                                            </td>
                                            <td class="text-light">
                                                <?php echo date('d/M/Y g:i', strtotime($payment->created_at)) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody><!-- For more projects: Visit codeastro.com  -->
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
<!-- For more projects: Visit codeastro.com  -->
</html>