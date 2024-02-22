<?php
require_once '../libraries/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Lấy và làm sạch đầu vào của người dùng
   $binhluan = mysqli_real_escape_string($conn, $_POST['binhluan']);
   $iduser = mysqli_real_escape_string($conn, $_POST['name']);
   $id_pro = intval($_POST['id_pro']);

   // Thêm bình luận mới vào cơ sở dữ liệu
   $sql_insert_binhluan = "INSERT INTO binhluan ( iduser, product_id, noidung, trangthai, ngaydang) VALUES ($iduser, $id_pro, '$binhluan', 0, NOW())";
   $result_insert_binhluan = mysqli_query($conn, $sql_insert_binhluan);

   // Kiểm tra xem việc chèn bình luận có thành công hay không
   if ($result_insert_binhluan) {
      echo '<script>alert("Bình luận đã được gửi thành công. Xin vui lòng đợi phê duyệt.");</script>';
   } else {
      echo "Có lỗi xảy ra khi gửi bình luận.";
   }

   // Lấy và hiển thị các bình luận được phê duyệt
   $sql_binhluan = "SELECT bl.*, u.username AS name
                    FROM binhluan AS bl
                    JOIN user AS u ON bl.iduser = u.iduser
                    WHERE trangthai = 1 and product_id=$id_pro
                    ORDER BY ngaydang DESC limit 2";
   $result_binhluan = mysqli_query($conn, $sql_binhluan);

   if ($result_binhluan && mysqli_num_rows($result_binhluan) > 0) {
      while ($row_binhluan = mysqli_fetch_assoc($result_binhluan)) {
         echo '<div class="d-flex flex-start align-items-center" >'
            . '<span class="material-symbols-outlined">account_circle</span>'
            . '<div>'
            . '<h6 class="fw-bold text-primary mb-1">' . $row_binhluan['name'] . '</h6>'
            . '<p class="text-muted small mb-0">'
            . $row_binhluan['ngaydang']
            . '</p>'
            . '</div>'
            . '</div>'
            . '<p class="mt-3 mb-4 pb-2">'
            . $row_binhluan['noidung']
            . '</p>';
      }
   } else {
      // echo "Không có bình luận nào được phê duyệt.";
   }
}
