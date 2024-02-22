<?php
session_start();
require '../../models/user.php';
if (isset($_POST['huy'])) {
    header('location: add.php');
}
if (isset($_POST['them'])) {
    require '../../libraries/connect.php';

    if (!$conn) {
        exit('Kết nối không thành công!');
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
            'created' => date("Y-m-d H:i:s"),
            'modified' => date("Y-m-d H:i:s"),
            'image' => $new_file_name


        );
        if ($new_file_name === '') {
            echo "<script>alert('Bạn chưa chọn hình ảnh');</script>";
        } else {
            if (get_user_by_categoryname($data['name'], $conn) > 0) {
                echo "<script> location.href = 'add.php';</script>";
                $_SESSION['trung'] = true;
                exit;
            } else {
                if (add_category($data, $conn)) {

                    echo "<script> location.href = 'add.php';</script>";
                    $_SESSION['danhmuc'] = true;
                    exit;
                } else {
                    echo "<script>alert('Thêm danh mục không thành công');</script>";
                }
            }
        }
    }
}
require 'add.tpl.php';
