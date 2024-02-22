<?php
  session_start();
  require '../../libraries/connect.php';
  require '../../models/user.php';
  if (isset($_POST['them'])) {
    if (!$conn) {
        exit('Kết nối không thành công!');
    }

    // Lấy giá trị từ form
    $name = $_POST['name'];
    $startDay = $_POST['start_day'];
    $endDay = $_POST['end_day'];
    $content = $_POST['content'];
    $discount = $_POST['discount'];
    $status = isset($_POST['status']) ? 1 : 0;

    $currentDate = date('Y-m-d');
    

    // Thêm dữ liệu vào bảng Promotions
    $insertQuery = "INSERT INTO promotion (name, start_day, end_day, content, discount, status, created)
                    VALUES ('$name', '$startDay', '$endDay', '$content', '$discount', '$status', NOW())";

    if ($conn->query($insertQuery) === TRUE) {
      $promotionId = $conn->insert_id;
      
      $selectedProducts = isset($_POST['selected_product']) ? $_POST['selected_product'] : [];
      // echo "<script>alert('" . var_dump($_POST) . "');</script>";

     
      
      foreach ($selectedProducts as $productId) {
          $sql_pro = "INSERT INTO promotion_product (id_promotion, product_id) VALUES ('$promotionId', '$productId')";
          update_product_promtion($promotionId, $productId, $conn);
          if ($conn->query($sql_pro) !== TRUE) {
              echo "Lỗi khi lưu sản phẩm: " . $conn->error;
          }
      }

        $_SESSION['success'] = true;
        
        echo "<script> location.href = 'add.php'; </script>";
        exit;
    }
    }
  require 'add.tpl.php';
?>