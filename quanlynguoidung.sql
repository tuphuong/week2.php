-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 05:38 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlynguoidung`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_number` int(11) NOT NULL,
  `role_name` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_number`, `role_name`) VALUES
(1, 'nhân viên'),
(2, 'admin'),
(0, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `time` varchar(32) NOT NULL,
  `token` varchar(128) NOT NULL,
  `username` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`time`, `token`, `username`) VALUES
('2022-11-10 03:31:18', 'ffc0d178deacbd70a65d34b679aae20c', ''),
('2022-11-10 03:33:05', 'b07e64f5d3ecec6c875781e4e9f9edf6', 'admin'),
('2022-11-10 03:33:52', '05198aff21f4546a86ccc42116d54bda', 'admin'),
('2022-11-10 03:37:10', '938522a9efe6620da5fbdf644dae9e76', 'admin'),
('2022-11-10 09:55:10', 'd1ad25b65c0cb98b020a6f483ae65a3f', 'bi'),
('2022-11-10 10:23:20', 'feeb8d442d2515b6900097d3d6e02b54', 'bi'),
('2022-11-10 10:47:53', '5577055d3bb14e696b1a173371aa88e0', 'bi'),
('2022-11-10 10:51:53', 'a067a6800d2c67297acb3bef260e78ad', 'bi'),
('2022-11-10 11:02:18', '1cdc38a42322ac2dede9266893489bd9', 'bi'),
('2022-11-10 11:10:37', '71fb64d4b2110f5f781d3195efcc2ad7', 'bi'),
('2022-11-10 11:15:58', 'd4ae37e4f76dd22e765c88c47b13c325', 'bi'),
('2022-11-10 11:27:49', '6aa79b57a958402cb91f8b64bccd7c80', 'bi'),
('2022-11-10 11:48:37', '8a043589bed73fd676992cd34c17ae2d', 'bi'),
('2022-11-10 11:52:41', 'aacda732ffc23467efdadd45e5e36667', 'bi'),
('2022-11-10 11:56:57', 'c29b73479d8c3a8512d43436255f1e2c', 'bi'),
('2022-11-10 14:33:07', '4dd1dfe6f3683c39f7994c747167ea08', 'bi'),
('2022-11-10 16:34:39', '2e1e65349757e91b6b116c5fbcd8174b', 'bi'),
('2022-11-10 16:34:41', '81d83757159ad082b9e7240f9ab51a09', 'bi'),
('2022-11-10 16:35:04', 'e1197669689a1113ab4f3d123c045c64', 'bi'),
('2022-11-10 16:40:31', '4220e684993457399e3e15f9a5dd1b7e', 'mark'),
('2022-11-10 16:41:04', '5a82bb33ec99dfdd64f31bee88b907c0', 'mark'),
('2022-11-10 16:44:32', '819f404b45a62135129c5aa8a480f108', 'mark'),
('2022-11-10 16:44:52', '024ee23155aac8ab38b22b1f17d8224a', 'bi'),
('2022-11-10 16:45:32', 'e1adafeec56ca209ace84fc5e873855e', 'mark'),
('2022-11-10 16:48:12', '122ee7838768d962b72b40abd491fda5', 'bi'),
('2022-11-10 16:51:54', 'a3cf14d6390aa086e8125da02f98f0a8', 'bi'),
('2022-11-10 16:53:21', '5879677314ba8a5f0f3491a6a8c8f5e4', 'mark'),
('2022-11-10 16:55:40', '5004e19068a815da28430ede5fa50975', 'bi'),
('2022-11-10 16:59:25', '5f68e9f53c1d77a1ca8aad0693b0af4e', 'bi'),
('2022-11-10 16:59:37', '76d57f90db0ad1cdb57a51a4b47b13e0', 'mark'),
('2022-11-10 17:00:00', '387d3d7e3ea04fa3e6006b95228145b6', 'bi'),
('2022-11-10 17:00:21', '5ae23e1027f958d793c38dd818a4e9ec', 'mark'),
('2022-11-10 17:02:18', '2a84d1316d203fa8bceb5bd873ba38d7', 'mark'),
('2022-11-10 17:19:10', '6d8a83e6e4b582032947d7e0402f3523', 'mark'),
('2022-11-10 17:20:54', 'f155dcbc85196f84023aa59aa5e84c66', 'mark'),
('2022-11-10 17:22:28', '5f05883145405b3eb64f469f25ef3986', 'mark'),
('2022-11-11 08:37:50', 'ac2ae66cdc2a92a7efb70329aa8658ec', 'bi'),
('2022-11-11 08:38:12', '7d13b9bc52636fc277765347dc4839da', 'mark'),
('2022-11-11 09:14:14', '4c5b54be6fc7f8ca95d6aa691100d096', 'bi'),
('2022-11-11 11:00:45', '9d7a452b5d3810c7b1838e79132f3199', 'bi12'),
('2022-11-11 11:21:45', 'f1e183eaa2f3d3dde1882fd07be86ebe', 'bi'),
('2022-11-11 11:29:41', 'f675048a5e75aaa0aee16b9e1f6ed524', 'bi12'),
('2022-11-11 11:29:54', '0fa5e268d956e6488201c2ac6aa0cb54', 'bi12');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `content`, `username`) VALUES
(1, 'hello world', 'bi'),
(2, 'aaaaaaaa', 'bi'),
(4, 'Have a good day', 'at15'),
(6, 'Good afternoon!', 'at16'),
(7, 'Xin chao!', 'at17'),
(8, 'test', 'at17'),
(9, 'my name is Phuong', 'bi'),
(10, 'hello', 'bi12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `PhoneNumber` varchar(32) NOT NULL,
  `Address` varchar(32) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `email`, `PhoneNumber`, `Address`, `role`) VALUES
(3, 'at15', '83d9faf165ecacad7419bcbe331624b2', 'cwt06934@nezid.com ', '0987791711 ', 'Nghe An', 0),
(4, 'at16', '0b3bc9ce555f07d127c6da44337e364f', 'a@gmail.com', '0972355044', 'Ha Noi', 0),
(43, 'at17', '202cb962ac59075b964b07152d234b70', 'ni@gmail.com', '0123456789', 'Ha Nam', 0),
(45, 'bi', '0e7517141fb53f21ee439b355b5a1d0a', 'ni@gmail.com', '0972355023', 'Nghe An', 2),
(46, 'mark', '0e7517141fb53f21ee439b355b5a1d0a', 'mark@gmail.com', '0972355023', 'Seoul', 0),
(47, 'bi1', '0e7517141fb53f21ee439b355b5a1d0a', 'bi@gmail.com', '0987765432', '', 0),
(48, 'bi2', '0e7517141fb53f21ee439b355b5a1d0a', '1@gmail.com', '0987654321', '', 0),
(49, 'bi12', '0e7517141fb53f21ee439b355b5a1d0a', 'ni@gmail.com', '0972355023', '', 0),
(50, 'bi13', '0e7517141fb53f21ee439b355b5a1d0a', 'ni@gmail.com', '0972355023', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
