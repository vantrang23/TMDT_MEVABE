<?php
session_start();
require_once '../../models/user.php';
require_once '../../libraries/connect.php';

if (isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $file_name = $file['name'];
    move_uploaded_file($file['tmp_name'], '../upload/' . $file_name);
} else {
    $file_name = ''; // Nếu không có tệp hình ảnh, gán giá trị rỗng
    // echo 'rỗng';
}

$category_active_list = get_category_active_list($conn);
if ($_POST) {
    // Kiểm tra xem tệp hình ảnh đã được tải lên hay chưa


    // Nhận dữ liệu từ form và gán vào một mảng
    $data = array(
        'category_id' => $_POST['category_id'],
        'name' => $_POST['name'],
        'detail' => $_POST['detail'],
        'image' => $file_name, // Lưu đường dẫn đầy đủ của tệp hình ảnh
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'status' => isset($_POST['status']) ? 1 : 0,
        'created' => date('Y-m-d H:i:s'),
        'modified' => date('Y-m-d H:i:s')
    );
    $data_detail = array(
        'advantage' => $_POST['uudiem'],
        'object' => $_POST['doituong'],
        'instruct' => $_POST['huongdan'],
        'ingredient' => $_POST['thanhphan'],
        'preserve' => $_POST['baoquan']
    );
    if (add_product($data, $conn)) {
        //Tạo session để lưu cờ thông báo thành công
        $name_pro = $data['name'];
        $sql_id = "SELECT * from product where name='$name_pro'";
        $re_id = mysqli_query($conn, $sql_id);
        $row_id = mysqli_fetch_assoc($re_id);
        $product_id = $row_id['product_id'];
        add_product_detail($data_detail, $product_id, $conn);
        $_SESSION['success'] = true;
        //Tải lại trang (Mục đích là để reset form)
        header('location:list.php');
    }
}

require 'add.tpl.php';
