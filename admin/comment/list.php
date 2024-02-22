<?php
require_once '../../libraries/connect.php';
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
    <title>QUẢN TRỊ DANH SÁCH BÌNH LUẬN</title>
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
            font-size: 14px;
        }

        td {
            text-align: center;
            vertical-align: middle;
            font-size: 14px;
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
    session_start();
    $fullname = $_SESSION['fullname'];
    $_SESSION['fullname'] = $fullname;
    require '../header.php';
    ?>
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><a href="#">HOME</a>
                </li>
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><a href="#">BÌNH LUẬN</a>
                </li>
                <li class="breadcrumb-item active"><span>Danh sách bình luận</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3" style="font-weight: bold;">DANH SÁCH BÌNH LUẬN</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <?php if (isset($_SESSION['delete_bl'])) : ?>
                                        <script>
                                            Swal.fire(
                                                'Xóa thành công',
                                                '',
                                                'success'
                                            )
                                        </script>;
                                        <?php unset($_SESSION['delete_bl']); ?>
                                    <?php endif; ?>
                                    <thead>
                                        <tr class="title">
                                            <th>STT</th>
                                            <th>Tên khách hàng</th>
                                            <th>Tên sản phẩm/th>
                                            <th>Nội Dung</th>
                                            <th>Ngày đăng</th>
                                            <th>Trạng thái</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="acd">
                                        <?php
                                        $stt = 0;
                                        $sql_hienbl = "SELECT bl.*, u.username as username, p.name as name 
                                                            from binhluan bl, user u, product p
                                                            where bl.iduser=u.iduser and p.product_id=bl.product_id
                                                            order by ngaydang desc";
                                        $result_hienbl = mysqli_query($conn, $sql_hienbl);
                                        while ($row_hienbl = mysqli_fetch_assoc($result_hienbl)) {
                                            $stt += 1;
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $stt ?>
                                                </td>
                                                <td>
                                                    <?php echo $row_hienbl['username']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row_hienbl['name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row_hienbl['noidung']; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d/m/Y H:i:s', strtotime($row_hienbl['ngaydang'])); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($row_hienbl['trangthai'] == 1) ? 'Duyệt' : 'Chưa duyệt'; ?>
                                                </td>
                                                <td style="width: 100px;">
                                                    <input type="hidden" class="id_binhluan" value="<?php echo $row_hienbl['id_binhluan']; ?>">
                                                    <button class="chinhsua" data-id="<?php echo $row_hienbl['id_binhluan']; ?>" data-trangthai="<?php echo $row_hienbl['trangthai']; ?>">
                                                        <span class="material-symbols-outlined">task_alt</span>
                                                    </button>
                                                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row_hienbl['id_binhluan']; ?>)"><span class="material-symbols-outlined">delete</span></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
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
        function confirmDelete(id_binhluan) {
            Swal.fire({
                title: 'Confirmation',
                text: 'Bạn có chắc muốn xóa sản phẩm này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'comment/delete.php?id_binhluan=' + id_binhluan;
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
        $(document).ready(function() {
            $('.chinhsua').click(function() {
                var id_binhluan = $(this).data('id');
                var trangthai = $(this).data('trangthai');

                // Gửi yêu cầu AJAX để cập nhật trạng thái
                $.ajax({
                    type: 'POST',
                    url: 'comment/duyet.php', // Đặt tên file xử lý cập nhật trạng thái
                    data: {
                        id_binhluan: id_binhluan,
                        trangthai: trangthai
                    }
                }).done(function(response) {
                    $('.acd').html(response);

                });
            });
        });
    </script>


</body>

</html>