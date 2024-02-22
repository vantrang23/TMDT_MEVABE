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
    div#sidebar {
      background-color: #000044;
    }

    tr.title {
      background: #000044ab;
      color: white;
    }

    .table-striped>tbody>tr:nth-of-type(odd)>* {
      --cui-table-accent-bg: #8a93a242;
      color: var(--cui-table-striped-color);
    }

    table.list.table.table-striped {
      font-size: 12px;
    }

    td {
      text-align: center;
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
    label {
      font-size: 16px;
    }

    thead {
      font-size: 16px;
    }

    tbody {
      font-size: 16px;
    }

    .table-striped>tbody>tr:nth-of-type(odd)>* {
      --cui-table-accent-bg: #8a93a212;
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
          <!-- if breadcrumb is single--><a href="#">DANH MỤC SẢN PHẨM</a>
        </li>
        <li class="breadcrumb-item active"><span>Danh sách danh mục sản phẩm</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <main class="content">
    <div class="container-fluid p-0">
      <h1 class="h3 mb-3" style="font-weight: bold; font-size:20px;">DANH SÁCH DANH MỤC</h1>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive ">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
                  <?php if (isset($_SESSION['edit'])) : ?>
                    <script>
                      Swal.fire(
                        'Chỉnh sửa thành công',
                        '',
                        'success'
                      )
                    </script>';
                    <?php unset($_SESSION['edit']); ?>
                  <?php endif; ?>
                  <thead>
                    <tr class="title">
                      <th>STT</th>
                      <th>Tên danh mục</th>
                      <th>Ảnh</th>
                      <th>Trạng thái</th>
                      <th>Ngày tạo</th>
                      <!-- <th>Ngày chỉnh sửa</th> -->
                      <th>Tác vụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stt = 0;
                    while ($category = mysqli_fetch_assoc($category_list)) :
                      $stt += 1;
                    ?>
                      <tr>
                        <td>
                          <?php echo $stt ?>
                        </td>
                        <td>
                          <?php echo $category['name']; ?>
                        </td>

                        <td>
                          <img src="upload/<?php echo $category['image'] ?>" width="50px" height="60px">
                        </td>
                        <td>
                          <?php echo ($category['status'] == 1) ? 'Kích hoạt' : 'Không kích hoạt'; ?>
                        </td>
                        <td>
                          <?php echo date('d/m/Y H:i:s', strtotime($category['created'])); ?>
                        </td>
                        <!-- <td>
                          <?php //echo date('d/m/Y H:i:s', strtotime($category['modified'])); 
                          ?>
                        </td> -->
                        <td>
                          <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $category['category_id']; ?>)"><span class="material-symbols-outlined">delete</span></a>
                          <a href="category/edit.php?category_id=<?php echo $category['category_id']; ?>"><span class="material-symbols-outlined">border_color</span></a>
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
    function confirmDelete(category_id) {
      Swal.fire({
        title: 'Confirmation',
        text: 'Bạn có chắc muốn xóa danh mục bao gồm các sản phẩm trong danh mục này?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'category/delete.php?category_id=' + category_id;
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