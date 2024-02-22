<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>header</title>

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
    <style>
        .header__top__right__language ul li a {
            font-size: 14px;
            color: #ffffff;
            padding: 1px 10px;
            width: 1;
        }

        .header__top__right__language ul {
            background: #222222;
            width: 145px;
            text-align: left;
            padding: 5px 0;
            position: absolute;
            left: 0;
            top: 43px;
            z-index: 9;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all, 0.3s;
            -moz-transition: all, 0.3s;
            -ms-transition: all, 0.3s;
            -o-transition: all, 0.3s;
            transition: all, 0.3s;
        }

        img#logo {
            height: 47px;
            margin-left: 103px;
        }

        body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            -webkit-font-smoothing: antialiased;
            /* font-smoothing: antialiased; */
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->


    <!-- Humberger End -->

    <!-- Header Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> shopmevabe@gmail.com</li>
                                <li>Miễn phí vận chuyển cho đơn hàng từ 350k</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>


                            </div>
                            <div class="header__top__right__language">
                                <!-- <img src="img/language.png" alt=""> -->
                                <div>Tra cứu đơn hàng</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Tình trạng</a></li>
                                    <li><a href="#">Lịch sử</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__language">
                                <!-- <img src="img/language.png" alt=""> -->
                                <?php
                                require_once '../models/user.php';
                                if (isset($_SESSION['iduser'])) {
                                    $iduser = $_SESSION['iduser'];
                                    $user = get_user_by_iduser($iduser, $conn); ?>
                                    <div> <i class="fa fa-user"></i> <?php echo $user['fullname']; ?></div>
                                <?php  } else { ?>
                                    <div> <i class="fa fa-user"></i> Tài khoản</div>
                                <?php   } ?>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <!-- <li><a href="../admin/user/login.php">Đăng nhập</a></li>
                                    <li><a href="../admin/user/register.php">Đăng ký</a></li> -->
                                    <?php

                                    if (isset($_SESSION['iduser'])) {
                                        $iduser = $_SESSION['iduser'];

                                        echo '<li><a href="../admin/user/logout.php">Đăng xuất</a></li>';
                                        echo '<li><a href="update_user.php?iduser=' . $iduser . '">Cập nhật thông tin</a></li>';
                                    } else {
                                        echo '<li><a href="../admin/user/login.php">Đăng nhập</a></li>';
                                        echo '<li><a href="../admin/user/register.php">Đăng ký</a></li>';
                                    }


                                    ?>
                                    <!-- <li style="display: none;"><a href="#">Đăng xuất</a></li>
                                    <li style="display: none;"><a href="#">Cập nhật </a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt="" id="logo"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">HOME</a></li>
                            <li><a href="./shop-grid.php">Sản phẩm</a></li>
                            <li><a href="#">Liên kết</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./theodoidonhang.php">Theo dõi đơn hàng</a></li>
                                    <li><a href="./shoping-cart.php">Giỏ hàng</a></li>
                                    <li><a href="./checkout.php">Thanh toán</a></li>
                                    <li><a href="./blog-details.php">Chi tiết blog</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.php">Blog</a></li>
                            <li><a href="./contact.php">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <?php
                        if (isset($_SESSION['iduser'])) {
                            $iduser = $_SESSION['iduser'];
                            $sql_layslgh = "SELECT count(*) as sl from giohang where iduser=$iduser";
                            $result_layslgh = mysqli_query($conn, $sql_layslgh);
                            $row_layslgh = mysqli_fetch_assoc($result_layslgh);
                            echo '<ul>
                            <li><a href="./my-wishlist.php"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="./shopping-cart.php"><i class="fa fa-shopping-bag"></i> ';

                            if ($row_layslgh['sl'] > 0) {
                                echo '<span>' . $row_layslgh['sl'] . '</span>';
                            }
                            echo ' </a></li>
                        </ul>';
                        } ?>

                        <!-- <div class="header__cart__price">Tổng tiền: <span>150000</span></div> -->
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->


</body>
<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<!-- <script src="js/jquery.slicknav.js"></script> -->
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>