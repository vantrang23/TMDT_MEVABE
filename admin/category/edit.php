<?php
session_start();
require '../../libraries/connect.php';
require '../../models/user.php';
if (isset($_POST['huy'])) {
    // The "Hủy" button was clicked, simply redirect to list.php
    header('location: list.php');
}
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $category = get_category_by_id($category_id, $conn);
}



if ($_POST) {
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $new_file_name = $file['name'];
        move_uploaded_file($file['tmp_name'], '../upload/' . $new_file_name);
    } else {
        $new_file_name = ''; // Nếu không có tệp hình ảnh mới, gán giá trị rỗng
    }

    $data = array(
        'name' => $_POST['name'],
        'status' => isset($_POST['status']) ? 1 : 0,
        'modified' => date("Y-m-d H:i:s"),
        'image' => $new_file_name

    );
    // Chỉ cập nhật hình ảnh khi có hình ảnh mới
    if ($new_file_name === '') {
        $data['image'] = $category['image']; // Giữ nguyên hình ảnh cũ
    }

    $category_id = $_POST['category_id'];
    if (isset($_POST['edit'])) {

        edit_category($data, $category_id, $conn);
        $_SESSION['edit'] = true;
        header('location: list.php');
        exit;
    } else {
        echo 'Dữ liệu từ biểu mẫu không đầy đủ hoặc không đúng cấu trúc';
        exit;
    }
}



require 'edit.tpl.php';
