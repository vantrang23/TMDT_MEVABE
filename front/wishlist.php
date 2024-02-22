<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>San pham yeu thich</title>

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
</head>
<body>

<?php

session_start();
require_once '../libraries/connect.php';
// Kiểm tra nếu giỏ hàng chưa tồn tại, khởi tạo nó
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = array();
}

?>
    <?php
        require 'header.php';
    ?>
   
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Sản phẩm yêu thích</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>sanphamyeuthich</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    
    <!-- Shoping Cart Section Begin  -->
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    // Kiểm tra nếu giỏ hàng trống
                    if (empty($_SESSION['wishlist'])) {
                        echo '<p class="empty-cart-message">BẠN CHƯA THÊM SẢN PHẨM YÊU THÍCH NÀO</p>';
                    } else {
                    ?>
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thêm vào giỏ hàng</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($_SESSION['wishlist'] as $product_id => $product) : ?>
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <!-- Hiển thị hình ảnh và tên sản phẩm -->
                                            
                                                <img src="../admin/upload/<?php echo $product['image']; ?>" alt="Product Image" width=80px height=80px>

                                                <h5><?php echo $product['name']; ?></h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                <!-- Hiển thị giá sản phẩm -->
                                                <?php
                                                if (isset($product['price'])) {
                                                    echo number_format($product['price'], 0, '', '.') . ' VNĐ';
                                                } else {
                                                    echo 'Giá không khả dụng';
                                                }
                                                ?>
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <!-- Hiển thị số lượng sản phẩm -->
                                                        <?php echo $product['quantity']; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__add-to-cart" >
                                                <!-- Thêm vào giỏ hàng -->
                                                <a href="add-to-cart.php?product_id=<?php echo $product_id; ?>" class="primary-btn_them"><span class="icon_cart"></span> Thêm</a>
                                            </td>
                                            <td class="shoping__cart__item__close" onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm?')">
                                                <!-- Xóa sản phẩm khỏi danh sách yêu thích -->
                                                <a href="delete-wishlist.php?product_id=<?php echo $product_id; ?>"><span class="icon_close"></span></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                }
                ?>
                    </div>

                <div class="row">
                    <!-- <div class="col-lg-12"> -->
                        <div class="shoping__cart__btns">
                            <div class="button-container">
                                <a href="index.php" class="primary-btn cart-btn">Tiếp tục mua sắm</a>
                                <form id="xoatc" method="post" action="delete-all-wishlist.php" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm?')">
                                    <button type="submit" name="remove_all" class="cart-btn-delete">
                                        <span class="icon_close"></span> <b>XÓA TẤT CẢ</b>
                                    </button>
                                </form>
                            </div>
                        </div>                     
                    <!-- </div> -->
                </div>

            </div>
        </div>
    </section>

    <?php
        require 'footer.php';
    ?>
    
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- <script src="js/jquery.slicknav.js"></script> -->
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <style>
        .shoping__cart__table th,
        .shoping__cart__table td {
        padding: 15px;
        }
        .primary-btn_them {
            text-decoration: none;
            /* width: 60px;
            height:30px; */
            background-color: #7fad39;
            color:black;
            border: 1px solid black; /* Set border to 2px solid black */
            border-radius: 5px; /* Add rounded corners */  
            padding:7px 15px;
        }
        .primary-btn_them:hover {
            text-decoration: none;
            padding:7px 15px;
            /* width: 60px;
            height:30px; */
            background-color: #7fad39;
            color:white;
            border: 1px solid black; /* Set border to 2px solid black */
           

        }
        .shoping__cart__table .shoping__product {
        width: 30%;
        }
        .shoping__cart__table th:first-child,
        .shoping__cart__table td:first-child {
        padding-left: 0;
        }

        .shoping__cart__table th:last-child,  
        .shoping__cart__table td:last-child {
        padding-right: 0;
        }
        .shoping__cart__table tr:not(:last-child) {
        margin-bottom: 15px;
        }
      
        .cart-btn-delete {
        font-size:14px;
        width:200px;
        height:50.2px;
        background-color: #ff0000; /* Đặt màu đỏ cho nền */
        color: black; /* Đặt màu trắng cho chữ */
      
        }

        .cart-btn-delete:hover{
        color:white; 
        /* width:200px;
        height:50.2px; */
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
        #xoatc {
            float:right;
            padding-left:30px;
        }
        .cart-btn {
            background-color: #4caf50 !important;
            color: black !important;
            border: 2px solid #000000; /* Viền đen 2px */
            /* padding: 10px 20px; Điều chỉnh kích thước nút */
            text-decoration: none; /* Loại bỏ gạch chân khi làm việc với thẻ a */
            display: inline-block; /* Cho phép chỉnh kích thước và padding */
            transition: background-color 0.3s, color 0.3s; /* Hiệu ứng chuyển đổi màu nền và màu chữ trong 0.3s */
            /* margin-right: 10px; Khoảng cách với nút khác (nếu có) */
        }

        .cart-btn:hover {
            /* background-color: #45a049; Màu nền khi hover */
            text-decoration: none;
            color: white !important;/* Màu chữ khi hover */
        }
    </style>

</body>