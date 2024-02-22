<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
  <link rel="stylesheet" href="../css/vendors/login.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <title>FORM ĐĂNG NHẬP</title>
</head>
<body>

<div id="wrapper">
  <form action="login.php" name="login" id="form-login" method="POST">
    <?php
      // Your PHP logic for error handling and success messages
    ?>
    <h1 class="form-heading">ĐĂNG NHẬP</h1>
    <div class="form-group">
      <i class="far fa-user"></i>
      <input type="text" class="form-input" id="username" placeholder="Tên đăng nhập" name="username" required>
    </div>
    <div class="form-group">
      <i class="fas fa-key"></i>
      <input type="password" class="form-input" id="password" placeholder="Mật khẩu" name="password" required>
      <span id="eye" class="password-toggle">
        <i class="fa fa-eye"></i>
      </span>
    </div>
    <input type="submit" value="Đăng nhập" class="form-submit" id="btn_login" name="btn_login">
    <div class="mb-1">
      <a href="../user/PHPMailer-master/forget_password.php">Quên mật khẩu?</a>
    </div>
    <div class="mb-0">
      <p>Chưa có tài khoản?
        <a href="register.php" class="text-white-50 fw-bold"> Đăng ký</a>
      </p>
    </div>
    <?php if (isset($_SESSION['open'])) { ?>
      <a href="../user/PHPMailer-master/xacminh.php" class="text-white-50 fw-bold"> Xác minh tài khoản</a>
    <?php } ?>
  </form>
</div>

<script>
$(document).ready(function() {
  // Show/hide password
  $(".password-toggle").click(function() {
    $(this).find("i").toggleClass("fa-eye fa-eye-slash");
    $("#password").attr("type", $("#password").attr("type") === "password" ? "text" : "password");
  });
});
</script>

</body>
</html>
