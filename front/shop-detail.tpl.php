<?php
if (isset($_SESSION['iduser'])) {
    $iduser = $_SESSION['iduser'];
    // die();
}


function truncateString($string, $maxLength)
{
    if (strlen($string) > $maxLength) {
        $string = mb_substr($string, 0, $maxLength - 3) . '...';
    }
    return $string;
}
?>
<?php
require 'search_keyword.php';

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" săp <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CHI TIẾT SẢN PHẤM</title>

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
    <!-- <link rel="stylesheet" href="css/style.css" type="text/css"> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<style>
    textarea#comment {
        overflow: auto;
        resize: vertical;
        width: 400px;
        height: 100px;
        margin-top: 10px;
    }

    input#email {
        margin-left: 62px;
    }

    button {
        margin-left: 285px;
        background-color: #cc3069;
        border-color: #cc3069;
        box-shadow: 10px;
    }
</style>
<!-- CSS BÌNH LUẬN -->
<style>
    span.material-symbols-outlined {
        color: #9E9E9E;
        font-size: 57px;
    }

    textarea#message {
        width: 500px;
    }

    input.guibinhluan {
        color: #212529;
        background-color: #cc306963;
        border-color: #cc306963;
        margin-right: 497px;
        margin-top: -51px;
        margin-bottom: 21px;
    }

    h3#slbl {
        font-size: 19px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    h3.xemthem1.xemthem {
        margin-left: 249px;
        font-size: 18px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin-top: -20px;
    }

    h3.xemthem1.anbot {
        margin-left: 249px;
        font-size: 18px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin-top: -20px;
    }

    div#tabs-3 {
        margin-top: -77px;
    }

    .card {
        width: 1000px;
        margin-left: -124px;
        padding: -48px;
    }

    form#commentForm {
        margin-top: 100px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .product__details__tab__desc {
        margin-top: -52px;
    }

    .tab-pane.tabs-description.active.show {
        margin-top: 40px;
    }

    .product__details__tab .product__details__tab__desc h6 {
        font-weight: 700;
        color: #333333;
        margin-bottom: 4px;
        /* margin-top: 40px; */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    .product__details__tab .product__details__tab__desc p {
        color: #666666;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin-top: -17px;
        margin-left: 29px;
    }

    ul.nav.nav-tabs {
        margin-bottom: 30px;
    }

    section.product-details.spad {
        margin-top: -79px;
    }

    .product-details {
        padding-top: 11px;
    }

    img.product__details__pic__item--large {
        margin-top: -27px;
    }
</style>
<!-- CSS DETAIL -->
<style>
    .product__details__text h3 {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .product__details__text ul {
        border-top: 0px solid #ebebeb;
        padding-top: 40px;
        margin-top: 50px;
        margin-bottom: 15px;
    }

    .section-title h2 {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    section.product-details.spad {
        margin-top: -51px;
        margin-bottom: -72px;
    }

    .section.hero.hero-normal.ab {
        padding-bottom: 66px;
    }

    p#bot {
        margin-bottom: -74px;
    }

    .goc {
        font-size: 17px;
        font-weight: 100;
        text-decoration: line-through;
        margin-left: 17px;
        margin-top: -13px;
        color: red;
    }

    .product__details__text .product__details__price {
        font-size: 25px;
        color: red;
        font-weight: 600;
        margin-bottom: 15px;
    }
</style>
<!-- CSS BÌNH LUẬN -->
<style>
    p.text-muted.small.mb-0 {
        margin-top: 10px;
        margin-left: 0px;
    }

    .card {
        padding-top: 15px;
        padding-left: 10px;
        margin-left: -130px;
    }
</style>
<!-- GIA -->
<style>
    h5#gia_detail {
        color: red;
        font-size: 17px;
        font-weight: 400;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        /* text-decoration: line-through; */
    }

    h5#gia_khuyenmai {
        color: red;
        font-size: 17px;
        font-weight: 500;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    h5#gia_detail\ rt {
        color: red;
        font-size: 17px;
        font-weight: 400;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-decoration: line-through;
    }

    .product__discount__percent {
        height: 45px;
        width: 45px;
        background: #dd2222;
        border-radius: 50%;
        font-size: 14px;
        color: #ffffff;
        line-height: 45px;
        text-align: center;
        position: absolute;
        left: 15px;
        top: 15px;
    }
</style>
<style>
    a.primary-btn {
        background: #cc30699c;
    }

    .mua {
        margin-top: -41px;
    }

    a.primary-btn.jj {
        margin-left: 255px;
        margin-top: -97px;
    }

    div#ak {
        margin-top: 10px;
    }

    img.product__details__pic__item--large {
        height: 456px;
    }

    a.primary-btn.ds.jj {
        margin-left: 1px;
        margin-top: 14px;
        height: 50px;
    }

    a.primary-btn.ds.jj:hover {
        margin-left: 1px;
        margin-top: 14px;
        height: 50px;
    }
</style>

<body>
    <?php
    require 'header.php';
    require 'search.php';
    ?>

    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?php echo '../admin/upload/' . $product['image']; ?>" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php
                            $sql_image = "SELECT * FROM product_image WHERE product_id = $product_id";
                            $result_image = mysqli_query($conn, $sql_image);
                            while ($product_image = mysqli_fetch_assoc($result_image)) {
                                echo '<img data-imgbigurl="../admin/upload/' . $product_image['image'] . '" src="../admin/upload/' . $product_image['image'] . '" alt="">';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $product['name']; ?></h3>
                        <?php
                        $sql_spkhuyenmai = "SELECT prom.* , COUNT(prom.id_promotion) as cokm from promotion prom, product pro where prom.id_promotion=pro.id_promotion and pro.product_id=$product_id AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE()) GROUP by (id_promotion)";
                        $result_spkhuyenmai = mysqli_query($conn, $sql_spkhuyenmai);

                        // Kiểm tra xem có dữ liệu trả về không
                        if ($result_spkhuyenmai) {
                            // Lấy dòng dữ liệu đầu tiên từ kết quả
                            $row_spkhuyenmai = mysqli_fetch_assoc($result_spkhuyenmai);

                            // Kiểm tra xem $row_spkhuyenmai có giá trị không
                            if ($row_spkhuyenmai !== null) {
                                // Kiểm tra điều kiện và hiển thị giá sản phẩm
                                if ($row_spkhuyenmai['cokm'] > 0) {
                                    $giagiam = $product['price'] - ($product['price'] * $row_spkhuyenmai['discount']) / 100;
                        ?>
                                    <div class="product__details__price"><?php echo number_format($giagiam, 0, '', '.'); ?> VNĐ</div>
                                    <input type="hidden" class="" id="gia" value="<?php echo $giagiam ?>">
                                    <div class="goc"><?php echo number_format($product['price'], 0, '', '.'); ?> VNĐ</div>
                                <?php
                                } else {
                                ?>
                                    <div class="product__details__price"><?php echo number_format($product['price'], 0, '', '.'); ?> VNĐ</div>
                                    <input type="hidden" class="" id="gia" value="<?php echo $product['price'] ?>">
                                <?php
                                }
                            } else { ?>
                                <div class="product__details__price"><?php echo number_format($product['price'], 0, '', '.'); ?> VNĐ</div>
                                <input type="hidden" class="" id="gia" value="<?php echo $product['price'] ?>">
                        <?php  }
                        }
                        ?>
                        <p id="bot"><?php //echo $product['detail']; 
                                    ?></p>

                        <ul>
                            <input type="hidden" name="" id="" class="con" value="<?php echo $product['quantity']; ?>">
                            <li><b>Trạng thái:</b> <span>còn <?php echo $product['quantity']; ?> sản phẩm</span></li>
                            <!-- <li><b>Đang chuyển hàng:</b> <span>1 ngày vận chuyển. <samp>Miễn phí ship trong hôm nay</samp></span></li> -->
                            <!-- <li><b>Cân nặng</b> <span>0.5 kg</span></li> -->
                            <!-- <li><b>Chia sẻ</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li> -->
                        </ul>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <form action="" method="post">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input class="sl" name="sl" id="quantityInput" type="text" value="1">
                                        <input type="hidden" name="slgh" id="slgh" class="" value="">

                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="muaa">
                            <a href="#" class="primary-btn ds jj" id="addToCartBtn">THÊM VÀO GIỎ HÀNG</a>
                        </div>
                        <div class="mua">
                            <a href="#" class="primary-btn jj" id="addToCartBtn1">MUA NGAY</a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <!-- Trong phần nav-tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href=".tabs-description" role="tab" aria-selected="false"> Mô tả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href=".tabs-reviews" role="tab" aria-selected="false">Đánh giá</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active tabs-description" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <?php
                                    $sql = "SELECT * FROM  product WHERE product_id='$product_id'";
                                    $query = mysqli_query($conn, $sql);
                                    $row_detail = mysqli_fetch_assoc($query); ?>

                                    <h6>Mô tả</h6>
                                    <p><?php echo $row_detail['detail'] ?></p>

                                </div>
                            </div>
                            <div class="tab-pane active tabs-description" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <?php
                                    if (!empty($product_detail['advantage'])) { ?>
                                        <h6>Thông tin sản phẩm</h6>
                                        <p><?php echo $product_detail['advantage'] ?></p>
                                    <?php   } else { ?>

                                    <?php   } ?>
                                </div>
                            </div>
                            <div class="tab-pane active tabs-description" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <?php
                                    if (!empty($product_detail['object'])) { ?>
                                        <h6>Đối tượng sử dụng</h6>
                                        <p><?php echo $product_detail['object'] ?></p>
                                    <?php   } ?>
                                </div>
                            </div>
                            <div class="tab-pane active tabs-description" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <?php
                                    if (!empty($product_detail['instruct'])) { ?>
                                        <h6>Cách dùng</h6>
                                        <p><?php echo $product_detail['instruct'] ?></p>
                                    <?php   } ?>
                                </div>
                            </div>
                            <div class="tab-pane active tabs-description" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <?php
                                    if (!empty($product_detail['ingredient'])) { ?>
                                        <h6>Thành phần</h6>
                                        <p><?php echo $product_detail['ingredient'] ?></p>
                                    <?php   } ?>
                                </div>
                            </div>
                            <div class="tab-pane active tabs-description" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <?php
                                    if (!empty($product_detail['preserve'])) { ?>
                                        <h6>Bảo quản</h6>
                                        <p><?php echo $product_detail['preserve'] ?></p>
                                    <?php   } ?>
                                </div>
                            </div>



                            <?php
                            $sql_binhluan = "SELECT * from binhluan where product_id=$product_id";
                            $result_binhluan = mysqli_query($conn, $sql_binhluan);
                            $row_binhluan = mysqli_fetch_assoc($result_binhluan);

                            //lay ten nguoi dung
                            $sql_name_user = "SELECT * from user where iduser=$iduser";
                            $result_name_user = mysqli_query($conn, $sql_name_user);
                            $row_name_user = mysqli_fetch_assoc($result_name_user);

                            ?>
                            <div class="tab-pane tabs-reviews" id="tabs-3" role="tabpanel">
                                <form id="commentForm" method="post">
                                    <?php
                                    $sql_sobinhluan = "SELECT count(*) as soluong FROM binhluan  WHERE trangthai = 1 and product_id=$product_id";
                                    $result_sobinhluan = mysqli_query($conn, $sql_sobinhluan);
                                    $sobinhluan = mysqli_fetch_assoc($result_sobinhluan);
                                    ?>
                                    <fieldset>
                                        <div class="row">
                                            <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                                <textarea width="10%" height="200px" class="form-control binhluan" id="message" name="noidung" placeholder="Viết bình luận . . ." required="" maxlength="100"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <input type="hidden" class="id_pro" value="<?php echo $product_id ?>">
                                    <input type="hidden" name="name" class="name" value="<?php echo $iduser ?>">
                                    <input type="submit" class="guibinhluan" value="Gửi bình luận">
                                    <h3 id="slbl"><?php echo $sobinhluan['soluong'] ?> Bình luận</h3>
                                    <?php
                                    if ($sobinhluan['soluong'] > 0) { ?>
                                        <a href="">
                                            <h3 class="xemthem1 xemthem">Xem thêm bình luận . . .</h3>
                                        </a>
                                        <a href="">
                                            <h3 class="xemthem1 anbot">Ẩn bớt</h3>
                                        </a>
                                    <?php }
                                    ?>
                                </form>
                                <?php
                                if ($sobinhluan['soluong'] > 0) { ?>
                                    <div class="product__details__tab__desc">
                                        <section style="background-color: #eee;">
                                            <div class="container my-5 py-5">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-md-12 col-lg-10 col-xl-8">
                                                        <div class="card ac">
                                                            <?php
                                                            $sql_binhluan_1 = "SELECT bl.*, u.username AS name
                                                                                FROM binhluan AS bl
                                                                                JOIN user AS u ON bl.iduser = u.iduser
                                                                                WHERE trangthai = 1 and product_id=$product_id
                                                                                ORDER BY ngaydang DESC limit 2";
                                                            $result_binhluan_1 = mysqli_query($conn, $sql_binhluan_1);

                                                            if (mysqli_num_rows($result_binhluan_1) > 0) {
                                                                while ($row_binhluan = mysqli_fetch_assoc($result_binhluan_1)) { ?>
                                                                    <div class="d-flex flex-start align-items-center">
                                                                        <span class="material-symbols-outlined">account_circle</span>
                                                                        <div>
                                                                            <h6 class="fw-bold text-primary mb-1"><?php echo $row_binhluan['name'] ?></h6>
                                                                            <p class="text-muted small mb-0">
                                                                                <?php echo $row_binhluan['ngaydang'] ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <p class="mt-3 mb-4 pb-2">
                                                                        <?php echo $row_binhluan['noidung'] ?>
                                                                    </p>

                                                            <?php  }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>

                </div>
            </div>
            <div class="row">
                <?php

                if (mysqli_num_rows($result_sanphamlienquan) > 0) {
                    while ($row_sanphanlienquan = mysqli_fetch_assoc($result_sanphamlienquan)) {

                        // Lấy thông tin sản phẩm và hiển thị
                        $image = $row_sanphanlienquan['image'];
                        $name = $row_sanphanlienquan['name'];
                        $price = $row_sanphanlienquan['price'];
                        $id_category = $row_sanphanlienquan["category_id"];
                        $path = '../admin/upload/' . $image;
                        $sql_1 = "SELECT prom.*, pro.price as price
                                        FROM promotion prom
                                        JOIN product pro ON prom.id_promotion = pro.id_promotion
                                        WHERE pro.product_id = " . $row_sanphanlienquan['product_id'] . " AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE())
                                        GROUP BY prom.id_promotion;";
                        $result_1 = mysqli_query($conn, $sql_1);
                        $row_1 = mysqli_fetch_assoc($result_1);

                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6" . <?php echo  $id_category ?>>
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?php echo $path; ?>">
                                    <?php if ($row_1 !== null) { ?>
                                        <div class="product__discount__percent">-<?php echo $row_1['discount'] ?>%</div>
                                    <?php } ?>
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                        <li><a href="shopping-cart.php?product_id=<?php echo $row_sanphanlienquan['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="shop-details.php?product_id=<?php echo $row_sanphanlienquan['product_id']; ?>"><?php echo truncateString($name, 35)  ?></a></h6>

                                    <?php
                                    if ($row_sanphanlienquan['id_promotion'] > 0) {

                                        if ($row_1 !== null) {
                                            $discountedPrice = $row_1['price'] - ($row_1['price'] * $row_1['discount']) / 100;
                                            echo '<h5 id="gia_khuyenmai"><a id="none" href="shop-details.php?product_id=' . $row_sanphanlienquan['product_id'] . '" style="color:#E91E63; font-weight:500;">' . number_format($discountedPrice, 0, '', '.') . 'VNĐ</a></h5>';
                                            echo '<h5 id="gia_detail rt"><a id="none" href="shop-details.php?product_id=' . $row_sanphanlienquan['product_id'] . '" style="color:#E91E63; font-weight:500;">' . number_format($price, 0, '', '.') . 'VNĐ</a></h5>';
                                        } else {
                                            echo '<h5 id="gia_detail"><a id="none" href="shop-details.php?product_id=' . $row_sanphanlienquan['product_id'] . '" style="color:#E91E63; font-weight:500;">' . number_format($price, 0, '', '.') . 'VNĐ</a></h5>';
                                        }
                                    } else {
                                        if ($row_sanphanlienquan['id_promotion'] == 0) {
                                            echo '<h5 id="gia_detail">' . number_format($price, 0, '', '.') . 'VNĐ</h5>';
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                <?php       }
                }
                ?>

            </div>
        </div>
    </section>
    <?php
    require 'footer.php';
    ?>

    <!-- TĂNG SỐ LƯỢNG -->
    <script>
        $(document).ready(function() {

            $('.inc').click(function(e) {
                e.preventDefault();

                var sl = $('.sl').val();
                var quantity = $('.con').val();
                slgh = parseInt(sl)
                slgh = slgh + 1;
                // alert(quantity);
                if (sl == quantity) {
                    return;
                }
                console.log("Số lượng đã thay đổi: " + slgh);
                document.getElementById('slgh').value = slgh;

            });
        });
    </script>
    <!-- GIẢM SỐ LƯỢNG -->
    <script>
        $(document).ready(function() {

            $('.dec').click(function(e) {
                e.preventDefault();

                var sl = $('.sl').val();
                // sl = sl - 1;
                // alert(sl);
                if (sl == 0) {
                    return;
                }
                console.log("Số lượng đã thay đổi: " + sl);
                document.getElementById('slgh').value = sl;

            });
            // alert(sl);
        });
    </script>

    <script>
        document.getElementById('addToCartBtn').addEventListener('click', function() {
            var slgh = document.getElementById('slgh').value;
            // alert(slgh)
            var productId = <?php echo htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8'); ?>;

            window.location.href = 'shopping-cart.php?product_id=' + productId + '&soluong=' + slgh;
        });
    </script>
    <script>
        document.getElementById('addToCartBtn1').addEventListener('click', function() {
            var slgh = document.getElementById('slgh').value;
            var thanhtien = document.getElementById('gia').value;
            // alert(slgh)
            var productId = <?php echo htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8'); ?>;

            window.location.href = 'checkout_detail.php?product_id=' + productId + '&soluong=' + slgh + '&thanhtien=' + thanhtien;
        });
    </script>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>




    <script>
        $(document).ready(function() {
            $('.nav-tabs a').on('click', function(e) {
                e.preventDefault();
                $('.tab-pane').removeClass('active');
                var targetTab = $(this).attr('href');
                $(targetTab).addClass('active show');
                $('.nav-tabs a').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>

    <!-- BÌNH LUẬN -->
    <script>
        $(document).ready(function() {
            $('.guibinhluan').click(function(e) {
                e.preventDefault();

                var binhluan = $('.binhluan').val();
                var name = $('.name').val();
                var id_pro = $('.id_pro').val();
                // alert(id_pro);

                $.ajax({
                    method: "POST",
                    url: "binhluan.php",
                    dataType: 'html',
                    data: {
                        binhluan: binhluan,
                        name: name,
                        id_pro: id_pro
                    }
                }).done(function(response) {
                    $('.ac').html(response);
                    document.getElementById('message').value = '';
                });
            });
        });
    </script>
    <!-- XEM THÊM BÌNH LUẬN -->
    <script>
        $(document).ready(function() {
            // Ẩn các bình luận ban đầu
            $('.anbot').hide();
            $('.xemthem').on('click', function(e) {
                e.preventDefault();
                // Hiển thị nút "Xem thêm" và ẩn các bình luận
                $('.xemthem').hide();
                $('.anbot').show();

                // Lấy tất cả bình luận
                $.ajax({
                    method: 'POST',
                    url: 'xemthembl.php',
                    dataType: 'html',
                    data: {
                        id_pro: $('.id_pro').val(),
                        iduser: $('.name').val(),
                    }
                }).done(function(response) {
                    // Thay thế các bình luận hiện có bằng các bình luận đã lấy
                    $('.ac').html(response);
                });
            });

            // Tạo sự kiện click cho nút "Ẩn bình luận"
            $('.anbot').on('click', function(e) {
                e.preventDefault();

                $('.anbot').hide();
                $('.xemthem').show();
                // alert("hi");
                // exit();
                // Lấy tất cả bình luận
                $.ajax({
                    method: 'POST',
                    url: 'a.php',
                    dataType: 'html',
                    data: {
                        id_pro: $('.id_pro').val(),
                        iduser: $('.name').val()
                    }
                }).done(function(response) {
                    // Thay thế các bình luận hiện có bằng các bình luận đã lấy
                    $('.ac').html(response);

                });
            });
        });
    </script>




</body>

</html>