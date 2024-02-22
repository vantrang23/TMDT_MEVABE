<?php
session_start();
require '../../libraries/connect.php';
require '../../models/user.php';

if (isset($_POST['huy'])) {
    // The "Hủy" button was clicked, simply redirect to list.php
    exit(header('location: list.php'));
}
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    // echo 
} else {
    $product_id = "";
}

$product = get_product_by_id($product_id, $conn);



if ($_POST) {
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $new_file_name = $file['name'];
        move_uploaded_file($file['tmp_name'], '../upload/' . $new_file_name);
    } else {
        $new_file_name = ''; // Nếu không có tệp hình ảnh mới, gán giá trị rỗng
    }

    $data = array(
        'category_id' => $_POST['category_id'],
        'name' => $_POST['name'],
        'detail' => $_POST['detail'],
        'image' => $new_file_name,
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'status' => isset($_POST['status']) ? 1 : 0,
        'modified' => date('Y-m-d H:i:s') // Sử dụng giá trị cũ
    );

    $data_detail = array(
        'advantage' => $_POST['uudiem'],
        'object' => $_POST['doituong'],
        'instruct' => $_POST['huongdan'],
        'ingredient' => $_POST['thanhphan'],
        'preserve' => $_POST['baoquan']
    );

    // Chỉ cập nhật hình ảnh khi có hình ảnh mới
    if ($new_file_name === '') {
        $data['image'] = $product['image']; // Giữ nguyên hình ảnh cũ
    }

    $product_id = $_POST['product_id'];
    if (isset($_POST['edit'])) {
        edit_product($data, $product_id, $conn);
        edit_product_detail($data_detail, $product_id, $conn);
        $_SESSION['success_them'] = true;
        header('location: list.php');
        exit;
    } else {
        echo 'Dữ liệu từ biểu mẫu không đầy đủ hoặc không đúng cấu trúc';
        exit;
    }
}

require 'edit.tpl.php';
