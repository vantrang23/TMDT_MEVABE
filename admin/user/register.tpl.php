<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="../css/vendors/login.css">
    <title>ĐĂNG KÝ</title>
    <style>
        div#wrapper {
            /* background: #6a11cb; */
            background-image: url('../css/vendors/background.png');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body>

    <div id="wrapper">
        <form action="register.php" id="form-login" method="POST">
            <h1 class="form-heading">ĐĂNG KÝ</h1>
                <?php if(isset($error))
        { ?> <div class="error"><p style="color:red">
            <?php echo $error; ?></div> <?php } ?>
            <?php if(isset($success))
            { ?> <div class="success">
                <?php echo $success; ?>
            </div> <?php } 
            ?>

            <div class="form-group">
                <i class="far fa-user"></i>
                <input type="text" class="form-input" placeholder="Tên đăng nhập gồm chữ và số" name="username"  required>
            </div>

            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <input type="email" class="form-input" placeholder="Email" name="email" required>
            </div>

            <div class="form-group">
                <i class="far fa-user"></i>
                <input type="text" class="form-input" placeholder="Họ và Tên" name="fullname" required>
            </div>

            <div class="form-group">
                <i class="fas fa-key"></i>
                <input type="password" class="form-input" id="pass" placeholder="Mật khẩu" name="password" required>
                <div id="eye">
                    <!-- <i class="far fa-eye"></i> -->
                    <span ><i class="fa fa-eye-slash" onclick="showHidden()"></i></span>
                </div>
            </div>
            <div class="form-group">
                <i class="fas fa-key"></i>
                <input type="password" class="form-input" id="pass" placeholder="Nhập lại mật khẩu" name="cpass" required>
                <div id="eye">
                    <!-- <i class="far fa-eye"></i> -->
                    <span ><i class="fa fa-eye-slash" onclick="showHidden()"></i></span>
                </div>
            </div>
            
             <input type="submit" value="Đăng ký" class="form-submit" name="register">
                    
              <div class="mb-0">
                <p>Có tài khoản?  
                <a href="login.tpl.php" class="text-white-50 fw-bold"> Đăng nhập</a></p>
            </div>
              
             
        </form>
        
    </div>
    <script>
        isBool =true;
function showHidden(){
      if(isBool){
         document.getElementById("pass").setAttribute("type","text");
         document.querySelector("#eye i").setAttribute("class","far fa-eye");
         isBool =false;
      }else{
         document.getElementById("pass").setAttribute("type","password");
         document.querySelector("#eye i").setAttribute("class","fa fa-eye-slash");
         isBool = true;
      }
}
    </script>
    <script src="../../../template/admin/js/login.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js">    </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


</html>
