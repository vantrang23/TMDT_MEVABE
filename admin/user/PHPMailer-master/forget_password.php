<?php
    require '../../../libraries/connect.php';
    require '../../../models/user.php';
    session_start();
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $sql="SELECT *FROM user WHERE email= '$email'";
        $result = mysqli_query($conn, $sql);
        $count=mysqli_num_rows($result);
        
        // echo $count;
        if($count==0)
        {
            $_SESSION['loi']=true;
        }
        else
        {
            $newpass=substr(md5(rand(0,99999)), 0,8);
            $sql="UPDATE user SET pass= '$newpass' WHERE email= '$email'";      
            mysqli_query($conn, $sql);    
            sendpass($email, $newpass);
        }
    }
?>

<?php
        function sendpass($email, $newpass)
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
                $noidungthu = "<p>Mật khẩu mới của bạn là: {$newpass}</p>"; 
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
    
    require 'forget-pass.php';
?>