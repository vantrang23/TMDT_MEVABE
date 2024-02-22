<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./../">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>QUẢN TRỊ CHỈNH SỬA NGƯỜI DÙNG</title>
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/add_user.css">
  <link rel="stylesheet" href="css/vendors/edit.css">
  <link rel="stylesheet" href="css/vendors/color.css">
  <link href="css/style.css" rel="stylesheet">

  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/accordion/">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    div#sidebar {
      background-color: #000044;
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
        <li class="breadcrumb-item">
          <!-- if breadcrumb is single--><a href="#">CHỈNH SỬA</a>
        </li>
        <li class="breadcrumb-item active"><span>Chỉnh sửa người dùng</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header"><strong>CHỈNH SỬA NGƯỜI DÙNG</strong></div>
            <div class="card-body">

              <div class="example">

                <div class="tab-content rounded-bottom " id="bgg">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <div class="background-blur">
                      <div id="form-container" class="form-slide">
                        <form action="user/edit.php  " id="form-login" method="POST">

                          <input type="hidden" name="iduser" value="<?php echo $iduser; ?>">
                          <table id="table_edit">

                            <tr>
                              <td>Tài khoản:</td>
                              <td><input type="text" name="username" value="<?php echo $user['username']; ?>"></td>
                            </tr>
                            <tr>
                              <td>Quyền:</td>
                              <td><input type="text" name="username" value="<?php echo $user['role']; ?>"></td>
                            </tr>

                            <tr>
                              <td>Họ và tên:</td>
                              <td><input type="text" name="fullname" value="<?php echo $user['fullname']; ?>"></td>
                            </tr>

                            <tr>
                              <td>Email:</td>
                              <td><input type="email" name="email" value="<?php echo $user['email']; ?>"></td>
                            </tr>
                            <tr>
                              <td>Mở/ Khóa tài khoản: </td>
                              <td><input type="checkbox" name="status" <?php echo ($user['status'] == 1) ? 'checked="checked"' : ''; ?>></td>
                            </tr>
                            <tr>
                              <td colspan=2 class="button-container">
                                <input type="submit" value="OK" class="form-submit" name="edit">
                                <input type="submit" value="Hủy" class="form-submit" name="huy">

                              </td>
                            </tr>


                          </table>
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