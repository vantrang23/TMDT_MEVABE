<?php
    require '../../../libraries/connect.php';
    require '../../../models/user.php';
    session_start();
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql="SELECT *from user  WHERE  quantity_locked<4";      
    mysqli_query($conn, $sql); 
    
    if (isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $sql="SELECT *FROM user WHERE email= '$email'";
        $result = mysqli_query($conn, $sql);
        $user=mysqli_fetch_assoc($result);
  
        $count=mysqli_num_rows($result);
        
        // echo $count;
        if($count==0)
        {
            $_SESSION['loi']=true;
        }
        else
        {
            if ($user['quantity_locked']>=4)
            {
                send_user_lock($email);
            }
            else{
                $newpass=substr(md5(rand(0,99999)), 0,8);
                $sql="UPDATE user SET pass= '$newpass', status=1, locked=0 WHERE email= '$email' ";      
                mysqli_query($conn, $sql);    
                send_user($email, $newpass);
            }
            
        }
    }
?>

<?php
        function send_user($email, $newpass)
        {
            require "../PHPMailer-master/src/PHPMailer.php"; 
            require "../PHPMailer-master/src/SMTP.php"; 
            require '../PHPMailer-master/src/Exception.php'; 
            
            
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
            try {
                $mail->SMTPDebug = 0; //0,1,2: chế độ debug
                $mail->isSMTP();  
                $mail->CharSet  = "utf-8";
                $mail->Host = 'smtp.gmail.com';  //SMTP servers
                $mail->SMTPAuth = true; // Enable authentication
                $mail->Username = 'hothuyduy.tvb2018@gmail.com'; // SMTP username
                $mail->Password = 'vwhnzltppsnkjsii';   // SMTP password
                $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
                $mail->Port = 465;  // port to connect to                
                $mail->setFrom('hothuyduy.tvb2018@gmail.com', 'SHOPMEVABE' ); 
                $mail->addAddress($email); 
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'Email lại mật khẩu';
                $noidungthu = "<p>Tài khoản của bạn đã được mở lại <br> Mật khẩu mới của bạn là: {$newpass}</p>"; 
                $mail->Body = $noidungthu;
                $mail->smtpConnect( array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                ));
                $mail->send();
                // $_SESSION['thanhcong']=true;
                // header ('location: forget_password.php');
                echo "<script>alert('Đã gửi mail');</script>";
            } catch (Exception $e) {
                echo 'Error: ', $mail->ErrorInfo;
            }
        }


        function send_user_lock($email)
        {
            require "../PHPMailer-master/src/PHPMailer.php"; 
            require "../PHPMailer-master/src/SMTP.php"; 
            require '../PHPMailer-master/src/Exception.php'; 
            
            
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
            try {
                $mail->SMTPDebug = 0; //0,1,2: chế độ debug
                $mail->isSMTP();  
                $mail->CharSet  = "utf-8";
                $mail->Host = 'smtp.gmail.com';  //SMTP servers
                $mail->SMTPAuth = true; // Enable authentication
                $mail->Username = 'hothuyduy.tvb2018@gmail.com'; // SMTP username
                $mail->Password = 'vwhnzltppsnkjsii';   // SMTP password
                $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
                $mail->Port = 465;  // port to connect to                
                $mail->setFrom('hothuyduy.tvb2018@gmail.com', 'SHOPMEVABE' ); 
                $mail->addAddress($email); 
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'Email lại mật khẩu';
                $noidungthu = "<p>Tài khoản của bạn đã bị khóa do nhiều lần nhập sai nên không thể mở lại</p>"; 
                $mail->Body = $noidungthu;
                $mail->smtpConnect( array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                ));
                $mail->send();
                // $_SESSION['thanhcong']=true;
                // header ('location: forget_password.php');
                echo "<script>alert('Đã gửi mail');</script>";
            } catch (Exception $e) {
                echo 'Error: ', $mail->ErrorInfo;
            }
        }
    
    require 'xacminh_user.php';
?>