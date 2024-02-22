<?php
    session_start();
    require_once '../../libraries/connect.php';
    require_once '../../models/user.php';

    $category_id = $_GET['category_id'];

    delete_category($category_id, $conn);
    $_SESSION['delete'] = true;
    header("Location: list.php"); // Redirect to your list page after deletion
?>


