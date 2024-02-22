<?php
session_start();
require_once '../libraries/connect.php';

// Kiểm tra nếu product_id được truyền từ URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Kiểm tra xem sản phẩm có tồn tại trong danh sách yêu thích không
    if (array_key_exists($product_id, $_SESSION['wishlist'])) {
        // Xóa sản phẩm khỏi danh sách yêu thích
        unset($_SESSION['wishlist'][$product_id]);

        // Chuyển hướng người dùng đến trang wishlist.php
        header('Location: wishlist.php');
        exit;
    } else {
        // Nếu sản phẩm không tồn tại trong danh sách yêu thích, có thể chuyển hướng người dùng đến trang lỗi hoặc trang chính
        header('Location: error-page.tpl.php');
        exit;
    }
} else {
    // Nếu không có product_id được truyền từ URL, chuyển hướng người dùng đến trang lỗi hoặc trang chính
    header('Location: error-page.tpl.php');
    exit;
}
?>
