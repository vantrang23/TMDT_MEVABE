<?php
session_start();
require '../../models/user.php';
if (isset($_POST['them'])) {
    require '../../libraries/connect.php';

    if (!$conn) {
        exit('Kết nối không thành công!');
    }
    // $fullname=$_GET['fullname'];
    if ($_POST) {
        $data = array(
            'username' => $_POST['username'],
            'pass' => $_POST['pass'],
            'passagain' => $_POST['passagain'],
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'status' => isset($_POST['status']) ? 1 : 0,
            'role' => $_POST['role'],
            'created' => date("Y-m-d H:i:s"),
            'modified' => date("Y-m-d H:i:s")

        );

        if (strlen($data['pass']) < 8 || strlen($data['pass']) > 12) {
            echo "<script>alert('Mật khẩu phải có từ 8 đến 12 ký tự');</script>";
        } else {
            if ($data['pass'] !== $data['passagain']) {
                echo "<script>alert('Mật khẩu không khớp');</script>";
            } else {
                if (get_user_by_username($data['username'], $conn) > 0) {
                    echo "<script>alert('Tên đăng nhập bị trùng');</script>";
                } else {
                    if (!preg_match('/^(?=[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{2,20}$/', $data['username'])) {
                        echo "<script>alert('Tên đăng nhập gồm chữ và số, và ký tự đầu tiên là chữ cái');</script>";
                    } else {
                        if (checkmail($data['email'], $conn) > 0) {
                            echo "<script>alert('Email đã đăng ký tài khoản!');</script>";
                        } else {
                            if (add_user($data, $conn)) {
                                $_SESSION['success'] = true;
                                if (isset($_GET['fullname'])) {
                                    $fullname = $_GET['fullname'];

                                    echo "<script> location.href = 'add.php?fullname=" . urlencode($fullname) . "'; </script>";
                                    exit;
                                } else {
                                    // echo "<script>alert('Đăng ký không thành công');</script>";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
require 'add.tpl.php';
