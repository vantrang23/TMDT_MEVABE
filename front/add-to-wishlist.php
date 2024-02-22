
<?php
session_start();
require_once '../libraries/connect.php';

// Kiểm tra xem sản phẩm có tồn tại không
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Truy vấn lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        // Kiểm tra xem giỏ hàng đã được tạo chưa
        if (!isset($_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = array();
        }

        // Kiểm tra xem sản phẩm đã có trong yêu thích chưa
        if (array_key_exists($product_id, $_SESSION['wishlist'])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
            echo '<p class="msg">Sản phẩm đã có trong yêu thích</p>';
        }  else {
            // Nếu sản phẩm chưa tồn tại trong yêu thích, thêm sản phẩm vào yêu thích với số lượng là 1
            $_SESSION['wishlist'][$product_id] = array(
                'image' => $product['image'],
                'price' => $product['price'],
                'name' => $product['name'],
                'quantity' => 1
            );
        }

        // Chuyển hướng người dùng đến trang yêu thích
        header('Location: my-wishlist.php');
        exit;
    }
}

// Nếu sản phẩm không tồn tại, chuyển hướng người dùng đến trang lỗi hoặc trang chính
header('Location: error-page.tpl.php');
exit;

?>
