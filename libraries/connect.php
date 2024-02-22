<?php
//khai báo biến host
$hostName = 'localhost';
// khai báo biến username
$userName = 'root';
//khai báo biến password
$passWord = '';
// khai báo biến databaseName
$databaseName = 'shopmevabe';
// khởi tạo kết nối
$conn = mysqli_connect($hostName, $userName, $passWord, $databaseName);
//Kiểm tra kết nối
if (!$conn) {
    exit('Kết nối không thành công!');
}
// thành công

?>