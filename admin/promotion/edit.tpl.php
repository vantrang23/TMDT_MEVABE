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
  <link rel="stylesheet" href="css/vendors/edit_prom.css">
  <link rel="manifest" href="assets/favicon/manifest.json">
  <link rel="stylesheet" href="css/vendors/color.css">
  <link href="css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/accordion/">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../../template/admin/js/delete.js"></script>
  <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

    div#sidebar {
      background-color: #000044;
    }

    .card.mb-4 {
      height: 1300px;
      margin-bottom: 100px;
    }
  </style>
  <style>
    label#tieude {
      font-size: 16px;
    }

    input.form-input {
      height: 42px;
      font-size: 15px;
    }

    label#trangthai {
      font-size: 17px;
      padding-left: 0px;
    }
    h4#chonsp {
    font-size: 21px;
    font-weight: 800;
    color: #E91E63;
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
        <li class="breadcrumb-item active"><span>Chỉnh sửa chương trình khuyến mãi</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header"><strong style="font-size: 18px;">CHỈNH SỬA CHƯƠNG TRÌNH KHUYẾN MÃI</strong></div>
            <div class="card-body">

              <div class="example">

                <div class="tab-content rounded-bottom">


                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <form action="promotion/edit.php" method="POST" id="km">
                      <input type="hidden" name="id_promotion" value="<?php echo $id_promotion; ?>">
                      <div class="form-group">
                        <label for="" id="tieude">Tên khuyến mãi: </label>
                        <input type="text" class="form-input" name="name" value="<?php echo $promotion['name']; ?>">
                      </div>

                      <div class="form-group">
                        <label for="start_day" id="tieude">Ngày bắt đầu: </label>
                        <input type="date" name="start_day" id="txtDatestart" min="2023-01-01" value="<?php echo $promotion['start_day']; ?>" />
                      </div>

                      <div class="form-group">
                        <label for="end_day" id="tieude">Ngày kết thúc:</label>
                        <input type="date" name="end_day" id="txtDateend" min="2023-01-01" value="<?php echo $promotion['end_day']; ?>" />
                      </div>

                      <div class="form-group">
                        <label for="" id="tieude">Nội dung: </label>
                        <textarea class="form-input" id="pass" name="content"><?php echo $promotion['content']; ?></textarea>
                      </div>

                      <div class="form-group">
                        <label for="" id="tieude">Giá giảm: </label>
                        <input type="text" class="form-input" name="discount" value="<?php echo $promotion['discount']; ?>">
                      </div>

                      <div class="form-group">
                        <label for="status" id="trangthai">Trạng thái: </label>
                        <input type="checkbox" class="form-input trangthai" name="status" <?php echo ($promotion['status'] == 1) ? 'checked="checked"' : ''; ?>>
                      </div>
                      <hr>
                      <div id="form-group">
                        <h4 id="chonsp">Chọn sản phẩm:</h4>
                      </div>
                      <div id="khuyenmai">
                        <?php
                        // Truy vấn danh mục sản phẩm
                        $categorySql = "SELECT * FROM category WHERE status=1 ORDER BY name ";
                        $categoryResult = $conn->query($categorySql);

                        // Truy vấn sản phẩm có id_promotion
                        $promotionSql = "SELECT * FROM product WHERE id_promotion='$id_promotion'";
                        $promotionResult = mysqli_query($conn, $promotionSql);

                        // Tạo một mảng chứa id sản phẩm có id_promotion
                        $promotionIds = array();
                        while ($promotionProduct = $promotionResult->fetch_assoc()) {
                          $promotionIds[] = $promotionProduct['product_id'];
                        }

                        // Lặp qua danh mục sản phẩm
                        while ($category = $categoryResult->fetch_assoc()) {
                          echo '<p id="danhmuc">' . $category['name'] . '</p>';

                          // Truy vấn sản phẩm thuộc danh mục này
                          $productSql = "SELECT * FROM product WHERE status=1 and category_id = " . $category['category_id'];
                          $productResult = $conn->query($productSql);

                          // Lặp qua sản phẩm và tạo checkbox cho mỗi sản phẩm
                          while ($product = $productResult->fetch_assoc()) {
                            // Kiểm tra xem sản phẩm có nằm trong mảng id_promotion hay không
                            $isChecked = in_array($product['product_id'], $promotionIds) ? 'checked="checked"' : '';
                            echo '<input type="checkbox" name="selected_product[]" value="' . $product['product_id'] . '" ' . $isChecked . ' >';
                            echo '<label for="" id="sanpham">' . $product['name'] . '</label><br>';
                          }
                        }
                        ?>

                      </div>
                      <div id="button_add">
                        <input type="submit" value="Chỉnh sửa " class="form-submit" name="edit">
                        <input type="submit" value="Hủy" class="form-submit" name="huy">
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