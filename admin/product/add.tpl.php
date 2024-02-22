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
  <link rel="stylesheet" href="css/vendors/add_category.css">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/accordion/">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../../template/admin/js/delete.js"></script>

  <link rel="stylesheet" href="css/vendors/color.css">

  <style>
    div#sidebar {
      background-color: #000044;
    }

    #wrapper {
      background-color: #f9fafa;
      padding: 20px;
      border-radius: 5px;
      /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
      text-align: justify;
      width: 102%;
      margin-left: auto;
      margin-right: auto;
      margin-top: 7px;
      height: 428px;
    }

    .form-group {
      display: flex;
      align-items: center;
      margin: 4px 0;
    }

    form#form-login {
      margin-top: -19px;
    }

    .form-submit {
      width: 22%;
      padding: 10px;
      background-color: #FF99CC;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: px;
      margin-left: 146px;
      margin-right: -135px;
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
  <style>
    .card.mb-4 {
      height: 1100px;
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

    div#wrapper {
      background: white;
    }

    div#preview-1000 {
      background: white;
    }
  </style>
  <style>
    label {
      font-size: 21px;
    }

    select.form-input {
      font-size: 17px;
    }

    input.form-input.hinhanh {
      font-size: 15px;
    }

    .tab-content.rounded-bottom {
      margin-left: 10px;
    }

    /* textarea#message {
      margin-left: -97px;
      height: 68px;
      width: 358px;
    } */

    .mota {
      width: 1000px;
    }
  </style>

  <style>
    textarea {
      resize: vertical;
      width: 717px;
    }

    p#motaq {
      font-size: 19px;
      font-weight: 800;
      color: #673AB7;
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
          <!-- if breadcrumb is single--><a href="#">SẢN PHẨM</a>
        </li>
        <li class="breadcrumb-item active"><span>Thêm sản phẩm</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header"><strong>THÊM SẢN PHẨM</strong></div>
            <div class="card-body">

              <div class="example">

                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <div id="wrapper">
                      <form action="product/add.php" id="form-login" method="POST" role="form" enctype="multipart/form-data">
                        <div class="sanpham">
                          <div class="form-group">
                            <label>Danh mục:</label>
                            <select name="category_id" class="form-input">
                              <?php while ($category_active = mysqli_fetch_assoc($category_active_list)) : ?>
                                <option value="<?php echo $category_active['category_id']; ?>">
                                  <?php echo $category_active['name']; ?>
                                </option>
                              <?php endwhile; ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" class="form-input ten" name="name" required>
                          </div>
                          <div class="form-group">
                            <label for="">Chi tiết: </label>
                            <input type="textarea" class="form-input chitiet" name="detail" required>
                          </div>
                          <div class="form-group">
                            <label>Hình ảnh:</label>
                            <input type="file" name="image" class="form-input hinhanh">
                          </div>
                          <div class="form-group">
                            <label>Giá:</label>
                            <input type="text" name="price" class="form-input gia">
                          </div>
                          <div class="form-group">
                            <label>Số lượng:</label>
                            <input type="text" name="quantity" class="form-input soluong">
                          </div>
                          <div class="form-group">
                            <label for="">Trạng thái: </label>
                            <input type="checkbox" class="form-input trangthai" name="status" value="1">
                          </div>
                        </div>

                        <hr>
                        <p id="motaq">CHI TIẾT SẢN PHẨM</p>
                        <div class="mota">
                          <div class="form-group">
                            <label>Ưu điểm:</label>
                            <textarea id="message" name="uudiem" rows="4" cols="50"></textarea>
                          </div>
                          <div class="form-group">
                            <label>Đối tượng:</label>
                            <input type="text" id="doituong" name="doituong" rows="4" cols="50"></input>
                          </div>
                          <div class="form-group">
                            <label>Hướng dẫn:</label>
                            <textarea id="huongdan" name="huongdan" rows="4" cols="50"></textarea>
                          </div>

                          <div class="form-group tp">
                            <label>Thành phần:</label>
                            <textarea id="thanhphan" name="thanhphan" rows="4" cols="50"></textarea>
                          </div>
                          <div class="form-group bq">
                            <label>Bảo quản:</label>
                            <textarea id="baoquan" name="baoquan" rows="4" cols="50"></textarea>
                          </div>
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