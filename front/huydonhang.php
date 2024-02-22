<?php
require_once '../libraries/connect.php';

session_start();
// Lấy iduser từ URL
$id_order = $_GET['id_order'];
$sql_huydonhang = "UPDATE `order` set status='Hủy đơn hàng' where id_order=$id_order";
$re_huydonhang = mysqli_query($conn, $sql_huydonhang);

$_SESSION['huydonhang'] = true;
header('location: theodoidonhang.php');
exit;
