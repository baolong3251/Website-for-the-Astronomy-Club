-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 10, 2021 lúc 09:51 AM
-- Phiên bản máy phục vụ: 10.4.16-MariaDB
-- Phiên bản PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `csdl_clb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chart_data`
--

CREATE TABLE `chart_data` (
  `chart_id` int(11) NOT NULL,
  `year` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `month` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `view` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `chart_data`
--

INSERT INTO `chart_data` (`chart_id`, `year`, `month`, `view`) VALUES
(3, '2020', 'Tháng 1', '500'),
(4, '2020', 'Tháng 2', '300'),
(5, '2020', 'Tháng 3', '900'),
(6, '2020', 'Tháng 4', '800'),
(7, '2020', 'Tháng 5', '666'),
(8, '2020', 'Tháng 6', '662'),
(9, '2020', 'Tháng 7', '500'),
(10, '2020', 'Tháng 8', '800'),
(11, '2020', 'Tháng 9', '200'),
(12, '2020', 'Tháng 10', '600'),
(13, '2020', 'Tháng 11', '111'),
(14, '2020', 'Tháng 12', '333'),
(15, '2021', 'Tháng 5', '500'),
(16, '2021', 'Tháng 6', '747');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_parent` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_value` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `comment_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_parent`, `user_id`, `post_id`, `comment_value`, `comment_point`) VALUES
(59, 0, 1, 35, 'hay\r\n', 1),
(60, 59, 1, 35, 'chào', 0),
(65, 0, 1, 35, 'aaaaa', 0),
(68, 0, 3, 35, 'hay đấy', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `img_name` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`img_id`, `img_name`, `post_id`) VALUES
(41, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523700.jpeg', 65),
(42, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523648.jpeg', 65),
(43, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523612.jpeg', 65),
(44, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523576.jpeg', 65),
(45, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523515.jpeg', 65),
(46, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523458.jpeg', 65),
(47, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523420.jpeg', 65),
(48, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523369.jpeg', 65),
(49, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523310.jpeg', 65),
(50, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523262.jpeg', 65),
(51, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523077.jpeg', 65),
(52, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523212.jpeg', 65),
(53, '23-buc-anh-tuyet-dep-gui-den-tu-vu-tru-docx-1588426523158.jpeg', 65);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `point_categories`
--

CREATE TABLE `point_categories` (
  `point_cat_id` int(11) NOT NULL,
  `point_name` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `point_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `point_categories`
--

INSERT INTO `point_categories` (`point_cat_id`, `point_name`, `point_value`) VALUES
(1, 'View', 1),
(2, 'Like', 10),
(3, 'Dislike', -5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_name` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `post_content` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `post_view` int(11) NOT NULL,
  `post_like` int(11) NOT NULL,
  `post_dislike` int(11) NOT NULL,
  `post_type` int(5) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_exp_date` datetime NOT NULL,
  `post_stat` int(11) NOT NULL,
  `post_point` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `post_name`, `post_content`, `post_view`, `post_like`, `post_dislike`, `post_type`, `post_date`, `post_exp_date`, `post_stat`, `post_point`) VALUES
(35, 1, 'Sao tối: hạt giống của các lỗ đen siêu nặng?', '<p style=\"text-align:center\"><img alt=\"\" src=\"images/darkstars.jpg\" /></p>\r\n\r\n<p>Sao tối l&agrave; những đối tượng l&yacute; thuyết được cho l&agrave; hoạt động nhờ vật chất tối v&agrave; c&oacute; thể đ&atilde; tồn tại trong giai đoạn sớm của vũ trụ. Nếu ch&uacute;ng tồn tại, những con qu&aacute;i vật b&iacute; ẩn n&agrave;y sẽ kh&ocirc;ng chỉ l&agrave; những ng&ocirc;i sao đầu ti&ecirc;n của vũ trụ, ch&uacute;ng c&ograve;n c&oacute; thể giải th&iacute;ch cho sự xuất hiện của c&aacute;c lỗ đen si&ecirc;u nặng.</p>\r\n\r\n<p><strong>Ch&aacute;y s&aacute;ng nhờ vật chất tối</strong></p>\r\n\r\n<p>C&aacute;c sao th&ocirc;ng thường đều hoạt động theo c&ugrave;ng một c&aacute;ch: nhiệt hạch. C&aacute;c sao l&agrave; những vật thể nặng tới mức ch&uacute;ng lu&ocirc;n c&oacute; nguy cơ sụp đổ v&agrave;o ch&iacute;nh m&igrave;nh. Nhưng trong khi lực hấp dẫn siết chặt một ng&ocirc;i sao lại, n&oacute; tạo ra lượng nhiệt trong l&otilde;i sao nhiều tới mức nghiền n&aacute;t c&aacute;c nguy&ecirc;n tử v&agrave; giải ph&oacute;ng ra năng lượng. Năng lượng n&agrave;y g&acirc;y ra &aacute;p suất hướng ra ngo&agrave;i đủ lớn để c&acirc;n bằng với sự sụp đổ do hấp dẫn của ng&ocirc;i sao.</p>\r\n\r\n<p>Nhưng với c&aacute;c sao tối, c&acirc;u chuyện c&oacute; kh&aacute;c đ&ocirc;i ch&uacute;t.</p>\r\n\r\n<p>L&yacute; thuyết gợi &yacute; rằng c&aacute;c sao tối (*) được tạo th&agrave;nh hầu hết bởi vật chất tương tự như ở sao b&igrave;nh thường - chủ yếu l&agrave; hydro v&agrave; heli. Nhưng bởi c&aacute;c sao tối về l&yacute; thuyết th&igrave; h&igrave;nh th&agrave;nh trong vũ trụ sơ khai, khi m&agrave; vũ trụ đặc hơn nhiều, ch&uacute;ng cũng c&oacute; thể chứa một phần nhỏ vật chất tối dưới dạng c&aacute;c hạt nặng tương t&aacute;c yếu (viết tắt l&agrave; WIMP) - loại hạt được cho l&agrave; th&agrave;nh phần ch&iacute;nh của vật chất tối.</p>\r\n\r\n<p>Những hạt WIMP n&agrave;y được cho l&agrave; c&oacute; thể tương t&aacute;c với nhau như với phản hạt của ch&iacute;nh ch&uacute;ng, tức l&agrave; một hạt c&oacute; thể tương t&aacute;c với hạt kh&aacute;c v&agrave; hủy lẫn nhau để sinh ra năng lượng. Trong một sao tối, năng lượng khổng lồ từ sự ti&ecirc;u hủy của c&aacute;c hạt WIMP c&oacute; thể cung cấp một &aacute;p suất hướng ra ngo&agrave;i đủ lớn để ngăn sự co lại m&agrave; kh&ocirc;ng cần tới qu&aacute; tr&igrave;nh nhiệt hạch ở l&otilde;i.</p>\r\n\r\n<p>Theo nh&agrave; nghi&ecirc;n cứu sao tối Katherine Freese ở UT-Austin (Đại học Texas đặt tại Austin - Mỹ), c&aacute;c hạt WIMP chỉ chiếm khoảng 0,1% tổng khối lượng của sao. Nhưng chỉ một phần nhỏ như vậy cũng c&oacute; thể giữ cho sao tối giữ được trạng th&aacute;i như vậy trong h&agrave;ng triệu hay thậm ch&iacute; c&oacute; thể l&agrave; h&agrave;ng tỷ năm.</p>\r\n\r\n<p><strong>C&aacute;c sao tối tr&ocirc;ng ra sao?</strong></p>\r\n\r\n<p>Sao tối kh&ocirc;ng chỉ h&agrave;nh xử kh&aacute;c với sao b&igrave;nh thường m&agrave; h&igrave;nh dạng của ch&uacute;ng cũng kh&aacute;c.</p>\r\n\r\n<p>V&igrave; c&aacute;c sao tối kh&ocirc;ng phụ thuộc v&agrave;o nhiệt hạch ở l&otilde;i để chống lại sự sụp đổ hấp dẫn, ch&uacute;ng kh&ocirc;ng bị n&eacute;n chặt như c&aacute;c sao b&igrave;nh thường. Thay v&agrave;o đ&oacute;, sao tối giống như những đ&aacute;m m&acirc;y khổng lồ, phồng to v&agrave; rất s&aacute;ng. Theo Freese, v&igrave; đặc điểm đ&oacute;, c&aacute;c sao tối thậm ch&iacute;&nbsp;c&oacute; thể c&oacute; đường k&iacute;nh l&ecirc;n tới 10 đơn vị thi&ecirc;n văn (10 AU) - tức l&agrave; bằng 10 lần khoảng c&aacute;ch từ Tr&aacute;i Đất tới Mặt Trời.</p>\r\n\r\n<p>&quot;Ch&uacute;ng sẽ tiếp tục lớn l&ecirc;n chừng n&agrave;o vẫn c&ograve;n nhi&ecirc;n liệu vật chất tối,&quot; Freese n&oacute;i. &quot;Ch&uacute;ng t&ocirc;i cho rằng ch&uacute;ng c&oacute; thể đạt tới 10 triệu lần khối lượng Mặt Trời v&agrave; s&aacute;ng gấp Mặt Trời 10 tỷ lần. Nhưng ch&uacute;ng t&ocirc;i kh&ocirc;ng biết chắc. Về nguy&ecirc;n l&yacute; th&igrave; kh&ocirc;ng c&oacute; giới hạn n&agrave;o cả.&quot;</p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"\" src=\"images/darkstarwimps.jpg\" /></p>\r\n\r\n<p style=\"text-align:center\"><em>H&igrave;nh vẽ m&ocirc; tả của Astronomy.com về va chạm v&agrave; ti&ecirc;u hủy lẫn nhau của c&aacute;c WIMP (tr&aacute;i) v&agrave; h&igrave;nh dạng cơ bản của sao tối (phải).</em></p>\r\n\r\n<p><strong>T&igrave;m kiếm sao tối</strong></p>\r\n\r\n<p>Một trong những r&agrave;o cản trong việc chứng minh sự tồn tại của sao tối l&agrave; ch&uacute;ng sống phụ thuộc v&agrave;o sự ti&ecirc;u hủy vật chất tối. Tuy nhi&ecirc;n, sự ti&ecirc;u hủy n&agrave;y chủ yếu xảy ra trong giai đoạn rất sớm của vũ trụ, khi m&agrave; c&aacute;c hạt vật chất tối c&ograve;n ở rất gần nhau. V&igrave; vậy, để t&igrave;m kiếm sao tối, ch&uacute;ng ta cần những k&iacute;nh thi&ecirc;n văn đủ mạnh để nh&igrave;n v&agrave;o qu&aacute; khứ rất xa.</p>\r\n\r\n<p>Theo Freese, điều may mắn l&agrave; k&iacute;nh thi&ecirc;n văn kh&ocirc;ng gian James Webb sắp đi v&agrave;o hoạt động c&oacute; thể đủ khả năng ph&aacute;t hiện c&aacute;c sao tối.</p>\r\n\r\n<p>&quot;Ch&uacute;ng sẽ ho&agrave;n to&agrave;n kh&aacute;c với c&aacute;c sao n&oacute;ng,&quot; Freese n&oacute;i. &quot;C&aacute;c sao tối rất lạnh (khoảng 9.700 độ C). V&igrave; thế, về tần số của &aacute;nh s&aacute;ng th&igrave; ch&uacute;ng sẽ giống với những sao như Mặt Trời hơn, d&ugrave; ch&uacute;ng s&aacute;ng hơn nhiều. Sự kết hợp của lạnh v&agrave; s&aacute;ng như vậy rất kh&oacute; giải th&iacute;ch đối với c&aacute;c thi&ecirc;n thể kh&aacute;c.&quot;</p>\r\n\r\n<p>&quot;Thật l&agrave; một viễn cảnh th&uacute; vị khi m&agrave; một loại sao ho&agrave;n to&agrave;n mới c&oacute; thể sẽ được kh&aacute;m ph&aacute; ra trong dữ liệu sắp c&oacute;,&quot; Freese v&agrave; c&aacute;c đồng nghiệp của b&agrave; viết trong một b&agrave;i b&aacute;o.</p>\r\n\r\n<p><strong>Hạt giống của c&aacute;c lỗ đen si&ecirc;u nặng</strong></p>\r\n\r\n<p>Nếu c&aacute;c nh&agrave; nghi&ecirc;n cứu c&oacute; thể t&igrave;m ra bằng chứng về sự tồn tại của sao tối, điều đ&oacute; sẽ thay đổi c&aacute;ch m&agrave; ch&uacute;ng ta nghĩ về những giai đoạn sớm của vũ trụ. C&aacute;c sao tối sẽ nhanh ch&oacute;ng trở th&agrave;nh ứng cử vi&ecirc;n h&agrave;ng đầu cho thế hệ sao đầu ti&ecirc;n khi m&agrave; ch&uacute;ng h&igrave;nh th&agrave;nh v&agrave;o thời điểm chỉ khoảng 200 triệu năm sau Big Bang.</p>\r\n\r\n<p>C&aacute;c sao tối cũng c&oacute; thể giải th&iacute;ch một trong những c&acirc;u hỏi h&oacute;c b&uacute;a nhất trong vũ trụ học: C&aacute;c lỗ đen si&ecirc;u nặng h&igrave;nh th&agrave;nh như thế n&agrave;o?</p>\r\n\r\n<p>&quot;Nếu một sao tối c&oacute; khối lượng h&agrave;ng triệu lần Mặt Trời được t&igrave;m thấy (bởi k&iacute;nh James Webb) ở thời điểm rất sớm, th&igrave; r&otilde; r&agrave;ng một vật thể như thế sẽ trở th&agrave;nh một lỗ đen,&quot; Freese n&oacute;i. &quot;Sau đ&oacute;, những thứ n&agrave;y c&oacute; thể hợp nhất với nhau v&agrave; tạo th&agrave;nh c&aacute;c lỗ đen si&ecirc;u nặng. Một kịch bản rất hợp l&yacute;!&quot;</p>\r\n\r\n<p><strong>Bryan</strong></p>\r\n\r\n<p><em>Dịch từ Astronomy</em></p>\r\n\r\n<p>(*) Sao tối l&agrave; thuật ngữ dịch ra từ &quot;dark star&quot;, &yacute; l&agrave; sao hoạt động nhờ vật chất tối, mặc d&ugrave; n&oacute; vẫn rất s&aacute;ng.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 252, 2, 1, 1, '2021-05-31 07:00:47', '0000-00-00 00:00:00', 0, -2285.578424195),
(60, 5, 'Xin chào', '<p>T&ocirc;i chỉ muốn ch&agrave;o mọi người th&ocirc;i ^^</p>\r\n', 0, 0, 0, 1, '2021-06-07 16:09:41', '0000-00-00 00:00:00', 1, 0),
(63, 5, ' 			Tính khối lượng Mặt Trời từ quỹ đạo Mặt Trăng		', '<p><img alt=\"\" src=\"images/sun-moon.jpg\" /></p>\r\n\r\n<p>C&aacute;c nh&agrave; thi&ecirc;n văn đo khối lượng của c&aacute;c thi&ecirc;n thể ở xa như thế n&agrave;o? Sau đ&acirc;y l&agrave; một v&iacute; dụ: sử dụng quỹ đạo Mặt Trăng để t&igrave;m ra khối lượng của Mặt Trời.</p>\r\n\r\n<p>Thật kh&oacute; để h&igrave;nh dung xem hiểu biết về Hệ Mặt Trời của ch&uacute;ng ta sẽ ra sao nếu như kh&ocirc;ng c&oacute; đồng h&agrave;nh của ch&uacute;ng ta l&agrave; Mặt Trăng. Quỹ đạo của Mặt Trăng cung cấp cho ch&uacute;ng ta cơ sở v&agrave; ti&ecirc;u chuẩn cần c&oacute; để giải quyết nhiều b&agrave;i to&aacute;n vũ trụ.</p>\r\n\r\n<p>Chẳng hạn, Mặt Trăng cho ph&eacute;p c&aacute;c nh&agrave; thi&ecirc;n văn t&iacute;nh ra được khối lượng của Mặt Trời so với Tr&aacute;i Đất.</p>\r\n\r\n<p>Sau đ&acirc;y l&agrave; c&aacute;ch m&agrave; bạn c&oacute; thể sử dụng Mặt Trăng c&ugrave;ng một h&agrave;nh tinh bất kỳ trong Hệ Mặt Trời (trừ Tr&aacute;i Đất) để x&aacute;c định khối lượng của Mặt Trời. H&atilde;y thử lấy Sao Thủy cho v&iacute; dụ n&agrave;y - d&ugrave; nếu lấy h&agrave;nh tinh kh&aacute;c th&igrave; cũng vẫn thực hiện được y như vậy.</p>\r\n\r\n<p>Với mục ti&ecirc;u của b&agrave;i to&aacute;n, ch&uacute;ng ta cần biết b&aacute;n trục lớn quỹ đạo của Mặt Trăng v&agrave; chu kỳ quỹ đạo của n&oacute; quanh Tr&aacute;i Đất. B&ecirc;n cạnh đ&oacute;, ch&uacute;ng ta cũng cần biết b&aacute;n trục lớn quỹ đạo v&agrave; chu kỳ quỹ đạo của Sao Thủy quanh Mặt Trời. Sau đ&acirc;y l&agrave; những th&ocirc;ng số n&agrave;y theo kết quả đo ch&iacute;nh x&aacute;c của NASA:</p>\r\n\r\n<p>B&aacute;n trục lớn quỹ đạo của Mặt Trăng: 384.000 km</p>\r\n\r\n<p>Chu kỳ quỹ đạo Mặt Trăng: 27,322 ng&agrave;y Tr&aacute;i Đất (sau đ&acirc;y gọi tắt l&agrave; &#39;ng&agrave;y&#39;)</p>\r\n\r\n<p>B&aacute;n trục lớn quỹ đạo của Sao Thủy: 57.910.000 km</p>\r\n\r\n<p>Chu kỳ quỹ đạo Sao Thủy: 88 ng&agrave;y</p>\r\n\r\n<p>Tiếp theo, ch&uacute;ng ta quy đổi c&aacute;c th&ocirc;ng số của h&agrave;nh tinh được chọn (ở đ&acirc;y l&agrave; Sao Thủy) sang đơn vị so s&aacute;nh với Mặt Trăng (n&oacute;i c&aacute;ch kh&aacute;c l&agrave; t&iacute;nh tỷ lệ giữa th&ocirc;ng số tương đương).</p>\r\n\r\n<p>B&aacute;n trục lớn Sao Thủy/B&aacute;n trục lớn Mặt Trăng = 57.910.000/384.000 = 150,719 (gọi số n&agrave;y l&agrave; a)</p>\r\n\r\n<p>Chu kỳ quỹ đạo Sao Thủy/chu kỳ quỹ đạo Mặt Trăng = 88/27,322 = 3,221 (gọi số n&agrave;y l&agrave; p)</p>\r\n\r\n<p><img alt=\"\" src=\"images/s-e-m.jpg\" /></p>\r\n\r\n<p>Định luật thứ 3 của Kepler cho biết b&igrave;nh phương của chu kỳ v&agrave; lập phương của b&aacute;n trục lớn tỷ lệ với nhau. Quỹ đạo của c&aacute;c thi&ecirc;n thể phụ thuộc trực tiếp v&agrave;o khối lượng của hệ n&ecirc;n ch&uacute;ng ta c&oacute; được phương tr&igrave;nh sau.</p>\r\n\r\n<p>N&oacute;i ch&iacute;nh x&aacute;c hơn đ&acirc;y l&agrave; tỷ lệ giữa khối lượng hệ Mặt Trời - Sao Thủy v&agrave; hệ Tr&aacute;i Đất - Mặt Trăng. V&igrave; Mặt Trời chiếm khối lượng gần như tuyệt đối trong hệ Mặt Trời - Sao Thủy v&agrave; Tr&aacute;i Đất cũng vậy trong hệ Tr&aacute;i Đất - Mặt Trăng n&ecirc;n ch&uacute;ng ta c&oacute; thể coi rằng con số tr&ecirc;n l&agrave; gần ch&iacute;nh x&aacute;c.</p>\r\n\r\n<p>Nếu thay Sao Thủy bằng một h&agrave;nh tinh kh&aacute;c trong Hệ Mặt Trời, bạn cũng sẽ c&oacute; kết quả tương tự.</p>\r\n\r\n<p>Tất nhi&ecirc;n, ng&agrave;y nay c&oacute; nhiều c&aacute;ch kh&aacute;c để t&iacute;nh ra khối lượng của c&aacute;c thi&ecirc;n thể v&agrave; c&aacute;c ơheps đo chi tiết nhất đ&atilde; cho thấy khối lượng của Mặt Trời bằng khoảng 333.000 lần khối lượng Tr&aacute;i Đất - tức l&agrave; ph&eacute;p t&iacute;nh tr&ecirc;n chỉ sai số rất nhỏ. Tr&ecirc;n đ&acirc;y chỉ l&agrave; một v&iacute; dụ về việc c&oacute; thể sử dụng c&aacute;c th&ocirc;ng số quỹ đạo của Mặt Trăng v&agrave; một h&agrave;nh tinh bất kỳ để t&iacute;nh ra khối lượng tương quan giữa Mặt Trời v&agrave; Tr&aacute;i Đất.</p>\r\n\r\n<p>T&aacute;c giả:&nbsp;<strong>Bruce McClure - Earthsky.org</strong></p>\r\n\r\n<p>Dịch v&agrave; giải th&iacute;ch chi tiết hơn:&nbsp;<strong>Bryan - VACA</strong></p>\r\n', 26, 2, 0, 6, '2021-06-07 17:16:54', '0000-00-00 00:00:00', 0, -44.9526413),
(64, 5, 'Lỗ đen nguyên thủy', '<p>Lỗ đen nguy&ecirc;n thủy&nbsp;l&agrave; một loại&nbsp;lỗ đen&nbsp;giả thuyết được h&igrave;nh th&agrave;nh ngay sau&nbsp;Vụ nổ lớn. Trong vũ trụ sơ khai, mật độ cao v&agrave; điều kiện kh&ocirc;ng đồng nhất c&oacute; thể đ&atilde; khiến c&aacute;c v&ugrave;ng đủ d&agrave;y đặc trải qua sự sụp đổ lực hấp dẫn, tạo th&agrave;nh c&aacute;c lỗ đen.&nbsp;Yakov Borisovich Zel&#39;dovich&nbsp;v&agrave;&nbsp;Igor Dmitriyevich Novikov&nbsp;v&agrave;o năm 1966&nbsp;lần đầu ti&ecirc;n đề xuất sự tồn tại của c&aacute;c lỗ đen như vậy. L&yacute; thuyết đằng sau nguồn gốc của ch&uacute;ng lần đầu ti&ecirc;n được&nbsp;Stephen Hawking&nbsp;nghi&ecirc;n cứu s&acirc;u v&agrave;o năm 1971.[2]&nbsp;Do c&aacute;c lỗ đen nguy&ecirc;n thủy kh&ocirc;ng h&igrave;nh th&agrave;nh từ sự&nbsp;sụp đổ lực hấp dẫn&nbsp;của sao, n&ecirc;n khối lượng của ch&uacute;ng c&oacute; thể thấp hơn nhiều so với khối sao (khoảng&nbsp;2&times;1030&nbsp;kg). Hawking t&iacute;nh to&aacute;n rằng c&aacute;c lỗ đen nguy&ecirc;n thủy c&oacute; thể nặng chỉ c&oacute;&nbsp;10&minus;8&nbsp;kg.</p>\r\n', 8, 0, 1, 6, '2021-06-07 18:16:41', '0000-00-00 00:00:00', -1, -10.94758847),
(65, 4, 'Những bức ảnh tuyệt đẹp gửi đến từ Vũ trụ', '', 38, 1, 0, 2, '2021-06-07 18:18:59', '0000-00-00 00:00:00', 0, -60.93141054),
(66, 2, '10 điều thú vị về Hệ Mặt Trời', '<p>1. Mặt Trời chiếm 99,8% tổng khối lượng của Hệ</p>\r\n\r\n<p>Ch&uacute;ng ta đều biết Măt Trời&nbsp;l&agrave; ng&ocirc;i sao trung t&acirc;m, c&oacute; k&iacute;ch thước v&agrave; khối lượng lớn hơn hẳn c&aacute;c h&agrave;nh tinh. Nhưng c&oacute; lẽ &iacute;t người biết rằng Mặt Trời &aacute;p đảo tới mức n&oacute; chiếm tới 99,8% tổng khối lượng của Hệ Mặt Trời , chỉ c&oacute; 0,2% c&ograve;n lại chia cho tất cả c&aacute;c th&agrave;nh phần c&ograve;n lại bao gồm c&aacute;c h&agrave;nh tinh, h&agrave;nh tinh l&ugrave;n, tiểu h&agrave;nh tinh, vệ tinh, sao chổi, thi&ecirc;n thạch, kh&iacute; v&agrave; bụi...</p>\r\n\r\n<p><img alt=\"\" src=\"images/ss02.jpg\" style=\"height:450px; width:600px\" /></p>\r\n\r\n<p>2. Sự ... giảm c&acirc;n của Mặt Trời</p>\r\n\r\n<p>Gi&oacute; Mặt Trời (d&ograve;ng hạt mang điện ph&oacute;ng ra từ Mặt Trời) khiến Mặt Trời mất đi khối lượng với một tốc độ kh&ocirc;ng hề nhỏ, khoảng 1 tỷ kg mỗi gi&acirc;y.</p>\r\n\r\n<p>Tuy nhi&ecirc;n, bạn cũng n&ecirc;n biết rằng khối lượng của Mặt Trời l&agrave; khoảng 1,99 x 10^30 kg, vậy n&ecirc;n nếu l&agrave;m thử một ph&eacute;p chia bạn sẽ thấy y&ecirc;n t&acirc;m rằng c&oacute; sống đến h&agrave;ng trăm tỷ năm nữa Mặt Trời cũng chẳng ... giảm c&acirc;n được bao nhi&ecirc;u cả, trong khi theo t&iacute;nh to&aacute;n hiện nay th&igrave; n&oacute; chỉ c&oacute; thể sống th&ecirc;m khoảng 5 tỷ năm nữa.</p>\r\n\r\n<p>3. Mặt Trời c&oacute; thể giết chết bạn từ rất xa</p>\r\n\r\n<p>Mặt Trời (cũng như c&aacute;c ng&ocirc;i sao kh&aacute;c) ch&aacute;y s&aacute;ng nhờ phản ứng kết hợp hạt nh&acirc;n (nhiệt hạch) xảy ra ở trong l&ograve;ng của n&oacute;. Ch&uacute;ng ta c&aacute;ch Mặt Trời khoảng 150 triệu km, v&agrave; Mặt Trời sưởi ấm ch&uacute;ng ta, mang lại cho ch&uacute;ng ta sự sống. Nhưng bạn c&oacute; biết, với nhiệt lượng tỏa ra từ phản ứng nhiệt hạch trong l&ograve;ng ng&ocirc;i sao n&agrave;y, khi tới gần, chỉ cần một mẩu vật chất (kh&iacute;) nhỏ bằng một mũi kim từ Mặt Trời sẽ giết chết bạn bởi bức xạ của n&oacute; từ khi bạn c&ograve;n c&aacute;ch tới 145km.</p>\r\n\r\n<p>4. Sao Thổ đủ nhẹ để c&oacute; thể nổi tr&ecirc;n nước</p>\r\n\r\n<p><img alt=\"\" src=\"images/ss03.jpg\" style=\"height:276px; width:572px\" /></p>\r\n\r\n<p>Sao Thổ&nbsp; l&agrave; h&agrave;nh tinh nhẹ nhất với th&agrave;nh phần to&agrave;n kh&iacute;. Khối lượng ri&ecirc;ng trung b&igrave;nh của h&agrave;nh tinh n&agrave;y l&agrave; 0,687 g/cm3. Như vậy c&oacute; nghĩa l&agrave; nếu như tr&ecirc;n một h&agrave;nh tinh khổng lồ n&agrave;o đ&oacute; c&oacute; một bể mặt nước, hay l&agrave; một đại dương đủ lớn để đặt Sao Thổ v&agrave;o th&igrave; n&oacute; sẽ nổi l&ecirc;n tr&ecirc;n mặt nước.</p>\r\n\r\n<p>5. V&agrave;nh đai ch&iacute;nh của Sao Thổ mỏng đến kh&oacute; tin</p>\r\n\r\n<p>Với đường k&iacute;nh khoảng 300.000km, v&agrave;nh đai ch&iacute;nh của h&agrave;nh tinh n&agrave;y c&oacute; độ d&agrave;y chỉ khoảng 10m. N&oacute; gồm hầu hết l&agrave; nước đ&aacute; với c&aacute;c hạt gồm nhiều k&iacute;ch thước từ 1cm đến 10m. X&eacute;t về mặt tỷ lệ (giữa độ d&agrave;y v&agrave; đường k&iacute;nh), đ&acirc;y thực sự l&agrave; cấu tr&uacute;c mỏng nhất từng được quan s&aacute;t ngo&agrave;i kh&ocirc;ng gian.</p>\r\n\r\n<p>6. Vết Đỏ Lớn lớn hơn Tr&aacute;i Đất nhiều</p>\r\n\r\n<p><img alt=\"\" src=\"images/ss04.jpg\" style=\"height:377px; width:670px\" /></p>\r\n\r\n<p>Vết Đỏ Lớn của Sao Mộc (Great Red Spot) l&agrave; một cơn b&atilde;o khủng khiếp với k&iacute;ch thước hai chiều khi nh&igrave;n từ tr&ecirc;n xuống l&agrave; 24-40.000km x 12-14.000km. C&oacute; nghĩa l&agrave; n&oacute; c&oacute; thể đặt gọn trong đ&oacute; 2 hoặc 3 h&agrave;nh tinh cỡ Tr&aacute;i Đất. Bạn c&oacute; thể thấy vết đỏ lớn n&agrave;y khi quan s&aacute;t Sao Mộc qua c&aacute;c k&iacute;nh thi&ecirc;n văn nghiệp dư.</p>\r\n\r\n<p>7. Sao Thi&ecirc;n Vương lăn ngang tr&ecirc;n quỹ đạo</p>\r\n\r\n<p><img alt=\"\" src=\"images/ss05.jpg\" style=\"height:358px; width:636px\" /></p>\r\n\r\n<p>Sao Thi&ecirc;n Vương c&oacute; trục tự quay gần như nằm ngang so với c&aacute;c h&agrave;nh tinh kh&aacute;c. N&oacute; giống như một quả b&oacute;ng lăn tr&ecirc;n quỹ đạo. Đ&acirc;y cũng l&agrave; h&agrave;nh tinh duy nhất trong số 7 h&agrave;nh tinh của Hệ Mặt Trời (kh&ocirc;ng t&iacute;nh Tr&aacute;i Đất) được đặt t&ecirc;n theo thần thoại Hy Lạp (Uranus).</p>\r\n\r\n<p>8. H&agrave;nh tinh n&oacute;ng nhất</p>\r\n\r\n<p>Mặc d&ugrave; Sao Thuỷ ở gần Mặt Trời nhất, nhưng Sao Kim mới l&agrave; h&agrave;nh tinh c&oacute; nhiệt độ bề mặt cao nhất do hiệu ứng nh&agrave; k&iacute;nh g&acirc;y ra bởi kh&iacute; quyển d&agrave;y của n&oacute;. Nhiệt độ bề mặt của n&oacute; v&agrave;o ban ng&agrave;y c&oacute; thể l&ecirc;n 462 độ C, trong khi ở Sao Thuỷ nhiệt độ bề mặt tối đa chỉ tới 427 độ C. Cả hai nhiệt độ n&agrave;y đều đủ để ... r&aacute;n ch&iacute;n một quả trứng chỉ trong v&agrave;i gi&acirc;y. Do đ&oacute; mặc d&ugrave; c&oacute; rất nhiều đặc điểm vật l&yacute; giống với Tr&aacute;i Đất nhưng chỉ ri&ecirc;ng nhiệt độ th&igrave; Sao Kim đ&atilde; kh&ocirc;ng thể đ&aacute;p ứng cho sự sống tồn tại. Sao Kim cũng l&agrave; h&agrave;nh tinh duy nhất c&oacute; chiều tự quay ngược với c&aacute;c h&agrave;nh tinh c&ograve;n lại của Hệ Mặt Trời.</p>\r\n\r\n<p>9. Đỉnh n&uacute;i cao nhất Hệ Mặt Trời nằm ở Sao Hoả</p>\r\n\r\n<p><img alt=\"\" src=\"images/ss06.jpg\" style=\"height:369px; width:625px\" /></p>\r\n\r\n<p>Điều n&agrave;y kh&aacute; th&uacute; vị v&igrave; Sao Hoả l&agrave; h&agrave;nh tinh nhỏ thứ hai của Hệ Mặt Trời. Đỉnh Olympus tr&ecirc;n Sao Hỏa c&oacute; độ cao l&agrave; khoảng 22 km, tức l&agrave; cao hơn rất nhiều so với cả Mauna Kea v&agrave; Everest tr&ecirc;n Tr&aacute;i Đất. Ch&acirc;n n&uacute;i tại điểm d&agrave;i nhất trải rộng ra hơn 550km, c&oacute; nghĩa l&agrave; khi bạn đứng ở một b&ecirc;n th&igrave; ch&acirc;n n&uacute;i ph&iacute;a b&ecirc;n kia kh&ocirc;ng chỉ kh&ocirc;ng thể nh&igrave;n thấy v&igrave; qu&aacute; xa, m&agrave; n&oacute; c&ograve;n bị khuất ph&iacute;a dưới đường ch&acirc;n trời của h&agrave;nh tinh n&agrave;y.</p>\r\n\r\n<p>10. K&iacute;ch thước của Hệ Mặt Trời</p>\r\n\r\n<p><img alt=\"\" src=\"images/ss07.jpg\" style=\"height:500px; width:635px\" /></p>\r\n\r\n<p>Nếu bạn c&oacute; một chiếc xe c&oacute; thể đi l&ecirc;n bầu trời v&agrave; cứ thẳng tiến, với tốc độ 100km/h (tốc độ phổ biến tr&ecirc;n c&aacute;c đường cao tốc) v&agrave; xe chạy li&ecirc;n tục kh&ocirc;ng ngừng nghỉ, kh&ocirc;ng cần tiếp nhi&ecirc;n liệu, bạn sẽ mất</p>\r\n\r\n<p>- Gần một giờ để ra khỏi kh&iacute; quyển Tr&aacute;i Đất, tới kh&ocirc;ng gian ngo&agrave;i vũ trụ</p>\r\n\r\n<p>- Gần 6 th&aacute;ng để tới được Mặt Trăng</p>\r\n\r\n<p>- 180 năm để tới được Mặt Trời</p>\r\n\r\n<p>- Khoảng 757 năm để tới được Sao Mộc (khi n&oacute; gần Tr&aacute;i Đất nhất)</p>\r\n\r\n<p>- Hơn 5.000 năm để tới được Sao Hải Vương</p>\r\n\r\n<p>- Hơn 10 triệu năm để tới được những nơi xa nhất thuộc m&acirc;y Oort đ&atilde; được biết tới</p>\r\n\r\n<p>- 50 triệu năm để tới được ng&ocirc;i sao gần Hệ Mặt Trời nhất (với &aacute;nh s&aacute;ng, thời gian tới được nơi đ&oacute; l&agrave; khoảng 4 năm)</p>\r\n', 115, 2, 0, 10, '2021-06-08 18:33:50', '0000-00-00 00:00:00', 0, -64.578212595),
(71, 3, 'Sao Thổ', '<p><strong>Sao Thổ (Saturn)</strong>&nbsp;tức&nbsp;<strong>Thổ tinh</strong>&nbsp;(chữ H&aacute;n: 土星) l&agrave;&nbsp;h&agrave;nh tinh&nbsp;thứ s&aacute;u t&iacute;nh theo khoảng c&aacute;ch trung b&igrave;nh từ&nbsp;Mặt Trời&nbsp;v&agrave; l&agrave;&nbsp;h&agrave;nh tinh lớn thứ hai về đường k&iacute;nh cũng như khối lượng, sau&nbsp;Sao Mộc&nbsp;trong&nbsp;Hệ Mặt Trời. T&ecirc;n tiếng Anh của h&agrave;nh tinh mang t&ecirc;n thần&nbsp;Saturn&nbsp;trong&nbsp;thần thoại La M&atilde;, k&yacute; hiệu thi&ecirc;n văn của h&agrave;nh tinh l&agrave; (♄) thể hiện&nbsp;c&aacute;i liềm&nbsp;của thần. Sao Thổ l&agrave;&nbsp;h&agrave;nh tinh kh&iacute; khổng lồ&nbsp;với b&aacute;n k&iacute;nh trung b&igrave;nh bằng 9 lần của&nbsp;Tr&aacute;i Đất.&nbsp;Tuy khối lượng của h&agrave;nh tinh cao gấp 95 lần khối lượng của Tr&aacute;i Đất nhưng với thể t&iacute;ch lớn hơn 763 lần, khối lượng ri&ecirc;ng trung b&igrave;nh của Sao Thổ chỉ bằng một phần t&aacute;m so với của Tr&aacute;i Đất.</p>\r\n', 9, 1, 0, 6, '2021-06-08 07:33:19', '0000-00-00 00:00:00', 0, -10.10681675);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_categories`
--

CREATE TABLE `post_categories` (
  `post_type` int(5) NOT NULL,
  `post_cat_name` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `post_categories`
--

INSERT INTO `post_categories` (`post_type`, `post_cat_name`) VALUES
(1, 'Bài Viết'),
(2, 'Ảnh'),
(3, 'Event'),
(6, 'Kiến thức'),
(7, 'Tin tức'),
(9, 'Hành tinh'),
(10, 'Hệ mặt trời'),
(11, 'Giải trí');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `save_post`
--

CREATE TABLE `save_post` (
  `save_user_id` int(11) NOT NULL,
  `save_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `save_post`
--

INSERT INTO `save_post` (`save_user_id`, `save_post_id`) VALUES
(1, 35),
(3, 35),
(2, 35);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` longtext COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `user_pic` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `num_post` int(11) NOT NULL,
  `user_point` int(11) NOT NULL,
  `user_rank` int(11) NOT NULL,
  `user_full_name` varchar(30) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `user_pic`, `num_post`, `user_point`, `user_rank`, `user_full_name`) VALUES
(1, 'long', '$2y$10$SXVL8QMXYYQlXbXpZbZv.O.OVOCIY0ctN/wAqagnppMQweF.KmEDS', 'icon.png', 1, 267, 1, ''),
(2, 'hao', '$2y$10$iNPT3NKES.dCrSeBqfomeuerieDj/7Dtx8jGxtZVWcBCETc3wd4Qy', 'icon.png', 1, 135, 2, ''),
(3, 'admin', '$2y$10$iYC3N10EYllvn8kl9ujP2uHgBE2jkZrlwWyzvdp3uc3i9SW6Qj1Ne', 'icon.png', 1, 0, 5, ''),
(4, 'khanh', '$2y$10$PWYVUwXTctD9nE69WnTdWOhx.T.Kgjac6bN3m/EmbGZbpbdXfIqOG', 'icon.png', 1, 48, 4, ''),
(5, 'pham', '$2y$10$M/JXp48qQvHx91.BOGaRXebR/9p55hKn37sdkeqHMURGVSthaB9kG', 'icon.png', 3, 49, 3, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vote_status`
--

CREATE TABLE `vote_status` (
  `vote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `vote_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `vote_status`
--

INSERT INTO `vote_status` (`vote_id`, `user_id`, `post_id`, `vote_value`) VALUES
(196, 3, 35, -1),
(197, 1, 35, 1),
(206, 2, 35, 1),
(212, 4, 35, 0),
(220, 5, 35, 0),
(227, 5, 60, 0),
(234, 5, 63, 0),
(235, 3, 63, 1),
(236, 3, 64, -1),
(237, 4, 64, 0),
(238, 4, 63, 0),
(239, 4, 65, 0),
(240, 3, 65, 1),
(241, 2, 65, 0),
(242, 2, 64, 0),
(243, 2, 63, 1),
(244, 2, 66, 1),
(245, 3, 66, 1),
(248, 1, 66, 0),
(249, 1, 65, 0),
(250, 1, 64, 0),
(251, 1, 63, 0),
(255, 3, 71, 1),
(257, 1, 71, 0),
(260, 2, 71, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `zodiac_sign`
--

CREATE TABLE `zodiac_sign` (
  `star_id` int(11) NOT NULL,
  `star_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `star_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `star_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `zodiac_sign`
--

INSERT INTO `zodiac_sign` (`star_id`, `star_name`, `star_content`, `star_img`) VALUES
(1, 'Bạch Dương (Aries)', 'BẠCH DƯƠNG (21/3-19/4)\r\nBạch Dương (7/6/2021)\r\n\r\nTình yêu: 3/5\r\nTiền bạc: 3/5\r\nCông việc: 4/5\r\nSức khỏe: 3/5\r\nSố may mắn: 12, 40\r\n\r\nMặt Trăng vuông góc sao Thổ cho thấy Bạch Dương không thể lý giải nổi lúc này điều gì đang làm bạn cảm thấy bất an. Nếu bạn đang làm sai điều gì nên chủ động chỉnh sửa sớm nhé.\r\n \r\n- Công việc: Có thể bạn đã tin tưởng một người bạn hay đồng nghiệp nhưng điều bạn nhận được đo slaf sự thật vọng. Bạn yêu cầu họ quá cao so với thực tế mà thôi.\r\n\r\n- Tiền bạc: Đừng chỉ giữ khư khư tiền trong két, nếu chỉ tiết kiệm, bạn sẽ không thể trở nên giàu có. Tích lũy và đầu tư mới là cách khôn khoan để tiền đẻ ra tiền.  \r\n\r\n- Tình cảm: Một số đánh giá của bạn về đối tượng mới quen khá chính xác, do đó bạn nên lùi bước. Những cặp đôi hôm nay cũng dễ xảy ra xung đột.', 'Aries.jpg'),
(2, 'Kim Ngưu (Taurus)', 'KIM NGƯU (20/4-20/5)\r\nKim Ngưu (7/6/2021)\r\n\r\nTình yêu: 2/5\r\nTiền bạc: 3/5\r\nCông việc: 4/5\r\nSức khỏe: 4/5\r\nSố may mắn: 29, 33\r\n\r\nMặt Trăng ở vị trí Kim Ngưu cho thấy bạn có bản tính kiên nhẫn, điềm tĩnh và vững vàng, bạn không dễ dàng bị tác động. Những người khác tìm sự hỗ trợ từ bạn đấy, hãy trở thành chỗ dựa của họ nhé.\r\n\r\n- Công việc: Bạn đủ khả năng xử lý những việc khó khăn trong ngày này. Đây là lúc bạn thể hiện được năng lực vượt trội của mình.\r\n\r\n- Tình cảm: Bạn nên học cách thay đổi lại cách hành xử và nói năng với người ấy. Dùng những lời nhẹ nhàng, tình cảm dễ nghe hơn bạn nhé.  \r\n\r\n- Tiền bạc: Nhiều việc không tên khiến bạn tiêu nhiều trong ngày đầu tuần. Hãy tìm cách để kiểm soát lại tình hình ban nhé.', 'Taurus.jpg'),
(3, 'Song Tử (Gemini)', 'SONG TỬ (21/5-21/6)\r\nSong Tử (7/6/2021)\r\n\r\nTình yêu: 3/5\r\nTiền bạc: 4/5\r\nCông việc: 4/5\r\nSức khỏe: 4/5\r\nSố may mắn: 29, 55\r\n\r\n Mặt Trăng trùng góc sao Thiên Vương cho thấy sự độc lập đã giúp Song Tử vượt qua được một số khó khăn, trở ngại trong ngày hôm nay.\r\n\r\n- Công việc: Những lời khen trở thành động lực để bạn chăm chỉ làm việc trong ngày hôm nay. Bạn tập trung cao độ và hiệu quả công việc tăng cao.\r\n\r\n- Tình cảm: Đừng quá mong chờ vào một tin vui sẽ tìm đến với người độc thân trong ngày hôm nay. Bạn hãy cứ từ tốn tìm hiểu và để mọi thứ diễn ra theo tự nhiên.\r\n\r\n- Sức khỏe: Bạn muốn khỏe mạnh, chống lại được bệnh tật thì cần có chế độ ăn uống và luyện tập hợp lý, luôn giữ tâm trạng thoải mái, tích cực, sống trong môi trường ít ồn ào.', 'Gemini.jpg'),
(4, 'Cự Giải (Cancer)', 'CỰ GIẢI (22/6-22/7)\r\nCự Giải (7/6/2021)\r\n\r\nTình yêu: 3/5\r\nTiền bạc: 3/5\r\nCông việc: 4/5\r\nSức khỏe: 4/5\r\nSố may mắn: 31, 39\r\n\r\nMặt Trăng 30 độ Mặt Trời nhắc nhở cung hoàng đạo Cự Giải cần nâng cao ý thức tự giác trong ngày hôm nay. Có thể một số người đưa ra những lý do không chính đáng và bạn phải kiên nhẫn giải thích cho họ.\r\n\r\n- Công việc: Bạn tránh sa đà vào việc của người khác khiến bạn lãng phí thời gian vàng bạc của mình trong ngày hôm nay. Hãy chuyên tâm vào nhiệm vụ của mình, xong với mới nên nghĩ tới chuyện khác.\r\n\r\n- Tiền bạc: Hôm nay bạn dễ được hỗ trợ tiền bạc, nhưng đừng lãng phí cả tiền vừa được đưa bạn nhé, chi tiêu phải có kế hoạch rõ ràng nếu không cứ có tiền mặt trong tay bạn lại tiêu sạch.\r\n\r\n- Tình cảm: Đừng mong người ấy hiểu ý bạn khi bạn không chịu nói ra lòng mình. Sự  im lặng của bạn có thể khiến đối phương tức giận đấy nhé.', 'Cancer.jpg'),
(5, 'Sư Tử (Leo)', 'SƯ TỬ (23/7-22/8)\r\nSư Tử (7/6/2021)\r\n\r\nTình yêu: 4/5\r\nTiền bạc: 4/5\r\nCông việc: 3/5\r\nSức khỏe: 4/5\r\nSố may mắn: 29, 88\r\n\r\nMặt Trăng vuông góc sao Thổ cho thấy một số vấn đề trong quá khứ khiến Sư Tử hôm nay không dám mở lòng, bạn cần phải khắc phục tính thiếu tự tin và cảm giác thống khổ trước khi đạt được sự trưởng thành.\r\n\r\n- Công việc: Bạn đối xử công bằng, tốt bụng với mọi người nhưng không phải ai cũng hiểu được điều này đâu. Thực ra, bạn cũng không cần tốn thời gian đi giải thích cho người ta làm gì.\r\n\r\n- Tình cảm: Hạnh phúc đang tìm đến bạn đấy, chỉ cần bạn mở lòng mình ra mà thôi. Đừng quá khó tính hay khắt khe với người ta bạn nhé.\r\n\r\n- Tiền bạc: Việc kinh doanh của bạn cũng cần tập trung mới mong tăng doanh thu, bạn chỉ cần bạn biết cách kiếm tiền từ những người có tiền, nhất định bạn sẽ giàu có.', 'Leo.jpg'),
(6, 'Xử Nữ (Virgo)', 'XỬ NỮ (23/8-22/9)\r\nXử Nữ (7/6/2021)\r\n\r\nTình yêu: 4/5\r\nTiền bạc: 3/5\r\nCông việc: 4/5\r\nSức khỏe: 4/5\r\nSố may mắn: 26, 54\r\n\r\nTiếp nối Tử vi hàng ngày 6/6/2021 của 12 cung hoàng đạo, hôm nay, Mặt Trăng 45 độ sao Kim cho thấy Xử Nữ dù đã lên kế hoạch mọi thứ nhưng cũng không tránh được sự bất cẩn, bạn dễ để xảy ra sai sót và phải đi sửa lại.\r\n\r\n- Công việc: Đừng cố chấp cho rằng mình đúng, bạn phải lắng nghe và chịu khó nhìn vào thiếu sót của bản thân.\r\n\r\n- Tiền bạc: Tình hình tài chính của chòm sao này đang giữ ở mức khá ổn định. Các khoản thu chi tương đối cân bằng sẽ giúp cho bạn không phải lo lắng quá nhiều nữa.\r\n\r\n- Sức khỏe: Bạn nên hạn chế ăn thịt lợn và các loại thịt đỏ khác. Thực tế, bạn chỉ nên ăn 300 gram thịt trong một tuần mà thôi.', 'Virgo.jpg'),
(7, 'Thiên Bình (Libra)', 'THIÊN BÌNH (23/9-23/10)\r\nThiên Bình (7/6/2021)\r\n\r\nTình yêu: 3/5\r\nTiền bạc: 3/5\r\nCông việc: 4/5\r\nSức khỏe: 4/5\r\nSố may mắn: 19, 93\r\n\r\nMặt Trăng 30 độ sao Thủy khuyên Thiên Bình hãy cứ là chính mình, đừng vì muốn làm hài lòng mọi người mà bạn trở thành người khác.\r\n\r\n- Công việc: Mọi việc đang diễn ra vô cùng thuận lợi đúng như những gì mà bạn mong đợi. Con đường thăng tiến đang rộng mở ngay trước mắt chòm sao này rồi đó.  \r\n\r\n- Tình cảm: Ảnh hưởng của chuyện tiền bạc không hề nhỏ khiến mối quan hệ của đôi lứa căng thẳng. Bạn hãy thông cảm cho những khó khăn của người ấy trong thời kỳ dịch bệnh này.\r\n\r\n- Tiền bạc: Đừng tự mãn mình giỏi rồi oán thán sao mình mà vẫn nghèo. Trí tuệ chỉ là trí tuệ sống khi chúng được chuyển hóa thành tiền. Hãy nghĩ thêm cách gia tăng tài sản.\r\n', 'Libra.jpg'),
(8, 'Bò Cạp (Scorpio)', 'THIÊN YẾT (24/10-21/11)\r\nThiên Yết (7/6/2021)\r\n\r\nTình yêu: 4/5\r\nTiền bạc: 3/5\r\nCông việc: 4/5\r\nSức khỏe: 4/5\r\nSố may mắn: 30, 78\r\n\r\nMặt Trăng 30 độ Mặt Trời khuyên Hổ Cáp nên soi chiếu vào thực tế mà đánh giá tình hình. Bạn đang mong đợi một điều quá xa tầm với rồi.\r\n\r\n- Công việc: Đừng quá căng thẳng nếu mọi thứ không diễn tiến như bạn mong đợi. Hãy tự tin vào khả năng của bản thân vì bạn đủ năng lực để xử lý tình huống khó khăn.\r\n\r\n - Tình cảm: Bạn nhận ra tình cảm thật đang sục sôi trong lòng mình. Đừng vì phút yếu lòng mà trả giá bằng việc đánh mất cả gia đình đấy nhé.\r\n\r\n- Sức khỏe: Có thể vì lối sống, cách ăn uống vô độ và cảm xúc thất thường, khó kiểm soát của bạn đã làm ảnh hưởng rất lớn tới tình hình sức khỏe hiện tại đấy. Đã đến lúc thay đổi.', 'Scorpio.jpg'),
(9, 'Nhân Mã (Sagittarius)', 'NHÂN MÃ (22/11-21/12)\r\nNhân Mã (7/6/2021)\r\n\r\nTình yêu: 4/5\r\nTiền bạc: 4/5\r\nCông việc: 3/5\r\nSức khỏe: 4/5\r\nSố may mắn: 20, 55\r\n\r\nMặt Trăng trùng góc sao Thiên Vương cho thấy Nhân Mã hôm nay nhìn nhận mọi việc rất tích cực, chính nhờ đó mà không có điều gì khiến bạn cảm thấy phải tức giận cả.\r\n\r\n- Công việc: Ngày đầu tuần hứa hẹn nhiều thông tin tích cực. Những tin vui liên tục báo về khiến chòm sao này trở nên hào hứng hơn bao giờ hết.\r\n\r\n- Tình cảm: Một lời bày tỏ tình cảm với người ấy rất cần thiết lúc này. Bạn thiếu đi sự thể hiện có thể làm cảm xúc phai nhạt.\r\n\r\n- Tiền bạc: Hãy luôn sẵn sàng đi khắp bốn phương, tám hướng để kiếm tiền. Không ngại khó, ngại khổ, chỉ cần là thị trường tiềm năng, bạn hãy tìm cách tiến vào ngay.', 'Sagittarius.jpg'),
(10, 'Ma Kết (Capricorn)', 'MA KẾT (22/12-19/1)\r\nMa Kết (7/6/2021)\r\n\r\nTình yêu: 3/5\r\nTiền bạc: 4/5\r\nCông việc: 3/5\r\nSức khỏe: 4/5\r\nSố may mắn: 29, 67\r\n\r\nMặt Trăng trùng góc sao Thiên Vương cho thấy bạn là một người có tính cá nhân rất cao và rất giỏi trong việc xử lý những rắc rối của người hơn là của bạn.\r\n\r\n- Công việc: Bạn cần tránh bốc đồng, đưa ra quyết định nhất thời mà không suy nghĩ kỹ lưỡng, cũng đừng vì lợi ích trước mắt và quên đi lợi ích lâu dài.\r\n\r\n - Tình cảm: Một số ý kiến của người thân về chuyện của hai người rất đáng để cân nhắc, bạn không nên gạt mọi thứ sang một bên và phủ nhận suy nghĩ của mọi người.\r\n\r\n- Sức khỏe: Không cần phải uống nhiều thuốc bổ, mỗi người đều học được cách sống tích cực, chiến thắng trong cuộc chiến giành lấy sức khỏe và vượt qua bệnh tật này...', 'Capricorn.jpg'),
(11, 'Bảo Bình (Aquarius)', 'BẢO BÌNH (20/1-18/2)\r\nBảo Bình (7/6/2021)\r\n\r\nTình yêu: 4/5\r\nTiền bạc: 4/5\r\nCông việc: 4/5\r\nSức khỏe: 4/5\r\nSố may mắn: 29, 63\r\n\r\nMặt Trăng 45 độ sao Kim cho thấy Bảo Bình hay cả tin, bạn chỉ cần vài thông tin có vẻ có lý là vội vàng làm theo mà không cân nhắc thêm.\r\n \r\n- Công việc: Hôm nay, bạn nên nghĩ đến sự phát triển trong tương lai, từ đó tìm cách phát triển năng lực, có như vậy thành công của bạn sẽ càng vươn xa.\r\n\r\n- Tình cảm: Bạn chủ động làm một số việc để mong rằng người ấy vui nhưng phản ứng của họ không được như ý. Có thể bạn cần thêm thời gian để hiểu người ta.\r\n\r\n- Tiền bạc: Thay vì dành hàng giờ chỉ để tiết kiệm, bạn nên học hỏi, tìm kiếm thêm thông tin để tính toán xem nên đầu tư vào đâu, làm gì để kiếm thêm tiền.', 'Aquarius.jpg'),
(12, 'Song Ngư (Pisces)', 'SONG NGƯ (19/2-20/3)\r\nSong Ngư (7/6/2021)\r\n\r\nTình yêu: 3/5\r\nTiền bạc: 4/5\r\nCông việc: 3/5\r\nSức khỏe: 4/5\r\nSố may mắn: 80, 93\r\n\r\nMặt Trăng 30 độ sao Thủy cho thấy Song Ngư đang cảm thấy bất an, sự bồn chồn và lo lắng sẽ khiến bạn thiếu tầm nhìn xa, không được sáng suốt như mọi hôm.\r\n\r\n- Công việc: Có một số việc đòi hỏi quyết tâm cao và với nỗ lực của bạn ở hiện tại là chưa đủ. Hãy tìm động lực để bạn dồn tâm, dồn sức cho việc hiện tại nhé.\r\n \r\n- Tiền bạc: Chuyện tiền nong nên rạch ròi, nếu còn khoản nợ đối với người thân thì nên tìm cách để có thể sớm xử lý. Đừng vay mượn quá lâu bạn nhé.\r\n\r\n - Tình cảm: Chớ nên đặt quá nhiều kỳ vọng vào người khác vì điều đó cho thấy bạn không tự tin vào mối quan hệ của mình. Hãy dành thời gian đó cải thiện bản thân trở nên thu hút hơn.\r\n\r\nMời các bạn đón đọc Tử vi ngày 8/6/2021 của 12 cung hoàng đạo trên Lịch ngày tốt vào hồi 17h và fanpage Mật ngữ 12 chòm sao vào hồi 20h hàng ngày nhé.\r\n', 'Pisces.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chart_data`
--
ALTER TABLE `chart_data`
  ADD PRIMARY KEY (`chart_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `point_categories`
--
ALTER TABLE `point_categories`
  ADD PRIMARY KEY (`point_cat_id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_type` (`post_type`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`post_type`);

--
-- Chỉ mục cho bảng `save_post`
--
ALTER TABLE `save_post`
  ADD KEY `save_post_id` (`save_post_id`),
  ADD KEY `save_user_id` (`save_user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `vote_status`
--
ALTER TABLE `vote_status`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `zodiac_sign`
--
ALTER TABLE `zodiac_sign`
  ADD PRIMARY KEY (`star_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chart_data`
--
ALTER TABLE `chart_data`
  MODIFY `chart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `point_categories`
--
ALTER TABLE `point_categories`
  MODIFY `point_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `post_type` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `vote_status`
--
ALTER TABLE `vote_status`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Các ràng buộc cho bảng `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`post_type`) REFERENCES `post_categories` (`post_type`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `save_post`
--
ALTER TABLE `save_post`
  ADD CONSTRAINT `save_post_ibfk_1` FOREIGN KEY (`save_post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `save_post_ibfk_2` FOREIGN KEY (`save_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `vote_status`
--
ALTER TABLE `vote_status`
  ADD CONSTRAINT `vote_status_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_status_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
