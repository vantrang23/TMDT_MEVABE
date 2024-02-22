<?php
     require_once '../libraries/connect.php';
     if($_POST)
     {
        $keyword=$_POST['search'];
        header("location: shop-search.php?keyword=".$keyword ) ;  
        
     }




?>