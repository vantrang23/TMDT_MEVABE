<?php
function truncateString($string, $maxLength)
{
    if (strlen($string) > $maxLength) {
        $string = mb_substr($string, 0, $maxLength - 3) . '...';
    }
    return $string;
}
?>

<?php require_once '../models/user.php'; ?>
<?php
session_start();
if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];
    $_SESSION['iduser'] = $iduser;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trangchu_user</title>

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
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://uhchat.net/code.php?f=58d955"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <style>
        a#none:hover {
            color: #E91E63;
            text-decoration: none;
        }

        body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            -webkit-font-smoothing: antialiased;
            /* font-smoothing: antialiased; */
        }

        #color {
            border-color: #cc30690f;
            border-style: double;
            margin: 5px 5px;
            padding: 4px 25px;
        }


        .col-lg-3.col-md-4.col-sm-6.mix {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 24%;
            border-radius: 10px;
            box-shadow: 5px 1px 3px rgb(0 0 0 / 19%);
        }

        .latest-product__item {
            border-radius: 10px;
            box-shadow: 5px 1px -4px rgb(0 0 0 / 19%);
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .categories__item {
            background-size: cover;
            background-position: center;
            height: 300px;
            /* Đặt chiều cao cố định cho các phần tử */
            width: 100%;
            /* Đặt chiều rộng cố định cho các phần tử */
        }

        .category-image {
            text-align: center;
        }

        .category-text {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.7);
            /* Tạo nền mờ để tạo sự tương phản với văn bản */
            color: #fff;
            text-align: center;
            padding: 5px;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
            margin-top: -9px;
        }

        #set-bg {
            background-repeat: no-repeat;
            background-size: contain;
            background-position: top center;
            height: 200px;
        }

        h5 {
            color: #000044;
        }

        div#cantrai {
            margin-left: 17px;
        }

        #name_cate {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: #cc3069;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .header__top {
            margin-top: -316px;
        }
    </style>

    <!-- HIEN SAN PHẨM -->
    <style>
        h6 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        a#none {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        a#none\ ah {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
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

        img.categories__item.set-bg.af {
            height: 263px;
        }

        .slide img {
            width: 100%;
            height: 75%;
        }

        .header__top {
            margin-top: -191px;
        }
    </style>

</head>

<?php
require 'slideshow.php';
require 'header.php';
require 'search.php';
?>

<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php if (isset($_SESSION['dathang'])) : ?>
                    <script>
                        Swal.fire(
                            'Đơn hàng đã được gửi đi',
                            '',
                            'success'
                        )
                    </script>';
                    <?php unset($_SESSION['dathang']); ?>
                <?php endif; ?>
                <?php
                require_once '../libraries/connect.php';
                $sql = "SELECT * from category where status=1";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($category = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-lg-3">
                            <a href="shop-category.php?category_id=<?php echo $category['category_id']; ?>">
                                <img class="categories__item set-bg af" data-setbg="<?php echo '../admin/upload/' . $category['image']; ?>">
                                <h5 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><a id="name_cate" href="shop-category?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a></h5>
                                </img>
                            </a>
                        </div>
                <?php   }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">

        <div class="section-title">
            <h2 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Sản phẩm mới nhất</h2>
        </div>
        <div class="row featured__filter " id="cantrai">
            <?php
            // Kết nối đến cơ sở dữ liệu
            // require_once '../../models/user.php';
            require_once '../libraries/connect.php';
            // Truy vấn lấy danh sách sản phẩm mới nhất từ cơ sở dữ liệu
            $sql = "SELECT * FROM product where status=1 ORDER BY created DESC LIMIT 8";

            $result = mysqli_query($conn, $sql);

            // Kiểm tra và hiển thị danh sách sản phẩm mới nhất
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Lấy thông tin sản phẩm và hiển thị
                    $product_id = $row['product_id'];
                    $image = $row['image'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $id_category = $row["category_id"];
                    $path = '../admin/upload/' . $image;
                    //echo $path;exit;
                    $sql_1 = "SELECT prom.*, pro.product_id as product_id, COUNT(prom.id_promotion) AS cokm
                                    FROM promotion prom
                                    JOIN product pro ON prom.id_promotion = pro.id_promotion
                                    WHERE pro.product_id = $product_id and pro.status=1 AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE())
                                    GROUP BY prom.id_promotion;";
                    $result_1 = mysqli_query($conn, $sql_1);
                    $row_1 = mysqli_fetch_assoc($result_1);
            ?>

                    <div id="color" class="col-lg-3 col-md-4 col-sm-6 mix " . <?php echo  $id_category ?>>
                        <div class="featured__item">

                            <div class="featured__item__pic set-bg click" id="set-bg" data-setbg='<?php echo $path; ?>'>
                                <?php if ($row_1 !== null) { ?>
                                    <div class="product__discount__percent">-<?php echo $row_1['discount'] ?>%</div>
                                <?php } ?>
                                <input type="hidden" class="product_id" id="" value="<?php echo $row['product_id']; ?>">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="add-to-wishlist.php?product_id=<?php echo $row['product_id']; ?>"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="shopping-cart.php?product_id=<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a id="none" href="shop-details.php?product_id=<?php echo $row['product_id']; ?>"> <?php echo truncateString($name, 25); ?></a></h6>

                                <?php
                                if ($row_1 !== null) {
                                    $giagiam = $price - ($price * $row_1['discount']) / 100; ?>
                                    <h5 class="gia"><a id="none" href="shop-details.php?product_id=<?php echo $row['product_id']; ?>" style="color:#E91E63; font-weight:500;"> <?php echo number_format($giagiam, 0, '', '.'); ?> VNĐ</a></h6>
                                        <h5 class="gia"><a id="none ah" href="shop-details.php?product_id=<?php echo $row['product_id']; ?>" style="color:#E91E63; font-weight:500;"> <?php echo number_format($price, 0, '', '.'); ?> VNĐ</a></h6>
                                        <?php } else { ?>
                                            <h5 class="gia"><a id="none" href="shop-details.php?product_id=<?php echo $row['product_id']; ?>" style="color:#E91E63; font-weight:500;"> <?php echo number_format($price, 0, '', '.'); ?> VNĐ</a></h6>
                                            <?php       } ?>

                            </div>
                        </div>
                    </div>

            <?php }
            } else {
                echo "Không có sản phẩm mới nhất.";
            }
            ?>
        </div>
    </div>
</section>


<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row ty">
            <div class="container">

                <div class="section-title">
                    <h2 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Sản phẩm khuyến mãi</h2>
                </div>
                <div class="row featured__filter " id="cantrai">


                    <?php
                    $sql = "SELECT pro.*, prom.discount as prom_discount, cate.name as cate_name
                                            FROM product pro, promotion prom, category cate 
                                            WHERE pro.id_promotion = prom.id_promotion and pro.status=1 AND pro.category_id=cate.category_id and (prom.end_day > CURDATE() OR prom.end_day = CURDATE()) 
                                            LIMIT 6";
                    $result = mysqli_query($conn, $sql);
                    $sl_khuyenmai = mysqli_num_rows($result);
                    if ($sl_khuyenmai > 0) {
                        while ($pro_prom = mysqli_fetch_assoc($result)) {
                            $discountedPrice = $pro_prom['price'] - ($pro_prom['price'] * $pro_prom['prom_discount']) / 100; ?>

                            <a href="shop-details.php?product_id=<?php echo $pro_prom['product_id']; ?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="<?php echo '../admin/upload/' . $pro_prom['image']; ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><?php echo truncateString($pro_prom['name'], 30); ?></h6>
                                    <div class="product__item__price" style="color:#E91E63; font-weight:500; "><?php echo number_format($discountedPrice, 0, '', '.'); ?> VNĐ<span style="color:#E91E63; font-weight:100;text-decoration: line-through;"><?php echo number_format($pro_prom['price'], 0, '', '.'); ?> VNĐ</span></div>
                                </div>
                            </a>
                    <?php   }
                    } ?>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="latest-product__text">
            <!-- <h4 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Sản phẩm được được mua nhiều nhất</h4> -->
            <div class="latest-product__slider owl-carousel">
                <div class="latest-prdouct__slider__item">
                    <!-- <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a> -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <!-- <h2 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Bài viết từ Blog</h2> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <!-- <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <!-- <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <!-- <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
</section>
<!-- Blog Section End -->
<?php
require 'footer.php';
?>

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<style>
    .featured__item__pic {
        cursor: default;
    }

    .featured__item__pic:hover {
        cursor: pointer;
    }
</style>
<script>
    featuredItems = document.querySelectorAll('.featured__item__pic');
    for (const featuredItem of featuredItems) {
        featuredItem.addEventListener('click', function() {
            var product_id = featuredItem.querySelector('.product_id').value;
            if (product_id) {
                // alert(product_id);
                window.location.href = `shop-details.php?product_id=${product_id}`;
            }
        });
    }
</script>



</body>

</html>