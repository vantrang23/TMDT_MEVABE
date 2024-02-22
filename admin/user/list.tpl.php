<!DOCTYPE html><!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2023 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
--><!-- Breadcrumb-->
<html lang="en">

<head>
  <base href="./../">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>QUẢN TRỊ DANH SÁCH NGƯỜI DÙNG</title>
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <link rel="stylesheet" href="css/vendors/list-user.css">
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
      /* font-size:15px; */
    }

    div.dataTables_wrapper table.dataTable thead th {
      border-top: 1px solid #ddd;
      border-bottom: 2px solid #ddd;
      text-align: center;
      vertical-align: middle;
    }

    div#sidebar {
      background-color: #000044;
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
          <!-- if breadcrumb is single--><a href="#">NGƯỜI DÙNG</a>
        </li>
        <li class="breadcrumb-item active"><span>Danh sách người dùng</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <main class="content">
    <div class="container-fluid p-0">
      <h1 class="h3 mb-3" style="font-weight: bold;">DANH SÁCH NGƯỜI DÙNG</h1>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive ">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
                      <th>STT</th>
                      <th>Tài khoản</th>
                      <th>Họ tên</th>
                      <th>Trạng thái</th>
                      <th>Email</th>
                      <th>Ngày tạo</th>
                      <th>Quyền</th>
                      <th>Tác vụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stt = 0;
                    while ($user = mysqli_fetch_assoc($user_list)) :
                      $stt += 1;
                    ?>
                      <tr>
                        <td>
                          <?php echo $stt ?>
                        </td>
                        <td>
                          <?php echo $user['username']; ?>
                        </td>
                        <td>
                          <?php echo $user['fullname']; ?>
                        </td>
                        <td>
                          <?php echo ($user['status'] == 1) ? 'Kích hoạt' : 'Không kích hoạt'; ?>
                        </td>
                        <td>
                          <?php echo $user['email']; ?>
                        </td>
                        <td>
                          <?php echo date('d/m/Y H:i:s', strtotime($user['created'])); ?>
                        </td>
                        <td>
                          <?php echo ($user['role'] == "admin") ? 'Nhân viên' : 'Khách'; ?>
                        </td>

                        <td>
                          <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $user['iduser']; ?>)"><span class="material-symbols-outlined">delete</span></a>

                          <a href="user/edit.php?iduser=<?php echo $user['iduser']; ?>"><span class="material-symbols-outlined">border_color</span></a>
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
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <script>
  </script>
  <script>
    function confirmDelete(iduser) {
      Swal.fire({
        title: 'Confirmation',
        text: 'Bạn có chắc muốn xóa ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'user/delete.php?iduser=' + iduser;
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