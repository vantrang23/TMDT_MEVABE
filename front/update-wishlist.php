<?php
session_start();
require_once '../libraries/connect.php';

// Kiểm tra nếu giỏ hàng chưa tồn tại, khởi tạo nó
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = array();
}

// Xử lý khi có sự kiện xoá tất cả sản phẩm khỏi giỏ hàng
if (isset($_GET['remove_product'])) {
    $product_id = $_GET['remove_product'];

    // Kiểm tra xem giỏ hàng có tồn tại hay không
    if (isset($_SESSION['wishlist']) && !empty($_SESSION['wishlist'])) {
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (array_key_exists($product_id, $_SESSION['wishlist'])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($_SESSION['wishlist'][$product_id]);

            // Cập nhật giỏ hàng
            $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);

            // Chuyển hướng trở lại trang giỏ hàng
            header("Location: my-wishlist.php");
            exit();
        }
    }
}

// Nếu không có sản phẩm nào được xóa, chuyển hướng trở lại trang giỏ hàng
header("Location: my-wishlist.php");
exit();
?>
