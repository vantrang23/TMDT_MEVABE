<?php
session_start();
require_once '../libraries/connect.php';

// Kiểm tra nếu giỏ hàng chưa tồn tại, khởi tạo nó
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Xử lý khi có sự kiện xoá tất cả sản phẩm khỏi giỏ hàng
if (isset($_GET['remove_product'])) {
    $product_id = $_GET['remove_product'];

    // Kiểm tra xem giỏ hàng có tồn tại hay không
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($_SESSION['cart'][$product_id]);

            // Cập nhật giỏ hàng
            $_SESSION['cart'] = array_values($_SESSION['cart']);

            // Chuyển hướng trở lại trang giỏ hàng
            header("Location: shopping-cart-neww.php");
            exit();
        }
    }
}

// Nếu không có sản phẩm nào được xóa, chuyển hướng trở lại trang giỏ hàng
header("Location: shopping-cart-neww.php");
exit();
?>
