<?php 
    require_once '../../libraries/connect.php';
    require_once '../../models/user.php';
    session_start();
    // Lấy iduser từ URL
    $iduser = $_GET['iduser'];
    if(delete_user($iduser, $conn))
    {
        $_SESSION['delete']=true;
        header ('location: list.php');
        exit;
    } 
    
?>

