-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 06, 2022 at 04:31 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `level`, `token`) VALUES
(1, 'Admin', 'admin@gmail.com', '123', 0, 'user_627539e01c8e03.76894337'),
(2, 'Super admin', 'sadmin@gmail.com', '123s', 1, 'user_627d26a1374811.41242174');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phone_number` char(20) NOT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `birthday`, `email`, `password`, `address`, `phone_number`, `token`) VALUES
(1, 'Nguyễn A', '2002-08-08', 'nguyena@gmail.com', '123123', 'Hà Nội', '0120812564', 'user_628e52985f2ba4.41339695'),
(6, 'Trần B', '1999-02-15', 'sdv0pnc3@duck.com', 'new123', 'Hồ Chí Minh', '09158156615', 'user_62753aeec6c3a8.97377121');

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `customer_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone_number` char(15) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer_name`, `address`, `phone_number`, `image`) VALUES
(14, 'Acer', 'United States', '01811516552', '1651248160.jpg'),
(15, 'Lenovo', 'China', '07081516', '1651249606.png'),
(16, 'Dell', 'United States', '018156151', '1651249655.png'),
(17, 'Asus', 'Netherlands', '05011891981', '1651249915.jpg'),
(18, 'Apple', 'United States', '018161515', '1652372012.jpg'),
(19, 'Samsung', 'United States', '0123005156', '1652372229.png'),
(20, 'Akko', 'United States', '02818156', '1652372356.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `recipient_name` varchar(50) NOT NULL,
  `recipient_phone_number` char(20) NOT NULL,
  `recipient_address` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `recipient_name`, `recipient_phone_number`, `recipient_address`, `status`, `created_at`, `total_price`) VALUES
(21, 1, 'Nguyễn A', '0120812564', 'Hà Nội', 1, '2022-05-05 16:42:33', 188000000),
(22, 6, 'Trần B', '09158156615', 'Hồ Chí Minh', 2, '2022-05-06 15:13:04', 86000000),
(23, 1, 'Nguyễn A', '0120812564', 'Hà Nội', 1, '2022-05-17 16:01:16', 65000000),
(24, 1, 'Nguyễn A', '0120812564', 'Hà Nội', 0, '2022-05-23 16:31:06', 73000000),
(25, 1, 'Nguyễn A', '0120812564', 'Hà Nội', 0, '2022-07-09 01:03:26', 15000000);

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`order_id`, `product_id`, `quantity`) VALUES
(21, 9, 3),
(21, 10, 1),
(21, 12, 1),
(21, 14, 2),
(22, 10, 1),
(22, 13, 2),
(22, 16, 1),
(23, 17, 2),
(23, 19, 1),
(24, 11, 1),
(24, 12, 1),
(24, 15, 1),
(24, 19, 1),
(25, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `image`, `price`, `description`, `manufacturer_id`, `type_id`) VALUES
(9, 'Lenovo Thinkpad', '1651250007.jpg', 15000000, 'Bảo mật, phong cách và mạnh mẽ, đó là những tính năng bạn cần ở một chiếc laptop hiện đại. Lenovo ThinkPad E14 Gen 3 đáp ứng đầy đủ tiêu chí đó khi mang trên mình sức mạnh của bộ vi xử lý AMD Ryzen 5000 series, độ bền chuẩn quân đội và loạt công nghệ bảo mật đáng tin cậy.', 15, 1),
(10, 'Lenovo Legion 5', '1651250060.png', 25000000, 'Lenovo Legion 5 15ACH6 đầy đủ vũ khí cho một game thủ đích thực với bộ vi xử lý AMD Ryzen 5000 series, GPU đồ họa RTX 30 series, màn hình 15,6 inch Full HD tốc độ cao 165Hz, âm thanh Nahimic 3D và bàn phím Legion Truestrike chính xác.', 15, 1),
(11, 'Dell Inspiron', '1651250119.jpg', 15000000, 'Dell Inspiron 14 N5420 là mẫu laptop cao cấp mới nhất thuộc dòng Inspiron với điểm nhấn từ bộ vi xử lý Intel thế hệ thứ 12 Alder Lake, màn hình tỉ lệ 16:10 rộng hơn và một thiết kế đầy sang trọng.', 16, 1),
(12, 'Asus Vivobook', '1651250173.jpg', 18000000, 'Đến từ một trong những thương hiệu uy tín nhất thế giới laptop, Asus Vivobook X515EA-BR2044W được trang bị màn hình lớn, chip xử lý xuất sắc và khoác lên mình thiết kế nịnh mắt. Sản phẩm được cài đặt sẵn hệ điều hành Windows 11, đồng thời lên kệ với mức giá tương đối vừa túi tiền.', 17, 1),
(13, 'Asus TUF gaming', '1651250228.jpg', 20000000, 'Asus TUF Gaming F15 FX506LHB-HN188W là chiếc laptop gaming giá rẻ với thiết kế tuyệt đẹp, phong cách chuẩn game thủ và cấu hình mạnh mẽ cho cả học tập, công việc cũng như chơi game. Bên cạnh đó là độ bền chuẩn quân đội đã làm nên tên tuổi của dòng TUF.', 17, 1),
(14, 'Asus ROG', '1651250286.jpg', 25000000, 'Thật tuyệt vời khi bạn sẽ được sở hữu chiếc laptop gaming dòng ROG cao cấp Asus Gaming ROG Strix G15 G513IH HN015W trong tầm giá chỉ 20 triệu đồng. Thỏa sức thể hiện kỹ năng chơi game trên một sản phẩm tuyệt đẹp và phong cách.', 17, 1),
(15, 'Acer Nitro 5', '1651250335.png', 25000000, 'Bền bỉ, tiết kiệm và sở hữu cấu hình miễn chê, Acer Nitro Gaming AN515-57-5669 là sự lựa chọn phù hợp cho các game thủ muốn tận hưởng những công nghệ mới nhất trong một mức giá bán dễ chịu.', 14, 1),
(16, 'Acer Aspire 7', '1651250399.jpg', 21000000, 'Một chiếc laptop gaming nhưng lại được bán với mức giá văn phòng, đồng thời bạn cũng có thể mang đi làm một cách bình thường. Acer Aspire 7 A715 42G R4XX là giải pháp đa năng cho cả công việc và giải trí trong tầm giá vô cùng hấp dẫn.', 14, 1),
(17, 'Iphone 11', '1652372053.jpg', 25000000, 'iPhone 11 với 6 phiên bản màu sắc, camera có khả năng chụp ảnh vượt trội, thời lượng pin cực dài và bộ vi xử lý mạnh nhất từ trước đến nay sẽ mang đến trải nghiệm tuyệt vời dành cho bạn.', 18, 7),
(18, 'Samsung galaxy tab 8', '1652372456.png', 30000000, 'Với Samsung Galaxy Tab S8, bạn sẽ thoải mái tận hưởng những khung hình mượt mà trên màn hình 120Hz, trải nghiệm loạt ứng dụng đòi hỏi cao ở hiệu suất nhờ chip Snapdragon 8 Gen 1, đồng thời nâng cao tính chuyên nghiệp khi làm việc với sự hỗ trợ của bút S-Pen.', 19, 7),
(19, 'Akko 3870V2', '1652372608.jpg', 15000000, 'Bàn phím cực kỳ chất lượng đến từ nhà Akko', 20, 15);

-- --------------------------------------------------------

--
-- Table structure for table `rating_comment`
--

CREATE TABLE `rating_comment` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating_comment`
--

INSERT INTO `rating_comment` (`customer_id`, `product_id`, `rating`, `comment`, `created_at`) VALUES
(1, 9, 4, 'Máy dùng bền, tốt, rất hài lòng', '2022-05-22 16:44:05'),
(6, 9, 4, 'Bền, sử dụng để làm việc văn phòng rất phù hợp', '2022-05-22 16:46:53'),
(6, 10, 5, 'Máy cực tốt trong tầm giá, rất hài lòng khi sử dụng', '2022-05-22 17:14:51'),
(6, 15, 3, 'Máy dùng lâu hơi nóng và lag, hơi thất vọng', '2022-05-22 17:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_name`) VALUES
(1, 'Laptop'),
(5, 'Phụ kiện'),
(7, 'Điện thoại'),
(15, 'Bàn phím');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`manufacturer_id`),
  ADD UNIQUE KEY `manufacturer_name` (`manufacturer_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `orders_products_ibfk_1` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `manufacturer_id` (`manufacturer_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `rating_comment`
--
ALTER TABLE `rating_comment`
  ADD PRIMARY KEY (`customer_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD CONSTRAINT `forgot_password_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`manufacturer_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`);

--
-- Constraints for table `rating_comment`
--
ALTER TABLE `rating_comment`
  ADD CONSTRAINT `rating_comment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `rating_comment_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
