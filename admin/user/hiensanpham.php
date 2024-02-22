<?php
session_start();
require '../../libraries/connect.php';
require '../../models/user.php';
// $name_cate=$_SESSION['danhmuc'];

$product_id = $_GET['category_id'];
$product_list = get_product_active_list($product_id, $conn);

if (isset($_POST['oke'])) {
  header('location: addkhuyenmai.php');
  exit;
}


if (isset($_POST['huy'])) {
  header('location: khuyenmai.php');
  // exit;
}

// require 'hiendanhmuc.php'
?>

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
  <title>QUẢN TRỊ THÊM NGƯỜI DÙNG</title>

  <!-- Vendors styles-->
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <link rel="stylesheet" href="css/vendors/add_user.css">
  <link rel="stylesheet" href="css/vendors/color.css">
  <!-- Main styles for this application-->
  <link href="css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/accordion/">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../../template/admin/js/delete.js"></script>
  <style>
    div#sidebar {
      background-color: #000044;
    }

    #dialog {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background: #fff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      height: 200px;
      width: 500px;
      background: gainsboro;
      margin: 0px 136px;

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

    #selectOption {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }

    button#okButton {
      width: 77px;
      background: #FF99CC;
    }

    button#cancelButton {
      width: 77px;
      background: #FF99CC;
    }

    div#butt {
      padding: 20px 150px;
    }

    .form-input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 25px;
      margin-left: 4px;
    }

    b,
    strong {
      font-weight: bolder;
      font-size: 20px;
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
          <!-- if breadcrumb is single--><a href="#">KHUYẾN MÃI</a>
        </li>
        <li class="breadcrumb-item active"><span>Thêm chương trình khuyến mãi</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header"><strong>THÊM CHƯƠNG TRÌNH KHUYẾN MÃI</strong></div>
            <div class="card-body">

              <div class="example">

                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <form action="user/hiensanpham.php" method="POST">
                      <div id="dialog">
                        <select name="product_id" id='categorySelect' class="form-input">
                          <?php while ($product_active = mysqli_fetch_assoc($product_list)) : ?>
                            <option value="<?php echo $product_active['product_id']; ?>">
                              <?php echo $product_active['name']; ?>
                            </option>
                          <?php endwhile; ?>
                        </select>
                        <div id="butt">
                          <button id="okButton" name="oke">OK</button>
                          <button id="cancelButton" name="huy">Hủy</button>
                        </div>

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
  <!-- <footer class="footer">
        <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2023 creativeLabs.</div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
      </footer> -->
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>


</body>

</html>

<div id="dialog">
  <select name="category_id" class="form-input">
    <?php while ($category_active = mysqli_fetch_assoc($category_active_list)) : ?>
      <option value="<?php echo $category_active['category_id']; ?>">
        <?php echo $category_active['name']; ?>
      </option>
    <?php endwhile; ?>
  </select>
  <div id="butt">
    <button id="okButton" name="oke"><i class="fa fa-arrow-right"></i></button>

    <button id="cancelButton" name="huy">Hủy</button>
  </div>