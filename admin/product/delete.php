<?php
    session_start();
    require_once '../../libraries/connect.php';
    require_once '../../models/user.php';

    $product_id = $_GET['product_id'];

    delete_product($product_id, $conn);
    $_SESSION['delete'] = true;
    header("Location: list.php"); // Redirect to your list page after deletion

?>
