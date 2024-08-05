-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 06:07 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upos`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`, `status`) VALUES
(20, 'LG', '1'),
(21, 'Sony', '1'),
(22, 'pepsi', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catname`, `status`) VALUES
(57, 'Computer', 1),
(60, 'Mobile', 1),
(61, 'TV', 1),
(62, 'Pepsi', 1),
(63, 'String', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `barcode_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `cal_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `barcode_id`, `product_name`, `price`, `discount_name`, `discount_type`, `amount`, `cal_amount`) VALUES
(16, 1111, 'LG 1001', 15000, 'fix', 2, 10, 1500),
(17, 2222, 'Sony 2011 TV', 40000, 'fix', 2, 10, 4000),
(18, 111111, '200ml', 45, 'fix', 2, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_description` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `warranty` int(11) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `retail_price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `reorderlevel` int(11) NOT NULL,
  `barcode` int(11) NOT NULL,
  `add_date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `p_name`, `p_description`, `cat_id`, `brand_id`, `warranty`, `cost_price`, `retail_price`, `qty`, `reorderlevel`, `barcode`, `add_date`, `status`) VALUES
(65, 'LG 1001', 'LG 1001', 60, 20, 2, 12000, 15000, 78, 50, 1111, '2018-10-30', 1),
(66, 'Sony 2011 TV', 'Sony 2011 TV only ', 61, 21, 5, 20000, 40000, 33, 50, 2222, '2018-10-30', 1),
(67, '200ml', '200ml', 62, 22, 0, 42, 45, 75, 10, 111111, '2018-11-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_vendor`
--

CREATE TABLE `product_vendor` (
  `id` int(11) NOT NULL,
  `barcode_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `buy_price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `barcode` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `pay` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `payment_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `id` int(11) NOT NULL,
  `pur_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `buyprice` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_item`
--

INSERT INTO `purchase_item` (`id`, `pur_id`, `prod_id`, `buyprice`, `qty`, `total`) VALUES
(813, 4, 1111, 35000, 40, 1750000),
(814, 5, 1111, 35000, 0, 350000),
(815, 6, 2222, 20000, -2, 1000000),
(816, 7, 2222, 20000, -2, 1000000),
(817, 8, 1111, 35000, 2, 420000),
(818, 9, 2222, 20000, -40, 240000),
(819, 9, 2222, 20000, -39, 260000),
(820, 10, 2222, 20000, -40, 240000),
(821, 11, 1111, 35000, 100, 3500000),
(822, 11, 2222, 20000, 100, 2000000),
(823, 12, 1111, 35000, 50, 1750000),
(824, 12, 2222, 20000, 50, 1000000),
(825, 13, 1111, 35000, 50, 1750000),
(826, 14, 2222, 20000, 12, 240000),
(827, 15, 1111, 35000, 56, 1960000),
(828, 16, 2222, 20000, 60, 1200000),
(829, 17, 1111, 35000, 11, 385000),
(830, 17, 2222, 20000, 12, 240000),
(831, 17, 2222, 20000, 12, 240000),
(832, 18, 1111, 35000, 2, 70000),
(833, 18, 2222, 20000, 12, 240000),
(834, 19, 2222, 40000, 50, 2000000),
(835, 20, 1111, 15000, 100, 1500000),
(836, 21, 111111, 45, 100, 4500),
(837, 22, 111111, 45, 25, 1125);

-- --------------------------------------------------------

--
-- Table structure for table `purs`
--

CREATE TABLE `purs` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` int(11) NOT NULL,
  `pay` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purs`
--

INSERT INTO `purs` (`id`, `vendor_id`, `date`, `total`, `pay`, `due`, `payment_type`) VALUES
(4, 1, '2018-08-13', 1750000, 1200000, -6000, 1),
(5, 1, '2018-08-13', 350000, 350000, 0, 1),
(6, 0, '2018-08-13', 1000000, 500000, 500000, 1),
(7, 2, '2018-08-13', 1000000, 500000, 0, 1),
(8, 1, '2018-08-22', 420000, 300000, 0, 1),
(9, 2, '2018-09-08', 500000, 450000, 170000, 2),
(10, 2, '2018-10-03', 240000, 200000, 20000, 0),
(11, 2, '2018-10-09', 5500000, 2000000, 3500000, 1),
(12, 2, '2018-10-09', 2750000, 2000000, 750000, 0),
(13, 2, '2018-10-15', 1750000, 1200000, 550000, 1),
(14, 2, '2018-10-15', 240000, 222222, 17778, 0),
(15, 2, '2018-10-15', 1960000, 222222, 1737778, 1),
(16, 2, '2018-10-15', 1200000, 444444, 755556, 0),
(17, 2, '2018-10-18', 865000, 111111, 753889, 1),
(18, 2, '2018-10-21', 310000, 40000, 270000, 1),
(19, 2, '2018-10-30', 2000000, 1500000, 500000, 1),
(20, 1, '2018-10-30', 1500000, 1000000, 500000, 1),
(21, 2, '2018-11-08', 4500, 0, 4500, 2),
(22, 2, '2018-11-08', 1125, 0, 1125, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `subtotal` int(255) NOT NULL,
  `discount_toal` int(255) NOT NULL,
  `grand_total` int(255) NOT NULL,
  `pay` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `date`, `subtotal`, `discount_toal`, `grand_total`, `pay`, `balance`, `payment_type`) VALUES
(51, '2018-08-13', 70000, 7000, 63000, 70000, 7000, 1),
(52, '2018-08-13', 40000, 4000, 36000, 40000, 4000, 1),
(53, '2018-08-13', 40000, 4000, 36000, 40000, 4000, 1),
(54, '2018-08-13', 55000, 5500, 49500, 50000, 500, 1),
(55, '2018-09-11', 220000, 22000, 198000, 200000, 2000, 1),
(56, '2018-10-09', 410000, 41000, 369000, 600000, 231000, 1),
(57, '2018-10-09', 350000, 35000, 315000, 400000, 85000, 0),
(58, '2018-10-09', 620000, 62000, 558000, 600000, 42000, 0),
(59, '2018-10-09', 590000, 59000, 531000, 600000, 69000, 0),
(60, '2018-10-09', 440000, 44000, 396000, 400000, 4000, 1),
(61, '2018-10-09', 2750000, 275000, 2475000, 4000000, 1525000, 0),
(62, '2018-10-15', 35000, 3500, 31500, 40000, 8500, 1),
(63, '2018-10-30', 350000, 35000, 315000, 400000, 85000, 1),
(64, '2018-10-30', 660000, 66000, 594000, 600000, 6000, 1),
(65, '2018-11-08', 2250, 250, 2000, 2000, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_product`
--

CREATE TABLE `sales_product` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_product`
--

INSERT INTO `sales_product` (`id`, `sales_id`, `product_id`, `price`, `qty`, `discount`, `total`) VALUES
(90, 51, 1111, 35000, 2, 7000, 70000),
(91, 52, 2222, 20000, 2, 4000, 40000),
(92, 53, 2222, 20000, 2, 4000, 40000),
(93, 54, 2222, 20000, 1, 2000, 20000),
(94, 54, 1111, 35000, 1, 3500, 35000),
(95, 55, 2222, 20000, 11, 22000, 220000),
(96, 56, 1111, 35000, 10, 35000, 350000),
(97, 57, 1111, 35000, 10, 35000, 350000),
(98, 58, 2222, 20000, 10, 20000, 200000),
(99, 58, 1111, 35000, 12, 42000, 420000),
(100, 59, 1111, 35000, 10, 35000, 350000),
(101, 59, 2222, 20000, 12, 24000, 240000),
(102, 60, 2222, 20000, 11, 22000, 220000),
(103, 60, 2222, 20000, 11, 22000, 220000),
(104, 61, 1111, 35000, 50, 175000, 1750000),
(105, 61, 2222, 20000, 50, 100000, 1000000),
(106, 62, 1111, 35000, 1, 3500, 35000),
(107, 63, 1111, 15000, 10, 15000, 150000),
(108, 63, 2222, 40000, 5, 20000, 200000),
(109, 64, 1111, 15000, 12, 18000, 180000),
(110, 64, 2222, 40000, 12, 48000, 480000),
(111, 65, 111111, 45, 50, 250, 2250);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `password`, `join_date`) VALUES
(1, 'kobianth', 'kobi', '123', '2018-08-03'),
(2, 'laven', 'laven', '321', '2018-08-09');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `vname` varchar(255) NOT NULL,
  `contactno` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vname`, `contactno`, `email`, `address`, `status`) VALUES
(1, 'kishan', 11111, 'kobi.ram@gmail.com', 'sdfsdf', 1),
(2, 'John', 941111111, 'john@gmail.com', 'india', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_vendor`
--
ALTER TABLE `product_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purs`
--
ALTER TABLE `purs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_product`
--
ALTER TABLE `sales_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `product_vendor`
--
ALTER TABLE `product_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=838;

--
-- AUTO_INCREMENT for table `purs`
--
ALTER TABLE `purs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `sales_product`
--
ALTER TABLE `sales_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
