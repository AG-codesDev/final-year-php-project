<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
if (isset($_POST['addProduct'])) {
  //Prevent Posting Blank Values
  if (empty($_POST["prod_code"]) || empty($_POST["prod_name"]) || empty($_POST['prod_desc']) || empty($_POST['prod_price'])) {
    $err = "Blank Values Not Accepted";
  } else {
    $prod_id = $_POST['prod_id'];
    $prod_code  = $_POST['prod_code'];
    $prod_name = $_POST['prod_name'];
    $prod_img = $_FILES['prod_img']['name'];
    move_uploaded_file($_FILES["prod_img"]["tmp_name"], "assets/img/products/" . $_FILES["prod_img"]["name"]);
    $prod_desc = $_POST['prod_desc'];
    $prod_price = $_POST['prod_price'];
	
    //Insert Captured information to a database table
    $postQuery = "INSERT INTO rpos_products (prod_id, prod_code, prod_name, prod_img, prod_desc, prod_price ) VALUES(?,?,?,?,?,?)";
    $postStmt = $mysqli->prepare($postQuery);
    //bind paramaters
    $rc = $postStmt->bind_param('ssssss', $prod_id, $prod_code, $prod_name, $prod_img, $prod_desc, $prod_price);
    $postStmt->execute();
    //declare a varible which will be passed to alert function
    if ($postStmt) {
      $success = "Product Added" && header("refresh:1; url=add_product.php");
    } else {
      $err = "Please Try Again Or Try Later";
    }
  }
}
require_once('partials/_head.php');
?>

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
          <div class="card bg-dark shadow">
            <div class="card-header bg-warning border-0">
              <h3>Please Fill All Fields</h3>
            </div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-6">
                    <label class="text-secondary">Product Name</label>
                    <input type="text" name="prod_name" class="form-control  bg-dark text-secondary">
                    <input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>" class="form-control  bg-dark text-secondary">
                  </div>
                  <div class="col-md-6">
                    <label class="text-secondary">Product Code</label>
                    <input type="text" name="prod_code" value="<?php echo $alpha; ?>-<?php echo $beta; ?>" class="form-control bg-dark text-secondary" value="">
                  </div>
                </div>
                <hr>
                <div class="form-row">
                  <div class="col-md-6">
                    <label class="text-secondary">Product Image</label>
                    <input type="file" name="prod_img" class="btn btn-outline-success form-control bg-dark text-secondary" value="">
                  </div>
                  <div class="col-md-6">
                    <label class="text-secondary">Product Price</label>
                    <input type="text" name="prod_price" class="form-control bg-dark text-secondary" value="">
                  </div>
                </div>
                <hr>
                <div class="form-row">
                  <div class="col-md-12">
                    <label class="text-secondary">Product Description</label>
                    <textarea rows="5" name="prod_desc" class="form-control  bg-dark text-secondary" value=""></textarea>
                  </div>
                </div>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="addProduct" value="Add Product" class="btn btn-danger" value="">
                  </div>
                </div>
              </form>
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