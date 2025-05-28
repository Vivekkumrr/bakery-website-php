-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 10:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `pid` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(12, 1, 21, 'Zaatar Bread', 50, 1, 'bread1.png');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `number` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'vivek', 'vivek@gmail.com', '12345567', 'Welcome Sir!'),
(2, 2, 'aa', 'aa@gmail.com', '12', 'www'),
(3, 1, 'vivek', 'vivek@gmail.com', '1234', 'Products are good'),
(4, 1, 'vivek', 'vive', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `number` int(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `method` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `total_products` varchar(250) NOT NULL,
  `total_price` varchar(250) NOT NULL,
  `placed_on` varchar(250) NOT NULL,
  `payment_status` varchar(250) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 1, 'vivek', 123, 'vivek@gmail.com', 'card', 'Dubai', '10', '1000', 'placed', 'update_payment'),
(2, 1, 'vivek', 58502190, 'vivek@gmail.com', 'credit card', 'Sharjah', '', '1180', '04-May-2024', 'pending'),
(3, 20, 'sass', 123, '', 'cash on delivery', 'dd', '', '300', '05-May-2024', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `product_detail` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `product_detail`, `image`) VALUES
(21, 'Zaatar Bread', 50, 'Delicous', 'bread1.png'),
(22, 'Sesame bread', 22, 'Specially Baked', 'bread3.png'),
(23, 'Apple Pie', 70, 'Made with blending the ingredients of the apple and mixing with cranberries for the special favors.', 'bread2.png'),
(24, 'Chocolate Moose Cake', 300, 'Cakes and breads', 'cake1.png'),
(25, 'Strawberry Donuts', 200, 'Donuts Sugarcoated with Joy and Sprinkles', 'cake2.png'),
(26, 'Apple Donut', 150, 'Apple donut made with pink stawbeery filling and apple flavors', 'donut1.png'),
(27, 'Dark Chocolate Coffee Pastry', 300, 'Chocolate Pastry made with cream filling and some dark chocolate sprinkles', 'pastry1.png'),
(28, 'Mango Cranberry Pastry', 200, 'Enjoy our newly added in the menu mango flavoured pastry that has cranbery topping and much more...', 'pastry2.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` varchar(250) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'vivek', 'vivek@gmail.com', '$2y$10$8ljEhXHO0W0t9/Hl0rBCHObXRnhyZjCSUEKIRsFzxCT3HAZjYwoTS', 'user'),
(2, 'ram', 'ram@gmail.com', '$2y$10$4ctJj0DKo1g/.GTRq7xbsOywDlQOisnD1vfFLUPrDjSArngqQ8EEC', 'admin'),
(3, 'ii', 'ii@gmail.com', '$2y$10$2s5H2nVWx3xu8swwpLUaGulyCyZelErEtAQt8Bh2egbeZuMuBOjOm', 'user'),
(4, 'bhangi aaron', 'bhangitalks@gmail.com', '$2y$10$LUuMNCu6hT0phmiJ5U/1L.8duBRHYrLMDelu3KGOXmbddj1xhTjFe', 'user'),
(5, 'rrr', 'rrr@gmail.com', '$2y$10$87V.1en.SI5JPQ0dfk0P6.WHgnp6OORreirkgIYLbRs5R85AmMlEK', 'user'),
(7, 'www', 'www@gmail.com', '$2y$10$.RfMtCUkOmWv8JgIYib5xuC79UuWZWo.35iBVWsiQlKRbGR6GLrlK', 'user'),
(8, 't4', 't4@gmail.com', '$2y$10$wW3HJ/4HAQhV9t70KD5Fw.bTSzvjzE89Wm0tdGgNXUuS8Ty4U2T0q', 'user'),
(9, 'chapri aaron', 'chapriaaron@gmail.com', '$2y$10$xZZIZuZm.gGoKDHQcGUmeO2UDt8nnyW7324Ny8FumC5fJbC2HTOZi', 'user'),
(10, 'buldozer rani', 'buldozer@gmail.com', '$2y$10$VfM0TK8ALlyhSnt4cNYjgeexEi7ZW1tXU7kj4b8t4w7ey4xS9.h3W', 'user'),
(11, 'rascalrafeeq', 'rascalrafeeq@gmail.com', '$2y$10$Pag4R/ph32MngmEbVfo0B.ysk38GsGZpTiVV5keITT6CPgPat.XSe', 'user'),
(12, 'lovely', 'lovely@gmail.com', '$2y$10$Ny2OoS1p6VxREYrVtbysWej0x17GHMKI03sYvOR78yWUXl4S.pXdq', 'user'),
(13, 'rani', 'rani@gmail.com', '$2y$10$TV36FNgRfwbkoy8hhmna4OrlT/oW.wvBIGYNU1/GMSBKgzq9QGygO', 'user'),
(14, 'ken', 'ken@gmail.com', '$2y$10$ulZDsetK5mhoptTFuk2Oze8GrHYc.pqvSYW1qyJlykmICKFBNa71y', 'user'),
(15, 'kumar', 'kumar@gmail.com', '$2y$10$QWdvibhVhHLve3Wtj9IzhO3H62KWP06vP9J/BEv0DJhTezE8aF3IC', 'user'),
(16, 'ttt', 'ttt@gmail.com', '$2y$10$ZmvvYOLrxCIyY68dCUf6Zu1C2Tkqy/u9igNUfBkGXY0CBvdXszKZC', 'user'),
(17, 'fff', 'fff@gmail.com', '$2y$10$6oWaxl08UUsn8BJH.pc.KO2dAaSLRwAU7vrgk7jJ.v8x9dwzUk/du', 'user'),
(18, 'ddd', 'ddd@gmail.com', '$2y$10$p7z3NYYn2pSZVUkPBChfZOu4O3Vx8ROXbf9FS2GogFCsaWfgZL68W', 'user'),
(19, 'yyy', 'yyy@gmail.com', '$2y$10$d/B5.bwg0nwjcfHlxvs36O9dU59MV3CPI0r8xZhAu4P0bBLjCbPES', 'user'),
(20, 'sass', 'sass@gmail.com', '$2y$10$esmDwcKl8C.mce6Ma57PYOe8qk6fImCRSrBAiA8x/lTdcF736UGpK', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `pid` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(16, 1, 21, 'Zaatar Bread', 50, 'bread1.png'),
(18, 1, 22, 'Sesame bread', 22, 'bread3.png'),
(19, 20, 22, 'Sesame bread', 22, 'bread3.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
