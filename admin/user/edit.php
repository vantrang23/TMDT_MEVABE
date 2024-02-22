<?php 
    session_start();
    require '../../libraries/connect.php';
    require '../../models/user.php';
    if (isset($_POST['huy'])) {
        // The "Hủy" button was clicked, simply redirect to list.php
        exit(header('location: list.php'));
    }
    $iduser = $_GET['iduser'];
    $user = get_user_by_iduser($iduser, $conn);


    if ($_POST) {
        // Kiểm tra xem dữ liệu từ biểu mẫu đã được gửi hay chưa
        if (isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['email'])) {
            $data = array(
                'username' => $_POST['username'],
                'pass' => empty($_POST['pass']) ? null : md5($_POST['pass']),
                'fullname' => $_POST['fullname'],
                'email' => $_POST['email'],
                'status' => isset($_POST['status']) ? 1 : 0,
                'modified' => date("Y-m-d H:i:s")

            );           
        }
  
            $iduser = $_POST['iduser'];
            if (isset($_POST['edit']))
            {
                
                edit_user($data, $iduser, $conn);  
                $_SESSION['success']=true;     
                header ('location: list.php');

            }   
            else {
                echo 'Dữ liệu từ biểu mẫu không đầy đủ hoặc không đúng cấu trúc';
                exit;
            }
    }
   


    require 'edit.tpl.php';


?>
