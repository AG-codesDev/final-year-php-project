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
              Select On Any Product To Make An Order
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead text-secondary">
                  <tr>
                    <th scope="col"><b>Image</b></th>
                    <th scope="col"><b>Product Code</b></th>
                    <th scope="col"><b>Name</b></th>
                    <th scope="col"><b>Price</b></th>
                    <th scope="col"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  rpos_products ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($prod = $res->fetch_object()) {
                  ?>
                    <tr class="bg-dark text-secondary">
                      <td>
                        <?php
                        if ($prod->prod_img) {
                          echo "<img src='assets/img/products/$prod->prod_img' height='60' width='60 class='img-thumbnail'>";
                        } else {
                          echo "<img src='assets/img/products/default.jpg' height='60' width='60 class='img-thumbnail'>";
                        }

                        ?>
                      </td>
                      <td><?php echo $prod->prod_code; ?></td>
                      <td><?php echo $prod->prod_name; ?></td>
                      <td>₹ <?php echo $prod->prod_price; ?></td>
                      <td>
                        <a href="make_oder.php?prod_id=<?php echo $prod->prod_id; ?>&prod_name=<?php echo $prod->prod_name; ?>&prod_price=<?php echo $prod->prod_price; ?>">
                          <button class="btn btn-sm btn-warning">
                            <i class="fas fa-cart-plus"></i>
                            Place Order
                          </button>
                        </a>
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