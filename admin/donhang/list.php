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
            margin-top: 17px;
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

        span {
            font-size: 16px;
            font-family: system-ui;
        }

        select#sort-box {
            font-size: 16px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
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
                <!-- <li class="breadcrumb-item active"><span>Danh sách chương trình khuyến mãi</span></li> -->
            </ol>
        </nav>
    </div>
    </header>
    <main class="content">
        <div class="container-fluid p-0">
            <h4 class="h3 mb-3" style="font-weight: bold; font-size:20px;">DANH SÁCH ĐƠN HÀNG</h4>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive ">
                                <span>Lọc: </span>
                                <select id="sort-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                    <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "Chờ xử lý") { ?> selected <?php } ?> value="donhang/list.php?field=status&sort=Chờ xử lý">Chờ xử lý</option>
                                    <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "Đã xác nhận") { ?> selected <?php } ?> value="donhang/list.php?field=status&sort=Đã xác nhận">Đã xác nhận</option>
                                    <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "Đang trên đường giao hàng") { ?> selected <?php } ?> value="donhang/list.php?field=status&sort=Đang trên đường giao hàng">Đang trên đường giao hàng</option>
                                    <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "Đã giao") { ?> selected <?php } ?> value="donhang/list.php?field=status&sort=Đã giao">Đã giao</option>
                                    <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "Hủy đơn hàng") { ?> selected <?php } ?> value="donhang/list.php?field=status&sort=Hủy đơn hàng">Hủy đơn hàng</option>
                                </select>
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
                                            <th>STT</th>
                                            <th>ID Đơn hàng</th>
                                            <th>Tên khách hàng</th>
                                            <th>Địa chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Thời gian đặt hàng</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['field']) && isset($_GET['sort'])) {
                                            $field = $_GET['field'];
                                            $sort = $_GET['sort'];
                                            $sql_donhang = "SELECT distinct `order`.*, user.fullname as fullname
                                                            FROM `order` , order_detail od, user  
                                                            where `order`.id_order=od.id_order  and user.iduser=`order`.iduser
                                                                    and `order`.status='$sort'";
                                        } else {
                                            $sql_donhang = "SELECT distinct `order`.*, user.fullname as fullname
                                            FROM `order` , order_detail od, user  
                                            where `order`.id_order=od.id_order  and user.iduser=`order`.iduser";
                                        }
                                        $stt = 0;
                                        $re_donhang = mysqli_query($conn, $sql_donhang);
                                        while ($donhang = mysqli_fetch_assoc($re_donhang)) :
                                            $stt += 1;
                                            // $id_prom = $promotion['id_promotion'];
                                            // $sql_1 = "SELECT prom.*, COUNT(prom.id_promotion) AS cokm
                                            //             FROM promotion prom
                                            //             JOIN product pro ON prom.id_promotion = pro.id_promotion
                                            //             WHERE prom.id_promotion= $id_prom AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE())
                                            //             GROUP BY prom.id_promotion;";
                                            // $result_1 = mysqli_query($conn, $sql_1);
                                            // $row_1 = mysqli_fetch_assoc($result_1);
                                            // Tính toán giá sau khuyến mãi
                                            // $discountedPrice = $promotion['price']-($promotion['price'] * $promotion['discount'])/100;
                                        ?>
                                            <tr class="promotion-row">
                                                <td>
                                                    <?php echo $stt; ?>
                                                </td>
                                                <td>
                                                    <?php echo $donhang['id_order']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $donhang['fullname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $donhang['address']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $donhang['sdt']; ?>
                                                </td>
                                                <td>
                                                    <?php echo number_format($donhang['tongtien'], 0, '', '.') ?> VNĐ
                                                </td>

                                                <td>
                                                    <?php echo $donhang['status']; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d/m/Y H:i:s', strtotime($donhang['created'])); ?>
                                                </td>

                                                <td id="a">
                                                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo  $promotion['id_promotion']; ?>)"><span class="material-symbols-outlined">delete</span></a>
                                                    <a href="donhang/edit.php?id_order=<?php echo $donhang['id_order']; ?>"><span class="material-symbols-outlined">border_color</span></a>
                                                    <a href="donhang/xemchitiet.php?id_order=<?php echo $donhang['id_order']; ?>"><span class="material-symbols-outlined">steppers</span></a>
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




</body>

</html>