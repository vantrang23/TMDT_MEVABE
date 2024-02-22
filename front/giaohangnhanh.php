<?php
require_once '../libraries/connect.php';
// $sql_fromdistrict = "SELECT from_district FROM shipping_method";
// $result_fromdistrict = mysqli_query($conn, $sql_fromdistrict);

?>
<?php
session_start();
require_once '../libraries/connect.php';
if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];
    $_SESSION['iduser'] = $iduser;
}

?>
<?php
if (isset($_POST['ok'])) {
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <?php
    require 'header.php';
    ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Thanh toán</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">

            <div class="checkout__form">
                <h2 class="ac">Giao hàng nhanh</h2><br>
                <?php if (isset($error)) { ?> <div class="error">
                        <p style="color:red">
                            <?php echo $error; ?>
                    </div> <?php } ?>
                <?php if (isset($success)) { ?> <div class="success">
                        <?php echo $success; ?>
                    </div> <?php }
                            ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__form-wrapper">
                                <div class="checkout__input">
                                    <p>Địa chỉ gởi hàng<span>*</span></p>
                                    <h2 class="form-control unicase-form-control text-input"><?php
                                                                                                // Loop through results and display each district
                                                                                                // while ($row = mysqli_fetch_assoc($result_fromdistrict)) {
                                                                                                //     echo $row['from_district'];
                                                                                                //     echo '<br>';
                                                                                                // }
                                                                                                ?></h2>
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
                                    <!-- <h2 readonly  type="hidden" class="form-control unicase-form-control text-input"  id="selectedInfo"></h2> -->
                                    <br>
                                    <button name="ok" type="submit">OK</button>

                                </div>

                                <div class="checkout__input">
                                    <p>Phí vận chuyển</p>

                                    <input value="<?php echo  $shippingFee; ?> " class="form-control unicase-form-control text-input" id="shippingFee" readonly>
                                    <br>
                                    <button name="xacnhan_ghn" type="submit">Áp dụng</button>
                                    <button name="trove_thanhtoan" type="button" id="cancel-button">Hủy</button>

                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- NHAN NUT HUY DE VE TRANG THANH TOAN -->
    <script>
        document.getElementById('cancel-button').addEventListener('click', function() {
            // Chuyển hướng trở lại trang checkout.php
            window.location.href = 'checkout.php';
        });
    </script>
    <script>
        // // Function to update the content of the <h2> element
        // function updateSelectedInfo() {
        //     // Get the selected values from the <select> elements
        //     var selectedCity = $("#city").val();
        //     var selectedDistrict = $("#district").val();
        //     var selectedWard = $("#ward").val();

        //     // Create a string with the selected information
        //     var selectedInfo = "id_tinh " + selectedCity +
        //         " | id_quanhuyen: " + selectedDistrict +
        //         " | id_xa: " + selectedWard;

        //     // Update the content of the <h2> element
        //     $("#selectedInfo").text(selectedInfo);

        //     // Call API to determine shipping method
        //     var shopId =4752601; // Replace with your shop ID
        //     var fromDistrictId = 1562;
        //     // var toDistrictId = parseInt(selectedDistrict);
        //       var toDistrictId = 1442;
        //     var availableServicesUrl = "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services";
        //     var headers = {
        //         "Content-Type": "application/json",
        //         "Authorization": "576288c8-95a2-11ee-a59f-a260851ba65c" // Replace with your authorization token
        //     };
        //     var data = {
        //         "shop_id": shopId,
        //         "from_district": fromDistrictId,
        //         "to_district": toDistrictId
        //     };

        //     $.ajax({
        //         url: availableServicesUrl,
        //         type: "POST",
        //         headers: headers,
        //         data: JSON.stringify(data),
        //         success: function(response) {
        //             // Handle the response and update the UI with available shipping methods
        //             var shippingMethods = response.data;
        //             // Update the UI with the available shipping methods
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     });

        //     // Call API to calculate shipping fee
        //     var serviceId = 53321; // Replace with the selected service ID
        //     var insuranceValue = 500000; // Replace with the actual insurance value
        //     var coupon = null; // Replace with the coupon code if available
        //     var toWardCode = selectedWard; // Replace with the actual ward code
        //     var height = 15; // Replace with the actual package height
        //     var length = 15; // Replace with the actual package length
        //     var weight = 1000; // Replace with the actual package weight
        //     var width = 15; // Replace with the actual package width
        //     var calculateFeeUrl = "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee";
        //     var feeData = {
        //         "service_id": serviceId,
        //         "insurance_value": insuranceValue,
        //         "coupon": coupon,
        //         "to_ward_code": toWardCode,
        //         "to_district_id": toDistrictId,
        //         "from_district_id": fromDistrictId,
        //         "weight": weight,
        //         "length": length,
        //         "width": width,
        //         "height": height
        //     };

        //     $.ajax({
        //         url: calculateFeeUrl,
        //         type: "POST",
        //         headers: headers,
        //         data: JSON.stringify(feeData),
        //         success: function(response) {
        //             // Handle the response and update the UI with the calculated shipping fee
        //             var shippingFee = response.data.total_fee;
        //             $("#shippingFee").val(shippingFee);
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     });
        // }

        // // Attach the updateSelectedInfo function to the change event of the <select> elements
        // $("#city, #district, #ward").change(updateSelectedInfo);
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Hàm để lấy thông tin gói dịch vụ và tính giá cước vận chuyển
        // const calculateShippingFee = () => {
        //     // Gọi API để lấy thông tin các gói dịch vụ có sẵn
        //     $.ajax({
        //         url: "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services",
        //         type: "GET",
        //         headers: {
        //             "Content-Type": "application/json",
        //             "Authorization": "576288c8-95a2-11ee-a59f-a260851ba65c" // Thay bằng mã thông báo (authorization token) của bạn
        //         },
        //         success: function(response) {
        //             // Xử lý dữ liệu khi nhận được phản hồi thành công
        //             var availableServices = response.data;

        //             // Lấy thông tin gói dịch vụ cần tính giá cước (ví dụ: lấy gói dịch vụ đầu tiên)
        //             var service = availableServices[0];
        //             var serviceId = service.service_id;

        //             // Lấy giá trị các thông tin cần thiết từ gói dịch vụ và các trường dữ liệu khác
        //             var insuranceValue = ''; // Giá trị bảo hiểm hàng hóa
        //             var coupon = null; // Mã giảm giá (nếu có)
        //             var toWardCode = $("#ward").val(); // ID Phường/Xã người nhận
        //             // var toDistrictId = $("#district").val(); // ID Quận/Huyện người nhận
        //             var toDistrictId = parseInt($("#district").val());

        //             var fromDistrictId = 1562; // ID Quận/Huyện người gửi
        //             var weight = ''; // Trọng lượng hàng hóa (gram)
        //             var length = ''; // Chiều dài (cm)
        //             var width = ''; // Chiều rộng (cm)
        //             var height = ''; // Chiều cao (cm)

        //             // Tạo đối tượng dữ liệu để gửi lên API tính giá cước vận chuyển
        //             var data = {
        //                 "service_id": serviceId,
        //                 "insurance_value": insuranceValue,
        //                 "coupon": coupon,
        //                 "to_ward_code": toWardCode,
        //                 "to_district_id": toDistrictId,
        //                 "from_district_id": fromDistrictId,
        //                 "weight": weight,
        //                 "length": length,
        //                 "width": width,
        //                 "height": height
        //             };

        //             // Gọi API để tính giá cước vận chuyển
        //             $.ajax({
        //                 url: "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee",
        //                 type: "POST",
        //                 headers: {
        //                     "Content-Type": "application/json",
        //                     "Authorization": "576288c8-95a2-11ee-a59f-a260851ba65c" // Thay bằng mã thông báo (authorization token) của bạn
        //                 },
        //                 data: JSON.stringify(data),
        //                 success: function(response) {
        //                     // Xử lý dữ liệu khi nhận được phản hồi thành công
        //                     var shippingFee = response.data.total;
        //                     console.log("Giá trị shippingFee: " + shippingFee);
        //                     // Cập nhật giá cước vận chuyển lên giao diện
        //                     $("#shippingFee").text(shippingFee); 


        //                 },
        //                 error: function(error) {
        //                     console.error("Lỗi khi gọi API tính giá cước vận chuyển:", error);
        //                 }
        //             });

        //         },
        //         error: function(error) {
        //             console.error("Lỗi khi gọi API lấy thông tin các gói dịch vụ:", error);
        //         }
        //     });
        // };
        // $("#district, #ward").change(calculateShippingFee);

        //      calculateShippingFee();
    </script>
    <script>
        //     // Function to update the content of the <h2> element
        //     function updateSelectedInfo() {
        //         // Get the selected values from the <select> elements
        //         var selectedCity = $("#city").val();
        //         var selectedDistrict = $("#district").val();
        //         var selectedWard = $("#ward").val();

        //         // Create a string with the selected information
        //         var selectedInfo = "id_tinh " + selectedCity +
        //             " | id_quanhuyen: " + selectedDistrict +
        //             " | id_xa: " + selectedWard;

        //         // Update the content of the <h2> element
        //         $("#selectedInfo").text(selectedInfo);

        //         // Call API to determine shipping method
        //         var shopId = 4752601; // Replace with your shop ID
        //         var fromDistrictId = 1562;
        //         var toDistrictId = parseInt(selectedWard);
        //         var availableServicesUrl = "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services";
        //         var headers = {
        //             "Content-Type": "application/json",
        //             "Authorization": "576288c8-95a2-11ee-a59f-a260851ba65c" // Replace with your authorization token
        //         };
        //         var data = {
        //             "shop_id": shopId,
        //             "from_district": fromDistrictId,
        //             "to_district": toDistrictId
        //         };

        //         $.ajax({
        //             url: availableServicesUrl,
        //             type: "POST",
        //             headers: headers,
        //             data: JSON.stringify(data),
        //             success: function(response) {
        //                 // Handle the response and update the UI with available shipping methods
        //                 var shippingMethods = response.data;
        //                 // Update the UI with the available shipping methods
        //             },
        //             error: function(error) {
        //                 console.log(error);
        //             }
        //         });

        //         // Call API to calculate shipping fee
        //         var serviceId = 53321; // Replace with the selected service ID
        //         var insuranceValue = 500000; // Replace with the actual insurance value
        //         var coupon = null; // Replace with the coupon code if available
        //         var toWardCode = selectedWard; // Replace with the actual ward code
        //         var height = 15; // Replace with the actual package height
        //         var length = 15; // Replace with the actual package length
        //         var weight = 1000; // Replace with the actual package weight
        //         var width = 15; // Replace with the actual package width
        //         var calculateFeeUrl = "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee";
        //         var feeData = {
        //             "service_id": serviceId,
        //             "insurance_value": insuranceValue,
        //             "coupon": coupon,
        //             "to_ward_code": toWardCode,
        //             "to_district_id": toDistrictId,
        //             "from_district_id": fromDistrictId,
        //             "weight": weight,
        //             "length": length,
        //             "width": width,
        //             "height": height
        //         };

        //         $.ajax({
        //             url: calculateFeeUrl,
        //             type: "POST",
        //             headers: headers,
        //             data: JSON.stringify(feeData),
        //             success: function(response) {
        //     // Handle the response and update the UI with the calculated shipping fee
        //     var shippingFee = response.data.total_fee;
        //     $("#shippingFee").val(shippingFee);
        // },
        //         });
        //     }

        //     // Attach the updateSelectedInfo function to the change event of the <select> elements
        //     $("#city, #district, #ward").change(updateSelectedInfo);
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
    <!-- <script>
        $(document).ready(function() {
            $(".ok").click(function(e) {
                e.preventDefault();

                var selectedDistrict = $("#district").val();
                // alert(selectedDistrict);
                $.ajax({
                    method: "POST",
                    url: "a.php",
                    dataType: 'html',
                    data: {
                        selectedDistrict: selectedDistrict,
                        selectedWard: selectedWard,
                        // id_pro: id_pro
                    }
                }).done(function(response) {
                    $('.ac').html(response);
                    // document.getElementById('message').value = '';
                });

            });
        });

    </script> -->

    <style>
        .site-btn {
            background-color: #CC3069;
            color: black;
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>