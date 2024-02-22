<?php
session_start();

// Check if the "remove_all" parameter is set in the request
if (isset($_POST['remove_all'])) {
    // Unset the wishlist session variable
    unset($_SESSION['wishlist']);

    // Redirect back to the wishlist page or any other desired page
    header('Location: wishlist.php');
    exit();
}
?>
