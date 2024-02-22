<?php
require_once '../libraries/connect.php';
// echo '<script>alert("Bình luận đã được gửi thành công. Xin vui lòng đợi phê duyệt.");</script>';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $iduser = $_POST['iduser'];
    $sl = $_POST['sl'];
    $product_id = intval($_POST['product_id']); // Convert id_pro to integer

    $sql_upgiohang = "UPDATE giohang SET soluong=$sl+1 WHERE iduser=$iduser AND product_id=$product_id";
    $result_upgiohang = mysqli_query($conn, $sql_upgiohang);

    $sql_giohang = "SELECT gh.*, p.image AS image, p.price AS price, p.name AS name, p.quantity as quantity
                    FROM giohang gh
                    INNER JOIN product p ON gh.product_id = p.product_id
                    WHERE gh.iduser = $iduser";
    $result_giohang = mysqli_query($conn, $sql_giohang);

    while ($row_giohang = mysqli_fetch_assoc($result_giohang)) {
        $tongtien = $row_giohang['price'] * $row_giohang['soluong'];
        $sql_1 = "SELECT prom.*, pro.product_id as product_id, COUNT(prom.id_promotion) AS cokm
        FROM promotion prom
        JOIN product pro ON prom.id_promotion = pro.id_promotion
        WHERE pro.product_id = $product_id and pro.status=1 AND (prom.end_day > CURDATE() OR prom.end_day = CURDATE())
        GROUP BY prom.id_promotion;";
        $result_1 = mysqli_query($conn, $sql_1);
        $row_1 = mysqli_fetch_assoc($result_1);
        echo '<tr class="sd">
                <input type="hidden" class="price" id="" value="' . $row_giohang['price'] . '">
                <input type="hidden" class="product_id" id="" value="' . $row_giohang['product_id'] . '">
                <input type="hidden" class="iduser" id="" value="' . $iduser . '">
                <td class="shoping__cart__item">
                    <img src="../admin/upload/' . $row_giohang['image'] . '" alt="Product Image" width="80px" height="80px">
                    <h5>' . $row_giohang['name'] . '</h5>
                </td>
                <td class="shoping__cart__quantity">
                    <div class="quantity">
                        <div class="pro">
                            <a href="" class="ab"><span class="dec qtybtn">-</span></a>
                            <input type="text" class="quantity ad" name="quantity[' . $product_id . ']" value="' . $row_giohang['soluong'] . '">
                            <a href="" class="ab"><span class="inc qtybtn">+</span></a>
                        </div>
                    </div>
                </td>
                <td class="shoping__cart__price" style="font-weight: 400;">';

        // Place the PHP condition here
        if ($row_1 !== null) {
            $giagiam = $row_giohang['price'] - ($row_giohang['price'] * $row_1['discount']) / 100;
            echo number_format($giagiam, 0, '', '.') . ' VNĐ<br>';
            echo '<p style="text-decoration: line-through;">' . number_format($row_giohang['price'], 0, '', '.') . ' VNĐ</p>';
        } else {
            echo number_format($row_giohang['price'], 0, '', '.') . ' VNĐ';
        }

        echo '</td>
                <td class="shoping__cart__total" style="font-weight: 400;">';
        if ($row_1 !== null) {
            $tongtien = $giagiam * $row_giohang['soluong'];
            echo number_format($tongtien, 0, '', '.') . ' VNĐ';
        } else {
            echo number_format($tongtien, 0, '', '.') . 'VNĐ';
        }
        echo    '</td>
         <td class="shoping__cart__item__close" onclick="return confirm(\'Bạn có chắc chắn muốn xóa sản phẩm này?\')">
                    <a href="?remove_product=' . $product_id . '"><span class="icon_close"></span></a>
                </td>
                <td>
                    <input type="checkbox" name="buy_product[]" value="' . $product_id . '" class="product-checkbox">
                </td>
            </tr>';
    }
} else {
    // echo "Không có bình luận nào được phê duyệt.";
}
?>
<script>
    $(document).ready(function() {
        $('.dec').click(function(e) {
            e.preventDefault();
            // Tìm trường nhập số lượng gần nhất trong cùng một div cha
            var quantityInput = $(this).closest('.pro').find('.ad');
            var product_id = $(this).closest('.sd').find('.product_id').val();
            var iduser = $('.iduser').val();
            var sl = quantityInput.val();
            $.ajax({
                method: "POST",
                url: "giohang.php",
                dataType: 'html',
                data: {
                    sl: sl,
                    iduser: iduser,
                    product_id: product_id
                }
            }).done(function(response) {
                $('.r').html(response);

            });
        });
    });
</script>
<!-- TĂNG SỐ LƯỢNG SẢN PHẨM -->
<script>
    $(document).ready(function() {
        $('.inc').click(function(e) {
            e.preventDefault();
            // Tìm trường nhập số lượng gần nhất trong cùng một div cha
            var quantityInput = $(this).closest('.pro').find('.ad');
            var product_id = $(this).closest('.sd').find('.product_id').val();
            var iduser = $('.iduser').val();
            // Lấy giá trị số lượng hiện tại
            var sl = quantityInput.val();
            var quantity = $(this).closest('.sd').find('.quantity').val();

            // alert(product_id);
            if (sl == quantity) {
                return;
            }
            $.ajax({
                method: "POST",
                url: "giohangtang.php",
                dataType: 'html',
                data: {
                    sl: sl,
                    iduser: iduser,
                    product_id: product_id
                }
            }).done(function(response) {
                $('.r').html(response);
                // $('.shoping__cart__total').text(response + ' VNĐ');
                // document.getElementById('message').value = '';
            });
        });
    });
</script>

<script>
    function selectAllItems() {
        const selectAllCheckbox = document.getElementById('select-all');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const selectedCount = document.getElementById('selected-count');

        for (const checkbox of productCheckboxes) {
            checkbox.checked = selectAllCheckbox.checked;
        }

        const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
        // selectedCount.textContent = `(${selectedProducts.length} sản phẩm được chọn)`;
        selectedCount.textContent = `(${selectedProducts.length})`;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const productCheckboxes = document.querySelectorAll('.product-checkbox');

        for (const checkbox of productCheckboxes) {
            checkbox.addEventListener('change', () => {
                const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
                const selectedCount = document.getElementById('selected-count');
                selectedCount.textContent = `(${selectedProducts.length})`;
            });
        }
    });
</script>
<!-- Trong phần head của trang -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectAllCheckbox = document.getElementById('select-all');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const selectedCount = document.getElementById('selected-count');
        const totalPriceElement = document.getElementById('total-price');
        const checkoutButton = document.getElementById('checkout-button');

        // Cập nhật số lượng sản phẩm được chọn khi checkbox thay đổi
        function updateSelectedCount() {
            const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
            selectedCount.textContent = `(${selectedProducts.length})`;

            // Tính toán giá tạm tính
            let totalTempPrice = 0;
            selectedProducts.forEach((checkbox) => {
                const row = checkbox.closest('tr');
                const quantity = parseInt(row.querySelector('.shoping__cart__quantity input').value);
                const price = parseFloat(row.querySelector('.shoping__cart__price').textContent.replace(' VNĐ', '').replace('.', ''));
                totalTempPrice += quantity * price;
            });

            // Hiển thị giá tạm tính
            totalPriceElement.textContent = `${numberWithCommas(totalTempPrice)} VNĐ`;

            // Enable/Disable nút checkout tùy thuộc vào số lượng sản phẩm được chọn
            checkoutButton.disabled = selectedProducts.length === 0;
        }

        // Bắt sự kiện thay đổi của checkbox
        selectAllCheckbox.addEventListener('change', () => {
            productCheckboxes.forEach((checkbox) => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateSelectedCount();
        });

        productCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                updateSelectedCount();
            });
        });

        // Hàm định dạng số có dấu phẩy ngăn cách hàng nghìn
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    });
</script>



<style>
    th label {
        margin-left: 5px;
        /* Adjust the margin as needed */
    }
</style>
<style>
    input[type="checkbox"] {
        width: 20px;
        /* Adjust the width as needed */
        height: 20px;
        /* Adjust the height as needed */
    }
</style>
<style>
    a#tieptucmuasam {
        background: #cc30692e;
        border-radius: 25px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    a#tieptucmuasam:hover {
        background: #e91e63ba;
        border-radius: 25px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    */ .cart-btn-continue:hover {
        color: white !important;
        /* Màu chữ khi hover */
        text-decoration: none;
    }
</style>
<style>
    .empty-cart-message {
        text-align: center;
        font-size: 50px;
        color: #555;
        margin-top: 20px;
    }
</style>



<style>
    .primary-btn.cart-btn {
        color: #6f6f6f;
        padding: 14px 30px 12px;
        background: #e91e6330;
        border-color: #f0f8ff00;
        border-radius: 76px;
    }

    .primary-btn.cart-btn:hover {
        color: #6f6f6f;
        padding: 14px 30px 12px;
        background: #e91e63ba;
        border-color: #f0f8ff00;
        border-radius: 76px;
    }

    .cart-btn-delete:hover {
        color: white !important;
        /* Đặt màu trắng cho chữ */
    }

    .cart-btn-update {
        background-color: #ffcc00 !important;
        /* Đặt màu đỏ cho nền */
        color: black !important;
        /* Đặt màu trắng cho chữ */
    }

    .cart-btn-update:hover {
        color: white !important;
        text-decoration: none;
    }

    /* Căn chỉnh kích thước cột */
    .shoping__cart__table th,
    .shoping__cart__table td {
        padding: 15px;
    }

    .shoping__cart__table .shoping__product {
        width: 30%;
    }


    .shoping__cart__btns button {
        margin-right: 10px;
        /* Điều chỉnh khoảng cách theo nhu cầu của bạn */
    }


    .shoping__cart__table th:first-child,
    .shoping__cart__table td:first-child {
        padding-left: 0;
    }

    .shoping__cart__table th:last-child,
    .shoping__cart__table td:last-child {
        padding-right: 0;
    }

    /* Tạo khoảng cách cân đối */
    .shoping__cart__table tr:not(:last-child) {
        margin-bottom: 15px;
    }

    .shoping__cart__table table tbody tr td.shoping__cart__item__close {
        text-align: center;
    }

    .shoping__checkout-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .primary-btn_buys {
        background-color: #CC3069;
        padding: 7px 60px;
        text-decoration: none;
        color: black;
        border: 2px solid black;
        /* Set border to 2px solid black */
        border-radius: 5px;
        /* Add rounded corners */
    }


    .primary-btn_buys:hover {
        background-color: #CC3069;
        padding: 7px 60px;
        text-decoration: none;
        color: white;
        border: 2px solid black;
        /* Set border to 2px solid black */
        border-radius: 5px;
        /* Add rounded corners */
    }
</style>

<!-- /*CĂN ĐỀU TABLE*/ -->

<style>
    .shoping__cart__table table tbody tr td.shoping__cart__price {
        font-size: 18px;
        color: #1c1c1c;
        font-weight: 700;
        width: 154px;
    }

    .shoping__cart__table table tbody tr td.shoping__cart__total {
        font-size: 18px;
        color: #1c1c1c;
        font-weight: 700;
        width: 163px;
    }
</style>