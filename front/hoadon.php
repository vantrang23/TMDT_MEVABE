<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin đơn hàng</title>
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
                <h2>Thông tin đơn hàng</h2>

                <!-- Display order details here -->

                <div class="checkout__order">
                    <div class="checkout__order__products">Sản phẩm <span>Tổng cộng</span></div>
                    <ul>
                        <!-- Loop through order items and display them -->
                        <li>Product 1 <span>100,000 VNĐ</span></li>
                        <li>Product 2 <span>150,000 VNĐ</span></li>
                        <!-- Add more items as needed -->
                    </ul>
                    <div class="checkout__order__subtotal">Tổng tiền hàng <span>250,000 VNĐ</span></div>
                    <div class="checkout__order__total">Phương thức vận chuyển<span>Nhanh</span></div>
                    <div class="checkout__order__total" id="paymentMethodLabel">Phương thức thanh toán <span>Tiền mặt</span></div>
                    <div class="checkout__order__total">Phí vận chuyển <span>20,000 VNĐ</span></div>
                    <div class="checkout__order__total">Tổng thanh toán <span>270,000 VNĐ</span></div>
                </div>
                <!-- Payment Buttons -->
                <div class="checkout__payment-buttons">
                    <button type="submit" onclick="selectPaymentMethod('momo')" class="site-btn">Thanh toán qua MoMo</button>
                    <button type="submit" onclick="selectPaymentMethod('cash')" class="site-btn">Thanh toán bằng tiền mặt</button>
                    <button type="submit" onclick="selectPaymentMethod('momo-atm')" class="site-btn">Thanh toán qua MoMo ATM</button>
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
</body>

</html>
