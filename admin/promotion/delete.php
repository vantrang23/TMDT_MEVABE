<?php
    session_start();
    require_once '../../libraries/connect.php';
    require_once '../../models/user.php';

    $id_promotion = $_GET['id_promotion'];
    delete_promotion($id_promotion, $conn);   
    header("Location: list.php"); 
    $_SESSION['delete'] = true;
    exit;
?>