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
-- Table structure for table `requirementtbl`
--

CREATE TABLE `requirementtbl` (
  `id` int(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `cet` double NOT NULL,
  `gpa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requirementtbl`
--

INSERT INTO `requirementtbl` (`id`, `college`, `course`, `cet`, `gpa`) VALUES
(15, 'coe', 'Civil Engineering', 90, 90),
(23, 'coe', 'Mechanical Engineering', 90, 90),
(30, 'ics', 'IT', 90, 90),
(31, 'coe', 'Sanitary Engineering', 90, 90),
(32, 'ics', 'Computer Science', 90, 90);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `requirementtbl`
--
ALTER TABLE `requirementtbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `requirementtbl`
--
ALTER TABLE `requirementtbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
