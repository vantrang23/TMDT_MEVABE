<?php
session_start();
require_once '../libraries/connect.php';
if (isset($_SESSION['iduser'])) {
    $iduser = $_SESSION['iduser'];
}
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // them gio hang
    $sql_layslgh = "SELECT * from giohang where iduser=$iduser and product_id=$product_id";
    $result_layslgh = mysqli_query($conn, $sql_layslgh);
    $row_layslgh = mysqli_fetch_assoc($result_layslgh);
    if ($row_layslgh == null) {
        $sql_themgh = "INSERT into giohang (iduser, product_id, soluong, thoigian) values($iduser, $product_id, 1, now())";
        $result_themgh = mysqli_query($conn, $sql_themgh);
    } else {
        $sl = $row_layslgh['soluong'];
        $sl += 1;
        $sql_themgh = "UPDATE  giohang set soluong=$sl where iduser=$iduser and product_id=$product_id";
        $result_themgh = mysqli_query($conn, $sql_themgh);
    }
}
if (isset($_GET['remove_product'])) {
    $product_id = $_GET['remove_product'];
    $sql_degiohang = "DELETE from giohang WHERE iduser=$iduser AND product_id=$product_id";
    $result_degiohang = mysqli_query($conn, $sql_degiohang);
}

?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>gio hang</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


    <style>
        input.quantity {
            text-align: center;
            background: #e91e6300;
            border-color: #e91e6300;
            width: 81px;
        }

        .pro {
            background: #e91e630d;
            width: 122px;
            color: black;
        }

        .ab {
            color: black;
            text-decoration: none;
            background-color: transparent;
        }
    </style>
    <!-- GIỎ HÀNG TRỐNG -->
    <style>
        .col-lg-12 {
            margin-top: 17px;
        }

        img#giohangtrong {
            margin-left: 450px;
            margin-top: -55px;
        }
    </style>
    <style>
        thead {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        thead {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
        }

        .gia {
            font-size: 18px;
            color: #1c1c1c;
            font-weight: 700;
            width: 148px;
            padding-left: 2px;
        }

        .pro {
            margin-left: 37px;
        }

        td#gia {
            width: 175px;
            padding-left: 31px;
        }
    </style>
    <!-- TỔNG TIỀN -->
    <style>
        h5 {
            font-family: sans-serif;
        }
    </style>
    <style>
        table {
            margin-top: -105px;
        }

        th#tt {
            width: 205px;
        }

        span.material-symbols-outlined {
            margin-left: -4px;
            font-size: 14px;
            font-family: sans-serif;
            color: red;
        }
    </style>
</head>

<body>
    <?php
    require 'header.php';

    require 'search.php';
    ?>

    <section class="shoping-cart spad">
        <div class="result"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post">
                        <div class="shoping__cart__table">
                            <table>
                                <?php if (isset($_SESSION['huydonhang'])) : ?>
                                    <script>
                                        Swal.fire(
                                            'Đã hủy đơn hàng',
                                            '',
                                            'success'
                                        )
                                    </script>';
                                    <?php unset($_SESSION['huydonhang']); ?>
                                <?php endif; ?>
                                <!-- Thêm cột checkbox vào bảng -->
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Sản phẩm</th>
                                        <!-- <th id="sl">Số lượng</th> -->
                                        <!-- <th>Giá</th> -->

                                        <th id="tt">Tổng tiền</th>
                                        <th id="nd">Ngày đặt</th>

                                        <th>
                                            Trạng thái
                                        </th>
                                        <th>Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody class="r">
                                    <?php
                                    $sql_giohang = "SELECT * FROM `order` WHERE iduser = $iduser";
                                    $result_giohang = mysqli_query($conn, $sql_giohang);

                                    while ($row_giohang = mysqli_fetch_assoc($result_giohang)) {
                                        $id_order = $row_giohang['id_order'];
                                        $sql_giohang_chitiet = "SELECT od.*, pro.name as pro_name, pro.image as image
                                                                    FROM `order_detail` od
                                                                    JOIN product pro ON od.product_id = pro.product_id
                                                                    WHERE od.id_order = $id_order";
                                        $result_giohang_chitiet = mysqli_query($conn, $sql_giohang_chitiet);
                                    ?>
                                        <tr class="sd">
                                            <td class="shoping__cart__item">
                                                <?php while ($row_giohang_chitiet_row = mysqli_fetch_assoc($result_giohang_chitiet)) { ?>
                                                    <img src="../admin/upload/<?php echo $row_giohang_chitiet_row['image']; ?>" alt="Hình ảnh sản phẩm" width="80px" height="80px">
                                                    <h5><?php echo $row_giohang_chitiet_row['pro_name']; ?></h5>
                                                    <p>Số lượng: <?php echo $row_giohang_chitiet_row['soluong']; ?></p>
                                                <?php } ?>
                                            </td>
                                            <td class="shoping__cart__total fd" style="font-weight: 400;" id="total-amount">
                                                <?php
                                                echo number_format($row_giohang['tongtien'], 0, '', '.') . ' VNĐ';
                                                ?>
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <?php echo $row_giohang['created']; ?>
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <?php echo $row_giohang['status']; ?>
                                            </td>

                                            <td>
                                                <?php
                                                if ($row_giohang['status'] == "Chờ xử lý") {
                                                    echo '<a  href="javascript:void(0);" onclick="confirmDelete(' . $row_giohang['id_order'] . ')"><span class="material-symbols-outlined">Hủy đơn hàng</span></a>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                                <!-- <button name="muahang" class="primary-btn_buys">MUA HÀNG</button> -->
                            </table>

                        </div>

                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">

                    <!-- <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Mã giảm giá</h5>
                            <form action="#">
                                <input type="text" placeholder="Nhập mã giảm giá">
                                <button type="submit" class="site-btn">Áp dụng</button>
                            </form>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-6">

                    <!-- Thay đổi phần hiển thị giá và nút thanh toán -->

                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
    require 'footer.php';
    ?>
    <script>
        function confirmDelete(id_order) {
            Swal.fire({
                title: 'Confirmation',
                text: 'Bạn có chắc muốn hủy đơn hàng này không?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hủy',
                cancelButtonText: 'Thoát'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'huydonhang.php?id_order=' + id_order;
                }
            });
        }
    </script>



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>


    <style>
        th label {
            margin-left: 5px;
            /* Adjust the margin as needed */
        }
    </style>
    <style>
        input[type="checkbox"] {
            width: 20px;
            /* Adjust the width as needed */
            height: 20px;
            /* Adjust the height as needed */
        }
    </style>
    <style>
        a#tieptucmuasam {
            background: #cc30692e;
            border-radius: 25px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        a#tieptucmuasam:hover {
            background: #e91e63ba;
            border-radius: 25px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        */ .cart-btn-continue:hover {
            color: white !important;
            /* Màu chữ khi hover */
            text-decoration: none;
        }
    </style>
    <style>
        .empty-cart-message {
            text-align: center;
            font-size: 50px;
            color: #555;
            margin-top: 20px;
        }
    </style>


    <style>
        .primary-btn.cart-btn {
            color: #6f6f6f;
            padding: 14px 30px 12px;
            background: #e91e6330;
            border-color: #f0f8ff00;
            border-radius: 76px;
        }

        .primary-btn.cart-btn:hover {
            color: #6f6f6f;
            padding: 14px 30px 12px;
            background: #e91e63ba;
            border-color: #f0f8ff00;
            border-radius: 76px;
        }

        .cart-btn-delete:hover {
            color: white !important;
            /* Đặt màu trắng cho chữ */
        }

        .cart-btn-update {
            background-color: #ffcc00 !important;
            /* Đặt màu đỏ cho nền */
            color: black !important;
            /* Đặt màu trắng cho chữ */
        }

        .cart-btn-update:hover {
            color: white !important;
            text-decoration: none;
        }

        /* Căn chỉnh kích thước cột */
        .shoping__cart__table th,
        .shoping__cart__table td {
            padding: 15px;
        }

        .shoping__cart__table .shoping__product {
            width: 30%;
        }


        .shoping__cart__btns button {
            margin-right: 10px;
            /* Điều chỉnh khoảng cách theo nhu cầu của bạn */
        }


        .shoping__cart__table th:first-child,
        .shoping__cart__table td:first-child {
            padding-left: 0;
        }

        .shoping__cart__table th:last-child,
        .shoping__cart__table td:last-child {
            padding-right: 0;
        }

        /* Tạo khoảng cách cân đối */
        .shoping__cart__table tr:not(:last-child) {
            margin-bottom: 15px;
        }

        .shoping__cart__table table tbody tr td.shoping__cart__item__close {
            text-align: center;
        }

        .shoping__checkout-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .primary-btn_buys {
            color: #6f6f6f;
            padding: 14px 30px 12px;
            background: #e91e6330;
            border-color: #f0f8ff00;
            border-radius: 76px;
        }


        .primary-btn_buys:hover {
            color: #6f6f6f;
            padding: 14px 30px 12px;
            background: #e91e63ba;
            border-color: #f0f8ff00;
            border-radius: 76px;
        }
    </style>
</body>

</html>