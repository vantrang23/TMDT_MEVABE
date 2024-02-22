<?php

  session_start();

  require '../../libraries/connect.php';
  require '../../models/user.php';
  if(isset($_SESSION['open']))
  {
    unset($_SESSION['open']);
  }

  if(isset($_POST['btn_login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
      $error = "Vui lòng nhập đầy đủ thông tin";
    } 
    else {
      $user = get_user_by_username($username,$conn);
      if ($user)
      {
        if($user['status']==1) {
          if($password == $user['pass'])
          {
            if($user['role'] == 'khach')
            {
              //đăng nhập thành công người dùng 
              $_SESSION['fullname'] = $user['fullname'];
              locked_user_true($username,$conn);
              header("Location: ../../front/index.php?iduser=" .$user['iduser']);
            }
            else
            {
              if($user['role'] == 'nhanvien' || $user['role'] == 'admin')
              {
                //đăng nhập nhân viên và amin thành cônh
                $_SESSION['user'] = $user['iduser']; 
                header("Location: ../index.php?iduser=" .$user['iduser']);
                exit;
              }
            }
          }
          else
          {
            $error = "Mật khẩu sai"; 
            $locked=$user['locked']+1;
            locked_user_false($locked,$username, $conn);  
            if ($user['locked']>=4)
            {             
              locked_user($username,$conn);          
              $error1 = "Tài khoản đã bị khóa do nhập sai mật khẩu nhiều lần ";
              $_SESSION['open'] = true;
              $_SESSION['lock_time'] = time() + 120;      
            }
            else{
              if ($user['locked']==3)
            {             
              // locked_user($username,$conn);          
              echo "<script>alert('Nếu bạn nhập sai 1 lần nữa tài khoản sẽ bị khóa, chọn quên mật khẩu để lấy lại mật khẩu!!!');</script>";
              // $_SESSION['wait'] = true;
              // $_SESSION['lock_time'] = time() + 120;      
            }
            }

          }
        }else{
          $error="Tài khoản đã bị khóa";
          $_SESSION['open']=true;
        }
      }else
      {
        
        $error="Tên người dùng không đúng";
      }
    }
  }
  // Kiểm tra thời gian khóa và kiểm tra số lần nhập sai
    if (isset($_SESSION['lock_time']) && $_SESSION['lock_time'] > time()) {
      $time_remaining = ceil(($_SESSION['lock_time'] - time()) / 60); // Tính thời gian còn lại (phút)
      $error1 = "Tài khoản đã bị khóa";
      $_SESSION['open']=true;
    }

    

  require 'login.tpl.php';

?>
