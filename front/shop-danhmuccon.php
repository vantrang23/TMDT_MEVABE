<?php
require_once '../models/product.php';
require_once '../models/user.php';
require_once '../libraries/connect.php';
function truncateString($string, $maxLength)
{
    if (strlen($string) > $maxLength) {
        $string = mb_substr($string, 0, $maxLength - 3) . '...';
    }
    return $string;
}
?>
<?php
session_start();
if (isset($_SESSION['iduser'])) {
    $iduser = $_SESSION['iduser'];
    $_SESSION['iduser'] = $iduser;
}
if (isset($_GET['danhmuccon'])) {
    $danhmuccon = $_GET['danhmuccon'];

    //LẤY DANH MỤC TỪ PHÂN LOẠI DANH MỤC CON
    $sql_danhmuc = "SELECT cate.category_id as category_id, pro.product_id as product_id
                    from category cate, product pro, product_detail dt 
                    where cate.category_id=pro.category_id and pro.product_id=dt.product_id and dt.phanloai='$danhmuccon'";
    $result_danhmuc = mysqli_query($conn, $sql_danhmuc);
    $row_danhmuc = mysqli_fetch_assoc($result_danhmuc);
    //LẤY SẢN PHẨM LIÊN QUAN
    $sql_sanphamlienquan = "SELECT pro.*
                       FROM product pro
                       WHERE pro.product_id <> " . $row_danhmuc['product_id'] . "
                       AND pro.category_id = " . $row_danhmuc['category_id'];
    $result_sanphamlienquan = mysqli_query($conn, $sql_sanphamlienquan);

    // echo $sql_sanphamlienquan;
    // die();
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
    <title>San pham</title>

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
    <style>
        #filter__item {
            padding-top: 1px;
            border-top: 0px solid #ebebeb;
            padding-bottom: 20px;
        }

        .col-lg-4.col-md-6.col-sm-6 {
            flex: 0 0 25%;
        }

        #pic {
            height: 199px;
            position: relative;
            overflow: hidden;
        }

        #pic_giam {
            height: 230px;
            position: relative;
            overflow: hidden;
        }

        #product {
            padding-top: 26px;
            padding-bottom: 80px;
        }

        .sidebar__item h4 {
            color: #1c1c1c;
            font-weight: 700;
            font-size: 21px;
        }

        #gon {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }


        /* BORDER SẢN PHẨM */
        #col {
            flex: 0 0 23%;
            border-style: double;
            border-color: #cc30690f;
            margin: 5px 5px;
            padding: 4px 2px;
        }

        .col-lg-3.col-md-4.col-sm-6.mix {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 24%;
            border-radius: 10px;
            box-shadow: 5px 1px 3px rgb(0 0 0 / 19%);
        }

        div#col {
            box-shadow: 5px 1px 3px rgb(0 0 0 / 19%);
            border-radius: 10px;
            /* FONT-SIZE: 32px; */
        }
    </style>
</head>

<body>
    <?php
    require 'header.php';
    ?>
    <?php
    require 'search.php';
    ?>
    <section class="product spad" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Danh mục</h4>

                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Màu sắc</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    Trắng
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Xám
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Đỏ
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Đen
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Xanh dương
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Xanh lá
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Kích thước phổ biến</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Lớn
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Vừa
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Nhỏ
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Rất nhỏ
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Sản phẩm mới nhất</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                                        require_once '../libraries/connect.php';

                                        $sql = "SELECT * FROM product  ORDER BY created DESC LIMIT 4";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $image = $row['image'];
                                                $name = $row['name'];
                                                $price = $row['price'];
                                                $id_category = $row["category_id"];
                                                $path = '../admin/upload/' . $image;

                                        ?>

                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="<?php echo $path ?>" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6 id="gon"><?php echo truncateString($name, 25); ?></h6>
                                                        <span><?php echo number_format($price, 0, '', '.'); ?> VNĐ</span>
                                                    </div>
                                                </a>

                                        <?php }
                                        } ?>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                                        require_once '../libraries/connect.php';

                                        $sql = "SELECT * FROM product ORDER BY created DESC LIMIT 4 OFFSET 4";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $image = $row['image'];
                                                $name = $row['name'];
                                                $price = $row['price'];
                                                $id_category = $row["category_id"];
                                                $path = '../admin/upload/' . $image;

                                        ?>

                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="<?php echo $path ?>" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6><?php echo truncateString($name, 25); ?></h6>
                                                        <span><?php echo number_format($price, 0, '', '.'); ?> VNĐ</span>
                                                    </div>
                                                </a>

                                        <?php }
                                        } ?>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                                        require_once '../libraries/connect.php';

                                        $sql = "SELECT * FROM product ORDER BY created DESC LIMIT 4 OFFSET 8";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $image = $row['image'];
                                                $name = $row['name'];
                                                $price = $row['price'];
                                                $id_category = $row["category_id"];
                                                $path = '../admin/upload/' . $image;

                                        ?>

                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="<?php echo $path ?>" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6 id="gon"><?php echo truncateString($name, 25); ?></h6>
                                                        <span><?php echo number_format($price, 0, '', '.'); ?> VNĐ</span>
                                                    </div>
                                                </a>

                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">

                    <?php
                    $orderConditon = "";
                    $param = "";
                    $orderField = isset($_GET['field']) ? $_GET['field'] : "";
                    $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
                    if (
                        !empty($orderField)
                        && !empty($orderSort)
                    ) {
                        $orderConditon = "ORDER BY `product`.`" . $orderField . "` " . $orderSort;
                        $param .= "field=" . $orderField . "&sort=" . $orderSort . "&";
                    }


                    ?>
                    <div class="filter__item ad" id="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sắp xếp</span>
                                    <select id="sort-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                        <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "desc") { ?> selected <?php } ?> value="shop-danhmuccon.php?field=price&sort=desc&danhmuccon='<?php echo $danhmuccon ?>">Giá cao đến thấp</option>
                                        <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "asc") { ?> selected <?php } ?> value="shop-danhmuccon.php?field=price&sort=asc&danhmuccon='<?php echo $danhmuccon ?>">Giá thấp đến cao</option>
                                        <option <?php if (isset($_GET['field']) && $_GET['field'] == "created") { ?> selected <?php } ?> value="shop-danhmuccon.php?field=created&sort=asc&danhmuccon='<?php echo $danhmuccon ?>">Sản phẩm mới nhất</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <?php
                                    $sql = "SELECT COUNT(*) AS total FROM product";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $totalProducts = $row['total'];

                                    ?>
                                    <h6 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><span><?php echo $totalProducts; ?></span> Được tìm thấy</h6>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $sql_pro = "SELECT pro.* FROM product pro, product_detail prod WHERE pro.product_id = prod.product_id AND prod.phanloai = '$danhmuccon' " . $orderConditon;

                        // exit;
                        $result_pro = mysqli_query($conn, $sql_pro);
                        if (mysqli_num_rows($result_pro) > 0) {
                            while ($row = mysqli_fetch_assoc($result_pro)) {
                                // Lấy thông tin sản phẩm và hiển thị
                                $image = $row['image'];
                                $name = $row['name'];
                                $price = $row['price'];
                                $id_category = $row["category_id"];

                                $path = '../admin/upload/' . $image;
                        ?>

                                <div class="col-lg-4 col-md-6 col-sm-6" id="col">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" id="pic" data-setbg="<?php echo $path; ?>">
                                            <input type="hidden" class="product_id" id="" value="<?php echo $row['product_id']; ?>">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6 id="gon"><a href="#" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"><?php echo truncateString($name, 25); ?></a></h6>
                                            <h5><a style="color:#E91E63; font-weight:500; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" id="mar" href="shop-details.php?product_id=<?php echo $row['product_id']; ?>"><?php echo number_format($price, 0, '', '.'); ?> VNĐ</a></h5>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>

                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">SẢN PHẨM LIÊN QUAN</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <?php
                                if (mysqli_num_rows($result_sanphamlienquan) > 0) {
                                    while ($row_sanphanlienquan = mysqli_fetch_assoc($result_sanphamlienquan)) {
                                        if ($row_sanphanlienquan['id_promotion'] == 0) {
                                            echo '<div class="col-lg-4">
                                                        <div class="product__discount__item">
                                                            <div class="product__discount__item__pic set-bg" id="pic_giam" data-setbg="../admin/upload/' . $row_sanphanlienquan['image'] . '">
                                                        
                                                                <ul class="product__item__pic__hover">
                                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="product__discount__item__text">
                                                                <h5><a href="shop-details.php?product_id=' . $row_sanphanlienquan['product_id'] . '"></a></h5>
                                                                <p style="color: black;">' . $row_sanphanlienquan['name'] . '</p>
                                                                <div class="product__item__price" style="color:#E91E63; font-weight:500;">' . number_format($row_sanphanlienquan['price'], 0, '', '.') . ' VNĐ</div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                        } else {
                                            $sql_1 = "SELECT prom.*, pro.product_id as product_id, COUNT(prom.id_promotion) AS cokm, pro.image as image, pro.price as price, pro.name as name
                                                        FROM promotion prom
                                                        JOIN product pro ON prom.id_promotion = pro.id_promotion
                                                        WHERE pro.product_id = " . $row_sanphanlienquan['product_id'] . " AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE())
                                                        GROUP BY prom.id_promotion;";
                                            $result_1 = mysqli_query($conn, $sql_1);
                                            while ($row_1 = mysqli_fetch_assoc($result_1)) {
                                                $discountedPrice = $row_1['price'] - ($row_1['price'] * $row_1['discount']) / 100;
                                                echo ' <div class="col-lg-4">
                                                        <div class="product__discount__item">
                                                            <div class="product__discount__item__pic set-bg" id="pic_giam" data-setbg="../admin/upload/' . $row_1['image'] . '">
                                                                <div class="product__discount__percent">-' . $row_1['discount'] . '%</div>
                                                                <ul class="product__item__pic__hover">
                                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="product__discount__item__text">
                                                                <h5><a href="shop-details.php?product_id=' . $row_1['product_id'] . '"></a></h5>
                                                                <p style="color: black;">' . $row_1['name'] . '</p>
                                                                <div class="product__item__price" style="color:#E91E63; font-weight:500;">' . number_format($discountedPrice, 0, '', '.') . ' VNĐ<span style="color:#E91E63; font-weight:100;">' . number_format($row_1['price'], 0, '', '.') . ' VNĐ</span></div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                            }
                                        }
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    <?php
    require 'footer.php';
    ?>
    </footer>
    <!-- Footer Section End -->

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
        #pic {
            position: relative;
        }

        #pic:hover {
            cursor: pointer;
        }

        .product__discount__title h2 {
            display: inline-block;
            font-size: 26px;
            text-align: center;
            margin: 47px 7px 0px 347px;
        }
    </style>
    <script>
        const featuredItems = document.querySelectorAll('#pic');

        for (const featuredItem of featuredItems) {
            featuredItem.addEventListener('click', function() {
                // const productID = featuredItem.getAttribute('data-product-id');
                var product_id = $('.product_id').val();
                window.location.href = `shop-details.php?product_id=${product_id}`;
            });
        }
    </script>



</body>

</html>