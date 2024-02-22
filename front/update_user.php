<?php 
    session_start();
    require '../libraries/connect.php';
    require '../models/user.php';
    // if (isset($_POST['huy'])) {
    //     // The "Hủy" button was clicked, simply redirect to list.php
    //     exit(header('location: list.php'));
    // }
    $iduser = $_GET['iduser'];
    $user = get_user_by_iduser($iduser, $conn);


    if ($_POST) {
        // Kiểm tra xem dữ liệu từ biểu mẫu đã được gửi hay chưa
        if (isset($_POST['name']) && isset($_POST['email'])) {
            $data = array(
                'username' => $_POST['name'],
                'pass_old' => $_POST['pass_old'] ,
                'new_pass' => $_POST['new_pass'] ,
                'confirm_pass' => $_POST['confirm_pass'] ,
                'fullname' => $_POST['fullname'],
                'email' => $_POST['email'],
                // 'status' => isset($_POST['status']) ? 1 : 0,
                'modified' => date("Y-m-d H:i:s")

            );           
        }
            
  
            $iduser = $_POST['iduser'];
            if (isset($_POST['update_profile']))
            {
                if ($data['pass_old']==null && $data['new_pass']==null && $data['confirm_pass']==null)
                {
                    if(update_user_profile($data, $iduser, $conn))
                    {
                        echo "<script>alert('Cập nhật thành công'); window.location.href = 'update_user.php?iduser=' + $iduser;</script>";
                    }  
                    
                }
                else {
                    if(checkPassword( $iduser,$data['pass_old'],$conn))
                {
                    if($data['new_pass']!==$data['confirm_pass'])
                    {
                        echo "<script>alert('Mật khẩu mới không khớp');</script>";
                    }
                    else
                    {
                        update_user_profile($data, $iduser, $conn);  
                        echo "<script>alert('Cập nhật thành công');</script>"; 
                        header ('location: update_user.php?iduser=' .$iduser);
                    }
                    
                }
                else
                {

                    echo "<script>alert('Mật khẩu không đúng');</script>";   
                } 
                    
                }           

            }   

    }
   


    require 'update-profile.tpl.php';


?>
