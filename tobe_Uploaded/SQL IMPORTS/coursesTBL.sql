-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2021 at 09:19 AM
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
-- Table structure for table `coursestbl`
--

CREATE TABLE `coursestbl` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursestbl`
--

INSERT INTO `coursestbl` (`course_id`, `course_name`, `course_description`, `college`) VALUES
(1, 'Computer Science', 'This course are for courageous only. So, back-off guys.', 'ics'),
(3, 'IT', 'Information Technology', 'ics'),
(4, 'Computer Engineering', 'Ewan lng..', 'coe'),
(5, 'Civil Engineering', 'Ewan lng den ulet..', 'coe'),
(6, 'Mechanical Engineering', 'Ewan lang den ulet..ulet..', 'coe'),
(7, 'Sanitary Engineering', 'Ewan', 'coe'),
(8, 'Electrical Engineering', 'Ewan', 'coe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursestbl`
--
ALTER TABLE `coursestbl`
  ADD PRIMARY KEY (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coursestbl`
--
ALTER TABLE `coursestbl`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
