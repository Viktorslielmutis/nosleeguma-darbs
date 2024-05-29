-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: fdb34.awardspace.net
-- Generation Time: May 29, 2024 at 10:46 AM
-- Server version: 5.7.40-log
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3931224_glabaatuve`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `virsraksts` varchar(30) NOT NULL,
  `teksts` text NOT NULL,
  `cena` decimal(65,0) NOT NULL,
  `img_url` varchar(999) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `user_id`, `virsraksts`, `teksts`, `cena`, `img_url`) VALUES
(124, 52, 'asdadasd', 'asdasdas', 44, 'uploads/yes.png'),
(132, 53, '4 GB RAM ', 'mazlietots', 35, 'uploads/RAM-PNG-Free-Download.png'),
(130, 46, 'retreter', 'tretert', 44, 'uploads/Screenshot_35.png'),
(131, 46, 'super fast cpu', 'uz dieva sss', 44343, 'uploads/CPU.jpg'),
(129, 46, 'fdsfds', 'fsdfsf', 333, 'uploads/CPU.jpg'),
(128, 46, 'erere', 'rererr', 333, 'uploads/Screenshot_37.png'),
(127, 46, 'dfdfdf', 'dfdfdfdf', 34343, 'uploads/Screenshot_35.png'),
(126, 46, 'super fast ram', 'qqqq', 36, 'uploads/Screenshot_35.png'),
(109, 46, 'dfd', 'fdfd', 44, 'uploads/ererere.png'),
(110, 46, 'wewe', 'wewew', 222, 'uploads/ererere.png'),
(111, 46, 'wewewe', 'wewew', 2222, 'uploads/ererere.jpg'),
(112, 46, 'weww', 'ewww', 32323, 'uploads/ererere.jpg'),
(113, 46, 'wewqew', '22322', 2222, 'uploads/ererere.jpg'),
(114, 46, 'wqeqweq', 'eqweqeq', 23221, 'uploads/ererere.jpg'),
(108, 46, 'erer', 'ere', 333, 'uploads/ererere.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
