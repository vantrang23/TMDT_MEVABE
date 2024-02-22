<?php
require_once '../../libraries/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_binhluan = $_POST['id_binhluan'];
    $trangthai = $_POST['trangthai'];

    // Thực hiện câu lệnh SQL để cập nhật trạng thái
    $sql_update = "UPDATE binhluan SET trangthai = NOT trangthai WHERE id_binhluan = $id_binhluan";
    $result_update = mysqli_query($conn, $sql_update);

    if ($result_update) {
        $stt = 0;
        $sql_hienbl = "SELECT bl.*, u.username as username, p.name as name 
                        FROM binhluan bl
                        INNER JOIN user u ON bl.iduser = u.iduser
                        INNER JOIN product p ON p.product_id = bl.product_id
                        order by ngaydang desc";
        $result_hienbl = mysqli_query($conn, $sql_hienbl);
        while ($row_hienbl = mysqli_fetch_assoc($result_hienbl)) {
            $stt += 1;
            echo '<tr>
                <td>' . $stt . '</td>
                <td>' . $row_hienbl['username'] . '</td>
                <td>' . $row_hienbl['name'] . '</td>
                <td>' . $row_hienbl['noidung'] . '</td>
                <td>' . date('d/m/Y H:i:s', strtotime($row_hienbl['ngaydang'])) . '</td>
                <td>' . ($row_hienbl['trangthai'] == 1 ? 'Duyệt' : 'Chưa duyệt') . '</td>
                <td style="width: 100px;">
                    <input type="hidden" class="id_binhluan" value="' . $row_hienbl['id_binhluan'] . '">
                    <button class="chinhsua" data-id="' . $row_hienbl['id_binhluan'] . '" data-trangthai="' . $row_hienbl['trangthai'] . '">
                        <span class="material-symbols-outlined">task_alt</span>
                    </button>
                    <button><span class="material-symbols-outlined">border_color</span></button>
                </td>
            </tr>';
        }
    }
}
?>

<script>
    $(document).ready(function() {
        $('.chinhsua').click(function() {
            var id_binhluan = $(this).data('id');
            var trangthai = $(this).data('trangthai');

            // Gửi yêu cầu AJAX để cập nhật trạng thái
            $.ajax({
                type: 'POST',
                url: 'comment/duyet.php', // Đặt tên file xử lý cập nhật trạng thái
                data: {
                    id_binhluan: id_binhluan,
                    trangthai: trangthai
                }
            }).done(function(response) {
                $('.acd').html(response);

            });
        });
    });
</script>