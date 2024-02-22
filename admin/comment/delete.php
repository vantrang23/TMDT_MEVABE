<?php
    session_start();
    require_once '../../libraries/connect.php';
    require_once '../../models/user.php';

    $id_binhluan = $_GET['id_binhluan'];

    $sql_xoabl="DELETE from binhluan where id_binhluan=$id_binhluan";
    $re_xoabl=mysqli_query($conn, $sql_xoabl);
    $_SESSION['delete_bl'] = true;
    header("Location: list.php"); // Redirect to your list page after deletion

?>