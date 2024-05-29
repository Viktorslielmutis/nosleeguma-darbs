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
-- Table structure for table `BLOGS_accounts`
--

CREATE TABLE `BLOGS_accounts` (
  `id` int(99) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BLOGS_accounts`
--

INSERT INTO `BLOGS_accounts` (`id`, `username`, `password`, `role`) VALUES
(32, 'kakalacis123', '$2y$10$NYQ8NrJn9lVRffCvjVCBvO2hZ81H.OBJ5fJ5aKiV.Zkv4H2VxMC9u', NULL),
(5, 'aaaaaaa', '$2y$10$zo0jU96Z', NULL),
(6, 'test123123', '$2y$10$AmXM5WOG', NULL),
(7, 'kakakaka', '$2y$10$kb3W.sut', NULL),
(8, 'janiscakste', '$2y$10$6IRC.Css', NULL),
(9, 'janiscakste1', '$2y$10$dGpv4r9g', NULL),
(10, 'janiscakste11', '$2y$10$eEB2jvSg', NULL),
(11, 'kakulacis', '$2y$10$VnxNDhby', NULL),
(12, 'kokskoks', '$2y$10$Bs.WINVk', NULL),
(13, 'kristaps123', '$2y$10$UikKe/LA', NULL),
(14, 'lauris123', '$2y$10$h1ALIgHUbi0IsgkIzskhBuxLWWPJLFFD5YNVRVKrylj/belt.I3nG', NULL),
(15, 'adele1234', '$2y$10$OTc6bafL2CUkxCIcJ8szCeIynY427RrlIxJMF6PCfNDXEd/ooqdZO', NULL),
(16, 'adele12345', '$2y$10$rxKeoqJzk5TLuAPGctQzlenZPLn3JPMNT5v6djXBdjh5qu3vvkZGy', NULL),
(17, 'klavs123', '$2y$10$enkP.0j2n10DG82EwWdFQewkuBk1CYUKyCQjgrmAeNGREZ95XbRU6', NULL),
(31, 'test12345', '$2y$10$rgF6UJEuiObzgv1JNNfGH.0R/Km9ix8DN.omaP7FkYLpLX.Md/jNO', NULL),
(30, 'kakakaka12', '$2y$10$P98blSgI.eEhjoTVX8EJr.V7UgsKowajzvAlDsS7bmHxmTQQLK2sm', NULL),
(29, 'kakakaka123', '$2y$10$y9JK6Ge20rLFNZ9DQsc4gue2Gj7a.GezJ3o0xJcJEoLpVzAIr0b1W', NULL),
(28, 'aaaaaaaaa', '$2y$10$gm50v4qfQP2eUDoRGb400.LxFLaR/T10ar3IGe.uD1CZ3sGW6.63C', NULL),
(27, 'aaaaaaaaaa', '$2y$10$13p5UV56BOCbK2ZnLLv3SeKvKRUdo6297xZYaivNT4tjmizgLaK4W', NULL),
(26, 'lauris1234', '$2y$10$UyJqWFKKiMp2WxvvTG4c4eWWcpgnPzJFnn48EymweuB8JABBIUoJe', NULL),
(33, 'koks', '$2y$10$69sEhfdVggiHu8feZxW5tOLSgyarYlSFM6NLLR3YuCh3G4u6t/DGK', NULL),
(34, 'maja123', '$2y$10$4rcr8TRpUL4odZNmBPQjcuWMb82j6zz8oCc5o32MgVW28qOruqIfa', NULL),
(35, 'aaa', '$2y$10$NjBPtaBI1WdKIu09tZ6JuuCFuIucKTylJirv4hG39/odzV7mabTbu', NULL),
(36, 'armands', '$2y$10$/11yOOWMaORg3cydwkBhQOpF57ROPyNRuzXw0YeeGDb2bEohJKJki', NULL),
(37, 'gejucis', '$2y$10$5P/Jc1JiBoy5CwxYaZ5IbO1iyEMwFp33P0HOJcvt47Gz44Jgs8TdG', NULL),
(38, 'ssssss', '$2y$10$AloyE1.tvCHkfqKsjrAgb.7QHdAhAWOmccLcaApt2n2bS/h.5k.o2', NULL),
(39, 'lauris', '$2y$10$u5AlzNl/nQVMnNpdwa/CTOUeU/lS.4iM/4HP.i79N6QJmmmAbYG6W', NULL),
(40, 'sarmite', '$2y$10$RoUtimVCvHLbeh16lZ4GCOzRd6aCEmLMUbcI2j2t2jHuvLKMfmdQu', NULL),
(41, 'sss', '$2y$10$NHFArRNbcOk2MJ10hAp/n.xhFJmhTQKoXhITqvvGmK/WAQtVMwT2G', NULL),
(42, 'a', '$2y$10$BUfbI8G02PnXExDwTj8iY.k8Z9lBWY5lz4yukqBMAwneRS6nXBcZe', NULL),
(43, 'gr', '$2y$10$m3SdQe816P9mcMYEbj4Kiuqi4TkaE/6r1HNZlI9Cggmb3bObgKorS', NULL),
(44, 'qwe', '$2y$10$QOPGYDngc3GXDWh7UJ0lF.3rTvV.8ILIQIO6gt4Bhqs1/FGKGW43m', NULL),
(45, 'zxc', '$2y$10$fRnLt0aRgj2dYB1oJ10BquVR1v2rUISu3fKB/TLgBTsjeqvUWDgym', NULL),
(46, 'qweasdzxc', '$2y$10$lybisXybUPTj5giH6VWjL.t0SXmY3RhH51diZNhnj71w39rnRCtGq', NULL),
(47, '4rma', '$2y$10$W9IOFalyGq9BOVbshOjo4.kxF/qDM.yQHnyzUYcicegc6vKO/Ei4.', NULL),
(48, 'admin', '$2y$10$SFVRo4wmUORV6XbCzraZ/ON.eE7DlbF9Rl49qkw334bPZuvfp8Wd2', 'admin'),
(49, 'ewqdsa', '$2y$10$HtqCyIG1Bslwq7P5uMTI1.zENcxIBoZiATc8iiSq0L1UoE/V7URMa', NULL),
(50, 'dakda', '$2y$10$3HNkmkVv6QlVfzdaTGXmWOOpgKEjoMqHnxyCky/ckNZ1IQ6n7MAuO', NULL),
(51, 'p', '$2y$10$zREoPBr81/9A6p/2eUeMXONEIRlly668EDG0QCAS5xZNFhOTJ3J0q', NULL),
(52, 'lauris123321', '$2y$10$MQkyksneVbB1Rn1fyEdbnOo7TGLg6voeEzyUlbVxgb6cBVOmArAQu', NULL),
(53, 'janisklava', '$2y$10$.mphSrLGm/nWKY71VpMpy.3PTKsKDPUiqGXvx/HG7SZ.DRZs7JepG', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BLOGS_accounts`
--
ALTER TABLE `BLOGS_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BLOGS_accounts`
--
ALTER TABLE `BLOGS_accounts`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
