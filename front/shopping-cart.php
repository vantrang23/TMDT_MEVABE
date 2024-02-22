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
if (isset($_POST['remove_all'])) {
    // echo '<script>alert("Bạn có muốn xóa tất cả sản phẩm trong giỏ hàng không.");</script>';
    $sql_degiohang = "DELETE from giohang WHERE iduser=$iduser";
    $result_degiohang = mysqli_query($conn, $sql_degiohang);
}
?>
<?php
if (isset($_POST['muahang'])) {
    if (isset($_POST['ds']) && is_array($_POST['ds'])) {
        // Duyệt qua các giá trị của các hidden input để lưu vào mảng
        $selectedtongtien = array();
        foreach ($_POST['ds'] as $product_id => $total_price) {
            $selectedtongtien[$product_id] = array(
                'product_id' => $product_id,
                'total_price' => $total_price
            );
        }
        $selectedProducts = array();
        foreach ($_POST['buy_product'] as $selectedProductID) {
            $selectedProducts[] = $selectedProductID;
        }

        $selectedsoluong = array();
        foreach ($_POST['quantity'] as $product_id => $sl) {
            $selectedsoluong[$product_id] = array(
                'product_id' => $product_id,
                'soluong' => $sl
            );
        }

        $selectedProductsQuery = http_build_query(array('product_id' => $selectedProducts));
        $selectedtongtienQuery = http_build_query(array('tongtien' => $selectedtongtien));
        $selectedsl = http_build_query(array('soluong' => $selectedsoluong));
        header("Location: checkout.php?$selectedProductsQuery&$selectedtongtienQuery&$selectedsl");
    }
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
                            <?php
                            $sql_gh = "SELECT * from giohang where iduser=$iduser";
                            $result_gh = mysqli_query($conn, $sql_gh);
                            $row_gh = mysqli_fetch_assoc($result_gh);
                            if ($row_gh == null) {
                                echo '<img src="../admin/upload/GIOHANGTRONG.png" alt="Product Image" id="giohangtrong" >';
                            } else {
                            ?>
                                <table>

                                    <!-- Thêm cột checkbox vào bảng -->
                                    <thead>
                                        <tr>
                                            <th class="shoping__product">Sản phẩm</th>
                                            <th id="sl">Số lượng</th>
                                            <th>Giá</th>

                                            <th>Tổng cộng</th>
                                            <th>Xóa</th>
                                            <th>
                                                <input type="checkbox" id="select-all" onclick="selectAllItems()">
                                                <label for="select-all">Chọn tất cả</label>
                                                <span id="selected-count">(0)</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="r">
                                        <?php
                                        $sql_giohang = "SELECT gh.*, p.image as image, p.price as price , p.name as name, p.quantity as quantity
                                                        from giohang gh, product p where gh.product_id=p.product_id and iduser=$iduser";
                                        $result_giohang = mysqli_query($conn, $sql_giohang);
                                        while ($row_giohang = mysqli_fetch_assoc($result_giohang)) {
                                            $tongtien = $row_giohang['price'] * $row_giohang['soluong'];
                                            $product_id = $row_giohang['product_id'];

                                            $sql_1 = "SELECT prom.*, pro.product_id as product_id, COUNT(prom.id_promotion) AS cokm
                                                            FROM promotion prom
                                                            JOIN product pro ON prom.id_promotion = pro.id_promotion
                                                            WHERE pro.product_id = $product_id and pro.status=1 AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE())
                                                            GROUP BY prom.id_promotion;";
                                            $result_1 = mysqli_query($conn, $sql_1);
                                            $row_1 = mysqli_fetch_assoc($result_1);
                                        ?>
                                            <tr class="sd">
                                                <input type="hidden" class="price" id="" value="<?php echo $row_giohang['price'] ?>">
                                                <input type="hidden" class="product_id" id="" value="<?php echo $row_giohang['product_id'] ?>">
                                                <input type="hidden" class="quantity" id="" value="'<?php echo $row_giohang['quantity'] ?>'">
                                                <input type="hidden" class="iduser" id="" value="<?php echo $iduser ?>">
                                                <td class="shoping__cart__item">
                                                    <img src="../admin/upload/<?php echo $row_giohang['image']; ?>" alt="Product Image" width="80px" height="80px">
                                                    <h5><?php echo $row_giohang['name']; ?></h5>
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <div class="pro">
                                                            <a href="" class="ab"><span class="dec qtybtn">-</span></a>
                                                            <input type="text" class="quantity ad" name="quantity[<?php echo $product_id; ?>]" value="<?php echo $row_giohang['soluong']; ?>">
                                                            <a href="" class="ab"><span class="inc qtybtn">+</span></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__price" id="gia" style="font-weight: 400;">
                                                    <?php
                                                    if ($row_1 !== null) {
                                                        $giagiam = $row_giohang['price'] - ($row_giohang['price'] * $row_1['discount']) / 100;
                                                        echo number_format($giagiam, 0, '', '.') . ' VNĐ<br>';
                                                        echo '<p style="text-decoration: line-through;">' . number_format($row_giohang['price'], 0, '', '.') . ' VNĐ</p>';
                                                    } else {
                                                        echo number_format($row_giohang['price'], 0, '', '.') . ' VNĐ';
                                                    }
                                                    ?>

                                                </td>
                                                <td class="shoping__cart__total fd" id="gia" style="font-weight: 400;" id="total-amount">
                                                    <?php
                                                    if ($row_1 !== null) {
                                                        $tongtien = $giagiam * $row_giohang['soluong'];
                                                        echo number_format($tongtien, 0, '', '.') . ' VNĐ';
                                                        echo '<input type="hidden" name="ds[' . $product_id . ']" value="' . $tongtien . '" class="tongtien">';
                                                    } else {
                                                        echo number_format($tongtien, 0, '', '.') . 'VNĐ';
                                                        echo '<input type="hidden" name="ds[' . $product_id . ']" value="' . $tongtien . '" class="tongtien">';
                                                    }
                                                    ?>
                                                </td>


                                                <td class="shoping__cart__item__close" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                    <a href="?remove_product=<?php echo $row_giohang['product_id'] ?>"><span class="icon_close"></span></a>

                                                </td>
                                                <!-- <td class="shoping__cart__item_heart">
                                                <a href="add-to-wishlist.php?product_id=<?php //echo $product_id; 
                                                                                        ?>"><i class="fa fa-heart"></i></a>
                                            </td> -->
                                                <td>
                                                    <input type="checkbox" name="buy_product[]" value="<?php echo $product_id; ?>" class="product-checkbox">
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <button name="muahang" class="primary-btn_buys">MUA HÀNG</button>
                                </table>
                            <?php } ?>
                        </div>
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns">
                                <?php
                                if ($row_gh == null) {
                                    echo '<a href="index.php" class="primary-btn cart-btn cart-btn-continue" id="tieptucmuasam">
                                    Tiếp tục mua sắm
                                </a>';
                                } else {
                                ?>
                                    <button type="submit" name="remove_all" class="primary-btn cart-btn cart-btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm?')">
                                        <span class="icon_close"></span> Xóa tất cả
                                    </button>
                                    <a href="index.php" class="primary-btn cart-btn cart-btn-continue" id="tieptuc">
                                        Tiếp tục mua sắm
                                    </a>
                                <?php } ?>
                            </div>
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
                    <?php
                    if ($row_gh != null) {
                    ?>
                        <div class="shoping__checkout shoping__checkout-center">
                            <h5 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">TỔNG GIÁ SẢN PHẨM</h5>
                            <ul>
                                <li>Tổng thanh toán: <span id="total-price" style="padding-left: 10px;">0 VNĐ</span></li>

                                <!-- <li>Tổng thanh toán <span id="total-payment">0 VNĐ</span></li> -->
                            </ul>

                        <?php } ?>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    require 'footer.php';
    ?>

    <!-- GIẢM SỐ LƯỢNG SẢN PHẨM -->
    <script>
        $(document).ready(function() {
            $('.dec').click(function(e) {
                e.preventDefault();
                // Tìm trường nhập số lượng gần nhất trong cùng một div cha
                var quantityInput = $(this).closest('.pro').find('.ad');
                var product_id = $(this).closest('.sd').find('.product_id').val();
                var iduser = $('.iduser').val();
                // Lấy giá trị số lượng hiện tại
                var sl = quantityInput.val();
                // alert(sl);
                // if (sl == 0) {
                //     return;
                // }
                $.ajax({
                    method: "POST",
                    url: "giohang.php",
                    dataType: 'html',
                    data: {
                        sl: sl,
                        iduser: iduser,
                        product_id: product_id
                    }
                }).done(function(response) {
                    $('.r').html(response);
                    // $('.shoping__cart__total').text(response + ' VNĐ');
                    // document.getElementById('message').value = '';
                });
            });
        });
    </script>
    <!-- TĂNG SỐ LƯỢNG SẢN PHẨM -->
    <script>
        $(document).ready(function() {
            $('.inc').click(function(e) {
                e.preventDefault();
                // Tìm trường nhập số lượng gần nhất trong cùng một div cha
                var quantityInput = $(this).closest('.pro').find('.ad');
                var product_id = $(this).closest('.sd').find('.product_id').val();
                var iduser = $('.iduser').val();
                var quantity = $(this).closest('.sd').find('.quantity').val();
                // Lấy giá trị số lượng hiện tại
                var sl = quantityInput.val();

                // alert(quantity);
                if (sl == quantity) {
                    return;
                }
                $.ajax({
                    method: "POST",
                    url: "giohangtang.php",
                    dataType: 'html',
                    data: {
                        sl: sl,
                        iduser: iduser,
                        product_id: product_id
                    }
                }).done(function(response) {
                    $('.r').html(response);
                    // $('.shoping__cart__total').text(response + ' VNĐ');
                    // document.getElementById('message').value = '';
                });
            });
        });
    </script>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function selectAllItems() {
            const selectAllCheckbox = document.getElementById('select-all');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            const selectedCount = document.getElementById('selected-count');

            for (const checkbox of productCheckboxes) {
                checkbox.checked = selectAllCheckbox.checked;
            }

            const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
            // selectedCount.textContent = `(${selectedProducts.length} sản phẩm được chọn)`;
            selectedCount.textContent = `(${selectedProducts.length})`;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const productCheckboxes = document.querySelectorAll('.product-checkbox');

            for (const checkbox of productCheckboxes) {
                checkbox.addEventListener('change', () => {
                    const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
                    const selectedCount = document.getElementById('selected-count');
                    selectedCount.textContent = `(${selectedProducts.length})`;
                });
            }
        });
    </script>
    <!-- Trong phần head của trang -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectAllCheckbox = document.getElementById('select-all');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            const selectedCount = document.getElementById('selected-count');
            const totalPriceElement = document.getElementById('total-price');
            const checkoutButton = document.getElementById('checkout-button');

            // Cập nhật số lượng sản phẩm được chọn khi checkbox thay đổi
            function updateSelectedCount() {
                const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
                selectedCount.textContent = `(${selectedProducts.length})`;

                // Tính toán giá tạm tính
                let totalTempPrice = 0;
                selectedProducts.forEach((checkbox) => {
                    const row = checkbox.closest('tr');
                    const quantity = parseInt(row.querySelector('.shoping__cart__quantity input').value);
                    const price = (row.querySelector('.shoping__cart__total').textContent.replace('.', '').replace('.', ''));
                    totalTempPrice += 1 * parseInt(price);
                });

                // Hiển thị giá tạm tính
                totalPriceElement.textContent = `${numberWithCommas(totalTempPrice)} VNĐ`;

                // Enable/Disable nút checkout tùy thuộc vào số lượng sản phẩm được chọn
                checkoutButton.disabled = selectedProducts.length === 0;
            }

            // Bắt sự kiện thay đổi của checkbox
            selectAllCheckbox.addEventListener('change', () => {
                productCheckboxes.forEach((checkbox) => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
                updateSelectedCount();
            });

            productCheckboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', () => {
                    updateSelectedCount();
                });
            });

            // Hàm định dạng số có dấu phẩy ngăn cách hàng nghìn
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script>

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