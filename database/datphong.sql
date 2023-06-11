-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th6 11, 2023 lúc 07:18 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `datphong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chukhachsan`
--

DROP TABLE IF EXISTS `chukhachsan`;
CREATE TABLE IF NOT EXISTS `chukhachsan` (
  `Email` char(100) NOT NULL,
  `Password` char(100) NOT NULL,
  `HoTen` varchar(150) NOT NULL,
  `NgaySinh` date NOT NULL,
  `SDT` char(11) NOT NULL,
  `cmnd` char(13) NOT NULL,
  `ADMINKS` char(30) NOT NULL,
  PRIMARY KEY (`Email`),
  KEY `ADMINKS` (`ADMINKS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `chukhachsan`
--

INSERT INTO `chukhachsan` (`Email`, `Password`, `HoTen`, `NgaySinh`, `SDT`, `cmnd`, `ADMINKS`) VALUES
('thuthao@gmail.com', 'admin123', 'Thu Thao', '2004-01-16', '0907344689', '079201018864', '079201018864_0907344689'),
('tuan60847@gmail.com', 'vipkute517', 'Lê Hoàng Tuấn', '2001-07-21', '0908644888', '079201018856', '079201018856_0908644888'),
('tuanhoang60847@gmail.com', 'vipkute517', 'tuan', '2004-01-15', '0907344682', '079201018852', '079201018852_0907344682');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctddp`
--

DROP TABLE IF EXISTS `ctddp`;
CREATE TABLE IF NOT EXISTS `ctddp` (
  `UIDCTDDP` int NOT NULL AUTO_INCREMENT,
  `MaDDP` char(50) NOT NULL,
  `UIDLoaiPhong` int NOT NULL,
  `SoNgayO` int NOT NULL DEFAULT '1',
  `soLuongPhong` int NOT NULL DEFAULT '1',
  `Tien` float NOT NULL,
  PRIMARY KEY (`UIDCTDDP`),
  KEY `FK_CTDDP_LP` (`UIDLoaiPhong`),
  KEY `FK_CTDDP_DDP` (`MaDDP`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `ctddp`
--

INSERT INTO `ctddp` (`UIDCTDDP`, `MaDDP`, `UIDLoaiPhong`, `SoNgayO`, `soLuongPhong`, `Tien`) VALUES
(31, '079201018856-079201018856_0908644888-20230602', 20, 0, 0, 0),
(32, '079201018856-079201018856_0908644888-20230602', 20, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diadiemdulich`
--

DROP TABLE IF EXISTS `diadiemdulich`;
CREATE TABLE IF NOT EXISTS `diadiemdulich` (
  `MaDDDL` int NOT NULL AUTO_INCREMENT,
  `TenDiaDiemDuLich` varchar(500) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `MoTa` varchar(700) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `GiaTien` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'Miễn Phí Vé Vào Cổng',
  `MaTP` int NOT NULL,
  `ThoiGianHoatDong` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`MaDDDL`),
  KEY `FK_diadiemdulich_Tp` (`MaTP`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `diadiemdulich`
--

INSERT INTO `diadiemdulich` (`MaDDDL`, `TenDiaDiemDuLich`, `DiaChi`, `MoTa`, `GiaTien`, `MaTP`, `ThoiGianHoatDong`) VALUES
(1, 'Chợ Bến Thành', 'Đường Lê Lợi, phường Bến Thành, quận 1.', 'Đây là một trong những địa điểm du lịch Thành phố Hồ Chí Minh nổi tiếng nhất nằm ngay trung tâm thành phố và luôn tấp nập người ra vào mua bán, du khách check in mỗi ngày.\n\nChợ Bến Thành buôn bán tất tần tật những mặt hàng từ thực phẩm, vải vóc, quần áo, đồ gia dụng, đặc sản Sài Gòn,… và quan trọng là khu ẩm thực cực kỳ hấp dẫn ở chợ và những góc check in ấn tượng sẽ làm bạn luôn muốn lưu lại nơi đây thật lâu.', 'Miễn Phí Vé Vào Cổng', 33, '7h - 20h.'),
(2, 'Dinh Độc Lập', '135 Nam Kỳ Khởi Nghĩa, Bến Nghé, Quận 1.', 'Dinh Độc Lập hay còn gọi là hội trường Thống Nhất, đây là một công trình được xây dựng bởi người Pháp, từ thời Pháp thuộc. Đối với người dân Sài Gòn, Dinh Độc Lập là một di tích lịch sử mang ý nghĩa hòa bình và toàn vẹn lãnh thổ. Nơi đây đã được công nhận là 1 trong 10 di tích quốc gia đặc biệt của Việt Nam vào năm 2009.\r\n\r\nDinh Độc Lập là nơi trưng bày và lưu giữ những hình ảnh, hiện vật giá trị từ những năm của thế kỷ 19 theo từng chủ đề khác nhau. Đặc biệt nơi đây vẫn còn giữ nguyên nội thất ', '10.000đ – 40.000đ', 33, '7h30 – 11h; 13h30 – 17h'),
(3, 'Nhà thờ Đức Bà', 'số 01 Công Xã Paris, Bến Nghé, Quận 1.', 'Cũng nằm ngay trung tâm quận 1, nhà thờ Đức Bà là địa điểm du lịch thành phố Hồ Chí Minh mà bạn nhất định phải ghé đến. Nhà thờ Đức Bà là một công trình kiến trúc độc đáo mang đậm phong cách Châu Âu, là nơi sinh hoạt và tổ chức các buổi Thánh lễ cho những người theo đạo Công giáo ở Sài Thành.\r\n\r\nGhé đến tham quan nhà thờ Đức Bà, bạn có thể đến vào buổi sáng để có thể ngắm được trọn vẹn vẻ đẹp của nhà thờ dưới ánh sáng ban ngày, check in ở mọi ngóc ngách trong nhà thờ đậm chất Gothic,… đặc biệt nhà thờ luôn đón chào những du khách, người dân và bất kỳ ai đến đây để nghe giảng đạo.', 'Miễn Phí Vé Vào Cổng', 33, '6h – 20h'),
(6, 'Bảo tàng lịch sử Việt Nam', 'số 2 Nguyễn Bỉnh Khiêm, Quận 1.', 'Bảo tàng lịch sử Việt Nam được xây dựng và hoạt động từ những năm đầu thế kỷ 20, là nơi lưu giữ và bảo tồn những hình ảnh, cổ vật từ thuở sơ khai đến nay. Bảo tàng lịch sử Việt Nam thu hút phần lớn những du khách yêu lịch sử và kiến trúc pha trộn giữa 2 phong cách Á – Âu độc đáo.\r\n\r\nNgoài là nơi lưu giữ nét văn hoa truyền thống của đất nước, bảo tàng lịch sử Việt Nam còn là một trong những điểm du lịch thành phố Hồ Chí Minh ấn tượng với những góc check in đẹp. Đây luôn là điểm đến thú vị trong những lịch trình của tour du lịch Hồ Chí Minh được yêu thích nhất.', '2.000đ – 15.000đ', 33, '8h – 17h'),
(7, 'Địa đạo Củ Chi', 'TL15, Phú Hiệp, Củ Chi', 'Địa đạo Củ Chi là di tích lịch sử nằm ở ngoại ô, cách trung tâm Tp.HCM khoảng 70km. Đây là một trong những điểm nên đến ở Sài Gòn được yêu thích, đặc biệt là đối với các du khách nước ngoài.\r\nNơi đây là di tích quốc gia đặc biệt, gắn liền với lịch sử chiến tranh Việt Nam, từng là căn cứ địa quan trọng và cũng là nơi sinh hoạt chung bao gồm bệnh xá, nhà bếp, nơi làm việc,… của quân đội ta trong cuộc kháng chiến chống quân xâm lược, giành lại toàn vẹn lãnh thổ.\r\n\r\nBên cạnh đó, bên trong địa đạo Củ Chi còn tái hiện tại cuộc sống của họ qua những qua những mô hình người và vật rất chân thật, ấn tượng. Nơi đây là một trong những điểm đến hấp dẫn của những tour Hồ Chí Minh mà bạn không nên bỏ qua', '20.000đ – 40.000đ', 33, '8h – 17h'),
(8, 'Phố đi bộ Nguyễn Huệ', 'Đường Nguyễn Huệ, quận 1.', 'Phố đi bộ Nguyễn Huệ từ lâu đã là một điểm đến thú vị ở Sài Gòn đối với người dân bản địa và cả các du khách. Đây là một trong những địa điểm vui chơi ở Quận 1 được nhiều người ghé tới đặc biệt vào mỗi tối và dịp cuối tuần.\r\n\r\nỞ phố đi bộ Nguyễn Huệ, bạn sẽ có cơ hội tham gia vào các hoạt động như trình diễn thời trang, nghệ thuật đường phố, vui chơi giải trí, ẩm thực,... rất đặc sắc. Nơi đây là điểm check in hot nhất nhì Sài Thành mà bạn không thể bỏ lỡ trong chuyến du lịch Sài Gòn của mình.', 'Miễn Phí Vé Vào Cổng', 33, 'Cả ngày'),
(9, 'Thảo Cầm Viên', ' 2 Nguyễn Bỉnh Khiêm, Bến Nghé, Quận 1', 'Một địa điểm du lịch thành phố Hồ Chí Minh phù hợp cho mọi lứa tuổi đó là Thảo Cầm Viên. Đây là khu bảo tồn động thực vật lớn ở trung tâm thành phố, có không gian rộng rãi với những khu vui chơi giải trí, khu nuôi dưỡng động vật hoang dã, khu trồng và chăm sóc thực vật,...rất thoáng mát.\r\n\r\nThảo Cầm Viên là một trong những điểm nên đến ở Sài Gòn thích hợp để bạn khám phá các loại động thực vật quý hiếm và thư giãn sau những ồn ào ở thành phố.', '30.000 - 50.000đ', 33, '7h – 18h30'),
(10, 'Bảo tàng tranh 3D Artinus', 'số 2 Khu Him Lam, quận 7', 'Là một bảo tàng tranh 3D lớn nhất Sài Gòn, Artinus là nơi check in cực hấp dẫn với nhiều du khách và giới trẻ Sài Thành. Bảo tàng tranh 3D Artinus có không gian kích thích sự sáng tạo ở mọi lứa tuổi qua từng khung ảnh. Bạn sẽ cảm thấy mình thật bé nhỏ khi đứng giữa những bức tranh 3D ấn tượng trong bảo tàng.\r\n\r\nBên trong bảo tàng Artinus, những bức tranh 3D được sắp xếp theo 9 chủ đề khác nhau như Đại Dương, Việt Nam, Ai Cập, Tình Yêu, Thần Tiên,... Nơi đây không chỉ là một điểm check in, tham quan mà còn là địa điểm chụp ảnh cưới của rất nhiều cặp đôi sáng tạo khi đến với Artinus.', '200.000 - 300.000đ', 33, '9h - 22h'),
(11, 'Tòa nhà Bitexco', 'Số 19-25 Nguyễn Huệ, Phường Bến Nghé, Quận 1', 'Tòa nhà Bitexco hay còn gọi là Tháp tài chính Bitexco, đây là một trong những tòa nhà cao nhất ở thành phố Hồ Chí Minh từ những năm 2010, sau này đã có tòa tháp khác cao hơn như Landmark 81 nhưng Bitexco mãi là một trong những biểu tượng của Sài Thành, đánh dấu cho sự phát triển mới của thành phố mang tên Bác.\r\n\r\nTòa nhà Bitexco có sân đậu trực thăng đầu tiên ở Việt Nam được đặt trên tầng 52, nơi đây còn là một trong những trung tâm thương mại sang trọng bậc nhất Sài Gòn. Có cơ hội ghé đến đây, bạn sẽ choáng ngợp với không gian hiện đại và sang chảnh của tòa nhà, bên cạnh đó thì bên ngoài tòa nhà cũng là một trong những background ấn tượng nhất thu hút rất nhiều giới trẻ ghé đến.', 'Miễn Phí Vé Vào Cổng', 33, '9h - 22h'),
(12, 'Công viên nước Đầm Sen', 'Số 3 Hòa Bình, phường 3, quận 11', 'Nhắc đến du lịch Sài Gòn tất nhiên cũng phải nhắc đến công viên nước Đầm Sen - một trong các khu du lịch ở Sài Gòn được yêu thích dành cho mọi lứa tuổi. Công viên nước Đầm Sen có diện tích lên đến 3000m2, là một trong những điểm nên đến ở Sài Gòn thu hút rất nhiều người dân và du khách.\r\n\r\nNơi đây được chia thành 2 khu công viên văn hóa là nơi tổ chức các sự kiện văn hóa, quảng bá, nhạc kịch,... và khu công viên nước là nơi có rất nhiều trò chơi hấp dẫn như tàu lượn siêu tốc, trượt nước, hồ bơi, nhà phao,... Ngoài ra, nơi đây còn có thủy cung là nơi sinh sống của hàng nghìn cá thể dưới nước rất thú vị.', '80.000đ - 150.000đ', 33, '9h - 18h'),
(14, 'Asia Park', '1 Phan Đăng Lưu, Hòa Cường Bắc, Hải Châu', 'Công viên châu Á - Asia Park - một trong những khu vui chơi giải trí ở Đà Nẵng hot nhất mà bạn không thể bỏ lỡ. Nơi đây có Sun Wheel nằm trong top 10 vòng quay cao nhất thế giới và được xem như một trong những biểu tượng của Đà Nẵng. Nếu bạn là người thích mạo hiểm, ở đây cũng có hàng loạt những trò chơi cảm giác mạnh về đêm như tháp rơi tự do - Golden Sky Tower, tàu điện trên cao - Monorail, tàu lượn dạng treo - Queen Cobram,...\r\n\r\nHay nếu muốn có một tấm ảnh xịn sò, đừng quên check in ở Tháp đồng hồ 9 mặt với lối kiến trúc độc đáo của nhiều quốc gia khác nhau. Bên cạnh đó, những lễ hội cũng thường xuyên được tổ chức tại Sun World Danang Wonders cho bạn cơ hội khám phá văn hoá châu Á ngay t', '80.000đ - 150.000đ/người', 19, 'Từ thứ 2 đến thứ 6: 15h00 - 22h00. Thứ 7 và chủ nhật: 09h00 - 22h00'),
(15, 'Hòa Phú Thành', 'Quốc lộ 14G, xã Hòa Phú, huyện Hòa Vang,', 'Hòa Phú Thành là một khu du lịch rất nổi tiếng trong những năm gần đây tại Đà Nẵng. Đây là nơi kết hợp giữa 3 yếu tố là vui chơi, nghỉ dưỡng và trải nghiệm. Các du khách đến đây, đặc biệt là các bạn trẻ ưa mạo hiểm sẽ được tham gia các trò chơi thú vị như trượt thác, massage cá, trượt Zipline,...Nổi tiếng nhất là trò chơi trượt thác. Bạn sẽ có một hành trình vượt thác đầy thú vị dài 3km qua những ghềnh thác với những độ cao khác nhau.\r\n\r\nNgoài ra còn có trò trượt dây cáp Zipline. Đây là đường trượt cáp đầu tiên tại Đà Nẵng với độ an toàn cao, trẻ em cũng có thể chơi được. Độ dài hai đường trượt là 350m. Còn khi tham gia trò massage cá bạn sẽ được những con cá không có răng dùng miệng hút hết', 'Vé vào cổng 100.000đ/vé, trẻ em dưới 1.2m: miễn phí. Vé trượt thác: 250.000đ/vé. Zipline: 50.000đ/vé', 19, '7h - 16h'),
(16, 'Chùa Ông', '676 đường Nguyễn Trãi,11,5', 'Chùa Ông Quận 5 hay còn được gọi là miếu Quan Đế hay Nghĩa An Hội Quán. Đây không chỉ là nơi chiêm bái của người Hoa gốc Triều Châu tại Sài Gòn mà còn được xem như một công trình kiến trúc độc đáo ở nửa cuối thế kỷ XIX - đầu thế kỷ XX. Do đó, ngày 7 tháng 11 năm 1993, chùa Ông đã được Bộ Văn hóa - Thông tin công nhận là di tích kiến trúc nghệ thuật cấp quốc gia. ', 'Miễn Phí Vé Vào Cổng', 33, '7h - 19h30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dondatphong`
--

DROP TABLE IF EXISTS `dondatphong`;
CREATE TABLE IF NOT EXISTS `dondatphong` (
  `UIDDatPhong` char(50) NOT NULL COMMENT 'CMNDKH_UIDKS',
  `EmailKH` char(100) NOT NULL,
  `NgayDatPhong` date DEFAULT NULL,
  `isChecked` int NOT NULL DEFAULT '0',
  `TienCoc` float DEFAULT NULL,
  `tongtien` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`UIDDatPhong`),
  KEY `FK_KH_DDP` (`EmailKH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `dondatphong`
--

INSERT INTO `dondatphong` (`UIDDatPhong`, `EmailKH`, `NgayDatPhong`, `isChecked`, `TienCoc`, `tongtien`) VALUES
('079201018856-079201018856_0908644888-20230602', 'tuan60847@gmail.com', '2023-06-02', 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanhdddl`
--

DROP TABLE IF EXISTS `hinhanhdddl`;
CREATE TABLE IF NOT EXISTS `hinhanhdddl` (
  `src` char(255) NOT NULL,
  `MaDDDL` int NOT NULL,
  PRIMARY KEY (`src`),
  KEY `hinhanh_DDDL` (`MaDDDL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `hinhanhdddl`
--

INSERT INTO `hinhanhdddl` (`src`, `MaDDDL`) VALUES
('image/diadiemdulich/BuFFwQxHfUTfGqBRuAejOJ84lLKAEu48k3soofKU.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanhks`
--

DROP TABLE IF EXISTS `hinhanhks`;
CREATE TABLE IF NOT EXISTS `hinhanhks` (
  `src` varchar(250) NOT NULL DEFAULT '',
  `UIDKS` char(30) NOT NULL,
  PRIMARY KEY (`src`),
  KEY `FK_HINHANH_KS` (`UIDKS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `hinhanhks`
--

INSERT INTO `hinhanhks` (`src`, `UIDKS`) VALUES
('image/khachsan/IaxNPtMCEEcLSawLc4oV4jOK7DgJUlNSedpYwF2R.jpg', '079201018852_0907344682'),
('image/khachsan/EbRzU5DxXFoQleniiDOKPmPXkQcCVbyw0fbX5OLI.jpg', '079201018856_0908644888');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanhloaiphong`
--

DROP TABLE IF EXISTS `hinhanhloaiphong`;
CREATE TABLE IF NOT EXISTS `hinhanhloaiphong` (
  `src` char(255) NOT NULL,
  `UIDLoaiPhong` int NOT NULL,
  PRIMARY KEY (`src`),
  KEY `FK_HINHANH_LoaiPhong` (`UIDLoaiPhong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `hinhanhloaiphong`
--

INSERT INTO `hinhanhloaiphong` (`src`, `UIDLoaiPhong`) VALUES
('image/loaiphong/ymdZoYcrWh53deCTJOpylcIhs8LZKWy3ZJ8lWTTp.jpg', 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanhsukien`
--

DROP TABLE IF EXISTS `hinhanhsukien`;
CREATE TABLE IF NOT EXISTS `hinhanhsukien` (
  `src` char(255) NOT NULL,
  `MaSuKien` int NOT NULL,
  PRIMARY KEY (`src`),
  KEY `hinhanhsukien_SuKien` (`MaSuKien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `hinhanhsukien`
--

INSERT INTO `hinhanhsukien` (`src`, `MaSuKien`) VALUES
('image/sukien/jNJW0IKETkDaqhh5hlpRgrn70aV77eTYwXzFRMhN.jpg', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanhtp`
--

DROP TABLE IF EXISTS `hinhanhtp`;
CREATE TABLE IF NOT EXISTS `hinhanhtp` (
  `src` char(255) NOT NULL,
  `MaTP` int NOT NULL,
  PRIMARY KEY (`src`),
  KEY `FK_HinhAnhTP` (`MaTP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `hinhanhtp`
--

INSERT INTO `hinhanhtp` (`src`, `MaTP`) VALUES
('image/thanhpho/JM6UCDkTU1L551cSUneg8tlDBMdVIVPmDqoYQQRE.jpg', 1),
('image/thanhpho/TlsDshl1MVMmZlAh0PaGpq4vx9sVIbh7mlloNhO7.jpg', 1),
('image/thanhpho/XeXFhinxq4DjU2uNmeLLt4xjb9YHftRJmZAIDy6p.jpg', 1),
('image/thanhpho/JvuN7gLP8gZED1BWbfWtpBoeX0kZ2We1ywGSdOpV.jpg', 33);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `Email` char(100) NOT NULL,
  `Password` char(100) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `NgaySinh` date NOT NULL,
  `SDT` char(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cmnd` char(13) NOT NULL,
  `isDatPhong` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`Email`, `Password`, `HoTen`, `NgaySinh`, `SDT`, `cmnd`, `isDatPhong`) VALUES
('hello123@gmail.com', 'vipkute517', 'tuanhoang', '2004-01-13', '0907344681', '079201015586', 0),
('tuan60847@gmail.com', 'vipkute517', 'Let Hoang Tuan', '2001-07-21', '0907344681', '079201018856', 1),
('tuanhoang60847@gmail.com', 'vipkute517', 'Lê Hoàng Tuấn', '0000-00-00', '0908644888', '079201018856', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachsan`
--

DROP TABLE IF EXISTS `khachsan`;
CREATE TABLE IF NOT EXISTS `khachsan` (
  `UIDKS` char(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Email_SDT',
  `TenKS` varchar(150) NOT NULL,
  `DiaChi` varchar(300) NOT NULL,
  `SDT` char(12) NOT NULL,
  `Buffet` tinyint(1) NOT NULL DEFAULT '0',
  `Wifi` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL,
  `MaDDDL` int NOT NULL,
  PRIMARY KEY (`UIDKS`),
  KEY `MaDDDL` (`MaDDDL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `khachsan`
--

INSERT INTO `khachsan` (`UIDKS`, `TenKS`, `DiaChi`, `SDT`, `Buffet`, `Wifi`, `isActive`, `MaDDDL`) VALUES
('079201018852_0907344682', 'hellobay by 12345', 'Tinh Tu,15,1,Hồ Chí Minh', '0907344683', 1, 1, 0, 1),
('079201018856_0908644888', 'Khách Sạn Thiên Đường', '90 ,Cô Giang,1,Đà Nẵng', '0907344682', 1, 0, 1, 14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaiphong`
--

DROP TABLE IF EXISTS `loaiphong`;
CREATE TABLE IF NOT EXISTS `loaiphong` (
  `UIDLoaiPhong` int NOT NULL AUTO_INCREMENT,
  `TenLoaiPhong` varchar(150) NOT NULL,
  `Gia` float NOT NULL,
  `UIDKS` char(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `soGiuong` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `soLuongPhong` int NOT NULL DEFAULT '1',
  `isMayLanh` tinyint(1) NOT NULL,
  PRIMARY KEY (`UIDLoaiPhong`),
  KEY `FK_KS_LoaiPhong` (`UIDKS`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `loaiphong`
--

INSERT INTO `loaiphong` (`UIDLoaiPhong`, `TenLoaiPhong`, `Gia`, `UIDKS`, `soGiuong`, `soLuongPhong`, `isMayLanh`) VALUES
(20, 'KingBedRoom', 500000, '079201018856_0908644888', '2  Single Bed', 10, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongconlai`
--

DROP TABLE IF EXISTS `phongconlai`;
CREATE TABLE IF NOT EXISTS `phongconlai` (
  `index` int NOT NULL AUTO_INCREMENT,
  `Ngay` date NOT NULL,
  `SoLuong` int NOT NULL,
  `UIDLoaiPhong` int NOT NULL,
  PRIMARY KEY (`index`),
  KEY `phongconlai_loaiphong` (`UIDLoaiPhong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sukien`
--

DROP TABLE IF EXISTS `sukien`;
CREATE TABLE IF NOT EXISTS `sukien` (
  `maSuKien` int NOT NULL AUTO_INCREMENT,
  `TenSuKien` varchar(250) NOT NULL,
  `Mota` varchar(700) DEFAULT '',
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `MaDDDL` int NOT NULL,
  PRIMARY KEY (`maSuKien`),
  KEY `sukien_DDDL` (`MaDDDL`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `sukien`
--

INSERT INTO `sukien` (`maSuKien`, `TenSuKien`, `Mota`, `NgayBatDau`, `NgayKetThuc`, `MaDDDL`) VALUES
(2, 'Hội chùa Ông - Lễ hội truyền thống ở HCM', 'Lễ hội chùa Ông là một trong các lễ hội ở thành phố Hồ Chí Minh gắn liền với sinh hoạt văn hóa tín ngưỡng của người Hoa gốc Triều Châu ở Sài Gòn. Lễ hội HCM diễn ra vào ngày 24/6 âm lịch hàng năm, bao gồm lễ thỉnh và cung nghinh các vị thần, thánh như: Nguyễn Hữu Cảnh, Lỗ Ban Tiên sư, Trần Thượng Xuyên, Thiên Hậu Thánh mẫu, Thành hoàng bổn cảnh…\r\n\r\nDu khách khi đến đây sẽ được chiêm ngưỡng các buổi biểu diễn tuồng cổ, đờn ca tài tử, múa lân - sư - rồng hoặc tham gia các trò chơi dân gian. Ngoài ra, trong dịp Tết Nguyên Tiêu và ngày vía Bạch Hổ, chùa Ông Quận 5 cũng thu hút rất nhiều du khách đến tham quan, chụp ảnh, chiêm bái.', '2023-08-10', NULL, 16);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhpho`
--

DROP TABLE IF EXISTS `thanhpho`;
CREATE TABLE IF NOT EXISTS `thanhpho` (
  `MaTP` int NOT NULL AUTO_INCREMENT,
  `TenTP` varchar(200) NOT NULL,
  `mota` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT ' ',
  PRIMARY KEY (`MaTP`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `thanhpho`
--

INSERT INTO `thanhpho` (`MaTP`, `TenTP`, `mota`) VALUES
(1, 'Bà Rịa', 'Thành phố Bà Rịa có tọa độ địa lý từ 10°30\' đến 10°50\' vĩ độ Bắc, từ 107°10\' đến 107°17\' kinh độ Đông, cách Thành phố Hồ Chí Minh 75 km về phía Đông Nam, cách thành phố Vũng Tàu 20 km về phía Bắc.\n\nĐịa giới hành chính thành phố Bà Rịa:\n\nPhía Đông giáp huyện Đất Đỏ\nPhía Đông Nam giáp huyện Long Điền\nPhía Tây và Tây Bắc giáp thị xã Phú Mỹ\nPhía Nam giáp thành phố Vũng Tàu\nPhía Bắc giáp huyện Châu Đức.\nThành phố Bà Rịa có diện tích 91,46 km² với dân số tính đến năm 2022 là 235.192 người.'),
(2, 'Bạc Liêu', 'Bạc Liêu là thành phố tỉnh lỵ của tỉnh Bạc Liêu, Việt Nam. Thành phố nằm ở phía đông tỉnh Bạc Liêu, bên bờ rạch Bạc Liêu. Trung tâm thành phố cách biển 10 km và là trung tâm hành chính và đầu mối giao lưu trong và ngoài tỉnh, cơ cấu kinh tế của thành phố là thương mại - dịch vụ - công nghiệp và nông nghiệp. Hiện nay, thành phố Bạc Liêu là đô thị loại II.'),
(3, 'Bảo Lộc ', 'Bảo Lộc thuộc tỉnh Lâm Đồng vốn được mệnh danh là mảnh đất trù phú, có thế mạnh về công nghiệp sản xuất chè bởi độ cao rất thuận lợi cho cây chè phát triển. Đặc biệt, mảnh đất này là thủ phủ của ngành tơ lụa Việt Nam và. Hiện nay, thành phố Bảo Lộc đang được xếp hạng là đô thị loại III và đang trên đường trở thành đô thị loại II.\nBảo Lộc là thành phố trực thuộc tỉnh Lâm Đồng, nằm ở vùng Tây Nguyên của Việt Nam. Tuy nhiên hiện tại thành phố này không phải là tỉnh lỵ của Lâm Đồng mà Đà Lạt mới là tỉnh lỵ của Lâm Đồng. Thành phố nằm trọn vẹn trên cao nguyên Di Linh, ở độ cao trung bình 900m so với mực nước biển.'),
(4, 'Bắc Giang ', ''),
(5, 'Bắc Kạn ', ''),
(6, 'Bắc Ninh ', ''),
(7, 'Bến Tre', ''),
(8, 'Biên Hòa ', ''),
(9, 'Buôn Ma Thuột ', ''),
(10, 'Cà Mau ', ''),
(11, 'Cam Ranh ', ''),
(12, 'Cao Bằng', ''),
(13, 'Cao Lãnh', ''),
(14, 'Cẩm Phả', ''),
(15, 'Cần Thơ', ''),
(16, 'Châu Đốc', ''),
(17, 'Dĩ An', ''),
(18, 'Đà Lạt', ''),
(19, 'Đà Nẵng', ''),
(20, 'Điện Biên Phủ', ''),
(21, 'Đông Hà', ''),
(22, 'Đồng Hới', ''),
(23, 'Đồng Xoài ', ''),
(24, 'Gia Nghĩa', ''),
(25, 'Hà Giang', ''),
(26, 'Hạ Long', ''),
(27, 'Hà Nội', ''),
(28, 'Hà Tiên', ''),
(29, 'Hà Tĩnh', ''),
(30, 'Hải Dương', ''),
(31, 'Hải Phòng', ''),
(32, 'Hòa Bình', ''),
(33, 'Hồ Chí Minh', ''),
(34, 'Hội An', ''),
(35, 'Hồng Ngự', ''),
(36, 'Huế', ''),
(37, 'Hưng Yên', ''),
(38, 'Kon Tum', ''),
(39, 'Lai Châu', ''),
(40, 'Lạng Sơn', ''),
(41, 'Lào Cai', ''),
(42, 'Long Khánh', ''),
(43, 'Long Xuyên', ''),
(44, 'Móng Cái', ''),
(45, 'Mỹ Tho', ''),
(46, 'Nam Định', ''),
(47, 'Ninh Bình', ''),
(48, 'Ngã Bảy', ''),
(49, 'Nha Trang', ''),
(50, 'Pleiku', ''),
(51, 'Phan Rang - Tháp Chàm', ''),
(52, 'Phan Thiết', ''),
(53, 'Phủ Lý', ''),
(54, 'Phú Quốc', ''),
(55, 'Phúc Yên', ''),
(56, 'Quảng Ngãi', ''),
(57, 'Quy Nhơn', ''),
(58, 'Rạch Giá', ''),
(59, 'Sa Đéc', ''),
(60, 'Sầm Sơn', ''),
(61, 'Sóc Trăng', ''),
(62, 'Sông Công', ''),
(63, 'Sơn La', ''),
(64, 'Tam Điệp', ''),
(65, 'Tam Kỳ', ''),
(66, 'Tân An', ''),
(67, 'Tây Ninh', ''),
(68, 'Tuy Hòa', ''),
(69, 'Tuyên Quang', ''),
(70, 'Thái Bình', ''),
(71, 'Thái Nguyên', ''),
(72, 'Thanh Hóa', ''),
(73, 'Thủ Dầu Một', ''),
(74, 'Thủ Đức', ''),
(75, 'Thuận An', ''),
(76, 'Trà Vinh', ''),
(77, 'Uông Bí', ''),
(78, 'Vị Thanh', ''),
(79, 'Việt Trì', ''),
(80, 'Vinh', ''),
(81, 'Vĩnh Long', ''),
(82, 'Vĩnh Yên', ''),
(83, 'Vũng Tàu', ''),
(84, 'Yên Bái', '');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ctddp`
--
ALTER TABLE `ctddp`
  ADD CONSTRAINT `FK_CTDDP_DDP` FOREIGN KEY (`MaDDP`) REFERENCES `dondatphong` (`UIDDatPhong`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_CTDDP_LP` FOREIGN KEY (`UIDLoaiPhong`) REFERENCES `loaiphong` (`UIDLoaiPhong`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `diadiemdulich`
--
ALTER TABLE `diadiemdulich`
  ADD CONSTRAINT `FK_diadiemdulich_Tp` FOREIGN KEY (`MaTP`) REFERENCES `thanhpho` (`MaTP`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `dondatphong`
--
ALTER TABLE `dondatphong`
  ADD CONSTRAINT `FK_KH_DDP` FOREIGN KEY (`EmailKH`) REFERENCES `khachhang` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `hinhanhdddl`
--
ALTER TABLE `hinhanhdddl`
  ADD CONSTRAINT `hinhanh_DDDL` FOREIGN KEY (`MaDDDL`) REFERENCES `diadiemdulich` (`MaDDDL`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `hinhanhks`
--
ALTER TABLE `hinhanhks`
  ADD CONSTRAINT `FK_HINHANH_KS` FOREIGN KEY (`UIDKS`) REFERENCES `khachsan` (`UIDKS`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `hinhanhloaiphong`
--
ALTER TABLE `hinhanhloaiphong`
  ADD CONSTRAINT `FK_HINHANH_LoaiPhong` FOREIGN KEY (`UIDLoaiPhong`) REFERENCES `loaiphong` (`UIDLoaiPhong`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `hinhanhsukien`
--
ALTER TABLE `hinhanhsukien`
  ADD CONSTRAINT `hinhanhsukien_SuKien` FOREIGN KEY (`MaSuKien`) REFERENCES `sukien` (`maSuKien`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `hinhanhtp`
--
ALTER TABLE `hinhanhtp`
  ADD CONSTRAINT `FK_HinhAnhTP` FOREIGN KEY (`MaTP`) REFERENCES `thanhpho` (`MaTP`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `khachsan`
--
ALTER TABLE `khachsan`
  ADD CONSTRAINT `khachsan_chuKS` FOREIGN KEY (`UIDKS`) REFERENCES `chukhachsan` (`ADMINKS`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `khachsan_ibfk_1` FOREIGN KEY (`MaDDDL`) REFERENCES `diadiemdulich` (`MaDDDL`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `loaiphong`
--
ALTER TABLE `loaiphong`
  ADD CONSTRAINT `FK_KS_LoaiPhong` FOREIGN KEY (`UIDKS`) REFERENCES `khachsan` (`UIDKS`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `phongconlai`
--
ALTER TABLE `phongconlai`
  ADD CONSTRAINT `phongconlai_loaiphong` FOREIGN KEY (`UIDLoaiPhong`) REFERENCES `loaiphong` (`UIDLoaiPhong`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `sukien`
--
ALTER TABLE `sukien`
  ADD CONSTRAINT `sukien_DDDL` FOREIGN KEY (`MaDDDL`) REFERENCES `diadiemdulich` (`MaDDDL`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
