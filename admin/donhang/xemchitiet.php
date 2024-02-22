<?php
session_start();
if (isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];
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
    <title>QUẢN TRỊ DANH SÁCH ĐƠN HÀNG</title>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
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

        label {
            margin-top: -10px;
            font-size: 16px;
        }

        th {
            font-size: 16px;
        }

        td {
            font-size: 16px;
            /* width: 100px; */
        }

        td#a {
            width: 100px;
        }

        input#button {
            background: #e91e6361;
            border-radius: 8px;
            border-color: #e91e6300;
            color: white;
            font-size: 16px;
        }
    </style>
    <style>
        p.tt {
            font-size: 24px;
            font-weight: 700;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #673AB7;
            border-bottom: 1px solid;
        }

        .sdt {
            margin-left: 473px;
            margin-top: -18px;
        }

        .trangthai {
            margin-left: 473px;
            margin-top: -58px;
        }

        .phi {
            margin-top: 48px;
            margin-bottom: 17px;
        }

        label {
            font-size: 18px;
        }

        .diachi {
            margin-top: 12px;
        }

        span {
            font-size: 17px;
        }

        .ghichu {
            margin-top: 16px;
        }

        .col-12 {
            margin-bottom: 50px;
        }

        .tongtien {
            margin-bottom: 10px;
        }

        .ha {
            /* margin-left: 473px; */
            margin-top: -247px;
        }

        table.table.table-striped.table-bordered.table-sm {
            margin-top: 45px;
        }

        .tongtien {
            margin-bottom: 261px;
        }
    </style>
</head>

<body>
    <?php

    require_once '../../libraries/connect.php';
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
                    <!-- if breadcrumb is single--><a href="#">ĐƠN HÀNG</a>
                </li>
                <li class="breadcrumb-item active"><span>Chi tiết đơn hàng</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <main class="content">
        <div class="container-fluid p-0">
            <h4 class="h3 mb-3" style="font-weight: bold; font-size:20px;">CHI TIẾT ĐƠN HÀNG</h4>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive ">
                                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
                                <?php
                                $sql_donhang = "SELECT `order`.*, pro.name as pro_name, user.username as username
                                                    FROM `order` , order_detail od, product pro, user  
                                                    where `order`.id_order=od.id_order and pro.product_id=od.product_id and user.iduser=`order`.iduser and `order`.id_order=$id_order";
                                $re_donhang = mysqli_query($conn, $sql_donhang);
                                $donhang = mysqli_fetch_assoc($re_donhang);
                                ?>
                                <div class="chitiet" id="thongtin">
                                    <p class="tt">THÔNG TIN KHÁCH HÀNG</p>
                                    <div class="tennh">
                                        <label for="">Tên người nhận: </label>
                                        <span id=""><?php echo $donhang['name'] ?></span>
                                    </div>
                                    <div class="sdt">
                                        <label for="">Số điện thoại người nhận: </label>
                                        <span id=""><?php echo $donhang['sdt'] ?></span>
                                    </div>
                                    <div class="diachi">
                                        <label for="">Địa chỉ: </label>
                                        <span id=""><?php echo $donhang['address'] ?></span>
                                    </div>
                                    <div class="ghichu">
                                        <label for="">Ghi chú: </label>
                                        <span id=""><?php echo $donhang['note_user'] ?></span>
                                    </div>
                                    <div class="trangthai">
                                        <label for="">Trạng thái: </label>
                                        <span id=""><?php echo $donhang['status'] ?></span>
                                    </div>
                                    <div class="phi">
                                        <label for="">Phí vận chuyển: </label>
                                        <span id=""><?php echo number_format($donhang['phi'], 0, '', '.') ?> VNĐ</span>
                                    </div>
                                    <div class="tongtien">
                                        <label for="">Tổng tiền: </label>
                                        <span id=""><?php echo number_format($donhang['tongtien'], 0, '', '.') ?> VNĐ</span>
                                    </div>
                                    <div class="ha">
                                        <?php
                                        if ($donhang['status'] == "Đã giao") {
                                            echo '<label for="">Hình ảnh giao hàng: </label><br>';
                                            echo '<img src="upload/' . $donhang['image'] . '" width="100px" height="110px">';
                                        }
                                        ?>
                                    </div>


                                </div>

                                <table id="sampleTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stt = 0;
                                        $sql_donhang1 = "SELECT od.*, pro.name as name, user.username as username, pro.product_id as product_id, pro.price as price
                                                            FROM `order` , order_detail od, product pro, user  
                                                            where `order`.id_order=od.id_order and pro.product_id=od.product_id and user.iduser=`order`.iduser and od.id_order=$id_order";
                                        $re_donhang1 = mysqli_query($conn, $sql_donhang1);
                                        while ($donhang1 = mysqli_fetch_assoc($re_donhang1)) :
                                            $stt += 1;
                                            $product_id1 = $donhang1['product_id'];
                                            $sql_1 = "SELECT prom.*, pro.price as price
                                                            FROM promotion prom
                                                            JOIN product pro ON prom.id_promotion = pro.id_promotion
                                                            WHERE pro.product_id = " . $product_id1 . " AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE())
                                                            GROUP BY prom.id_promotion;";
                                            $result_1 = mysqli_query($conn, $sql_1);
                                            $row_1 = mysqli_fetch_assoc($result_1);
                                            // Tính toán giá sau khuyến mãi
                                            // $discountedPrice = $promotion['price']-($promotion['price'] * $promotion['discount'])/100;
                                        ?>
                                            <tr class="promotion-row">
                                                <td>
                                                    <?php echo $stt; ?>
                                                </td>
                                                <td>
                                                    <?php echo $donhang1['name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo number_format($donhang1['price'], 0, '', '.') ?> VNĐ
                                                </td>
                                                <td>
                                                    <?php echo $donhang1['soluong']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $donhang1['thanhtien']; ?>
                                                </td>

                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <a style="font-size: 16px;" href="donhang/list.php">Quay lại</a>
                        </div>
                    </div>
                </div>

            </div>
    </main>
    <?php require '../footer.php'; ?>
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>
    <script>
    </script>
    <script>
        function confirmDelete(id_promotion) {
            Swal.fire({
                title: 'Confirmation',
                text: 'Bạn có chắc muốn xóa ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'promotion/delete.php?id_promotion=' + id_promotion;
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


    <script>
        //In dữ liệu
        var myApp = new function() {
            this.printTable = function() {
                var tab1 = document.getElementById('thongtin');
                var tab = document.getElementById('sampleTable');

                var win = window.open('', '', 'height=700,width=700');
                win.document.write(tab1.outerHTML);
                win.document.write(tab.outerHTML);

                win.document.close();
                win.print();
            }
        }

        $("#show-emp").on("click", function() {
            $("#ModalUP").modal({
                backdrop: false,
                keyboard: false
            })
        });
    </script>




</body>

</html>