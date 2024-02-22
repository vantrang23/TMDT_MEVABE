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
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
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

        #col {
            flex: 0 0 24%;
            border-style: ridge;
            border-color: #cc3069;
            margin: 1px 2px;
        }
    </style>
    <style>
        .col-lg-9.col-md-7.a {
            max-width: 100%;
        }

        div#col {
            border-color: #cc30690f;
            border-style: double;
            margin: 5px 5px;
            padding: 4px 25px;
            box-shadow: 5px 1px 3px rgb(0 0 0 / 19%);
            border-radius: 10px;
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

    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad" id="product">
        <div class="container">
            <div class="row rg">

                <div class="col-lg-9 col-md-7 a">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Giảm giá</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <?php
                                $sql = "SELECT pro.*, prom.discount as prom_discount, cate.name as cate_name
                                                 FROM product pro, promotion prom, category cate 
                                                 WHERE pro.id_promotion=prom.id_promotion and pro.category_id=cate.category_id and pro.id_promotion >0 AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE()) LIMIT 7";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($pro_prom = mysqli_fetch_assoc($result)) {
                                        $discountedPrice = $pro_prom['price'] - ($pro_prom['price'] * $pro_prom['prom_discount']) / 100; ?>
                                        <div class="col-lg-4">
                                            <div class="product__discount__item">
                                                <div class="product__discount__item__pic set-bg" id="pic_giam" data-setbg="<?php echo '../admin/upload/' . $pro_prom['image']; ?>">
                                                    <div class="product__discount__percent">-<?php echo $pro_prom['prom_discount'] ?>%</div>
                                                    <ul class="product__item__pic__hover">
                                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                        <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                                        <li><a href="shopping-cart.php?product_id=<?php echo $pro_prom['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product__discount__item__text">
                                                    <span> <?php echo truncateString($pro_prom['cate_name'], 25); ?></span>
                                                    <h5><a href="shop-details.php?product_id=<?php echo $pro_prom['product_id']; ?>"><?php echo truncateString($pro_prom['name'], 25) ?></a></h5>
                                                    <div class="product__item__price" style="color:#E91E63; font-weight:500;"><?php echo number_format($discountedPrice, 0, '', '.'); ?> VNĐ<span style="color:#E91E63; font-weight:100;"><?php echo number_format($pro_prom['price'], 0, '', '.'); ?> VNĐ</span></div>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
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
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sắp xếp</span>
                                    <select id="sort-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                        <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "desc") { ?> selected <?php } ?> value="shop-grid.php?field=price&sort=desc">Giá cao đến thấp</option>
                                        <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "asc") { ?> selected <?php } ?> value="shop-grid.php?field=price&sort=asc">Giá thấp đến cao</option>
                                        <option <?php if (isset($_GET['field']) && $_GET['field'] == "created") { ?> selected <?php } ?> value="shop-grid.php?field=created&sort=desc">Sản phẩm mới nhất</option>
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
                                    <h6><span><?php echo $totalProducts; ?></span> Được tìm thấy</h6>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if (isset($_GET['phantrang'])) {
                            $phantrang = $_GET['phantrang'];
                            if ($phantrang > 12) {
                                $offset = $phantrang - 12;
                                $sql = "SELECT * FROM product where status=1 " . $orderConditon . "  limit $offset OFFSET $offset ";
                            } else {
                                $sql = "SELECT * FROM product where status=1  " . $orderConditon . "  limit 12";
                            }
                        } else {
                            $sql = "SELECT * FROM product where status=1  " . $orderConditon . " limit 12";
                        }


                        $result = mysqli_query($conn, $sql);

                        // Kiểm tra và hiển thị danh sách sản phẩm mới nhất
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Lấy thông tin sản phẩm và hiển thị
                                $image = $row['image'];
                                $name = $row['name'];
                                $price = $row['price'];
                                $id_category = $row["category_id"];
                                $path = '../admin/upload/' . $image;
                                $product_id = $row['product_id'];
                        ?>

                                <div class="col-lg-4 col-md-6 col-sm-6" id="col">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" id="pic" data-setbg="<?php echo $path; ?>">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                                <li><a href="shopping-cart.php?product_id=<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6 id="gon"><a href="#"><?php echo truncateString($name, 25); ?></a></h6>
                                            <?php
                                            $sql_sanphamkh = "SELECT pro.*, prom.discount as prom_discount, cate.name as cate_name
                                                                FROM product pro, promotion prom, category cate 
                                                                WHERE pro.id_promotion=prom.id_promotion and pro.category_id=cate.category_id and pro.id_promotion >0 
                                                                AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE()) and pro.product_id=$product_id LIMIT 7";
                                            $result_sanphamkm = mysqli_query($conn, $sql_sanphamkh);
                                            $row_sanphamkm = mysqli_fetch_assoc($result_sanphamkm);

                                            if ($row_sanphamkm == null) {
                                                echo '<h5><a style="color:#E91E63; font-weight:500;" id="mar" href="shop-details.php?product_id=' . $row['product_id'] . '">' . number_format($price, 0, '', '.') . ' VNĐ</a></h5>';
                                            } else {
                                                $giagiam = $price - ($price * $row_sanphamkm['prom_discount']) / 100;
                                                echo '<h5><a style="color:#E91E63; font-weight:500;" id="" href="shop-details.php?product_id=' . $row['product_id'] . '">' . number_format($giagiam, 0, '', '.') . ' VNĐ</a></h5>';

                                                echo '<h5><a style="color:#E91E63; font-weight:500;text-decoration: line-through;" id="mard" href="shop-details.php?product_id=' . $row['product_id'] . '">' . number_format($price, 0, '', '.') . ' VNĐ</a></h5>';
                                            }
                                            ?>


                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="product__pagination">
                        <?php
                        $totalPages = ceil($totalProducts / 12);
                        $trang = 0;
                        if (isset($_GET['sort']) && $_GET['sort']) {
                            $orderField = isset($_GET['field']) ? $_GET['field'] : "";
                            $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";

                            for ($i = 1; $i <= $totalPages; $i++) {
                                $trang += 12;
                                echo '<a href="shop-grid.php?phantrang=' . $trang . '&field=' . $orderField . '&sort=' . $orderSort . '">' . $i . '</a>';
                            }
                        }
                        ?>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
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
    <!-- CHUYỂN TRANG CHO ẢNH(GIẢM GIÁ) -->
    <style>
        .product__discount__item__pic {
            cursor: default;
        }

        .product__discount__item__pic:hover {
            cursor: pointer;
        }
    </style>
    <script>
        featuredItems = document.querySelectorAll('.product__discount__item__pic');
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
    <!-- CHUYỂN TRANG CHO ẢNH(SẮP XẾP) -->
    <style>
        .product__item__pic {
            cursor: default;
        }

        .product__item__pic:hover {
            cursor: pointer;
        }
    </style>
    <script>
        featuredItems = document.querySelectorAll('.product__item__pic');
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