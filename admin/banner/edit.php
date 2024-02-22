<?php
session_start();
require '../../libraries/connect.php';
require '../../models/user.php';

$id_banner = isset($_GET['id_banner']) ? $_GET['id_banner'] : null;
if ($_POST) {
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $new_file_name = $file['name'];
        move_uploaded_file($file['tmp_name'], '../upload/' . $new_file_name);
    } else {
        $new_file_name = ''; // Nếu không có tệp hình ảnh mới, gán giá trị rỗng
    }

    $image = $new_file_name;


    // Chỉ cập nhật hình ảnh khi có hình ảnh mới
    if ($new_file_name === '') {
        $image = $product['image']; // Giữ nguyên hình ảnh cũ
    }

    $id_banner = $_POST['id_banner'];
    if (isset($_POST['edit'])) {
        edit_banner($id_banner, $image,  $conn);
        // $_SESSION['success'] = true;
        header('location: showbanner.php');
        exit;
    } else {
        echo 'Dữ liệu từ biểu mẫu không đầy đủ hoặc không đúng cấu trúc';
        exit;
    }
}
require 'edit.tpl.php';
