<?php
    session_start();
    if(isset($_POST['user']))
    {
        header ('location: login.php');
        exit;
    }
    require_once '../../models/user.php';
    require_once '../../libraries/connect.php';
    $category_list= get_category_list($conn);
    require 'list.tpl.php'

?>


