<?php
session_start();
include('config/config.php');
//login 
if (isset($_POST['login'])) {
  $admin_email = $_POST['admin_email'];
  $admin_password = sha1(md5($_POST['admin_password'])); //double encrypt to increase security
  $stmt = $mysqli->prepare("SELECT admin_email, admin_password, admin_id FROM rpos_admin WHERE (admin_email =? AND admin_password =?)"); //sql to log in user
  $stmt->bind_param('ss', $admin_email, $admin_password); //bind fetched parameters
  $stmt->execute(); //execute bind 
  $stmt->bind_result($admin_email, $admin_password, $admin_id); //bind result
  $rs = $stmt->fetch();
  $_SESSION['admin_id'] = $admin_id;
  if ($rs) {
    //if it's successful
    header("location:dashboard.php");
  } else {
    $err = "Incorrect Authentication Credentials";
  }
}
require_once('partials/_head.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      background-color: #E5E5E5;
    }
    .heading {
      font-size: 28px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-weight: bolder;
      color: black;
    }
    .card-heading {
      text-align: center;
      font-weight: 700;
      font-size: 20px;
      padding: 5px 0;
      color: blue;
      margin-bottom:10px;
    }
    .admin-login-heading {
      font-size: 20px;
      font-weight: 800;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="main-content">
    <div class="header bg-primary py-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="heading fw-bold text-white">Grocery Sales Management</h1>
              <h2 class="admin-login-heading text-white">ADMIN LOGIN</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-white shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="card-heading">Enter your email and password:</div>
              <form method="post" role="form">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input class="form-control p-2" required name="admin_email" placeholder="Enter Email" type="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input class="form-control p-2" required name="admin_password" placeholder="Enter Password" type="password">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember Me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" name="login" class="btn btn-primary my-4">Log In</button>
                  <a href="reset_pwd.php" class="btn btn-link">Forgot Password?</a>
                </div>
              </form>
              <?php if (isset($err)) { echo "<div class='alert alert-danger'>$err</div>"; } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php require_once('partials/_footer.php'); ?>
  <!-- Argon Scripts -->
  <?php require_once('partials/_scripts.php'); ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
