<?php
    if (isset($_POST['category_id'])) {
        $category_id = $_POST['category_id'];
        // require '../../libraries/connect.php';
        
        // Lấy danh sách sản phẩm dựa trên danh mục
        $query = "SELECT * FROM products WHERE category_id = $category_id";
        $result = mysqli_query($conn, $query);
    
        $products = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    
        echo json_encode($products);
    }

?>