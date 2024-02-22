<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./../">
  <meta charset="utf-8">
  <title>QUẢN TRỊ THÊM NGƯỜI DÙNG</title>
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <link rel="stylesheet" href="css/vendors/add_user.css">
  <link rel="stylesheet" href="css/vendors/color.css">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/accordion/">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../../template/admin/js/delete.js"></script>
  <style>
    .example .tab-content {
      background-color: #f9fafa00 !important;
    }

    select {
      word-wrap: normal;
      margin-left: -40px;
    }

    .sidebar-nav .nav-link {
      display: flex;
      flex: 1;
      align-items: center;
      padding: var(--cui-sidebar-nav-link-padding-y) var(--cui-sidebar-nav-link-padding-x);
      color: rgb(255 255 255);
      text-decoration: none;
      white-space: nowrap;
      background: var(--cui-sidebar-nav-link-bg);
      border: var(--cui-sidebar-nav-link-border);
      border-radius: var(--cui-sidebar-nav-link-border-radius);
      transition: background 0.15s ease, color 0.15s ease;
    }

    div#sidebar {
      background-color: #000044;
    }

    .form-submit {
      width: 22%;
      padding: 10px;
      background-color: #00004499;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: px;
    }

    .form-submit:hover {
      background-color: #000044eb;
    }

    .card.mb-4 {
      height: 600px;
    }
  </style>
</head>

<body>
  <?php
  $fullname = $_SESSION['fullname'];
  require '../header.php';
  ?>
  <div class="header-divider"></div>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <!-- if breadcrumb is single--><a href="#">MEVABE</a>
        </li>
        <li class="breadcrumb-item">
          <!-- if breadcrumb is single--><a href="#">NGƯỜI DÙNG</a>
        </li>
        <li class="breadcrumb-item active"><span>Thêm người dùng</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header"><strong style="font-size: 27px;">THÊM NGƯỜI DÙNG</strong></div>
            <div class="card-body">

              <div class="example">

                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <form action="user/add.php" id="form-login" method="POST">
                      <?php if (isset($_SESSION['success'])) : ?>
                        <script>
                          Swal.fire(
                            'THÊM THÀNH CÔNG',
                            '',
                            'success'
                          )
                        </script>';
                        <?php unset($_SESSION['success']); ?>
                      <?php endif; ?>
                      <div class="form-group">
                        <label for="" id="tieude">Tên đăng nhập: </label>
                        <input type="text" class="form-input" name="username" required>
                      </div>

                      <div class="form-group">
                        <label for="" id="tieude">Email: </label>
                        <input type="email" class="form-input" name="email" required>
                      </div>

                      <div class="form-group">
                        <label for="" id="tieude">Họ và tên: </label>
                        <input type="text" class="form-input" name="fullname" required>
                      </div>

                      <div class="form-group">
                        <label for="" id="tieude">Mật khẩu: </label>
                        <input type="password" class="form-input" id="pass" name="pass" required>
                        <div id="eye">
                          <!-- <i class="far fa-eye"></i> -->
                          <span><i class="fa fa-eye-slash" onclick="showHidden()"></i></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="" id="tieude">Nhập lại mật khẩu: </label>
                        <input type="password" class="form-input" id="pass" name="passagain" required>
                        <div id="eye">
                          <!-- <i class="far fa-eye"></i> -->
                          <span><i class="fa fa-eye-slash" onclick="showHidden()"></i></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="" id="tieude">Phân quyền: </label>
                        <select name="role" id="cars">
                          <option value="khach">Khách</option>
                          <option value="admin">Nhân viên</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="status" id="trangthai">Trạng thái: </label>
                        <input type="checkbox" name="status" value="1">
                      </div>
                      <div id="button_add">
                        <input type="submit" value="Thêm" class="form-submit" name="them">
                        <input type="reset" value="Hủy" class="form-submit" name="huy">
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require '../footer.php'; ?>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <script>
  </script>

</body>

</html>