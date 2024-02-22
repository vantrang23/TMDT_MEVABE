 <?php
    session_start();


    if (isset($_POST['register'])) {
        require '../../libraries/connect.php';
        require '../../models/user.php';
        // Lấy dữ liệu từ form
        $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $password = $_POST['password'];
        $cpass = $_POST['cpass'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];

        // Kiểm tra dữ liệu
        if (empty($username) || empty($password) || empty($cpass) || empty($fullname) || empty($email)) {
            $error = "Vui lòng nhập đầy đủ thông tin";
        } else if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 12) {
            $error = 'Mật khẩu phải có từ 8 đến 12 kí tự!';
        } else if (!preg_match('/^(?=[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{2,20}$/', $username)) {
            $error = "Tên đăng nhập gồm chữ và số, và ký tự đầu tiên là chữ cái";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Định dạng email không hợp lệ";
        } else if ($password !== $cpass) {
            $error = "Mật khẩu nhập lại không khớp";
        } else {
            // Kiểm tra tên đăng nhập đã tồn tại
            $query = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $suggestedUsername = generateSuggestedUsername($username, $conn);
                $error = "Tên đăng nhập đã tồn tại, vui lòng chọn tên khác! Gợi ý: $suggestedUsername";
            } else {
                // Nếu không có lỗi thực hiện đăng ký
                // $password = md5($password);
                $sql = "INSERT INTO user(username, pass, fullname, email, status, role, created) VALUES('$username', '$password', '$fullname', '$email', 1, 'khach', NOW())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['thanhcong'] = true;
                    header('location: login.php');
                    exit;
                } else {
                    $error = "Đăng ký không thành công. Vui lòng thử lại";
                }
            }
        }
    }



    require 'register.tpl.php';
    ?>