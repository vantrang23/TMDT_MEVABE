<?php
session_start();
require '../../libraries/connect.php';
$fullname = $_SESSION['fullname'];
$_SESSION['fullname'] = $fullname;

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
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
    <title>CHI TIẾT SẢN PHẨM</title>
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

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            --cui-table-accent-bg: rgb(0 0 21 / 0%);
            color: var(--cui-table-striped-color);
        }

        .table {
            border-color: #d8dbe000;
        }
    </style>
    <style>
        label {
            FONT-SIZE: 18px;
            font-weight: 700;
            color: #673AB7;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
            MARGIN-LEFT: 42px;
        }
    </style>
</head>

<body>
    <?php
    // session_start();

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
                <li class="breadcrumb-item active"><span>Chi tiết sản phẩm</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3" style="font-weight: bold;">CHI TIẾT SẢN PHẨM</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive ">
                                <!-- <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
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

                                <?php
                                // $sql_pro_1 = "SELECT * FROM product_image where product_id=$product_id";
                                // $result_pro_1 = mysqli_query($conn, $sql_pro_1);
                                // while ($product = mysqli_fetch_assoc($result_pro_1)) :
                                ?>
                                <!-- <tr>
                                            <td>
                                                <img src="upload/<?php //echo $product['image'] 
                                                                    ?>" width="100px" height="110px">
                                            </td>

                                            <td id="chon">
                                                <input type="file" name="image" class="form-input hinhanh" value="">
                                            </td>

                                        </tr> -->
                                <?php //endwhile; 
                                ?>
                                <!-- </tbody> -->
                                <!-- </table> -->
                                <?php
                                $sql_pro_detail = "SELECT * from product_detail where product_id=$product_id";
                                $re_pro_detail = mysqli_query($conn, $sql_pro_detail);
                                $pro_detail = mysqli_fetch_assoc($re_pro_detail);
                                ?>
                                <?php
                                if (!empty($pro_detail['advantage'])) {
                                    echo '<label for="uudiem">ƯU ĐIỂM</label>
                                    <p id="uudiem">' . $pro_detail['advantage'] . '</p>';
                                }
                                if (!empty($pro_detail['object'])) {
                                    echo '<label for="doituong">ĐỐI TƯỢNG</label>
                                    <p id="doituong">' . $pro_detail['object'] . '</p>';
                                }
                                if (!empty($pro_detail['instruct'])) {
                                    echo '<label for="">HƯỚNG DẪN</label>
                                    <p id="huongdan">' . $pro_detail['instruct'] . '</p>';
                                }
                                if (!empty($pro_detail['ingredient'])) {
                                    echo '<label for="thanhphan">THÀNH PHẦN</label>
                                    <p id="thanhphan">' . $pro_detail['ingredient'] . '</p>';
                                }
                                if (!empty($pro_detail['preserve'])) {
                                    echo '<label for="baoquan">BẢO QUẢN</label>
                                    <p id="baoquan">' . $pro_detail['preserve'] . '</p>';
                                }
                                ?>
                                <a style="font-size: 15px;" href="product/list.php">Quay lại</a>
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