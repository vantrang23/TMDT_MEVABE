<?php
function get_user_by_username($username, $conn)
{
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}

function get_user_by_email($email, $conn)
{
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}
//kiểm tra email
function checkmail($email, $conn)
{
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}

//kiểm tra đăng nhập đúng
function locked_user_true($username, $conn)
{
    $sql = "UPDATE user SET locked = 0 WHERE username = '$username'";
    return mysqli_query($conn, $sql);
}
//kiểm tra đăng nhập sai
function locked_user_false($locked, $username, $conn)
{
    $sql = "UPDATE user SET locked = $locked WHERE username = '$username'";
    return mysqli_query($conn, $sql);
}
//khóa tài khoản
function locked_user($username, $conn)
{
    $sql = "UPDATE user SET status = 0 WHERE username = '$username'";
    return mysqli_query($conn, $sql);
}
//mở lại tài khoản
function open_user($username, $conn)
{
    $sql = "UPDATE user SET status = 1, locked=0 WHERE username = '$username'";
    return mysqli_query($conn, $sql);
}
//kiểm tra đăng nhập



function get_user_by_categoryname($name, $conn)
{
    $sql = "SELECT * FROM category WHERE name='$name'";
    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}

function generateSuggestedUsername($username, $conn)
{
    $suggestedUsername = $username;
    $counter = 1;
    while (usernameExists($suggestedUsername, $conn)) {
        $suggestedUsername = $username . $counter;
        $counter++;
    }
    return $suggestedUsername;
}

function usernameExists($username, $conn)
{
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

function get_product_names($conn)
{
    $sql = "SELECT name FROM category";
    $query = mysqli_query($conn, $sql);

    $names = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $names[] = $row['name'];
    }
    return $names;
}

//hiển thị danh sách người dùng
function get_user_list($conn)
{
    $sql = "SELECT * FROM user ORDER BY fullname";
    return mysqli_query($conn, $sql);
}

//xóa người dùng
function delete_user($iduser, $conn)
{
    $sql_xoagh = "DELETE from giohang where iduser=$iduser";
    $xoa_gh = mysqli_query($conn, $sql_xoagh);

    $sql = "DELETE FROM user WHERE iduser='$iduser';";
    return mysqli_query($conn, $sql);
}

function edit_user($data, $iduser, $conn)
{
    echo $iduser;
    $sql = "UPDATE user SET 
                    username = '{$data['username']}',
                    fullname = '{$data['fullname']}',
                    email = '{$data['email']}',
                    status = '{$data['status']}',
                    modified = NOW()";

    // if ($data['pass'] != null) {
    //     $sql .= ", pass = '{$data['pass']}'";
    // }

    $sql .= " WHERE iduser ='$iduser' ";



    return mysqli_query($conn, $sql);
}


function get_user_by_iduser($iduser, $conn)
{
    //SQL
    $sql = "SELECT * FROM user WHERE iduser='$iduser';";
    //Query SQL
    $query = mysqli_query($conn, $sql);
    //return
    return mysqli_fetch_assoc($query);
}

//Thêm người dùng
function add_user($data, $conn)
{
    $sql_add = "INSERT INTO user (username, pass, fullname, email,role, status, created, modified, quantity_locked) 
                            VALUES ('{$data['username']}', '{$data['pass']}', '{$data['fullname']}', '{$data['email']}', '{$data['role']}','{$data['status']}', '{$data['created']}', NOW(),0)";
    return mysqli_query($conn, $sql_add);
}

//hiển thị danh sách danh mục sản phẩm
function get_category_list($conn)
{
    $sql = "SELECT * FROM category ORDER BY name";
    return mysqli_query($conn, $sql);
}
//danh mục theo id

function get_category_by_id($category_id, $conn)
{
    //SQL
    $sql = "SELECT * FROM category WHERE category_id='$category_id';";
    //Query SQL
    $query = mysqli_query($conn, $sql);
    //return
    return mysqli_fetch_assoc($query);
}

//chỉnh sửa danh mục
function edit_category($data, $category_id, $conn)
{
    $sql = "UPDATE category SET name = '{$data['name']}', status = {$data['status']}, modified = NOW()";
    if ($data['image'] !== null) {
        $sql .= ", image = '{$data['image']}'";
    }

    $sql .= " WHERE category_id = $category_id";
    return mysqli_query($conn, $sql);
}

//xóa danh mục
function delete_category($category_id, $conn)
{
    $sql_pro = "DELETE FROM product WHERE category_id='$category_id';";
    mysqli_query($conn, $sql_pro);
    $sql = "DELETE FROM category WHERE category_id='$category_id';";
    return mysqli_query($conn, $sql);
}

//Thêm danh mục
function add_category($data, $conn)
{
    $sql_add = "INSERT INTO category (name, status, created, modified, image) 
                            VALUES ('{$data['name']}', '{$data['status']}', '{$data['created']}', '{$data['modified']}', '{$data['image']}')";
    return mysqli_query($conn, $sql_add);
}

//sản phẩm

function get_product_list($conn)
{
    $sql = "SELECT pro.*, cate.name as name_cate
                FROM product pro
                INNER JOIN category cate ON pro.category_id = cate.category_id
                ORDER BY cate.name;";
    return mysqli_query($conn, $sql);
}

function get_category_active_list($conn)
{
    //  
    $sql = "SELECT * FROM category WHERE status = 1 ORDER BY name ASC";
    //Return
    return mysqli_query($conn, $sql);
}

function get_category_active_list1($category_id, $conn)
{
    //  
    $sql = "SELECT * FROM category WHERE status = 1 and category_id <> $category_id ORDER BY name ASC";
    //Return
    return mysqli_query($conn, $sql);
}

function get_product_active_list($category_id, $conn)
{
    //  
    $sql = "SELECT * FROM product WHERE status = 1 and category_id ='$category_id' ORDER BY name ASC";
    //Return
    return mysqli_query($conn, $sql);
}

function add_product($data, $conn)
{
    //SQL
    $sql = "INSERT INTO product(category_id, name, detail, image, price, status, created, modified, quantity, id_promotion) 
                            VALUES ({$data['category_id']}, '{$data['name']}', '{$data['detail']}', '{$data['image']}', {$data['price']}, {$data['status']}, '{$data['created']}', '{$data['modified']}', {$data['quantity']}, 0)";
    return mysqli_query($conn, $sql);
}
function add_product_detail($data_detail, $product_id, $conn)
{
    $sql = "INSERT INTO product_detail(advantage, object, instruct, ingredient, preserve, product_id) 
                            VALUES ('{$data_detail['advantage']}', '{$data_detail['object']}', '{$data_detail['instruct']}', '{$data_detail['ingredient']}','{$data_detail['preserve']}', $product_id )";
    return mysqli_query($conn, $sql);
}


function delete_product($product_id, $conn)
{
    $sql_detail = "DELETE FROM product_detail WHERE product_id='$product_id';";
    $result_detail = mysqli_query($conn, $sql_detail);
    $sql_detail1 = "DELETE FROM giohang WHERE product_id=$product_id;";
    $result_detail1 = mysqli_query($conn, $sql_detail1);
    

    $sql = "DELETE FROM product WHERE product_id='$product_id';";
    return mysqli_query($conn, $sql);
}

function get_product_by_id($product_id, $conn)
{
    //SQL
    $sql = "SELECT * FROM product WHERE product_id='$product_id';";
    //Query SQL
    $query = mysqli_query($conn, $sql);
    //return
    return mysqli_fetch_assoc($query);
}

//chỉnh sửa danh mục
function edit_product($data, $product_id, $conn)
{
    $sql = "UPDATE product SET 
                    category_id = {$data['category_id']}, 
                    name ='{$data['name']}', 
                    detail = '{$data['detail']}', 
                    price = {$data['price']}, 
                    quantity='{$data['quantity']}', 
                    status = {$data['status']}, 
                    modified = '{$data['modified']}'";

    if ($data['image'] !== null) {
        $sql .= ", image = '{$data['image']}'";
    }

    $sql .= " WHERE product_id = $product_id";

    return mysqli_query($conn, $sql);
}

function edit_product_detail($data_detail, $product_id, $conn)
{
    $sql = "UPDATE product_detail SET 
                    advantage = '{$data_detail['advantage']}', 
                    object ='{$data_detail['object']}', 
                    instruct = '{$data_detail['instruct']}', 
                    ingredient = '{$data_detail['ingredient']}', 
                    preserve='{$data_detail['preserve']}'
                    where product_id=$product_id";

    return mysqli_query($conn, $sql);
}

//KHUYẾN MÃI
function get_promotion_list($conn)
{
    $sql = "SELECT *
                from promotion prom
               ORDER BY name;";
    return mysqli_query($conn, $sql);
}

function get_promotion_list_all($conn)
{
    $sql = "SELECT prom.*, price, pro.name as name_pro
                from product pro, promotion prom
                where pro.id_promotion=prom.id_promotion and prom.status=1 ORDER BY name;";
    return mysqli_query($conn, $sql);
}

function get_promotion_list_dung($conn)
{
    $sql = "SELECT prom.*, price, pro.name as name_pro
                from product pro, promotion prom
                where pro.id_promotion=prom.id_promotion and prom.status=0 ORDER BY name;";
    return mysqli_query($conn, $sql);
}


function add_promotion($data, $conn)
{
    $sql = "INSERT INTO promotion( name, start_day, end_day, content, discount, status, createded) 
                    VALUES ('{$data['name']}', '{$data['start_day']}', '{$data['end_day']}', {$data['content']}, {$data['discount']}, {$data['status']}, '{$data['createded']}')";
    return mysqli_query($conn, $sql);
}

//KIEM TRA PASS 
function checkPassword($iduser, $password, $conn)
{

    $query = "SELECT * FROM user WHERE iduser = '$iduser' AND pass = '$password'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}
function update_user_profile($data, $iduser, $conn)
{
    // echo $iduser  ;
    $sql = "UPDATE user SET 
                    username = '{$data['username']}',
                    fullname = '{$data['fullname']}',
                    -- pass='{$data['confirm_pass']}'
                    email = '{$data['email']}',
                    -- status = '{$data['status']}',
                    
                    modified = NOW()";

    if ($data['pass_old'] != null && $data['new_pass'] != null && $data['confirm_pass'] != null) {
        $sql .= ", pass = '{$data['confirm_pass']}'";
    }

    $sql .= " WHERE iduser ='$iduser' ";



    return mysqli_query($conn, $sql);
}

//CẬP NHẬT PRODUCT KHUYẾN MÃI
function update_product_promtion($id_promotion, $product_id, $conn)
{
    $sql = "UPDATE product SET id_promotion = $id_promotion WHERE product_id = '$product_id'";
    return mysqli_query($conn, $sql);
}
function get_promotion_list_by_id($id_promotion, $conn)
{
    $sql = "SELECT *
                from promotion 
                where id_promotion='$id_promotion';";
    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}
//LẤY SẢN PHẨM KHUYẾN MÃI
function get_product_list_by_id($id_promotion, $conn)
{
    $sql = "SELECT *
                from product 
                where id_promotion='$id_promotion';";
    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}
//XÓA KHUYẾN MÃI
function delete_promotion($id_promotion, $conn)
{
    $sql_product = "UPDATE product SET id_promotion=0 WHERE id_promotion='$id_promotion';";
    mysqli_query($conn, $sql_product);
    $sql_pro_prom = "DELETE FROM promotion_product WHERE id_promotion='$id_promotion';";
    mysqli_query($conn, $sql_pro_prom);
    $sql = "DELETE FROM promotion WHERE id_promotion='$id_promotion';";
    return mysqli_query($conn, $sql);
}
//CHỈNH SỬA KHUYẾN MÃI
// function edit_promotion($data, $id_promotion, $conn)
// {
//     $sql = "UPDATE promotion SET 
//                 name = '{$data['name']}', 
//                 start_day ='{$data['start_day']}', 
//                 end_day = '{$data['end_day']}', 
//                 content = '{$data['content']}', 
//                 discount='{$data['discount']}', 
//                 status = {$data['status']}
//                 WHERE id_promotion='$id_promotion'";
//     return mysqli_query($conn, $sql);
// }
// //CAP NHAT SAN PHAM KHUYEN MAI
// function edit_promotion_product($product_id, $id_promotion,$conn)
// {
//     $sql = "UPDATE product SET id_promotion = '$id_promotion' WHERE product_id = '$product_id'";
//     return mysqli_query($conn, $sql);
// }



//banner
function edit_banner($id, $image, $conn)
{
    $sql_banner = "UPDATE banner set image='$image' where id_banner=$id";
    $result = mysqli_query($conn, $sql_banner);
}
