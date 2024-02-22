document.addEventListener('DOMContentLoaded', function() {
    // Lấy biểu mẫu và lớp form-slide
    const form = document.getElementById('form-container');
    const formSlide = document.querySelector('.form-slide');
    
    // Thiết lập thời gian trễ
    setTimeout(function() {
        formSlide.style.top = '0';
    }, 500); // Đợi 0.5 giây trước khi chuyển động xuống
});



//trở về trang list
function goBack() {
    window.location = 'list.php';
}

