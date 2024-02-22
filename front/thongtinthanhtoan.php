<?php
session_start();
require_once '../libraries/connect.php';
if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];
    $_SESSION['iduser'] = $iduser;
    $id_order = $_GET['id_order'];
    $_SESSION['id_order'] = $id_order;
}

$sql_orderdetail = "SELECT order.payment_method,order_detail.product_id, order.phi, order.tongtien, order.status, order.created, order.note_user, order.address, order.name, order.sdt, order_detail.soluong, order_detail.thanhtien 
FROM order_detail
JOIN `order` ON order_detail.id_order = `order`.id_order
WHERE `order`.iduser = $iduser  AND `order`.id_order='$id_order'";
$result_orderdetail = mysqli_query($conn, $sql_orderdetail);
$order = mysqli_fetch_assoc($result_orderdetail);
?>
<?php
if (isset($_SESSION['selectedProducts']) && isset($_SESSION['selectedProducts']) && isset($_SESSION['selectedsl'])) {
    // Lấy dữ liệu từ URL
    $selectedProducts = $_SESSION['selectedProducts'];
    $selectedtongtien = $_SESSION['selectedtongtien'];
    $selectedsl = $_SESSION['selectedsl'];

    // print_r($selectedProducts);
}
if (isset($_SESSION['product_id']) && isset($_SESSION['thanhtien']) && isset($_SESSION['soluong'])) {
    // Lấy dữ liệu từ URL
    $product_id = $_SESSION['product_id'];
    $thanhtien = $_SESSION['thanhtien'];
    $soluong = $_SESSION['soluong'];

    $them_gh = "INSERT into giohang (iduser, product_id, soluong, thoigian) VALUES ($iduser, $product_id, $soluong, now())";
    $result_them_gh = mysqli_query($conn, $them_gh);

    // print_r($selectedProducts);
}
?>
<?php
if (isset($_POST['matt'])) {
    header("location: index.php?iduser=" . $iduser);
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
    <title>HÓA ĐƠN</title>
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
    <!-- Header Section -->
    <header class="header">
        <!-- Header Content Goes Here -->
    </header>
    <style>
        h2 {
            text-align: center;
        }
    </style>
    <!-- Checkout Section -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form-wrapper">
                <h2>HÓA ĐƠN</h2>
                <div class="checkout__order">
                    <div class="checkout__order__products">Sản phẩm <span>Tổng cộng</span></div>
                    <ul>
                        <?php
                        $tong = 0; // Di chuyển biến $tong ra khỏi vòng lặp
                        if (isset($_GET['detail'])) {

                            $sql_gh = "SELECT * FROM giohang gh JOIN product pro ON gh.product_id = pro.product_id WHERE gh.product_id = $product_id";
                            $re_gh = mysqli_query($conn, $sql_gh);
                            $row_gh = mysqli_fetch_assoc($re_gh);
                            $soluong = intval($soluong);
                            $thanhtien = intval($thanhtien);
                            $tongcong = $soluong * $thanhtien; ?>
                            <input type="hidden" name="tt" id="" value="<?php echo $thanhtien ?>">
                            <input type="hidden" name="sl" id="" value="<?php echo $soluong ?>">
                            <li><?php echo $row_gh['name'] ?> <span><?php echo number_format($tongcong, 0, '', '.') ?> VNĐ</span></li>

                            <?php } else {
                            foreach ($selectedProducts as $product_id) {
                                $sql_gh = "SELECT * FROM giohang gh JOIN product pro ON gh.product_id = pro.product_id WHERE gh.product_id = $product_id";
                                $re_gh = mysqli_query($conn, $sql_gh);
                                $row_gh = mysqli_fetch_assoc($re_gh);
                                $tong += $selectedtongtien[$product_id]['total_price']; // Tính tổng ở đây
                            ?>
                                <input type="hidden" name="tt[<?php echo $product_id ?>]" id="" value="<?php echo $selectedtongtien[$product_id]['total_price'] ?>">
                                <input type="hidden" name="sl[<?php echo $product_id ?>]" id="" value="<?php echo $selectedsl[$product_id]['soluong'] ?>">
                                <li><?php echo $row_gh['name'] ?> <span><?php echo number_format($selectedtongtien[$product_id]['total_price'], 0, '', '.') ?> VNĐ</span></li>

                        <?php }
                        } ?>


                    </ul>
                    <?php
                    $_SESSION['phi'] = $order['phi'];
                    $_SESSION['tongtien'] = $order['tongtien'];
                    ?>
                    <div class="checkout__order__total">Tên người nhận<span><?php echo $order['name'] ?></span></div>
                    <div class="checkout__order__total">Địa chỉ nhận hàng<span><?php echo $order['address'] ?></span></div>
                    <div class="checkout__order__total">Phí vận chuyển <span><?php echo number_format($order['phi'], 0, '', '.') ?> VNĐ</span></div>
                    <div class="checkout__order__total">Tổng tiền hàng <span><?php echo number_format($order['tongtien'], 0, '', '.') ?> VNĐ</span></div>
                    <div class="checkout__order__total">Ngày đặt hàng<span><?php echo $order['created'] ?></span></div>
                    <div class="checkout__order__total">Phương thức thanh toán<span><?php echo $order['payment_method'] ?></span></div>
                    <div class="checkout__order__total">Phương thức vận chuyển<span>Nhanh</span></div>
                    <div class="checkout__order__total">Ghi chú<span><?php echo $order['note_user'] ?></span></div>
                </div>
                <!-- Payment Buttons -->
                <!-- <div class="checkout__payment-buttons">
                    <form action="xuly_tienmat.php" class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded">
                        <input type="submit" name="momo" value="Thanh toán bằng tiền mặt" class="btn btn-danger">
                    </form>
                    <form action="xulythanhtoanmomo.php" class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded">
                        <input type="submit" name="momo" value="Thanh toán MOMO QRcode" class="btn btn-danger">
                    </form>
                    <form action="xuly_atm_momo.php" class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded">
                        <input type="submit" name="momo_atm" value="Thanh toán MOMO ATM" class="btn btn-danger">
                    </form>
                </div>     -->
                <!-- <button type="submit" onclick="selectPaymentMethod('momo')" class="site-btn">Thanh toán qua MoMo</button>
                    <button type="submit" onclick="selectPaymentMethod('cash')" class="site-btn">Thanh toán bằng tiền mặt</button>
                    <button type="submit" onclick="selectPaymentMethod('momo-atm')" class="site-btn">Thanh toán qua MoMo ATM</button> -->


                <!-- Trong phần Payment Buttons -->

                <div class="checkout__payment-buttons">
                    <?php if ($order['payment_method'] == 'MoMo') { ?>
                        <form method="POST">
                            <input type="submit" name="matt" value="Trang chủ" class="btn btn-danger">
                        </form>

                        <form action="xulythanhtoanmomo.php?" method="POST" target="_blank" enctype="application/x-www-form-urlencoded">
                            <input type="hidden" name="iduser" value="<?php echo $iduser; ?>">
                            <input type="hidden" name="id_order" value="<?php echo $id_order; ?>">
                            <input type="submit" name="momo" value="Thanh toán MOMO QRcode" class="btn btn-danger">
                        </form>
                        <form action="xuly_atm_momo.php" method="POST" target="_blank" enctype="application/x-www-form-urlencoded">
                            <input type="hidden" name="iduser" value="<?php echo $iduser; ?>">
                            <input type="hidden" name="id_order" value="<?php echo $id_order; ?>">
                            <input type="submit" name="momo_atm" value="Thanh toán MOMO ATM" class="btn btn-danger">
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>

    </section>
    <!-- Footer Section -->
    <footer class="footer">
        <!-- Footer Content Goes Here -->
    </footer>
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <style>
        .checkout__payment-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            /* Add margin for spacing */
        }

        /* Style for the payment buttons */
        .checkout__payment-buttons form {
            flex-basis: 30%;
            /* Adjust the width based on your design */
        }

        .btn {
            width: 100%;
            padding: 10px 20px;
            background-color: #CC3069;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #FF6384;
            /* Change color on hover */
        }
    </style>
</body>

</html>