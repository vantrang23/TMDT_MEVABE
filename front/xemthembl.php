<?php
require_once '../libraries/connect.php';
// echo '<script>alert("Bình luận đã được gửi thành công. Xin vui lòng đợi phê duyệt.");</script>';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $iduser = $_POST['iduser'];
    $id_pro = intval($_POST['id_pro']); // Convert id_pro to integer

    // Retrieve and display approved comments
    $sql_binhluan = "SELECT bl.*, u.username AS name
                        FROM binhluan AS bl
                        JOIN user AS u ON bl.iduser = u.iduser
                        WHERE trangthai = 1 and bl.product_id=$id_pro
                        ORDER BY ngaydang DESC ";
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
