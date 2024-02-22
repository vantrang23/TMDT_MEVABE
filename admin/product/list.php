<?php
    session_start();
    if(isset($_POST['user']))
    {
        header ('location: login.php');
        exit;
    }
    require_once '../../models/user.php';
    require_once '../../libraries/connect.php';
    $product_list= get_product_list($conn);
    require 'list.tpl.php'

?>


