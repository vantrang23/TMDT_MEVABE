<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./../">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>QUẢN TRỊ THÊM NGƯỜI DÙNG</title>
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <link rel="stylesheet" href="css/vendors/add_category.css">
  <link rel="stylesheet" href="css/vendors/add-category.css">
  <link rel="stylesheet" href="css/vendors/color.css">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/accordion/">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../../template/admin/js/delete.js"></script>
  <style>
    div#sidebar {
      background-color: #000044;
    }

    .example .tab-content {
      background-color: #f9fafa00 !important;
    }

    #wrapper {
      background-color: #f9fafa00;
      padding: 20px;
      border-radius: 5px;
      /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
      text-align: center;
      max-width: 700px;
      width: 100%;
      margin-left: auto;
      margin-right: auto;
      margin-top: 7px;
      height: auto;
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

    .card.mb-4 {
      height: 360px;
    }

    label {
      margin-left: -21px;
    }

    input.form-input.hinhanh {
      font-size: 14px;
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
            <div class="card-header"><strong>THÊM DANH MỤC SẢN PHẨM</strong></div>
            <div class="card-body">

              <div class="example">

                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <div id="wrapper">
                      <form action="category/add.php" id="form-login" method="POST" enctype="multipart/form-data">
                        <?php if (isset($_SESSION['danhmuc'])) : ?>
                          <script>
                            Swal.fire(
                              'Thêm thành công',
                              '',
                              'success'
                            )
                          </script>';
                          <?php unset($_SESSION['danhmuc']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['trung'])) : ?>
                          <script>
                            Swal.fire(
                              'Tên danh mục bị trùng',
                              '',
                              'success'
                            )
                          </script>';
                          <?php unset($_SESSION['trung']); ?>
                        <?php endif; ?>
                        <!-- <h1 class="form-heading">THÊM DANH MỤC SẢN PHẨM</h1> -->
                        <div class="form-group">
                          <label for="">Tên danh mục: </label>
                          <input type="text" class="form-input" name="name" required>
                        </div>
                        <div class="form-group">
                          <label for="status" id="trangthai">Trạng thái: </label>
                          <input type="checkbox" name="status" value="1">
                        </div>
                        <div class="form-group">
                          <label style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Hình ảnh:</label>
                          <input type="file" name="image" class="form-input hinhanh" value="">

                        </div>
                        <input type="submit" value="Thêm" class="form-submit" name="them">
                        <input type="reset" value="Hủy" class="form-submit" name="huy">


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
  <?php require '../footer.php'; ?>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <script>
  </script>

</body>

</html>