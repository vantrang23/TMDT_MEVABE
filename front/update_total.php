<?php
require_once '../libraries/connect.php';

// Nhận dữ liệu từ yêu cầu Ajax
$iduser = $_POST['iduser'];
$quantities = $_POST['quantity']; // Một mảng chứa số lượng cho từng sản phẩm

// Tính toán tổng số tiền
$totalAmount = 0;

foreach ($quantities as $product_id => $quantity) {
    $sql = "SELECT price FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalAmount += $row['price'] * $quantity;
    }
}

// Trả về tổng số tiền mới để cập nhật trên trang
echo number_format($totalAmount, 0, '', '.');

// Đóng kết nối
mysqli_close($conn);
?>
