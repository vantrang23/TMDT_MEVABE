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

  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
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

    input.form-input {
      height: 37px;
    }

    label#tieude {
      font-size: 18px;
      width: 246px;
      /* margin-top: -65px; */
    }

    .example .tab-content {
      background-color: #f9fafa !important;
      width: 961px;
      margin-left: 78px;
    }

    input#txtDate {
      width: 127px;
      height: 33px;
      margin-left: -32px;
    }

    label#trangthai {
      font-size: 19px;
      padding-left: 0px;
    }

    input[type="checkbox"] {
      width: 30px;
      height: 30px;
      text-align: center;
      margin-top: -5px;
      margin-left: 127px;
    }

    b,
    strong {
      font-weight: bolder;
      font-size: 20px;
    }

    .card.mb-4 {
      height: 800px;
    }

    div#preview-1000 {
      height: 700px;
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
            <div class="card-header"><strong style="font-style:20px;">THÊM CHƯƠNG TRÌNH KHUYẾN MÃI</strong></div>
            <div class="card-body">

              <div class="example">

                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <form action="user/addkhuyenmai.php" id="form-login" method="POST">

                      <div class="form-group">
                        <label for="" id="tieude">Tên khuyến mãi: </label>
                        <input type="text" class="form-input" name="username" required>
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
                        <input type="checkbox" name="status" value="1">
                      </div>

                      <div class="form-group">
                        <label for="category_id" id="tieude">Danh mục: </label>
                        <select name="category_id" id="categorySelect" class="form-input">
                          <?php while ($category_active = mysqli_fetch_assoc($category_active_list)) : ?>
                            <option value="<?php echo $category_active['category_id']; ?>">
                              <?php echo $category_active['name']; ?>
                            </option>
                          <?php endwhile; ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="id_product" id="tieude">Sản phẩm: </label>
                        <div id="productsList">
                          <!-- Danh sách sản phẩm sẽ được thêm vào đây -->
                        </div>
                      </div>



                      <div id="button_add">
                        <input type="submit" value="Thêm" class="form-submit" name="them">
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
  <?php require '../footer.php'; ?>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <script>
  </script>
  <script>


  </script>

</body>

</html>