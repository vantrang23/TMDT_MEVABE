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
  <title>QUẢN TRỊ CHỈNH SỬA DANH MỤC</title>
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

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

    div#preview-1000 {
      background: white;
      height: 100px;
    }

    input.form-input.hinhanh {
      width: 300px;
      margin-left: -3px;
    }

    button.header-toggler.px-md-0.me-md-3 {
      margin-left: -249px;
    }

    strong {
      font-size: 20px;
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

    .tab-content.rounded-bottom {
      margin-left: 10px;
    }

    .card.mb-4 {
      height: 1200px;
    }

    div#wrapper {
      margin-left: 10px;
    }

    .mota {
      margin-left: -85px;
      width: 1000px;
    }
  </style>
</head>

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
        <li class="breadcrumb-item active"><span>Chỉnh sửa sản phẩm</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header"><strong>CHỈNH SỬA SẢN PHẨM</strong></div>
            <div class="card-body">

              <div class="example">

                <div class="tab-content rounded-bottom " id="bgg">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <div id="wrapper">
                      <!-- <form  action="product/edit.php" id="form-login" method="POST" > -->
                      <form action="product/edit.php" id="form-login" method="POST" enctype="multipart/form-data">
                        <?php
                        $sql_1 = "SELECT pro.*, cate.name as cate_name 
                                    from category cate, product pro 
                                    where cate.category_id=pro.category_id and pro.product_id=$product_id";
                        $result_1 = mysqli_query($conn, $sql_1);
                        $row_1 = mysqli_fetch_assoc($result_1);
                        $category_id = $row_1['category_id'];
                        $category_active_list = get_category_active_list1($category_id, $conn);
                        ?>
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <div class="form-group">
                          <label>Danh mục:</label>
                          <select name="category_id" class="form-input">
                            <option selected value="<?php echo $row_1['category_id'] ?>"><?php echo $row_1['cate_name'] ?></option>
                            <?php while ($category_active = mysqli_fetch_assoc($category_active_list)) : ?>
                              <option value="<?php echo $category_active['category_id']; ?>">
                                <?php echo $category_active['name']; ?>
                              </option>
                            <?php endwhile; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Tên sản phẩm</label>
                          <input type="text" class="form-input ten" name="name" value="<?php echo $product['name']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Chi tiết: </label>
                          <input type="textarea" class="form-input chitiet" name="detail" value="<?php echo $product['detail']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Hình ảnh:</label>
                          <input type="file" name="image" class="form-input hinhanh" value="">
                          <img src="upload/<?php echo $product['image'] ?>" width="50px" height="60px">
                        </div>
                        <div class="form-group">
                          <label>Giá:</label>
                          <input type="text" name="price" class="form-input" gia value="<?php echo $product['price']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Số lượng:</label>
                          <input type="text" name="quantity" class="form-input soluong" value="<?php echo $product['quantity']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Trạng thái: </label>
                          <input type="checkbox" class="form-input trangthai" name="status" <?php echo ($product['status'] == 1) ? 'checked="checked"' : ''; ?>>
                        </div>
                        <div id="edit">
                          <hr>
                          <?php
                          $sql_pro_detail = "SELECT * from product_detail where product_id=$product_id";
                          $re_pro_detail = mysqli_query($conn, $sql_pro_detail);
                          $pro_detail = mysqli_fetch_assoc($re_pro_detail);
                          ?>
                          <p id="motaq">CHI TIẾT SẢN PHẨM</p>
                          <div class="mota">
                            <div class="form-group">
                              <label>Ưu điểm:</label>
                              <textarea id="message" name="uudiem" rows="4" cols="50"><?php echo $pro_detail['advantage'] ?></textarea>
                            </div>
                            <div class="form-group">
                              <label>Đối tượng:</label>
                              <input type="text" id="doituong" name="doituong" rows="4" cols="50" value="<?php echo $pro_detail['object'] ?>"></input>
                            </div>
                            <div class="form-group">
                              <label>Hướng dẫn:</label>
                              <textarea id="huongdan" name="huongdan" rows="4" cols="50"><?php echo $pro_detail['instruct'] ?></textarea>
                            </div>

                            <div class="form-group tp">
                              <label>Thành phần:</label>
                              <textarea id="thanhphan" name="thanhphan" rows="4" cols="50"><?php echo $pro_detail['ingredient'] ?></textarea>
                            </div>
                            <div class="form-group bq">
                              <label>Bảo quản:</label>
                              <textarea id="baoquan" name="baoquan" rows="4" cols="50"><?php echo $pro_detail['preserve'] ?></textarea>
                            </div>
                          </div>

                          <input type="submit" value="Ok" class="form-submit" name="edit">
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