<?php
session_start();
if (isset($_SESSION['iduser'])) {
    $iduser = $_SESSION['iduser'];
    $_SESSION['iduser'] = $iduser;
}

?>

<?php
// session_start();
require_once '../models/product.php';
require_once '../models/user.php';
require_once '../libraries/connect.php';
$product_id = $_GET['product_id'];
$product = get_product_by_id($product_id, $conn);
$category_id = $product['category_id'];
$product_detail = get_product_detail_by_id($product_id, $conn);
// $product_image = get_product_image_by_id($product_id, $conn);
$result = get_product_relate($product_id, $category_id, $conn);



//SẢN PHẨM LIÊN QUAN
$sql_danhmuc = "SELECT pro.category_id as category_id
                    from category cate, product pro 
                    where cate.category_id=pro.category_id and  pro.product_id = $product_id";
$result_danhmuc = mysqli_query($conn, $sql_danhmuc);
$row_danhmuc = mysqli_fetch_assoc($result_danhmuc);


$sql_sanphamlienquan = "SELECT pro.* FROM product pro
                            WHERE pro.product_id <> $product_id AND pro.category_id = " . $row_danhmuc['category_id'];
$result_sanphamlienquan = mysqli_query($conn, $sql_sanphamlienquan);


require 'shop-detail.tpl.php';

?>