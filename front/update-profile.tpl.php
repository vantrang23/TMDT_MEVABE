<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>capnhattaikhoan</title>
     <!-- Google Font -->
     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">


</head>

<body>
<?php
   require 'header.php';
?>

 <section class="update-profile">
    <h1 class="title"><b>CẬP NHẬT HỒ SƠ<b></h1>
    <form action="" method="POST" enctype="multipart/form-data">
      
      <div class="flex">
        <div class="inputBox">
        <input type="hidden" name="iduser" value="<?php echo $iduser; ?>">
          <span>Tên người dùng:</span>
          <input type="text" name="name" value="<?php echo $user['username'];?>"  required class="box">
          <span>Email :</span>
          <input type="email" name="email" value="<?php echo $user['email'];?>" required class="box">
          <span>Họ và tên :</span>
          <!-- <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box"> -->
          <input type="text" name="fullname" value="<?php echo $user['fullname'];?>" required class="box">
          <!-- <input type="hidden" name="old_image" value=""> -->
        </div>
        <div class="inputBox">
          <input type="hidden" name="old_pass" value="">
          <span>Nhập mật khẩu cũ :</span>
          <input type="password" name="pass_old"  class="box">
          <span>Nhập mật khẩu mới :</span>
          <input type="password" name="new_pass" class="box">
          <span>Nhập lại mật khẩu :</span>
          <input type="password" name="confirm_pass"  class="box">
        </div>
      </div>
      <div class="flex-btn">
        <input type="submit" class="btn" value="CẬP NHẬT HỒ SƠ" name="update_profile">
       
        <a href="index.php?iduser=<?php echo $iduser;?>" class="option-btn"><B>QUAY LẠI<B></a>
      </div>
    </form>
  </section>
<?php
   require 'footer.php';
?>


</body>

</html>
<style>
    .update-profile {
      text-align: center;
      margin: 20px auto;
      width: 1000px;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .title {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .flex {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .inputBox {
      text-align: left;
      flex-basis: 48%;
    }

    .inputBox span {
      display: block;
      margin-bottom: 5px;
    }

    .box {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .flex-btn {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .btn,
    .option-btn {
      flex-basis: 50%;
    }

    .btn {
      padding: 10px 20px;
      background-color: #CC3069;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .option-btn {
      text-decoration: none;
      color: #CC3069;

    }
    .option-btn:hover{
      text-decoration: none;
      color: #ff99cc;
    }
  </style>