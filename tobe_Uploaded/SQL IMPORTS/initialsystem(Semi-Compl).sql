-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2021 at 12:43 PM
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
-- Table structure for table `admissiondatetbl`
--

CREATE TABLE `admissiondatetbl` (
  `id` int(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `schoolyear` varchar(255) NOT NULL,
  `is_active` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admissiondatetbl`
--

INSERT INTO `admissiondatetbl` (`id`, `start_date`, `end_date`, `schoolyear`, `is_active`) VALUES
(1, '0000-00-00', '0000-00-00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coursestbl`
--

CREATE TABLE `coursestbl` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `coursemajor` varchar(255) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursestbl`
--

INSERT INTO `coursestbl` (`course_id`, `course_name`, `coursemajor`, `course_description`, `college`) VALUES
(4, 'Computer Engineering', '', 'Ewan lng..', 'coe'),
(5, 'Civil Engineering', '', 'Ewan lng den ulet..', 'coe'),
(6, 'Mechanical Engineering', '', 'Ewan lang den ulet..ulet..', 'coe'),
(7, 'Sanitary Engineering', '', 'Ewan', 'coe'),
(8, 'Electrical Engineering', '', 'Ewan', 'coe'),
(12, 'Computer Science', 'Software Engineering', '--none--', 'ics'),
(13, 'Information Technology', 'Web Dev', '---NONE--', 'ics');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interviewertbl`
--

CREATE TABLE `interviewertbl` (
  `id` int(11) NOT NULL,
  `ic_name` varchar(255) NOT NULL,
  `ic_date` date NOT NULL,
  `ic_timefrom` time(4) NOT NULL,
  `ic_timeto` time(4) NOT NULL,
  `college` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `admissiondatetbl`
--
ALTER TABLE `admissiondatetbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursestbl`
--
ALTER TABLE `coursestbl`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`user_id`);

--
-- Indexes for table `interviewertbl`
--
ALTER TABLE `interviewertbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotatbl`
--
ALTER TABLE `quotatbl`
  ADD PRIMARY KEY (`quota_id`);

--
-- Indexes for table `requirementtbl`
--
ALTER TABLE `requirementtbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admissiondatetbl`
--
ALTER TABLE `admissiondatetbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coursestbl`
--
ALTER TABLE `coursestbl`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `interviewertbl`
--
ALTER TABLE `interviewertbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quotatbl`
--
ALTER TABLE `quotatbl`
  MODIFY `quota_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requirementtbl`
--
ALTER TABLE `requirementtbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
