<?php
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
  <title>QUẢN TRỊ DANH SÁCH SẢN PHẨM</title>
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <link rel="stylesheet" href="css/vendors/list-pro.css">
  <link rel="stylesheet" href="css/vendors/color.css">
  <script src="../js/delete.js"></script>
  <link href="css/style.css" rel="stylesheet">
  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/breadcrumb/">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

    th {
      text-align: center;
      vertical-align: middle;
      font-size: 16px;
    }

    td {
      text-align: center;
      vertical-align: middle;
      font-size: 16px;
    }

    div#sidebar {
      background-color: #000044;
    }

    label {
      font-size: 16px;
    }
  </style>
</head>

<body>
  <?php
  // session_start();
  $fullname = $_SESSION['fullname'];
  $_SESSION['fullname'] = $fullname;
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
        <li class="breadcrumb-item active"><span>Danh sách sản phẩm</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <main class="content">
    <div class="container-fluid p-0">
      <h1 class="h3 mb-3" style="font-weight: bold;">DANH SÁCH SẢN PHẨM</h1>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive ">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <?php if (isset($_SESSION['success'])) : ?>
                    <script>
                      Swal.fire(
                        'Thêm thành công',
                        '',
                        'success'
                      )
                    </script>;
                    <?php unset($_SESSION['success']); ?>
                  <?php endif; ?>
                  <?php if (isset($_SESSION['success_them'])) : ?>
                    <script>
                      Swal.fire(
                        'Chỉnh sửa thành công',
                        '',
                        'success'
                      )
                    </script>;
                    <?php unset($_SESSION['success_them']); ?>
                  <?php endif; ?>
                  <?php if (isset($_SESSION['delete'])) : ?>
                    <script>
                      Swal.fire(
                        'Xóa thành công',
                        '',
                        'success'
                      )
                    </script>;
                    <?php unset($_SESSION['delete']); ?>
                  <?php endif; ?>
                  <thead>
                    <tr class="title">
                      <th>STT</th>
                      <th>Hình ảnh</th>
                      <th>Tên sản phẩm</th>
                      <th>Tên danh mục</th>
                      <th>Giá</th>
                      <th>Số lượng</th>
                      <th>Trạng thái</th>
                      <th>Ngày tạo</th>
                      <!-- <th>Ngày chỉnh sửa</th>                              -->
                      <th>Tác vụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stt = 0;
                    while ($product = mysqli_fetch_assoc($product_list)) :
                      $stt += 1;
                    ?>
                      <tr>
                        <td>
                          <?php echo $stt; ?>
                        </td>
                        <td>
                          <img src="upload/<?php echo $product['image'] ?>" width="50px" height="60px">

                        </td>

                        <td>
                          <?php echo $product['name']; ?>
                        </td>
                        <td>
                          <?php echo $product['name_cate']; ?>
                        </td>
                        <td>
                          <?php echo number_format($product['price'], 0, '', '.'); ?> VNĐ</td>
                        </td>
                        <td>
                          <?php echo $product['quantity']; ?>
                        </td>
                        <td>
                          <?php echo ($product['status'] == 1) ? 'Đang bán' : 'Ngưng bán'; ?>
                        </td>
                        <td>
                          <?php echo date('d/m/Y H:i:s', strtotime($product['created'])); ?>
                        </td>
                        <!-- <td>
                                        <?php echo date('d/m/Y H:i:s', strtotime($product['modified'])); ?>
                                    </td> -->
                        <td style="width: 100px;">
                          <a href="product/xemchitiet.php?product_id=<?php echo $product['product_id']; ?>"><span class="material-symbols-outlined">info</span></a>
                          <a href="product/edit.php?product_id=<?php echo $product['product_id']; ?>"><span class="material-symbols-outlined">border_color</span></a>

                          <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $product['product_id']; ?>)"><span class="material-symbols-outlined">delete</span></a>
                        </td>

                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>
  <?php require '../footer.php'; ?>
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <script>
  </script>

  <script>
    function confirmDelete(product_id) {
      Swal.fire({
        title: 'Confirmation',
        text: 'Bạn có chắc muốn xóa sản phẩm này?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'product/delete.php?product_id=' + product_id;
        }
      });
    }
  </script>
  <script>
    $(document).ready(function() {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');
    });
  </script>

  <style>
    .navbar-bg {
      background: #fff;
      margin-left: 10px;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
      bottom: .5em;
    }

    div.dataTables_wrapper div.dataTables_filter {
      margin-bottom: 20px;
    }

    div.dataTables_wrapper table.dataTable thead th {
      border-top: 1px solid #ddd;
      border-bottom: 2px solid #ddd;
    }

    div.dataTables_wrapper div.dataTables_paginate {
      margin-top: 20px;
    }

    div.dataTables_wrapper div.dataTables_info {
      margin-top: 20px;
    }
  </style>
</body>

</html>