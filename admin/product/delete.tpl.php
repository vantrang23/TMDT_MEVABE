<?php
    session_start();
    require_once '../../libraries/connect.php';
    require_once '../../models/user.php';

    $product_id = $_GET['product_id'];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your HTML header content here -->
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Display a confirmation dialog using Swal (SweetAlert)
        Swal.fire({
            title: 'Xác nhận xóa?',
            text: 'Bạn có chắc muốn xóa danh mục này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, redirect to the delete action
                window.location.href = `delete.php?product_id=<?php echo $product_id; ?>`;
            } else {
                // If the user cancels, redirect back to the list page
                window.location.href = 'list.php';
            }
        });
    </script>
</body>
</html>



