
<?php
  
   session_start();
   require_once '../libraries/connect.php';
   //Kiểm tra xem sản phẩm có tồn tại không
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Truy vấn lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        // Kiểm tra xem giỏ hàng đã được tạo chưa
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm vào giỏ hàng với số lượng là 1
            $image = $product['image'];
            $name = $product['name'];
            $price = $product['price'];
  
            $_SESSION['cart'][$product_id] = array(
                'image' => $image,
                'price' => $price,
                'name'=> $name,
                'quantity' => 1
               
            );
        }

        // Chuyển hướng người dùng đến trang giỏ hàng
        header('Location: shopping-cart.php');
        exit;
    }
}

// // Nếu sản phẩm không tồn tại, chuyển hướng người dùng đến trang lỗi hoặc trang chính
// header('Location: error-page.tpl.php');
// exit;
?>
