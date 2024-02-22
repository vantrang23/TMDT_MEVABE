<?php
session_start();
require_once '../libraries/connect.php';
if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];
    $_SESSION['iduser'] = $iduser;
}
if (isset($_SESSION['iduser'])) {
    $iduser = $_SESSION['iduser'];
    $_SESSION['iduser'] = $iduser;
}
?>

<?php
// function truncateString($string, $maxLength)
// {
//     if (strlen($string) > $maxLength) {
//         $string = mb_substr($string, 0, $maxLength - 3) . '...';
//     }
//     return $string;
// }
?>
<?php
if (isset($_GET['product_id']) && isset($_GET['thanhtien']) && isset($_GET['soluong'])) {
    // Lấy dữ liệu từ URL
    $product_id = $_GET['product_id'];
    $thanhtien = $_GET['thanhtien'];
    $soluong = $_GET['soluong'];

    $_SESSION['product_id'] = $product_id;
    $_SESSION['thanhtien'] = $thanhtien;
    $_SESSION['soluong'] = $soluong;
}
?>

<!---------------------------TINH PHI VAN CHUYEN --------------------------------------------------->
<?php
if (isset($_POST['oke'])) {
    // header("Location: checkout.php?$selectedProductsQuery&$selectedtongtienQuery");

    $ghnApiUrl = "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services";

    // Define GHN token
    $ghnToken = "576288c8-95a2-11ee-a59f-a260851ba65c";

    // Additional parameters for the API request
    $shopId = 4752601; // Replace with your actual shop ID
    $fromDistrictId = 1562; // Replace with the actual ID of the sender's district
    $toDistrictId = intval($_POST['district']);
    $toWardId = $_POST['ward'];

    // Create data for the API request
    $data = [
        'shop_id' => $shopId,
        'from_district' => $fromDistrictId,
        'to_district' => $toDistrictId
    ];

    // Initialize cURL session
    $ch = curl_init($ghnApiUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Token: ' . $ghnToken
    ]);

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Decode the JSON response
    $availableServices = json_decode($response, true);

    // Check if the request was successful
    if (isset($availableServices['code']) && $availableServices['code'] === 200) {
        // The request was successful, and $availableServices['data'] contains the available shipping methods
        $shippingMethods = $availableServices['data'];
        // $selectedServiceId = $_POST['service_id'];

        // Find the selected service in the available shipping methods
        $selectedService = null;
        foreach ($shippingMethods as $service) {
            if ($service['service_id']) {
                $selectedService = $service;
                break;
            }
        }

        // Check if the selected service was found
        if ($selectedService) {
            // Calculate the shipping fee using the selected service's service_id

            // Additional parameters for the fee calculation
            $insuranceValue = 100000; // Giá trị bảo hiểm hàng hóa
            $coupon = ""; // Mã giảm giá (nếu có)
            $toWardCode = $toWardId; // Mã Phường/Xã người nhận
            $weight = 1000; // Trọng lượng hàng hóa (gram)
            $length = 20; // Chiều dài (cm)
            $width = 10; // Chiều rộng (cm)
            $height = 15; // Chiều cao (cm)

            // Create data for the API request
            $feeData = [
                'service_id' => $service['service_id'],
                'insurance_value' => $insuranceValue,
                'coupon' => $coupon,
                'to_ward_code' => $toWardCode,
                'to_district_id' => $toDistrictId,
                'from_district_id' => $fromDistrictId,
                'weight' => $weight,
                'length' => $length,
                'width' => $width,
                'height' => $height
            ];
            // Initialize cURL session for fee calculation
            $feeCh = curl_init("https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee");
            // Set cURL options for fee calculation
            curl_setopt($feeCh, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($feeCh, CURLOPT_POST, true);
            curl_setopt($feeCh, CURLOPT_POSTFIELDS, json_encode($feeData));
            curl_setopt($feeCh, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Token: ' . $ghnToken
            ]);
            // Execute cURL session for fee calculation and get the response
            $feeResponse = curl_exec($feeCh);

            // Check for cURL errors
            if (curl_errno($feeCh)) {
                echo 'Curl error: ' . curl_error($feeCh);
            }
            // Close cURL session for fee calculation
            curl_close($feeCh);

            // Decode the JSON response for fee calculation
            $feeResult = json_decode($feeResponse, true);

            // Check if the fee calculation was successful
            if (isset($feeResult['code']) && $feeResult['code'] === 200) {
                // The fee calculation was successful
                $shippingFee = $feeResult['data']['total'];
                // echo 'Phí vận chuyển: ' . $shippingFee . ' VND';
            } else {
                // The fee calculation failed, and you can handle the error here
                echo 'Error: ' . $feeResult['message'];
            }
        } else {
            // The selected service was not found in the available shipping methods
            echo 'Invalid service ID';
        }
    } else {
        // The request failed, and you can handle the error here
        echo 'Error: ' . $availableServices['message'];
    }
}
?>
<!----------------------- DON DAT HANG ------------------------->
<?php
if (isset($_POST['user_order'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $note_user = $_POST['note_user'];
    $payment_method = $_POST['payment_method'];
    $phi = $_POST['phivanchuyen'];
    $tongtien = $_POST['tongtien'];
    $iduser = $_POST['iduser'];
    $sl = $_POST['sl'];
    $thanhtien = $_POST['tt'];

    // Create sessions for the variables
    $_SESSION['name'] = $name;
    $_SESSION['address'] = $address;
    $_SESSION['phone'] = $phone;
    $_SESSION['note_user'] = $note_user;
    $_SESSION['payment_method'] = $payment_method;
    $_SESSION['phi'] = $phi;
    $_SESSION['tongtien'] = $tongtien;
    $_SESSION['iduser'] = $iduser;
    $_SESSION['sl'] = $sl;
    $_SESSION['tt'] = $thanhtien;


    // print_r($selectedsl[58]['soluong']);
    //NHỚ CHỈNH LẠI NGÀY GIAO
    $them_order = "INSERT into `order` (created, iduser, name, sdt, address, note_user, note_admin, phi, tongtien, status, payment_method, image) VALUES (now(), $iduser, '$name', '$phone', '$address', '$note_user', '', $phi, $tongtien, 'Chờ xử lý', '$payment_method',  '')";
    $result_them_order = mysqli_query($conn, $them_order);

    if ($result_them_order) {
        // Lấy id_order vừa mới thêm
        $last_inserted_id = mysqli_insert_id($conn);
        $product_id = $_SESSION['product_id'];
        $sql_themctgh = "INSERT INTO order_detail (id_order, product_id, soluong, thanhtien) VALUES ";
        // Kiểm tra giá trị trước khi thêm vào chuỗi SQL
        $sl = mysqli_real_escape_string($conn, $sl);
        $thanhtien = mysqli_real_escape_string($conn, $thanhtien);

        $sql_themctgh .= "($last_inserted_id, $product_id, $sl, $thanhtien),";
        $sql_xoagh = "DELETE from giohang where iduser=$iduser and product_id=$product_id";
        $xoa_gh = mysqli_query($conn, $sql_xoagh);

        $sql_upsl = "UPDATE product set quantity=quantity- $sl where product_id=$product_id";
        $re_upsl = mysqli_query($conn, $sql_upsl);
    }

    // Loại bỏ dấu phẩy cuối cùng
    $sql_themctgh = rtrim($sql_themctgh, ',');

    // Thực hiện truy vấn chèn chi tiết đơn hàng
    $re_themchgh = mysqli_query($conn, $sql_themctgh);

    if ($re_themchgh) {
        $_SESSION['dathang'] = true;
        // header("location: thongtinthanhtoan.php?iduser=$iduser");
        header("location: thongtinthanhtoan.php?iduser=$iduser&id_order=$last_inserted_id&detail=true");
    } else {
        echo "Lỗi khi thêm chi tiết đơn hàng: " . mysqli_error($conn);
    }
} else {
    // echo "Lỗi khi thêm order: " . mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>thanh toan</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <?php
    require 'header.php';
    ?>
    <section class="checkout spad">
        <div class="container">

            <div class="checkout__form">
                <h2>Chi tiết thanh toán</h2><br>
                <?php if (isset($error)) { ?> <div class="error">
                        <p style="color:red">
                            <?php echo $error; ?>
                    </div> <?php } ?>
                <?php if (isset($success)) { ?> <div class="success">
                        <?php echo $success; ?>
                    </div> <?php }
                            ?>
                <form action="checkout_detail.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__form-wrapper">
                                <input type="hidden" name="iduser" value="<?php echo $iduser; ?>">
                                <div class="checkout__input">
                                    <span>Tên người dùng:</span>
                                    <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
                                </div>
                                <div class="checkout__input">
                                    <span>Email :</span>
                                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                                </div>
                                <div class="checkout__input">
                                    <p>Chọn khu vực giao hàng<span>*</span></p>
                                    <div>
                                        <select id="city">
                                            <option value="" selected>Chọn tỉnh thành</option>
                                        </select>
                                        <select id="district" name="district">
                                            <option value="" selected>Chọn quận huyện</option>
                                        </select>

                                        <select id="ward" name='ward'>
                                            <option value="" selected>Chọn phường xã</option>
                                        </select>
                                    </div>
                                    <br>
                                    <button name="oke" class="site-btn">Áp dụng</button>
                                    <!-- <h2 readonly  type="hidden" class="form-control unicase-form-control text-input"  id="selectedInfo"></h2> -->
                                    <!-- <h2 class="form-control unicase-form-control text-input" id="result"></h2> -->

                                </div>
                                <div class="checkout__input">
                                    <p>Phí vận chuyển</p>

                                    <input type="hidden" name="phivanchuyen" value="<?php echo isset($shippingFee) ? $shippingFee : '0'; ?> " class="form-control unicase-form-control text-input" id="shippingFee" readonly>
                                    <input name="" value="<?php echo isset($shippingFee) ? number_format($shippingFee, 0, '', '.') : '0'; ?> VNĐ " class="form-control unicase-form-control text-input" id="shippingFee" readonly>

                                    <!-- <button name="xacnhan_ghn" type="submit">Áp dụng</button>
                                    <button name="trove_thanhtoan" type="button" id="cancel-button">Hủy</button> -->

                                </div>
                                <div class="checkout__input">
                                    <p>Tên người nhận<span>*</span></p>
                                    <input type="text" name="name" value="">
                                </div>

                                <div class="checkout__input">
                                    <p>Địa chỉ giao hàng<span>*</span></p>

                                    <input type="text" name="address">

                                </div>

                                <div class="checkout__input">
                                    <p>Số điện thoại <span>*</span></p>
                                    <input type="number" name="phone">
                                </div>

                                <div class="checkout__input">
                                    <div class="checkout__input__select">
                                        <div class="inputBox">
                                            <span>Phương thức thanh toán: </span>
                                            <select name="payment_method" id="paymentMethod" class="box">
                                                <option>Tiền mặt</option>
                                                <option>MoMo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="checkout__input">
                                    <p>Ghi chú (Nếu có)</p>
                                    <input type="text" name="note_user" placeholder="Ghi chú về đơn hàng của bạn ví dụ như ghi chú đặc biệt khi giao hàng">
                                </div>

                                <div class="checkout__input__checkbox">
                                    <label for="acc">
                                        Bạn chưa có tài khoản?
                                        <a href="">Đăng ký</a>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <!-- thong tin hoa don -->
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order" style="width:400px;">
                                <h2>Đơn hàng của bạn</h2>

                                <div class="checkout__order__products">Sản phẩm <span>Tổng cộng</span></div>
                                <ul>
                                    <?php
                                    $product_id = $_SESSION['product_id'];
                                    $thanhtien = $_SESSION['thanhtien'];
                                    $soluong = $_SESSION['soluong'];
                                    $soluong = intval($soluong);
                                    $thanhtien = intval($thanhtien);

                                    $tongcong = $soluong * $thanhtien;
                                    $sql_gh = "SELECT * from giohang gh, product pro where gh.product_id=pro.product_id and gh.product_id=$product_id";
                                    $re_gh = mysqli_query($conn, $sql_gh);
                                    $row_gh = mysqli_fetch_assoc($re_gh);
                                    ?>
                                    <input type="hidden" name="tt" id="" value="<?php echo $tongcong ?>">
                                    <input type="hidden" name="sl" id="" value="<?php echo $soluong ?>">
                                    <li><?php echo $row_gh['name'] ?> <span><?php echo number_format($tongcong, 0, '', '.') ?></span></li>
                                    <?php
                                    ?>

                                </ul>
                                <div class="checkout__order__subtotal">Tổng tiền hàng <span><?php echo number_format($tongcong, 0, '', '.'); ?></span></div>
                                <div class="checkout__order__total">Phương thức vận chuyển<span>Nhanh</span></div>
                                <div class="checkout__order__total">Phương thức thanh toán <span> Tiền mặt</span></div>
                                <div class="checkout__order__total">Phí vận chuyển <span><?php echo isset($shippingFee) ? number_format($shippingFee, 0, '', '.') : '0'; ?> VNĐ</span></div>
                                <!-- <div class="checkout__order__subtotal">Giảm giá<span>100000</span></div> -->
                                <!-- <div class="checkout__order__total">Giảm giá<span>100000</span></div> -->

                                <div class="checkout__order__total" name="tongtien"> Tổng thanh toán
                                    <?php if (isset($_POST['oke'])) {
                                        $soluong = intval($soluong);
                                        $thanhtien = intval($thanhtien);

                                        $tong = $soluong * $thanhtien;


                                        echo '<span>' . number_format($tong + $shippingFee, 0, '', '.') . ' VNĐ</span>';
                                    } ?></div>
                                <button name="user_order" type="submit" class="site-btn">Đặt hàng</button>
                                <input type="hidden" name="tongtien" id="" value="<?php echo $tong + $shippingFee ?>">
                                <input type="hidden" name="iduser" id="" value="<?php echo $iduser ?>">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <style>
        .site-btn {
            background-color: #CC3069;
            color: black;
            border: 2px solid #CC3069;
            border-radius: 20px;
            /* Thêm border-radius với giá trị là 20px */
            padding: 10px 20px;
            /* Thêm padding để nút trông đẹp hơn */
        }

        .site-btn:hover {
            background-color: #CC3069;
            color: white;
        }
    </style>
    <style>
        .update-profile {
            text-align: center;
            margin: 20px auto;
            width: 1000px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .inputBox {
            text-align: left;
            flex-basis: 48%;
        }

        .inputBox span {
            display: block;
            margin-bottom: 5px;
        }

        .box {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .flex-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn,
        .option-btn {
            flex-basis: 50%;
        }

        .btn {
            padding: 10px 20px;
            background-color: #CC3069;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .option-btn {
            text-decoration: none;
            color: #CC3069;

        }

        .option-btn:hover {
            text-decoration: none;
            color: #ff99cc;
        }
    </style>
    <style>
        .checkout__form-wrapper {
            background-color: #ffcccb;
            /* Pink background color */
            border: 2px solid #cc3069;
            /* Border color */
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Drop shadow */
            padding: 20px;
            /* Add padding as needed */
        }
    </style>
    <?php
    require 'footer.php';
    ?>
    <!-- Footer Section End -->
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- <script src="js/jquery.slicknav.js"></script> -->
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        // const host = "https://provinces.open-api.vn/api/";
        // var callAPI = (api) => {
        //     return axios.get(api)
        //         .then((response) => {
        //             renderData(response.data, "city");
        //         });
        // }
        // callAPI('https://provinces.open-api.vn/api/?depth=1');
        // var callApiDistrict = (api) => {
        //     return axios.get(api)
        //         .then((response) => {
        //             renderData(response.data.districts, "district");
        //         });
        // }
        // var callApiWard = (api) => {
        //     return axios.get(api)
        //         .then((response) => {
        //             renderData(response.data.wards, "ward");
        //         });
        // }

        // var renderData = (array, select) => {
        //     let row = ' <option disable value="">Chọn</option>';
        //     array.forEach(element => {
        //         row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
        //     });
        //     document.querySelector("#" + select).innerHTML = row
        // }

        // $("#city").change(() => {
        //     callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
        //     printResult();
        // });
        // $("#district").change(() => {
        //     callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
        //     printResult();
        // });
        // $("#ward").change(() => {
        //     printResult();
        // })

        // var printResult = () => {
        //     if ($("#district").find(':selected').data('id') != "" && $("#city").find(':selected').data('id') != "" &&
        //         $("#ward").find(':selected').data('id') != "") {
        //         let result = $("#city option:selected").text() +
        //             " | " + $("#district option:selected").text() + " | " +
        //             $("#ward option:selected").text();
        //         $("#result").text(result)
        //     }

        // }
    </script>
    <!-- lay tinh-->
    <script>
        // Định nghĩa hằng số
        const ghnApiUrl = "https://online-gateway.ghn.vn/shiip/public-api/master-data/province";
        const ghnToken = "576288c8-95a2-11ee-a59f-a260851ba65c";

        // Hàm để lấy danh sách tỉnh thành và cập nhật dropdown
        const fetchProvinces = () => {
            // Gửi yêu cầu GET đến API của GHN
            $.ajax({
                url: ghnApiUrl,
                method: "GET",
                headers: {
                    "Token": ghnToken
                },
                success: function(response) {
                    // Xử lý dữ liệu khi nhận được phản hồi thành công
                    if (response && response.data && response.data.length > 0) {
                        // Lặp qua danh sách tỉnh thành và thêm vào dropdown
                        response.data.forEach(function(province) {
                            $("#city").append(`<option value="${province.ProvinceID}">${province.ProvinceName}</option>`);

                        });
                    } else {
                        console.error("Không có dữ liệu tỉnh thành từ API.");
                    }
                },
                error: function(error) {
                    console.error("Lỗi khi gọi API tỉnh thành:", error);
                }
            });
        };

        // Gọi hàm để lấy danh sách tỉnh thành khi trang web được tải
        $(document).ready(function() {
            fetchProvinces();
        });
    </script>

    <!-- lay quan huyen -->
    <script>
        // Hàm để lấy danh sách quận/huyện và cập nhật dropdown
        const fetchDistricts = (provinceId) => {
            // Gọi API để lấy danh sách quận/huyện
            $.ajax({
                url: "https://online-gateway.ghn.vn/shiip/public-api/master-data/district",
                method: "GET",
                headers: {
                    "Token": ghnToken
                },
                data: {
                    "province_id": provinceId
                },
                success: function(response) {
                    // Xử lý dữ liệu khi nhận được phản hồi thành công
                    if (response && response.data && response.data.length > 0) {
                        // Xóa tất cả các option hiện tại trong dropdown quận/huyện
                        $("#district").empty();

                        // Thêm option mặc định
                        $("#district").append(`<option value="" selected>Chọn quận huyện</option>`);

                        // Lặp qua danh sách quận/huyện và thêm vào dropdown
                        response.data.forEach(function(district) {
                            $("#district").append(`<option value="${district.DistrictID}">${district.DistrictName}</option>`);
                        });
                    } else {
                        console.error("Không có dữ liệu quận/huyện từ API.");
                    }
                },
                error: function(error) {
                    console.error("Lỗi khi gọi API quận/huyện:", error);
                }
            });
        };

        // Sự kiện khi thay đổi tỉnh/thành phố
        $("#city").change(function() {
            // Lấy giá trị của tỉnh/thành phố đã chọn
            var selectedProvinceId = $(this).val();
            console.log(selectedProvinceId);
            // Gọi hàm để lấy danh sách quận/huyện dựa trên tỉnh/thành phố đã chọn
            fetchDistricts(selectedProvinceId);

        });
    </script>
    <!-- lay phuong xa -->
    <script>
        // Hàm để lấy danh sách phường/xã và cập nhật dropdown
        const fetchWards = (districtId) => {
            // Gọi API để lấy danh sách phường/xã
            $.ajax({
                url: "https://online-gateway.ghn.vn/shiip/public-api/master-data/ward",
                method: "GET",
                headers: {
                    "Token": ghnToken
                },
                data: {
                    "district_id": districtId
                },
                success: function(response) {
                    // Xử lý dữ liệu khi nhận được phản hồi thành công
                    if (response && response.data && response.data.length > 0) {
                        // Xóa tất cả các option hiện tại trong dropdown phường/xã
                        $("#ward").empty();

                        // Thêm option mặc định
                        $("#ward").append(`<option value="" selected>Chọn phường xã</option>`);

                        // Lặp qua danh sách phường/xã và thêm vào dropdown
                        response.data.forEach(function(ward) {
                            $("#ward").append(`<option value="${ward.WardCode}">${ward.WardName}</option>`);
                        });
                    } else {
                        console.error("Không có dữ liệu phường/xã từ API.");
                    }
                },
                error: function(error) {
                    console.error("Lỗi khi gọi API phường/xã:", error);
                }
            });
        };

        // Sự kiện khi thay đổi quận/huyện
        $("#district").change(function() {
            // Lấy giá trị của quận/huyện đã chọn
            var selectedDistrictId = $(this).val();
            console.log(selectedDistrictId);
            // Gọi hàm để lấy danh sách phường/xã dựa trên quận/huyện đã chọn
            fetchWards(selectedDistrictId);

        });
    </script>
    <script>
        //Function to update the content of the <h2> element
        function updateSelectedInfo() {
            // Get the selected values from the <select> elements
            var selectedCity = $("#city").val();
            var selectedDistrict = parseInt($("#district").val());
            var selectedWard = $("#ward").val();
            // Create a string with the selected information
            var selectedInfo = "id_tinh " + selectedCity +
                " | id_quanhuyen: " + selectedDistrict +
                " | id_xa: " + selectedWard;

            // Update the content of the <h2> element
            $("#selectedInfo").text(selectedInfo);
        }

        // Attach the updateSelectedInfo function to the change event of the <select> elements
        $("#city, #district, #ward").change(updateSelectedInfo);
    </script>


</body>

</html>