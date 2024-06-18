<?php
require_once('config/config.php');

if (isset($_POST['reset_password'])) {
    $reset_email = $_POST['reset_email'];
    $new_password = sha1(md5($_POST['new_password']));

    // Check if the email exists in the admin table
    $stmt = $mysqli->prepare("SELECT admin_email FROM rpos_admin WHERE admin_email = ?");
    $stmt->bind_param('s', $reset_email);
    $stmt->execute();
    $stmt->bind_result($admin_email);
    $stmt->fetch();
    $stmt->close();

    if ($admin_email) {
        // Update the password
        $stmt = $mysqli->prepare("UPDATE rpos_admin SET admin_password = ? WHERE admin_email = ?");
        $stmt->bind_param('ss', $new_password, $reset_email);
        $stmt->execute();
        $stmt->close();
        
        $msg = "Your password has been reset successfully.";
    } else {
        $err = "Email address not found.";
    }
}
require_once('partials/_head.php');
?>
<html>
<head>
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
        }
        input {
            border: 0;
            width: 310px;
            padding: 10px;
        }
        input:focus {
            outline: none;
        }
        .login {
            background-color: yellow;
            padding: 9px;
            border-radius: 10px;
            border: none;
        }
        .admin-login-heading {
            font-size: 20px;
            font-weight: 800;
            margin-top: 20px;
        }
        .form-container {
            margin: auto;
            width: 50%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="heading">Reset Password</h2>
        <?php if (isset($msg)) { echo "<div class='alert alert-success'>$msg</div>"; } ?>
        <?php if (isset($err)) { echo "<div class='alert alert-danger'>$err</div>"; } ?>
        <form method="post">
            <div class="form-group">
                <label for="reset_email">Enter your email address:</label>
                <input type="email" name="reset_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">Enter your new password:</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <button type="submit" name="reset_password" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
</body>
</html>
