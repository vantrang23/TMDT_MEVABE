<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ok'])) {
    // Bạn có thể thêm các kiểm tra khác nếu cần thiết
    $ghnApiUrl = "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services";

    // Define GHN token
    $ghnToken = "576288c8-95a2-11ee-a59f-a260851ba65c";

    // Lấy dữ liệu từ máy khách
    $fromDistrictId = 1562; // Replace with the actual ID of the sender's district
    $toDistrictId = intval($_POST['district']);
    $toWardId = $_POST['ward'];

    // Dữ liệu cho yêu cầu API
    $data = [
        'shop_id' => 4752601, // Replace with your actual shop ID
        'from_district' => $fromDistrictId,
        'to_district' => $toDistrictId
    ];

    // Khởi tạo cURL session
    $ch = curl_init($ghnApiUrl);

    // Cài đặt các tùy chọn cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Token: ' . $ghnToken
    ]);

    // Thực hiện yêu cầu cURL và lấy kết quả
    $response = curl_exec($ch);

    // Kiểm tra lỗi cURL
    if (curl_errno($ch)) {
        echo json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
    }

    // Đóng cURL session
    curl_close($ch);

    // Giải mã phản hồi JSON
    $availableServices = json_decode($response, true);

    // Kiểm tra xem yêu cầu có thành công không
    if (isset($availableServices['code']) && $availableServices['code'] === 200) {
        // Yêu cầu thành công, và $availableServices['data'] chứa các phương thức vận chuyển khả dụng
        $shippingMethods = $availableServices['data'];

        // Tìm phương thức vận chuyển đã chọn
        $selectedService = null;
        foreach ($shippingMethods as $service) {
            if ($service['service_id']) {
                $selectedService = $service;
                break;
            }
        }

        // Kiểm tra xem phương thức đã chọn có tồn tại không
        if ($selectedService) {
            // Tính phí vận chuyển bằng cách sử dụng service_id của phương thức đã chọn

            // Các tham số bổ sung cho việc tính phí
            $insuranceValue = 100000; // Giá trị bảo hiểm hàng hóa
            $coupon = ""; // Mã giảm giá (nếu có)
            $toWardCode = $toWardId; // Mã Phường/Xã người nhận
            $weight = 1000; // Trọng lượng hàng hóa (gram)
            $length = 20; // Chiều dài (cm)
            $width = 10; // Chiều rộng (cm)
            $height = 15; // Chiều cao (cm)

            // Dữ liệu cho yêu cầu API tính phí
            $feeData = [
                'service_id' => $selectedService['service_id'],
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

            // Khởi tạo cURL session cho việc tính phí
            $feeCh = curl_init("https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee");

            // Cài đặt các tùy chọn cURL cho việc tính phí
            curl_setopt($feeCh, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($feeCh, CURLOPT_POST, true);
            curl_setopt($feeCh, CURLOPT_POSTFIELDS, json_encode($feeData));
            curl_setopt($feeCh, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Token: ' . $ghnToken
            ]);

            // Thực hiện yêu cầu cURL cho việc tính phí và lấy kết quả
            $feeResponse = curl_exec($feeCh);

            // Kiểm tra lỗi cURL
            if (curl_errno($feeCh)) {
                echo json_encode(['error' => 'Curl error: ' . curl_error($feeCh)]);
            }

            // Đóng cURL session cho việc tính phí
            curl_close($feeCh);

            // Giải mã phản hồi JSON cho việc tính phí
            $feeResult = json_decode($feeResponse, true);

            // Kiểm tra xem tính phí có thành công không
            if (isset($feeResult['code']) && $feeResult['code'] === 200) {
                // Tính phí thành công
                $shippingFee = $feeResult['data']['total'];

                // Trả về thông tin kết quả
                echo json_encode(['success' => true, 'shipping_fee' => $shippingFee]);
            } else {
                // Tính phí thất bại, và bạn có thể xử lý lỗi ở đây
                echo json_encode(['error' => 'Error: ' . $feeResult['message']]);
            }
        } else {
            // Phương thức đã chọn không được tìm thấy trong các phương thức vận chuyển khả dụng
            echo json_encode(['error' => 'Invalid service ID']);
        }
    } else {
        // Yêu cầu thất bại, và bạn có thể xử lý lỗi ở đây
        echo json_encode(['error' => 'Error: ' . $availableServices['message']]);
    }
} else {
    // Không phải yêu cầu POST hoặc không có tham số 'ok', xử lý lỗi nếu cần
    echo json_encode(['error' => 'Invalid request']);
}
?>
