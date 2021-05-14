-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2021 at 12:52 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `initialsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `college` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`, `name`, `college`) VALUES
(16, 'ronald', 'ronaldxdale@gmail.com', 'user', 'ronald', 'FUENTEBELLA RONALD DALE', 'all'),
(17, 'jayson123', 'jayson@gmail.com', 'user', 'jayson', 'jayson', 'all'),
(22, 'admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'ics'),
(27, 'evaluator', 'evaluator@gmail.com', 'evaluator', '9e76d075c324f87e752db59dbcc8847c', 'ics evaluator', 'ics'),
(28, 'admission', 'admission@gmail.com', 'ao', '281edb7c3cf81e3b67aaa09df4e313f5', 'ics admission officer', 'coe'),
(29, 'coe-evaluator', 'coe-evaluator@gmail.com', 'evaluator', '9e76d075c324f87e752db59dbcc8847c', 'Evaluator Nim', 'coe'),
(30, 'ic', 'ic@gmail.com', 'ic', 'f05a225e14ff5e194a8eef0c6990cefb', 'ics ic', 'ics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
