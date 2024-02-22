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
  <title>QUẢN TRỊ CHỈNH SỬA HÌNH ẢNH</title>
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/add_user.css">
  <link rel="stylesheet" href="css/vendors/edit.css">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/accordion/">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="css/vendors/color.css">
  <style>
    div#sidebar {
      background-color: #000044;
    }

    div#bgg {
      width: 1093px;
      margin-left: 10px;
    }

    #wrapper {
      background-color: rgb(21 12 0 / 0%);
      padding: 8px;
      /* border-radius: 5px; */
      box-shadow: 0 0 10px rgb(0 0 0 / 0%);
      text-align: center;
      max-width: 817px;
      width: 100%;
      margin-left: auto;
      margin-right: auto;
      margin-top: -2px;
      height: auto;
    }

    label {
      font-size: 19px;
      width: 146px;
    }

    input[type="text"] {
      margin: 0px;
    }

    input.form-input {
      height: 41px;
      font-size: 17px;
      margin-left: 23px;
    }

    select.form-input {
      height: 39px;
      font-size: 19px;
      padding: 4px;
    }

    form#form-login {
      text-align: justify;
    }

    input.form-submit {
      margin-left: 210px;
      margin-top: -19px;
    }

    input.form-submit {
      width: 96px;
      height: 34px;
      /* text-align: center; */
      padding: inherit;
    }

    div#edit {
      margin: 4px 88px;
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

    button.header-toggler.px-md-0.me-md-3 {
      margin-left: -245px;
    }
  </style>
  <style>
    div#bgg {
      width: 1018px;
      margin-left: 10px;
    }

    div#preview-1000 {
      background: white;
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
          <!-- if breadcrumb is single--><a href="#">HÌNH ẢNH</a>
        </li>
        <li class="breadcrumb-item">
          <!-- if breadcrumb is single--><a href="#">CHỈNH SỬA</a>
        </li>
        <li class="breadcrumb-item active"><span>Chỉnh sửa hình ảnh</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <!-- <div class="card-header"><strong>CHỈNH SỬA SẢN PHẨM</strong></div> -->
            <div class="card-body">

              <div class="example">

                <div class="tab-content rounded-bottom " id="bgg">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <div id="wrapper">
                      <!-- <form  action="product/edit.php" id="form-login" method="POST" > -->
                      <form action="banner/edit.php" id="form-login" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="id_banner" value="<?php echo $id_banner; ?>">


                        <div class="form-group">
                          <label>Hình ảnh:</label>
                          <input type="file" name="image" class="form-input hinhanh">
                        </div>

                        <div id="edit">

                          <input type="submit" value="Thay đổi" class="form-submit" name="edit">
                          <input type="submit" value="Hủy" class="form-submit" name="huy">

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