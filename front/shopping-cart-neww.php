<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="MediaCenter, Template, eCommerce">
        <meta name="robots" content="all">

        <title>Giỏ hàng</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="assets\css\bootstrap.min.css">
        
        <!-- Customizable CSS -->
        <link rel="stylesheet" href="assets\css\main.css">
        <link rel="stylesheet" href="assets\css\blue.css">
        <link rel="stylesheet" href="assets\css\owl.carousel.css">
        <link rel="stylesheet" href="assets\css\owl.transitions.css">
        <link rel="stylesheet" href="assets\css\animate.min.css">
        <link rel="stylesheet" href="assets\css\rateit.css">
        <link rel="stylesheet" href="assets\css\bootstrap-select.min.css">

        
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->

    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">

    <link rel="stylesheet" href="css/style.css" type="text/css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="assets\css\font-awesome.css">
<!-- Fonts --> 
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body class="cnt-home">
        <!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php

session_start();
require_once '../libraries/connect.php';
// Kiểm tra nếu giỏ hàng chưa tồn tại, khởi tạo nó
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
function getProductDetails($product_id, $conn)
{
    $sql = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return false;
}
// Xử lý khi có sự kiện xoá sản phẩm khỏi giỏ hàng
if (isset($_GET['remove_product'])) {
    $product_id = $_GET['remove_product'];
    unset($_SESSION['cart'][$product_id]);
}


?>
<?php
    require 'header.php';
?>
<?php
    require 'search.php';
?>

</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Shopping Cart</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
    <div class="table-responsive">
			
	<form action="" method="post">
		<table class="table">
			<thead>
				<tr>                  
					<th class="cart-description item">Ảnh</th>
					<th class="cart-product-name item">Tên sản phẩm</th>							
					<th class="cart-qty item">Số lượng</th>
					<th class="cart-edit item">Yêu thích</th>
					<th class="cart-sub-total item">Giá</th>
					<th class="cart-total last-item">Tổng cộng</th>
					<th class="cart-romove item">Xóa</th>
					<th>
						<input type="checkbox" id="select-all" onclick="selectAllItems()">
						<label for="select-all">Mua tất cả</label>
						<span id="selected-count">(0)</span>
					</th>
				</tr>
			</thead><!-- /thead -->
					
						<tbody>
								<?php
                                
                                $totalPrice = 0;

                                foreach ($_SESSION['cart'] as $product_id => $product) :
                                    $productDetails = getProductDetails($product_id, $conn);

                                    if ($productDetails) :
                                        $price = $productDetails['price'];
                                        // $quantity=$_POST['quantity'];
                                        // print_r($quantity);
                                        // exit;
                                        $totalPrice += $price * $product['quantity'];
                                ?>
							<tr>
								
								<td class="cart-image">
									<a class="entry-thumbnail" href="shop-detail.tpl.php">
										<!-- <img src="assets\images\products\p1.jpg" alt=""> -->
										<img src="../admin/upload/<?php echo $productDetails['image']; ?>" alt="Product Image" width="80px" height="50%">
									</a>
								</td>
								<td class="cart-product-name-info">
									<h4 class='cart-product-description'><a href="shop-detail.tpl.php"><?php echo $productDetails['name']; ?></a></h4>
								
								</td>    
								<td class="shoping__cart__quantity">
									<div class="quantity">
										<div class="pro-qty">
											<span class="dec qtybtn">-</span>
											<input type="number" class="quantity" name="quantity[<?php echo $product_id; ?>]" value="<?php echo $product['quantity']; ?>">
											
											<span class="inc qtybtn">+</span>
										</div>
									</div>
								</td>
										
								<!-- <td class="shoping__cart__quantity">
									<div class="quantity">
										<div class="pro-qty"><span class="dec qtybtn">-</span>                                                      
											<input type="text" class="quantity" name="quantity" value="1">
												<span class="inc qtybtn">+</span></div>
										</div>
								</td>  -->
						
								<td class="cart-product-edit"><a href="add-to-wishlist.php?product_id=<?php echo $product_id;?>" class="product-edit"><i class="fa fa-heart"></i></a></td>
								
								<td class="cart-product-sub-total"><span class="cart-sub-total-price"> <?php echo number_format($price, 0, '', '.'); ?> VNĐ</span></td>
								
								<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo number_format($price * $product['quantity'], 0, '', '.'); ?> VNĐ</span></td>
								<td class="romove-item"> <a href="?remove_product=<?php echo $product_id; ?>" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>

								<td>
									<input type="checkbox" name="buy_product[]" value="<?php echo $product_id; ?>" class="product-checkbox">
								</td>
							</tr>		
							<?php
                                    endif;  
                                endforeach;
                                ?>          
						</tbody>			
					</table>
				</form>
						
		<tfoot>
                <tr>
                    <td colspan="7">
                        <div class="shopping-cart-btn">
                        <span class="">
                            <a href="index.php" class="primary-btn cart-btn cart-btn-continue">
                                Tiếp tục mua sắm
                            </a>
                            <a href="update-cart.php?remove_product=<?php echo $product_id; ?>" class="primary-btn cart-btn cart-btn-delete-all" style="margin-left: 30px;">
                                Xóa tất cả
                            </a>
                        </span>
                        </div><!-- /.shopping-cart-btn -->
                    </td>
                </tr>
            </tfoot>
	       
    	</div>
	
</div><!-- /.shopping-cart-table -->                
<div class="col-md-5 col-sm-12 estimate-ship-tax">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <span class="estimate-title">Nhập nơi giao hàng để xem phí vận chuyển</span>
                    <!-- <p>Enter your destination to get shipping and tax.</p> -->
                </th>
            </tr>
        </thead><!-- /thead -->
        <tbody>
                <tr>
                    <td>
                    
                        <div class="form-group">
                            <label class="info-title control-label">Tỉnh/ Thành phố<span>*</span></label>
                            <div>
                                <select id="city" >
                                <option value="" selected>Chọn tỉnh thành</option>           
                                </select>                                       
                                <select id="district">
                                <option value="" selected>Chọn quận huyện</option>
                                </select>

                                <select id="ward">
                                <option value="" selected>Chọn phường xã</option>
                                </select>
                            </div>                          
                        </div> <h2 class="form-control unicase-form-control text-input" id="result"></h2> 
                                                                
                        <div class="form-group">
                            <label class="info-title control-label">Phương thức vận chuyển </label>
                              <select class="form-control unicase-form-control">                                
                                    <option  value="" selected>Nhanh</option>
                                    <option value="" selected>Tiết kiệm</option>
                                    
                                </select>                    
                        </div>
                        <div class="form-group">
                            <label class="info-title control-label">Phí vận chuyển </label>
                            <input type="text" class="form-control unicase-form-control text-input" placeholder="">
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn-upper btn btn-primary">TRA CỨU</button>
                        </div>
                    </td>
                </tr>
        </tbody>
    </table>
</div><!-- /.estimate-ship-tax -->

<div class="col-md-3 col-sm-12 estimate-ship-tax">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <span class="estimate-title">KHUYẾN MÃI</span>
                    <p>Nhập mã giảm giá của bạn vào đây</p>
                </th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control unicase-form-control text-input" placeholder="Nhập mã khuyến mãi">
                        </div>
                        <div class="clearfix pull-right">
                            <button type="submit" class="btn-upper btn btn-primary">ÁP DỤNG</button>
                        </div>
                    </td>
                </tr>
        </tbody><!-- /tbody -->
    </table><!-- /table -->
</div><!-- /.estimate-ship-tax -->

<div class="col-md-4 col-sm-12 cart-shopping-total">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <div class="cart-sub-total">
                        TẠM TÍNH: <span class="inner-left-md">500.000</span>
                    </div>
                    <div class="cart-grand-total">
                        TỔNG TIỀN: <span class="inner-left-md">500.000</span>
                    </div>
                </th>
            </tr>
        </thead><!-- /thead -->
        <tbody>
                <tr>
                    <td>
                        <div class="cart-checkout-btn pull-right">
                            <button type="submit" class="btn btn-primary checkout-btn">ĐẶT HÀNG</button>
                        
                        </div>
                    </td>
                </tr>
        </tbody><!-- /tbody -->
    </table><!-- /table -->
</div><!-- /.cart-shopping-total -->            </div><!-- /.shopping-cart -->
        </div> <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

        <div class="logo-slider-inner"> 
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                <div class="item m-t-15">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->

                <div class="item m-t-10">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand3.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand6.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand2.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand4.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand1.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->

                <div class="item">
                    <a href="#" class="image">
                        <img data-echo="assets/images/brands/brand5.png" src="assets\images\blank.gif" alt="">
                    </a>    
                </div><!--/.item-->
            </div><!-- /.owl-carousel #logo-slider -->
        </div><!-- /.logo-slider-inner -->
    
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->    </div><!-- /.container -->
</div><!-- /.body-content -->

<!-- ============================================================= FOOTER ============================================================= -->
 <?php
        require 'footer.php';
    ?>
<!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->
    
    
    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="assets\js\jquery-1.11.1.min.js"></script>
    
    <script src="assets\js\bootstrap.min.js"></script>
    
    <script src="assets\js\bootstrap-hover-dropdown.min.js"></script>
    <script src="assets\js\owl.carousel.min.js"></script>
    
    <script src="assets\js\echo.min.js"></script>
    <script src="assets\js\jquery.easing-1.3.min.js"></script>
    <script src="assets\js\bootstrap-slider.min.js"></script>
    <script src="assets\js\jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets\js\lightbox.min.js"></script>
    <script src="assets\js\bootstrap-select.min.js"></script>
    <script src="assets\js\wow.min.js"></script>
    <script src="assets\js\scripts.js"></script>
<script>
     // Hàm định dạng số có dấu phẩy ngăn cách hàng nghìn
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
</script>

<script>
	document.querySelectorAll('.pro-qty').forEach(item => {
    const decButton = item.querySelector('.dec');
    const incButton = item.querySelector('.inc');
    const quantityInput = item.querySelector('.quantity');

    decButton.addEventListener('click', () => {
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantity--;
            quantityInput.value = quantity;
            
        }
    });

    incButton.addEventListener('click', () => {
        let quantity = parseInt(quantityInput.value);
        quantity++;
        quantityInput.value = quantity;
    });
});
    </script>   

    <style>
.btn-primary {
    color: #fff;
    background-color: #CC3069;
    border-color:#CC3069;
}
.cart-product-edit i.fa-heart {
  font-size: 20px;
}
.cart-product-edit i.fa-heart:hover {
  color:red;
}

.romove-item a.icon:hover i.fa-trash-o:hover{
  color: #0080FF;
}
.cart-btn-continue {
    background-color: #CC3069 !important; /* Màu xanh lá cây */
    color: white !important; /* Màu trắng cho chữ */
    border-radius: 8px;
    padding: 10px 20px; /* Điều chỉnh kích thước nút */
    display: inline-block; /* Cho phép chỉnh kích thước và padding */
    transition: background-color 0.3s, color 0.3s; /* Hiệu ứng chuyển đổi màu nền và màu chữ trong 0.3s */
}

.cart-btn-continue:hover {
    color:#ccc !important; /* Màu chữ khi hover */
    text-decoration: none;
}
.btn-primary:hover {
    color: #fff;
    background-color: #CC3069;
    
}
.btn-primary.focus, .btn-primary:focus {
    color: #fff;
    background-color:#CC3069 !important;
  
    /* box-shadow: 0 0 0 0.2rem rgba(38,143,255,.5); */
}
.cart-btn-delete-all {
    background-color: #CC3069 !important; /* Màu xanh lá cây */
    color: white !important; /* Màu trắng cho chữ */
    border-radius: 8px;
    padding: 10px 30px;
    display: inline-block;
    transition: background-color 0.3s, color 0.3s;
}

.cart-btn-delete-all:hover {
    color: #ccc !important;
    text-decoration: none;
    background-color: #CC3069;
}

.cart-btn-delete-all.focus, .cart-btn-delete-all:focus {
    color: #fff;
    background-color: #CC3069 !important;
}

</style>    
<style>
.shopping-cart {
	width:100%;
	margin:auto;
}
</style>	

<style>
    input[type="checkbox"] {
        width: 20px; /* Adjust the width as needed */
        height: 20px; /* Adjust the height as needed */
    }
</style>

<!-- phi van chuyen -->
</style>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
    const host = "https://provinces.open-api.vn/api/";
var callAPI = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data, "city");
        });
}
callAPI('https://provinces.open-api.vn/api/?depth=1');
var callApiDistrict = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.districts, "district");
        });
}
var callApiWard = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.wards, "ward");
        });
}

var renderData = (array, select) => {
    let row = ' <option disable value="">Chọn</option>';
    array.forEach(element => {
        row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
    });
    document.querySelector("#" + select).innerHTML = row
}

$("#city").change(() => {
    callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
    printResult();
});
$("#district").change(() => {
    callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
    printResult();
});
$("#ward").change(() => {
    printResult();
})

var printResult = () => {
    if ($("#district").find(':selected').data('id') != "" && $("#city").find(':selected').data('id') != "" &&
        $("#ward").find(':selected').data('id') != "") {
        let result = $("#city option:selected").text() +
            " | " + $("#district option:selected").text() + " | " +
            $("#ward option:selected").text();
        $("#result").text(result)
    }

}
	</script>    

</body>
</html>



