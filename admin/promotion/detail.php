<?php
session_start();
require_once '../../libraries/connect.php';
if (isset($_GET['id_promotion'])) {
  $id_promotion = $_GET['id_promotion'];
} else {
  $id_promotion = "";
}

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
  <title>QUẢN TRỊ DANH SÁCH NGƯỜI DÙNG</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">

  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <link rel="stylesheet" href="css/vendors/khuyenmai.css">
  <link rel="stylesheet" href="css/vendors/list-pro.css">
  <link rel="stylesheet" href="css/vendors/color.css">

  <script src="../js/delete.js"></script>
  <!-- Main styles for this application-->
  <link href="css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link href="css/examples.css" rel="stylesheet">
  <link rel="canonical" href="https://coreui.io/docs/components/breadcrumb/">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
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

    th,
    td {
      text-align: center;
      vertical-align: middle;
      font-size: 12px;
    }

    div#sidebar {
      background-color: #000044;
    }

    .table-striped>tbody>tr:nth-of-type(odd)>* {
      --cui-table-accent-bg: #fff0;
      color: var(--cui-table-striped-color);
    }
  </style>
  <style>
    div#dtBasicExample_wrapper {
      margin-top: -10px;
      font-size: 16px;
    }

    th.sorting.sorting_asc {
      font-size: 16px;
    }

    th.sorting {
      font-size: 16px;

    }

    td.sorting_1 {
      font-size: 16px;
      background: white;
    }

    td {
      font-size: 16px;
      background: white;
    }

    .table-striped>tbody>tr:nth-of-type(odd)>* {
      --cui-table-accent-bg: var(--cui-table-striped-bg);
      color: var(--cui-table-striped-color);
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
        <li class="breadcrumb-item active"><span>Danh sách chương trình khuyến mãi</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <main class="content">
    <div class="container-fluid p-0">
      <h4 class="h3 mb-3" style="font-weight: bold; font-size:20px;">DANH SÁCH KHUYẾN MÃI</h4>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive ">
                <!-- <a href="promotion/list.php"><input type="button" name="all" value="Tất cả" id="button"></a>
                          <a href="promotion/dangkhuyenmai.php"><input type="button" name="dangkhuyenmai" value="Đang khuyến mãi" id="button"></a>
                          <a href="promotion/dungkhuyenmai.php"><input type="button" name="dung" value="Đã khuyến mãi" id="button"></a> -->
                <br>
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                  <?php if (isset($_SESSION['success'])) : ?>
                    <script>
                      Swal.fire(
                        'Cập nhật thành công',
                        '',
                        'success'
                      )
                    </script>';
                    <?php unset($_SESSION['success']); ?>
                  <?php endif; ?>
                  <?php if (isset($_SESSION['delete'])) : ?>
                    <script>
                      Swal.fire(
                        'Xóa thành công',
                        '',
                        'success'
                      )
                    </script>';
                    <?php unset($_SESSION['delete']); ?>
                  <?php endif; ?>
                  <thead>
                    <tr class="title">
                      <th>Tên sản phẩm</th>
                      <th>Hình ảnh</th>
                      <th>Giá gốc</th>
                      <th>Phần trăm giảm</th>
                      <th>Giá giảm</th>
                      <th>Tác vụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql_pro = "SELECT pro.*, prom.discount as discount  from product pro, promotion prom WHERE pro.id_promotion=prom.id_promotion and pro.id_promotion=$id_promotion  order by pro.name asc ";
                    $result = mysqli_query($conn, $sql_pro);
                    if (mysqli_num_rows($result) > 0) {
                      while ($product = mysqli_fetch_assoc($result)) {
                        // Tính toán giá sau khuyến mãi
                        $discountedPrice = $product['price'] - ($product['price'] * $product['discount']) / 100;

                    ?>
                        <tr class="promotion-row">
                          <td>
                            <?php echo $product['name']; ?>
                          </td>
                          <td class="sorting_1">
                            <img src="upload/<?php echo $product['image'] ?>" width="50px" height="60px">
                          </td>
                          <td class="sorting_1">
                            <?php echo number_format($product['price'], 0, '', '.'); ?> VNĐ</td>
                          </td>
                          <td class="sorting_1">
                            <?php echo $product['discount']; ?> %
                          </td>
                          <td class="sorting_1">
                            <?php echo number_format($discountedPrice, 0, '', '.'); ?> VNĐ</td>
                          </td>
                          <td class="sorting_1">
                            <a href="javascript:void(0);" onclick="confirmDelete(<?php echo  $product['product_id']; ?>)"><span class="material-symbols-outlined">delete</span></a>

                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
                <div class="trove">
                  <a href="promotion/list.php?id_promotion=<?php echo $id_promotion ?>"><span class="material-symbols-outlined">arrow_back</span>
                    <p style="margin-top:-29px; margin-left:2rem;">Quay lại</p>
                  </a>
                </div>
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
        text: 'Bạn có chắc muốn xóa ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'promotion/delete_detail.php?product_id=' + product_id;
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var rows = document.querySelectorAll('.promotion-row');

      rows.forEach(function(row) {
        var promotionId = row.querySelector('td:first-child').innerText;
        var color = getColorForPromotionId(promotionId);

        row.style.backgroundColor = color;
      });

      function getColorForPromotionId(id) {
        // Điều chỉnh mã màu theo ý muốn của bạn tùy thuộc vào ID
        if (id % 2 === 0) {
          return '#00004405'; // Màu cho các ID chẵn
        } else {
          return '#FF99cc21'; // Màu cho các ID lẻ
        }
      }
    });
  </script>




</body>

</html>