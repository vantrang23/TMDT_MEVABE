-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th12 11, 2023 lúc 05:50 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopmevabe`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id_banner` int NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id_banner`, `image`) VALUES
(1, '1.jpg'),
(2, '2_sale.jpg'),
(3, 'dodungmevabe-bannerdanhmuc-04112021.jpg'),
(4, '2_sale.jpg'),
(5, '2_sale.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `id_binhluan` int NOT NULL,
  `iduser` int NOT NULL,
  `product_id` int NOT NULL,
  `noidung` varchar(500) NOT NULL,
  `trangthai` int NOT NULL,
  `ngaydang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`id_binhluan`, `iduser`, `product_id`, `noidung`, `trangthai`, `ngaydang`) VALUES
(1, 49, 49, 'rất tôt', 1, '2023-12-03 15:37:36'),
(2, 49, 51, 'rất hài lòng', 1, '2023-12-07 14:45:21'),
(3, 49, 51, 'TUYỆT', 0, '2023-12-07 21:47:36'),
(4, 49, 51, 'tuyệt lắm', 0, '2023-12-07 21:48:12'),
(6, 49, 51, 'dùng cho bé rất thoải mái', 1, '2023-12-07 21:48:58'),
(7, 49, 51, 'rất vừa vặn với bé nhà mình', 0, '2023-12-07 21:49:48'),
(8, 49, 51, 'mình mua rất nhiều lần rất hày lòng', 1, '2023-12-08 00:21:03'),
(9, 49, 49, 'bé nhà mình dùng ăn ngon miệng lắm', 1, '2023-12-08 13:56:00'),
(11, 49, 42, 'con mình dùng rất thoải mái', 1, '2023-12-09 16:56:07'),
(12, 49, 42, 'mua rất nhiều lần rồi', 0, '2023-12-10 11:50:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `name`, `status`, `created`, `modified`, `image`) VALUES
(16, 'Ăn dặm, dinh dưỡng', 1, '2023-10-27 03:31:42', '2023-12-10 16:17:47', 'andam_dinhduong.jpg'),
(17, 'Vitamin và an toàn cho bé', 1, '2023-10-27 03:32:05', '2023-10-31 12:59:05', 'vitamin_antoan.png'),
(18, 'Vệ sinh cho bé', 1, '2023-10-27 03:32:19', '2023-10-27 03:32:19', 'vesinh1.jpg'),
(20, 'Đồ chơi, học tập', 1, '2023-10-27 03:32:49', '2023-10-27 03:32:49', 'dochoi.jpg'),
(21, 'Thời trang và phụ kiện', 1, '2023-10-27 03:35:59', '2023-10-27 03:35:59', 'thoitrangbe.jpeg'),
(23, 'Đồ dùng gia đình', 1, '2023-10-27 03:36:37', '2023-12-10 16:17:30', 'tu.webp'),
(24, 'Sữa bột', 1, '2023-10-27 03:37:15', '2023-10-27 03:37:15', 'sb.png'),
(25, 'Bỉm, tã', 0, '2023-10-27 03:37:22', '2023-12-10 16:22:46', 'bimta.jpg'),
(26, 'Sữa tươi các loại', 1, '2023-10-27 03:37:35', '2023-10-27 03:37:35', 'suatoi.jpg'),
(29, 'Đồ dùng mẹ và bé', 0, '2023-12-10 09:33:38', '2023-12-10 09:33:38', 'mevabe.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_order`
--

CREATE TABLE `detail_order` (
  `id_detail` int NOT NULL,
  `id_order` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `shipping_method` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pay` int NOT NULL,
  `id_product` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `id_emp` int NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `hire_day` datetime NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id_giohang` int NOT NULL,
  `iduser` int NOT NULL,
  `product_id` int NOT NULL,
  `soluong` int NOT NULL,
  `thoigian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`id_giohang`, `iduser`, `product_id`, `soluong`, `thoigian`) VALUES
(14, 43, 50, 8, '2023-12-08 23:51:14'),
(51, 49, 51, 7, '2023-12-11 01:27:22'),
(54, 49, 50, 4, '2023-12-11 12:44:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id_order` int NOT NULL,
  `created` datetime NOT NULL,
  `iduser` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sdt` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `note_user` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `note_admin` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pay`
--

CREATE TABLE `pay` (
  `id_pay` int NOT NULL,
  `name_pay` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `detail` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` bit(2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `quantity` int NOT NULL,
  `id_promotion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `name`, `price`, `detail`, `image`, `status`, `created`, `modified`, `quantity`, `id_promotion`) VALUES
(36, 24, 'Sữa hoàng gia Úc Royal AUSNZ', 10000, '0-6', 'gold2-6-16thang.png', b'01', '2023-10-29 05:32:59', '0000-00-00 00:00:00', 100, 1),
(41, 24, 'Sữa hoàng gia Úc Royal AUSNZ  gold 2', 250000, '6-16 tháng', '1-3tuoi.jpg', b'01', '2023-10-31 06:42:29', '2023-12-06 07:49:28', 100, 6),
(42, 25, 'Bỉm', 10000, 'Tã Huggies Thin & Soft size L là sản phẩm phù hợp bé 4-7kg. Với thiết kế tã mỏng nhất chỉ 0.2 cm, “chiếc tã tàng hình” sẽ cho bé cảm giác nhẹ tênh, thoải mái như không hề mặc tã', 'bỉm-dán-bobby.jpg', b'01', '2023-10-31 06:43:30', '0000-00-00 00:00:00', 4, 27),
(45, 24, 'Sữa quốc dân Nature One Dairy', 550000, 'a', 'sua-bot-abbott-grow-4-huong-vani-1-7kg.jpg', b'01', '2023-11-03 06:43:15', '2023-11-03 06:43:15', 10, 0),
(46, 21, 'bộ quần áo', 250000, 'a', 'thoitrangbe.jpeg', b'01', '2023-11-03 06:57:19', '2023-11-03 06:57:19', 1000, 0),
(47, 17, 'Sịt ngăn sâu răng', 250000, 'a', 'sitnguasaurang.png', b'01', '2023-11-03 06:58:03', '2023-11-03 06:58:03', 10, 2),
(48, 17, 'siro cho bé', 250000, 'a', 'siro.png', b'01', '2023-11-03 06:58:24', '2023-11-03 06:58:24', 1000, 0),
(49, 17, 'Siro ăn ngon HOA THIÊN', 100000, 'a', 'siroanngon.jpg', b'01', '2023-11-03 07:00:47', '2023-11-03 07:00:47', 1000, 1),
(50, 25, 'Bỉm tã quần Bobby size M 76 miếng (6-10kg)', 375000, 'a', 'bim-ta-quan-bobby-m-76-mieng.jpg', b'01', '2023-12-06 06:55:29', '2023-12-06 06:55:29', 100, 6),
(51, 25, 'Combo 2 Tã quần Moony (L - bé trai, 44 miếng) + 6 miếng', 750000, 'a', 'ta-quan-moony-m-52-mieng.png', b'01', '2023-12-06 06:56:28', '2023-12-06 06:56:28', 100, 1),
(52, 25, 'Bỉm tã quần Bobby size XXXL 22 miếng (20-35kg)', 215000, 'a', 'bim-ta-quan-bobby-xxl-56-mieng.jpg', b'01', '2023-12-06 06:57:57', '2023-12-06 06:57:57', 150, 0),
(58, 26, 'Sữa Tươi TH True Milk TOPKID Organic 180ml', 560000, 'Sữa tươi tiệt trùng TH true MILK công thức TOPKID hoàn toàn từ sữa tươi Organic – Vị kem Vanilla tự nhiên, hộp 180ml. ', 'sua-tuoi-tiet-trung-th-true-milk-topkid-tu-sua-tuoi-organic.jpg', b'01', '2023-12-10 14:20:34', '2023-12-10 15:05:47', 150, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_detail`
--

CREATE TABLE `product_detail` (
  `id_pro_de` int NOT NULL,
  `advantage` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `object` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `instruct` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `ingredient` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `preserve` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_detail`
--

INSERT INTO `product_detail` (`id_pro_de`, `advantage`, `object`, `instruct`, `ingredient`, `preserve`, `product_id`) VALUES
(1, '-Lớp thấm nhanh siêu tốc: Bề mặt với 8.000 lỗ thấm hút siêu nhanh cho da bé luôn khô thoáng.<br>\n-Rãnh rốn Oheso: Thiết kế rãnh hạn chế tối đa tiếp xúc giữa tã và cuống rốn, bảo vệ vùng rốn bé luôn khô thoáng.<br>\n-Màng đáy xốp êm: Màng đáy dạng vải êm mềm, thoát ẩm, cho da bé hô hấp tự nhiên, giảm nguy cơ hăm tã.', 'Tã dán Bobby size S 32 miếng cho bé 4-7kg', '- Mở rộng phần eo và chân tã. Mang tã cho bé giống như mặc quần lót.<br>\n\n- Kéo tã lên bụng cho đến khi đũng quần vừa chạm mông bé.<br>\n\n- Điều chỉnh để vách chống trào luôn nằm trong tã và mép chun chân nằm ngoài cho bé thoải mái.<br>\n\n- Mở rộng phần eo và chân tã. Mang tã cho bé giống như mặc quần lót.<br>\n\n- Kéo tã lên bụng cho đến khi đũng quần vừa chạm mông bé.<br>\n\n- Điều chỉnh để vách chống trào luôn nằm trong tã và mép chun chân nằm ngoài cho bé thoải mái.', '', '', 42),
(2, 'Giúp bổ sung vitamin, L-Lysin và Kẽm cho cơ thể, giúp tăng cường sức đề kháng, hỗ trợ kích thích tiêu hóa và ăn ngon miệng.', 'Trẻ em biếng ăn, ăn uống kém, suy dinh dưỡng, tiêu hóa kém. Trẻ cần bồi bổ tăng cường sức khỏe đề kháng.', 'Uống sau bữa ăn, có thể hòa vào nước, sữa hoặc trộn với thức ăn lỏng. Lắc đều trước khi dùng.<br>\r\nTrẻ em 1-3 tuổi: Ngày 2 lần, mỗi lần 5ml (hoặc 1 thìa cà phê).<br>\r\nTrẻ em 4-6 tuổi: Ngày 2 lần, mỗi lần 10ml (hoặc 2 thìa cà phê).<br>\r\nTrẻ em trên 7 tuổi: Ngày 2 lần, mỗi lần 20ml (hoặc 4 thìa cà phê) ', 'L- lysin 3000mg, Chiết xuất quả cơm cháy ( Elderberry) 2400mg. Chiết xuất hạt bí 240mg, Kẽm guluconat 240mg, Magnesi citrat 240mg, Taurin 204mg, Vitamin B3 (Nicotinamid) 39.6mg, Vitamin B5 (D-pantothenat, calci) 24mg, Vitamin B1 (Thiamin hydroclorid) 13.2mg, Vitamin B2 (Riboflavin) 13.2mg, Vitamin B6 (Pyridoxin hydroclorid) 12mg, Vitamin B12 ( Cyanocobalamin) 24mcg.<br>\r\nPhụ liệu:<br>\r\nStrawberry, Elderberry, Natri benzoat, Kali sorbat, Xathan gum, Sucrose, Sucralose, Natri citrate, Acid citric, Nước tinh khiết vừa đủ 120 ml.', 'Nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp, nhiệt độ không quá 30 độ C.Hạn dùng\r\n36 tháng kể từ ngày sản xuất.', 49),
(3, 'Công nghệ không tràn tã - Hệ thun Air-fit: Phần thun bụng nâng cao, luôn ôm vừa vùng bụng, không tụt/xệ tã ngay cả khi bé vận động mạnh; Thun chân và thun đùi ôm vừa vặn theo từng cử động của bé mà không tạo ra khe hở.<br>\r\n\r\n. Chống hăm tã: Bề mặt tã mềm mịn, bổ sung tinh chất dầu Olive thiên nhiên thân thiện với làn da bé,  ngăn ngừa hăm tã hiệu quả.<br> \r\n\r\n. Siêu thấm hút : Màng vải thoáng khí và lõi bông cao cấp siêu thấm hút, khô thoáng đến 12h; Đường chỉ thị ướt giúp mẹ dễ dàng kiểm tra và xác định thời gian thay tã.', 'Dành cho bé trai 9-14 kg', ' Bước 1: Kiểm tra trước sau, giữ trẻ ở tư thế đứng vững rồi mặc tã cho trẻ giống như khi mặc quần. Dùng 2 tay mở rộng 2 bên hông miếng tã, cho chân của trẻ bước qua miếng tã. <br>\r\n. Bước 2:  Kéo phần đai lưng miếng tã lên đến rốn của bé để phần đùi không xuất hiện khe hở. <br>\r\n. Bước 3: Kiểm tra để chắc chắn phần nếp chun ở đai lưng và lớp viền xung quanh phần chân không bị cuộn ngược vào trong.', 'Màng thấm: Vải không dệt (Polyolefin, Polyester)<br>\r\nLõi thấm: Bột giấy, Hạt siêu thấm<br>\r\nMàng đáy: Polyolefin<br>\r\nTai dính: Polyolefin, Chun sợi, Polyurethane, Polyme kết dính<br>\r\nTinh chất dầu Olive', 'Bảo quản nơi khô ráo, thoáng mát, tránh ánh nắng mặt trời', 51),
(4, 'Các sản phẩm của Royal AUSNZ luôn đảm bảo 4 không: Không chất bảo quản, không chất tạo màu, không hương vị tổng hợp và không nguyên liệu biến đổi gen.', 'Trẻ em từ 6 – 12 tháng tuổi', 'Rửa sạch bình sữa và nắp trước khi sử dụng. <br>\r\n\r\n+ Làm nguội nước đun sôi đến 45ºC, sau đó đổ lượng nước chính xác vào bình đã tiệt trùng.<br>\r\n\r\n+ Thêm lượng sữa theo từng độ tuổi của trẻ, chỉ sử dụng muỗng kèm theo.<br>\r\n\r\n+ Đóng và lắc chai cho đến khi sữa hòa tan hoàn toàn<br>\r\n\r\n+ Kiểm tra nhiệt độ trên cổ tay trước khi cho con ăn.<br>\r\n\r\nCách pha: 1 muỗng = 4,3g; Một muống bột pha với 30ml nước<br>\r\n\r\n​- Trẻ 6 – 9 tháng: Pha 6 muỗng với 180ml nước. Mỗi ngày 4 – 5 lần.<br>\r\n\r\n– Trẻ từ 9 – 12 tháng: Pha 8 muỗng với 240ml nước. Mỗi ngày 3 – 4 lần. <br>', 'Lactose, sữa tách béo, dầu thực vật, whey protein cô đặc, kem, galacto-oligosaccharides (GOS), arachidonic acid (AA), docosahexaenoic acid (DHA), lecithin (đậu nành), nucleotides (5’cytidine monophosphate, muối 5’uridine monophosphate disodium, 5’adenosine monophosphate, muối 5’inosine monophosphate disodium, muối 5’guanosine monophosphate disodium), taurine, choline bitartrate, inositol, L-camitine, lutein.', 'Hộp sữa: Sử dụng trong vòng 04 tuần kể từ khi mở. Đóng chặt nắp sau mỗi lần sử dụng và bảo quản nơi khô mát. Sử dụng theo ngày là trên hộp. Không sử dụng nếu niêm phong bị thiếu hoặc hư hỏng. Nên được lưu trữ và làm đúng theo hướng dẫn trên nhãn, không cần thêm các chế phẩm vitamin hoặc khoáng chất.', 36),
(6, 'sữa organic tốt cho sức khoẻ hơn, nguồn gốc thức ăn của bò đều là tự nhiên, sạch, nên chắc chắn sữa của chúng cũng sạch hơn. Cách nuôi thả bò theo phương pháp hữu cơ giúp chúng thoải mái tinh thần khi tự do chạy nhảy phơi nắng trên đồng cỏ nên chúng cũng sẽ cung cấp nguồn sữa bổ dưỡng hơn.', 'cho trẻ em trên 2 tuổi', '– Sản phẩm sử dụng cho một lần uống\r\n\r\n– Ngon hơn khi uống lạnh', ' Vitamin C và Vitamin nhóm B (B1, B6) đảm bảo nhu cầu tối ưu cho trẻ trong việc tăng cường miễn dịch và khả năng hấp thu chất dinh dưỡng cũng như hỗ trợ các chức năng khác của não.', '– Bảo quản nơi khô ráo và thoáng mát\r\n\r\n– HSD: 6 tháng kể từ ngày sản xuất', 58);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_image`
--

CREATE TABLE `product_image` (
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_image`
--

INSERT INTO `product_image` (`image`, `product_id`) VALUES
('bim-ta-dan-bobby-jumbo-sieu-mong-m-6-10kg-76-mieng (1).jpg', 42),
('bim-ta-dan-bobby-jumbo-sieu-mong-m-6-10kg-76-mieng (2).jpg', 42),
('bim-ta-dan-bobby-jumbo-sieu-mong-m-6-10kg-76-mieng.jpg', 42),
('bim-ta-dan-bobby-jumbo-sieu-mong-m-6-10kg-76-mieng.png', 42);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotion`
--

CREATE TABLE `promotion` (
  `id_promotion` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `start_day` date NOT NULL,
  `end_day` date NOT NULL,
  `content` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `discount` float NOT NULL,
  `status` int NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `promotion`
--

INSERT INTO `promotion` (`id_promotion`, `name`, `start_day`, `end_day`, `content`, `discount`, `status`, `created`) VALUES
(1, 'khuyen mai thang', '2023-11-15', '2023-12-28', 'a', 15, 1, '2023-10-30 07:10:06'),
(2, 'khuyen mai thang', '2023-11-15', '2023-06-12', 'b\r\n', 10, 1, '2023-10-31 07:24:39'),
(6, 'khuyen mai thang', '2023-11-15', '2023-12-13', 'a', 10, 1, '2023-11-04 13:19:58'),
(8, 'khuyen mai thang', '2023-11-15', '2023-11-16', 'a', 10, 1, '2023-11-04 14:09:37'),
(9, 'khuyen mai thang', '2023-11-15', '2023-11-16', 'a', 10, 1, '2023-11-04 14:17:38'),
(10, 'khuyen mai thang', '2023-11-15', '2023-11-16', 'a', 10, 1, '2023-11-04 14:32:51'),
(27, 'khuyen mai thang', '2023-11-15', '2023-12-06', 'a', 10, 1, '2023-11-04 16:19:13'),
(34, 'khuyen mai thang', '2023-11-15', '2023-11-16', 'a', 10, 1, '2023-11-07 22:24:53'),
(35, 'khuyen mai thang', '2023-11-15', '2023-11-16', 'a', 10, 1, '2023-11-08 22:28:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotion_product`
--

CREATE TABLE `promotion_product` (
  `id_promotion` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `promotion_product`
--

INSERT INTO `promotion_product` (`id_promotion`, `product_id`) VALUES
(1, 36),
(1, 41),
(35, 41),
(35, 42),
(34, 45),
(34, 46);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `locked` int NOT NULL DEFAULT '0',
  `quantity_locked` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`iduser`, `username`, `pass`, `fullname`, `email`, `status`, `role`, `created`, `modified`, `locked`, `quantity_locked`) VALUES
(40, 'duy1', '12345678', 'hồ duy', '200040314@st.vlute.edu.vn', 1, 'admin', '2023-10-29 04:49:30', '2023-10-31 15:36:52', 5, 0),
(43, 'Trang', '12345678', 'Văn Thị Mỹ Trang', 'hothithuyduy26092002@gmail.com', 1, 'khach', '2023-10-29 10:29:36', '2023-10-31 13:40:32', 0, 0),
(44, 'dd1', '12345678', 'hồ duy', '200040344@st.vlute.edu.vn', 1, 'khach', '2023-10-29 15:59:07', '2023-10-31 12:58:55', 0, 0),
(47, 'Duy1', '12345679', 'Duy Duy', '20004034@st.vlute.edu.vn', 1, 'admin', '2023-10-31 15:42:00', '2023-12-10 14:25:03', 0, 0),
(48, 'Trang0108', '12345678', 'Trang Trang', '200040341@st.vlute.edu.vn', 1, 'khach', '2023-11-03 07:22:31', '0000-00-00 00:00:00', 0, 0),
(49, 'a1', '12345678', 'Hồ Duy', 'hothuyduy.tvb20181@gmail.com', 1, 'khach', '2023-11-03 07:23:12', '0000-00-00 00:00:00', 0, 0),
(50, 'd1', '12345678', 'Hồ Duy', '200040343@st.vlute.edu.vn', 1, 'admin', '2023-11-03 07:24:10', '0000-00-00 00:00:00', 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`id_binhluan`),
  ADD KEY `fk_user_binhluan` (`iduser`),
  ADD KEY `fk_binhluan_pro` (`product_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_or_detail` (`id_order`),
  ADD KEY `fk_pro` (`id_product`),
  ADD KEY `fk_pay_detail` (`id_pay`);

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_emp`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id_giohang`),
  ADD KEY `fk_gh_user` (`iduser`),
  ADD KEY `fk_gh_sp` (`product_id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_order_user` (`iduser`);

--
-- Chỉ mục cho bảng `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id_pay`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_category_product` (`category_id`),
  ADD KEY `fk_prom_product` (`id_promotion`) USING BTREE;

--
-- Chỉ mục cho bảng `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id_pro_de`),
  ADD KEY `fk_pro_detail` (`product_id`);

--
-- Chỉ mục cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image`,`product_id`),
  ADD KEY `fk_pro_image` (`product_id`);

--
-- Chỉ mục cho bảng `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promotion`);

--
-- Chỉ mục cho bảng `promotion_product`
--
ALTER TABLE `promotion_product`
  ADD PRIMARY KEY (`id_promotion`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id_banner` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `id_binhluan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `employee`
--
ALTER TABLE `employee`
  MODIFY `id_emp` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id_giohang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pay`
--
ALTER TABLE `pay`
  MODIFY `id_pay` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id_pro_de` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_promotion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `fk_binhluan_pro` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_user_binhluan` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `fk_or_detail` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`),
  ADD CONSTRAINT `fk_pay_detail` FOREIGN KEY (`id_pay`) REFERENCES `pay` (`id_pay`),
  ADD CONSTRAINT `fk_pro` FOREIGN KEY (`id_product`) REFERENCES `product` (`product_id`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `fk_gh_sp` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_gh_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_category_product` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Các ràng buộc cho bảng `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `fk_pro_detail` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Các ràng buộc cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_pro_image` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Các ràng buộc cho bảng `promotion_product`
--
ALTER TABLE `promotion_product`
  ADD CONSTRAINT `promotion_product_ibfk_1` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id_promotion`),
  ADD CONSTRAINT `promotion_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
