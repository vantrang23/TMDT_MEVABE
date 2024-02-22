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

	<title>Danh muc yeu thich</title>

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




	<!-- Icons/Glyphs -->
	<link rel="stylesheet" href="assets\css\font-awesome.css">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

</head>

<body class="cnt-home">
	<!-- ============================================== HEADER ============================================== -->
	<?php

	session_start();
	require_once '../libraries/connect.php';
	// Kiểm tra nếu giỏ hàng chưa tồn tại, khởi tạo nó
	if (!isset($_SESSION['wishlist'])) {
		$_SESSION['wishlist'] = array();
	}
	// Xử lý khi có sự kiện xoá sản phẩm khỏi giỏ hàng
	if (isset($_GET['remove_product'])) {
		$product_id = $_GET['remove_product'];
		unset($_SESSION['wishlist'][$product_id]);
	}
	?>

	<header class="header-style-1">
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
					<li><a href="home.html">Home</a></li>
					<li class='active'>Wishlist</li>
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
							<table class="table">
								<thead>
									<tr>

										<th class="cart-description item">Ảnh</th>
										<th class="cart-product-name item">Tên sản phẩm</th>
										<th class="cart-sub-total item">Giá</th>
										<th class="cart-qty item">Số lượng</th>
										<th class="cart-edit item">Thêm vào giỏ hàng</th>
										<th class="cart-romove item">Xóa</th>
									</tr>
								</thead><!-- /thead -->

								<tbody>
									<?php foreach ($_SESSION['wishlist'] as $product_id => $product) : ?>
										<tr>

											<td class="cart-image">
												<a class="entry-thumbnail" href="shop-detail.tpl.php">
													<img src="../admin/upload/<?php echo $product['image']; ?>" alt="Product Image" width="80px" height="50%">
												</a>
											</td>
											<td class="cart-product-name-info">
												<h4 class='cart-product-description'><a href="shop-detail.tpl.php"><?php echo $product['name']; ?></a></h4>
											</td>

											<td class="cart-product-sub-total"><span class="cart-sub-total-price"> <!-- Hiển thị giá sản phẩm -->

													<?php
													if (isset($product['price'])) {
														echo number_format($product['price'], 0, '', '.') . ' VNĐ';
													} else {
														echo 'Giá không khả dụng';
													}
													?></span></td>
											<td class="shoping__cart__quantity">
												<div class="quantity">
													<?php echo $product['quantity']; ?>
											</td>
											<td class="shoping__cart__add-to-cart">
												<a href="add-to-cart.php?product_id=<?php echo $product_id; ?>" class="primary-btn_them"><span class="icon_cart"></span> Thêm</a>

												<!-- <a href="#" class="primary-btn_them"><span class="icon_cart"></span> THÊM</a> -->

											</td>
											<!-- <td class="romove-item"><a href="#" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td> -->
											<td class="romove-item"> <a href="?remove_product=<?php echo $product_id; ?>" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7">
											<div class="shopping-cart-btn">
												<span class="">
													<a href="index.php" class="primary-btn cart-btn cart-btn-continue">
														Tiếp tục mua sắm
													</a>
													<a href="update-wishlist.php?remove_product=<?php echo $product_id; ?>" class="primary-btn cart-btn cart-btn-delete-all" style="margin-left: 30px;">
														Xóa tất cả
													</a>
													<!-- <a href="#" class="btn btn-upper btn-primary outer-left-xs">Tiếp tục mua sắm</a> -->
													<!-- <a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a> -->
												</span>
											</div><!-- /.shopping-cart-btn -->
										</td>
									</tr>
								</tfoot><!-- /tbody -->
							</table><!-- /table -->
						</div>
					</div><!-- /.shopping-cart-table -->
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
					<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
				</div><!-- /.container -->
			</div><!-- /.body-content -->
			<!-- ============================================================= FOOTER ============================================================= -->
			<?php
			require 'footer.php';
			?>

			<style>
				.cart-btn-continue {
					background-color: #CC3069 !important;
					/* Màu xanh lá cây */
					color: white !important;
					/* Màu trắng cho chữ */
					border-radius: 8px;
					padding: 10px 20px;
					/* Điều chỉnh kích thước nút */
					display: inline-block;
					/* Cho phép chỉnh kích thước và padding */
					transition: background-color 0.3s, color 0.3s;
					/* Hiệu ứng chuyển đổi màu nền và màu chữ trong 0.3s */
				}

				.shopping-cart {
					width: 100%;
					margin: auto;
				}

				.cart-btn-continue:hover {
					color: #ccc !important;
					/* Màu chữ khi hover */
					text-decoration: none;
				}

				.btn-primary {
					color: white;
					background-color: #CC3069;
					padding: 5px 10px;
					/* Điều chỉnh kích thước nút */
					border-color: #CC3069;
				}

				.btn-primary.focus,
				.btn-primary:focus {
					color: white;
					background-color: #CC3069 !important;

					padding: 5px 10px;
					/* Điều chỉnh kích thước nút */
					/* box-shadow: 0 0 0 0.2rem rgba(38,143,255,.5); */
				}

				.btn-primary:hover {
					color: #fff;
					padding: 5px 10px;
					/* Điều chỉnh kích thước nút */
					background-color: #CC3069 !important;

				}

				.primary-btn_them {
					text-decoration: none;
					/* width: 60px;
            height:30px; */
					background-color: #CC3069 !important;
					/* color: */
					border: 1px solid black;
					/* Set border to 2px solid black */
					border-radius: 5px;
					/* Add rounded corners */
					padding: 7px 15px;
				}

				.primary-btn_them:hover {
					text-decoration: none;
					padding: 7px 15px;
					/* width: 60px;
            height:30px; */
					background-color: #CC3069 !important;
					color: white;
					border: 1px solid black;
					/* Set border to 2px solid black */
				}

				.shoping__cart__add-to-cart a {
					color: white !important;
				}

				.romove-item a.icon:hover i.fa-trash-o:hover {
					color: #0080FF;
				}

				.cart-btn-delete-all {
					background-color: #CC3069 !important;
					/* Màu xanh lá cây */
					color: white !important;
					/* Màu trắng cho chữ */
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

				.cart-btn-delete-all.focus,
				.cart-btn-delete-all:focus {
					color: #fff;
					background-color: #CC3069 !important;
				}
			</style>

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

			<!-- For demo purposes – can be removed on production -->

			<script src="switchstylesheet/switchstylesheet.js"></script>

			<script>
				$(document).ready(function() {
					$(".changecolor").switchstylesheet({
						seperator: "color"
					});
					$('.show-theme-options').click(function() {
						$(this).parent().toggleClass('open');
						return false;
					});
				});

				$(window).bind("load", function() {
					$('.show-theme-options').delay(2000).trigger('click');
				});
			</script>
			<!-- For demo purposes – can be removed on production : End -->

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

				//     const decButton = document.querySelector('.dec');
				//     // console.log(decButton);       
				// const incButton = document.querySelector('.inc');
				// // console.log(incButton);
				// const quantityInput = document.querySelector('.pro-qty .quantity');
				// // console.log(quantityInput);

				// decButton.addEventListener('click', () => {
				//   let quantity = parseInt(quantityInput.value);
				//   console.log(quantity)
				//   if (quantity > 1) {
				//     quantity--;
				//     quantityInput.value = quantity;
				//   }
				// });

				// incButton.addEventListener('click', () => {
				//   let quantity = parseInt(quantityInput.value);
				//   quantity++;
				//   quantityInput.value = quantity;
				// });
			</script>


</body>

</html>