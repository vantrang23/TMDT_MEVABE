<?php
session_start();
require_once '../../libraries/connect.php';
require_once '../../models/user.php';

if (isset($_POST['edit'])) {
    // Lấy giá trị của các trường từ form
    $id_promotion = $_POST['id_promotion'];
    $name = $_POST['name'];
    $start_day = $_POST['start_day'];
    $end_day = $_POST['end_day'];
    $content = $_POST['content'];
    $discount = $_POST['discount'];
    $status = isset($_POST['status']) ? 1 : 0; // Nếu checkbox được chọn thì status là 1, ngược lại là 0
    $selected_product = $_POST['selected_product']; // Mảng chứa các id sản phẩm được chọn

    // Kết nối với cơ sở dữ liệu


    // Cập nhật bảng promotion với các giá trị mới
    $sql = "UPDATE promotion SET name = '$name', start_day = '$start_day', end_day = '$end_day', content = '$content', discount = '$discount', status = '$status' WHERE id_promotion = '$id_promotion'";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra xem cập nhật có thành công hay không
    if ($result) {
        // Xóa các bản ghi cũ trong bảng product liên quan đến id_promotion này
        // $sql = "UPDATE product SET id_promotion = NULL WHERE id_promotion = '$id_promotion'";
        // mysqli_query($conn, $sql);

        // Thêm các bản ghi mới vào bảng product với các id sản phẩm được chọn
        foreach ($selected_product as $product_id) {
            $sql = "UPDATE product SET id_promotion = '$id_promotion' WHERE product_id = '$product_id'";
            mysqli_query($conn, $sql);
        }

        $_SESSION['edit'] = true;
        header("Location: list.php");
        exit;
    } else {
        echo "<script>alert('Chỉnh sửa khuyến mãi thất bại');</script>";
    }
}

if (isset($_POST['huy'])) {
    header("Location: list.php");
    exit;
}

if (isset($_GET['id_promotion'])) {
    $id_promotion = $_GET['id_promotion'];
    $promotion = get_promotion_list_by_id($id_promotion, $conn);
} else {

    header("Location: list.php");
    exit;
}

require 'edit.tpl.php';
