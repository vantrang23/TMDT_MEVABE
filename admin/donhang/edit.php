<?php
session_start();

require_once '../../libraries/connect.php';
if (isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];
}
?>
<?php
if (isset($_POST['edit'])) {
    $id_order = $_POST["id_order"];
    $status = $_POST["status"];
    $ghi_chu = $_POST["huydonhang"];

    function getStatusName($status)
    {
        switch ($status) {
            case 0:
                return "Chờ xử lý";
            case 1:
                return "Đã xác nhận";
            case 2:
                return "Đang trên đường giao";
            case 3:
                return "Đã giao";
            case 4:
                return "Hủy đơn hàng";
            default:
                return "Trạng thái không xác định";
        }
    }
    $statusName = getStatusName($status);

    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $new_file_name = $file['name'];
        move_uploaded_file($file['tmp_name'], '../upload/' . $new_file_name);
    } else {
        $new_file_name = ''; // Nếu không có tệp hình ảnh mới, gán giá trị rỗng
    }
    $sql_up = "UPDATE `order` set status='$statusName', note_admin='$ghi_chu', image='$new_file_name' where id_order=$id_order";
    $re_up = mysqli_query($conn, $sql_up);
    // echo $sql_up; exit;

    if($status ==3){
        $sql_up = "UPDATE `order` set ngaygiao=NOW() where id_order=$id_order";
        $re_up = mysqli_query($conn, $sql_up);
    }
    header("location: list.php");
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



        label {
            font-size: 18px;
        }


        span {
            font-size: 17px;
        }

        .ghichu {
            margin-top: 16px;
        }

        .col-12 {
            margin-bottom: 200px;
        }

        textarea {
            height: 58px;
            width: 468px;
        }

        p#ad {
            font-size: 17px;
        }

        select.form-input {
            font-size: 16px;
            width: 250px;
            margin-left: 13px;
        }

        input#adas {
            width: 9%;
            padding: 10px;
            background-color: #00004499;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: px;
        }

        input#adas:hover {
            width: 9%;
            padding: 10px;
            background-color: #000044fc;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: px;
        }

        input[type="file"] {
            margin-bottom: 32px;
            font-size: 16px;
        }

        input#adas {
            margin-top: 39px;
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
                    <!-- if breadcrumb is single--><a href="#">ĐƠN HÀNG</a>
                </li>
                <li class="breadcrumb-item active"><span>Chỉnh sửa đơn hàng</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <main class="content">
        <div class="container-fluid p-0">
            <h4 class="h3 mb-3" style="font-weight: bold; font-size:20px;">CHỈNH SỬA ĐƠN HÀNG</h4>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_order" id="" value="<?php echo $id_order ?>">
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <?php
                                    $sql_donhangtt = "SELECT *
                                                    FROM  `order`
                                                    where id_order=$id_order";
                                    $re_donhangtt = mysqli_query($conn, $sql_donhangtt);
                                    $donhangtt = mysqli_fetch_assoc($re_donhangtt);
                                    $tt = $donhangtt['status'];

                                    $sql_donhang = "SELECT `order`.*, pro.name as pro_name, user.username as username
                                                    FROM `order` , order_detail od, product pro, user  
                                                    where `order`.id_order=od.id_order and pro.product_id=od.product_id and user.iduser=`order`.iduser and `order`.id_order=$id_order";
                                    $re_donhang = mysqli_query($conn, $sql_donhang);
                                    $donhang = mysqli_fetch_assoc($re_donhang);
                                    ?>

                                    <div class="chitiet">
                                        <!-- <p class="tt">THÔNG TIN KHÁCH HÀNG</p> -->
                                        <div class="trangthai">
                                            <label for="">Trạng thái: </label>
                                            <select name="status" class="form-input">
                                                <option value="0" <?php echo ($tt == "Chờ xử lý") ? 'selected' : ''; ?>>Chờ xử lý</option>
                                                <option value="1" <?php echo ($tt == "Đã xác nhận") ? 'selected' : ''; ?>>Đã xác nhận</option>
                                                <option value="2" <?php echo ($tt == "Đang trên đường giao") ? 'selected' : ''; ?>>Đang trên đường giao</option>
                                                <option value="3" <?php echo ($tt == "Đã giao") ? 'selected' : ''; ?>>Đã giao</option>
                                                <option value="4" <?php echo ($tt == "Hủy đơn hàng") ? 'selected' : ''; ?>>Hủy đơn hàng</option>
                                            </select>
                                        </div>
                                        <div class="ghichu" id="ghi-chu">
                                            <p id="ad">Ghi chú (nếu hủy đơn hàng): </p>
                                            <textarea name="huydonhang" id="" cols="30" rows="10"></textarea>
                                        </div>

                                        <div class="ghichu" id="hinh-anh">
                                            <p id="ad">Hình ảnh đã giao hàng: </p>
                                            <input type="file" name="image" id="" />
                                        </div>


                                    </div>


                                </div>
                                <input type="submit" name="edit" id="adas" value="Chỉnh sửa">
                                <a id="da" style="font-size: 16px;" href="donhang/list.php">Quay lại</a>
                            </div>
                        </form>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ẩn mặc định khi trang được tải
            $('#hinh-anh').hide();

            // Xử lý sự kiện khi giá trị của trạng thái thay đổi
            $('select[name="status"]').change(function() {
                var selectedValue = $(this).val();

                // Nếu trạng thái là "Đã giao", hiển thị phần hình ảnh, ngược lại ẩn đi
                if (selectedValue === "3") {
                    $('#hinh-anh').show();
                } else {
                    $('#hinh-anh').hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Ẩn mặc định khi trang được tải
            $('#ghi-chu').hide();

            // Xử lý sự kiện khi giá trị của trạng thái thay đổi
            $('select[name="status"]').change(function() {
                var selectedValue = $(this).val();

                // Nếu trạng thái là "Đã giao", hiển thị phần hình ảnh, ngược lại ẩn đi
                if (selectedValue === "4") {
                    $('#ghi-chu').show();
                } else {
                    $('#ghi-chu').hide();
                }
            });
        });
    </script>



</body>

</html>