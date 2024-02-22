<?php
//HIỆN CHI TIẾT SẢN PHẨM
//lấy sản phẩm
// function get_product_by_id($product_id,$conn)
// {
//     $sql="SELECT pro.*, cate.name as cate_name FROM product pro, category cate WHERE pro.category_id=cate.category_id and product_id='$product_id'";
//     $query =mysqli_query($conn, $sql);
//     //return
//     return mysqli_fetch_assoc($query);
// }
//lấy chi tiết sản phẩm
function get_product_detail_by_id($product_id, $conn)
{
    $sql = "SELECT dt.* , pro.detail as detail FROM product_detail dt, product pro WHERE dt.product_id=pro.product_id and pro.product_id='$product_id'";
    $query = mysqli_query($conn, $sql);
    //return
    return mysqli_fetch_assoc($query);
}
//lấy hình ảnh sản phẩm
function get_product_image_by_id($product_id, $conn)
{
    $sql = "SELECT * FROM product_image WHERE product_id='$product_id'";
    $query = mysqli_query($conn, $sql);
    //return
    return mysqli_fetch_assoc($query);
}
//sản phẩm liên quan
function get_product_relate($product_id, $category_id, $conn)
{
    $sql = "SELECT * FROM product WHERE category_id='$category_id' AND product_id <> '$product_id' LIMIT 4";
    return mysqli_query($conn, $sql);
    //return
    // return mysqli_fetch_assoc($query);
}

//HIEN SAN PHAM
function product_list($conn)
{
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);
    //return
    return mysqli_fetch_assoc($result);
}

// Thêm bình luận
function binhluan($iduser, $product_id, $noidung, $conn)
{
    $sql = "INSERT into binhluan(iduser, product_id, noidung, trangthai)
                    value($iduser, $product_id, $noidung, 0)";
    return mysqli_query($conn, $sql);
}
