function confirmDelete(iduser) {
    Swal.fire({
        title: 'Confirmation',
        text: 'Bạn có chắc muốn xóa?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'user/delete.php?iduser=' + iduser;
        }
    });
}

function Delete_category(category_id) {
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
            window.location.href = `../category/delete.php?category_id=<?php echo $category_id; ?>`;
        } else {
            // If the user cancels, redirect back to the list page
            window.location.href = 'list.php';
        }
    });
}