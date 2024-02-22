<?php
    session_start();
    require_once '../../libraries/connect.php';
    // require_once '../../models/user.php';

    $product_id = $_GET['product_id'];
    $sql_pro="SELECT *from product where product_id=$product_id";
    $result=mysqli_query($conn, $sql_pro);
    $product = mysqli_fetch_assoc($result);
    $id_promotion=$product['id_promotion'];

    $sql="UPDATE product set id_promotion=0 where product_id=$product_id";
    $result=mysqli_query($conn, $sql);
    header("Location: detail.php?id_promotion=".$id_promotion); 
    $_SESSION['delete'] = true;
    exit;
?>