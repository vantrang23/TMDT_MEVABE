
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>XÁC MINH TÀI KHOẢN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .card.shadow-sm {
    /* width: 500px; */
    padding: 14px;
}
button.btn.btn-primary {
    width: 199px;
    text-align: center;
    margin-left: 90px;
}
span {
    margin-left: -1px;
    text-align: center;
}
    </style>
  </head>

  <body>
    <?php
      // require '../../../front/header.php';
    ?>
    <div class="container d-flex flex-column">
      <div class="row align-items-center justify-content-center
          min-vh-100">
        <div class="col-12 col-md-8 col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h5>XÁC MINH TÀI KHOẢN</h5>
                <p class="mb-2">Nhập Email đã đăng ký để xác minh tài khoản
                </p>
              </div>
              <form method="POST" action="xacminh.php">
                    <?php if (isset($_SESSION['loi'])):?>
                      <div  class="alert alert-danger">Email đã nhập chưa đăng ký tài khoản!</div>
                    <?php unset($_SESSION['loi']);?>
                    <?php endif;?>
                  <!-- <label f or="email" class="form-label">Email</label> -->
                  <input type="email" id="email" class="form-control" name="email" placeholder=" Email"
                    required="">
                </div>
                <div class="mb-3 d-grid">
                  <button type="submit" class="btn btn-primary" name="submit">
                    XÁC MINH
                  </button>
                </div>
                <span>Bạn chưa có tài khoản?<a href="../register.php">Đăng ký</a></span>
                <br>
                <span>Quay về đăng nhập?<a href="../login.php">Đăng nhập</a></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>