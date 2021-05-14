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
-- Table structure for table `quotatbl`
--

CREATE TABLE `quotatbl` (
  `quota_id` int(10) NOT NULL,
  `quota_college` varchar(255) NOT NULL,
  `quota_course` varchar(255) NOT NULL,
  `quota` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotatbl`
--

INSERT INTO `quotatbl` (`quota_id`, `quota_college`, `quota_course`, `quota`) VALUES
(1, 'ics', 'Computer Science', 300),
(2, 'coe', 'Sanitary Engineering', 200),
(3, 'coe', 'Electrical Engineering', 400);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quotatbl`
--
ALTER TABLE `quotatbl`
  ADD PRIMARY KEY (`quota_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quotatbl`
--
ALTER TABLE `quotatbl`
  MODIFY `quota_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
