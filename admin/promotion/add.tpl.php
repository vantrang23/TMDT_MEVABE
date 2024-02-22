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
  <title>QUẢN TRỊ CHỈNH SỬA KHUYẾN MÃI</title>
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <link rel="stylesheet" href="css/vendors/add_user.css">
  <link rel="stylesheet" href="css/vendors/edit_promotion.css">
  <link rel="stylesheet" href="css/vendors/color.css">
  <link rel="manifest" href="assets/favicon/manifest.json">
  <link href="css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/accordion/">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../../template/admin/js/delete.js"></script>
  <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <script  src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->

  <style>
    .example .tab-content {
      background-color: #f9fafa00 !important;
    }

    div#preview-1000 {
      margin-left: -148px;
    }

    .form-input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      margin-left: 25px;
    }

    p {
      font-style: italic;
    }

    div#sidebar {
      background-color: #000044;
      color: while;
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
                    <form action="promotion/add.php" method="POST" id="km">
                      <div class="form-group">
                        <label for="" id="tieude">Tên khuyến mãi: </label>
                        <input type="text" class="form-input" name="name" required>
                      </div>

                      <div class="form-group">
                        <label for="" id="tieude">Ngày bắt đầu: </label>
                        <input type="date" name="start_day" id="txtDate" min="2023-01-01" />
                      </div>

                      <div class="form-group">
                        <label for="" id="tieude">Ngày kết thúc: </label>
                        <input type="date" name="end_day" id="txtDate" min="2023-01-01" />
                      </div>

                      <div class="form-group">
                        <label for="" id="tieude">Nội dung: </label>
                        <textarea class="form-input" id="pass" name="content" required></textarea>
                      </div>

                      <div class="form-group">
                        <label for="" id="tieude">Giá giảm: </label>
                        <input type="text" class="form-input" name="discount" required>
                      </div>

                      <div class="form-group">
                        <label for="status" id="trangthai">Trạng thái: </label>
                        <input type="checkbox" name="status" value="1" id="status">
                      </div>



                      <div id="button_add">
                        <input type="submit" value="Thêm" class="form-submit" name="them">
                        <input type="reset" value="Hủy" class="form-submit" name="huy">
                      </div>
                      <div id="form-group">
                        <h4 id="chonsp">Chọn sản phẩm:</h4>
                      </div>
                      <div id="khuyenmai">
                        <?php
                        $sql = "SELECT cate.category_id, cate.name as cate_name, product.product_id, product.name as pro_name
                                    FROM category cate
                                    LEFT JOIN product ON cate.category_id = product.category_id";

                        $result = $conn->query($sql);

                        // Xử lý và hiển thị dữ liệu
                        $categorySql = "SELECT * FROM category WHERE status=1 ORDER BY name ";
                        $categoryResult = $conn->query($categorySql);

                        // Lặp qua danh mục sản phẩm
                        while ($category = $categoryResult->fetch_assoc()) {
                          echo '<p>' . $category['name'] . '</p>';

                          // Truy vấn sản phẩm thuộc danh mục này
                          $productSql = "SELECT * FROM product WHERE status=1 and category_id = " . $category['category_id'];
                          $productResult = $conn->query($productSql);

                          // Lặp qua sản phẩm và tạo checkbox cho mỗi sản phẩm
                          while ($product = $productResult->fetch_assoc()) {

                            echo '<input type="checkbox" name="selected_product[]" value="' . $product['product_id'] . '">';
                            echo $product['name'] . '<br>';
                          }
                        }

                        ?>
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
  <?php require '../footer.php'; ?>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>

</body>

</html>



</html>