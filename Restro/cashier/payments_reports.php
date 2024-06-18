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
        <div style="background-image: url(https://media.istockphoto.com/id/656453072/photo/vintage-retro-grungy-background-design-and-pattern-texture.jpg?s=612x612&w=0&k=20&c=PiX0bt3N6Hqk7yO7g52FWCunpjqm_9LhjRA2gkbl5z8=); background-size: cover;" class="header  pb-8 pt-5 pt-md-8">
        <span class=""></span>
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
                        <div class="card-header bg-warning text-dark border-0">
                            Payment Reports
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead">
                                    <tr>
                                        <th class="text-secondary" scope="col">Payment Code</th>
                                        <th scope="col" class="text-light">Payment Method</th>
                                        <th class="text-secondary" scope="col">Order Code</th>
                                        <th scope="col" class="text-light">Amount Paid</th>
                                        <th class="text-secondary" scope="col">Date Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  rpos_payments ORDER BY `created_at` DESC ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($payment = $res->fetch_object()) {
                                    ?>
                                        <tr class="bg-dark">
                                            <th class="text-secondary" scope="row">
                                                <?php echo $payment->pay_code; ?>
                                            </th>
                                            <th scope="row" class="text-light">
                                                <?php echo $payment->pay_method; ?>
                                            </th>
                                            <td class="text-secondary">
                                                <?php echo $payment->order_code; ?>
                                            </td>
                                            <td class="text-light">
                                                ₹ <?php echo $payment->pay_amt; ?>
                                            </td>
                                            <td class="text-secondary">
                                                <?php echo date('d/M/Y g:i', strtotime($payment->created_at)) ?>
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