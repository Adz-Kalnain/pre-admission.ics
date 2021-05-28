-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2021 at 04:41 PM
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
-- Table structure for table `admissionbatch`
--

CREATE TABLE `admissionbatch` (
  `id` int(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` int(5) NOT NULL,
  `schoolyear` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admissionbatch`
--

INSERT INTO `admissionbatch` (`id`, `start_date`, `end_date`, `is_active`, `schoolyear`) VALUES
(1, '2022-01-01', '2022-01-20', 1, '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE `attachment` (
  `id` int(11) NOT NULL,
  `cet_path` text NOT NULL,
  `gmoral_path` text NOT NULL,
  `gpa_path` text NOT NULL,
  `shiftee_path` text DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `cetValue` varchar(100) NOT NULL,
  `gpaValue` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attachment`
--

INSERT INTO `attachment` (`id`, `cet_path`, `gmoral_path`, `gpa_path`, `shiftee_path`, `user_id`, `cetValue`, `gpaValue`) VALUES
(27, 'CHAPTER-III (2).docx', 'CHAPTER-III.docx', 'wmsucare-thesis.docx', NULL, 8, '95.2', '85'),
(28, 'CHAPTER-III (2).docx', 'wmsucare-thesis.docx', 'CHAPTER-III (3).docx', NULL, 8, '95.2', '85'),
(29, 'wmsucare-thesis.docx', 'CHAPTER-III (1).docx', 'CHAPTER-III (3).docx', NULL, 8, '95.2', '85'),
(30, 'Assignment 01.pdf', 'CHAPTER-III.docx', 'chapter2.docx', NULL, 8, '23', '23'),
(31, 'Assignment 01.pdf', 'CHAPTER-III.docx', 'concept_map.pdf', NULL, 8, '95.2', '85'),
(32, 'FacialRecognition_Chapter1-2-3[FINAL].docx', 'POWERPOINT-2.pptx', 'FacialRecognition_Chapter1-2-3.docx', NULL, 8, '95.2', '23'),
(33, 'FacialRecognition_Chapter1-2-3[FINAL].docx', 'FacialRecognition_Chapter1-2-3.docx', 'CHAPTER-I_II_III (1).docx', NULL, 8, '95.2', '23'),
(34, '01-CS138 - CS Elective 3.pdf', '02-CS138 - CS Elective 3.pdf', '03-CS138 - CS Elective 3.pdf', NULL, 15, '90', '90'),
(35, '05-CS138 - CS Elective 3 - Activity.pdf', '03-CS138 - CS Elective 3.pdf', '02-CS138 - CS Elective 3.pdf', NULL, 16, '95.5', '96.6');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(100) NOT NULL,
  `college_name` varchar(100) NOT NULL,
  `college_img` text DEFAULT NULL,
  `college_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `college_name`, `college_img`, `college_description`) VALUES
(1, 'Institute of Computer Studies', 'ics_seal.jpg', 'mememememememeeh'),
(2, 'College of Engineering', 'engineering.jfif', 'meow'),
(3, 'College of Nursing', 'nursing.png', 'Nursing '),
(4, 'College of Agriculture', NULL, 'Plant Veggies'),
(5, 'College of Architecture', NULL, 'Drawing is Life'),
(6, 'College of Asian and Islamic Studies', NULL, 'm'),
(7, 'College of Criminal Justice Education', NULL, 'Train to be Cardo'),
(8, 'College of Forestry and Environmental Studies', NULL, 'Plant trees to save the world\r\n'),
(9, 'College of Home Economics', NULL, 'Learn to be a good housewife'),
(10, 'College of Law', NULL, 'Knowledge is Power'),
(11, 'College of Liberal Arts', NULL, 'Sitting Pretty'),
(12, 'College of Public Administration and Development Studies', NULL, 'IDK wtf is this'),
(13, 'College of Sports Science and Physical Education', NULL, 'Dancing is Life'),
(14, 'College of Science and Mathematics', NULL, 'Intelligence100'),
(15, 'College of Social Work and Community Development', NULL, 'Lazy af'),
(16, 'College of Teacher Education', 'teacher.jpg', 'Pasensya is increased to 100'),
(17, 'sample college', NULL, '10101010101001');

-- --------------------------------------------------------

--
-- Table structure for table `coursestbl`
--

CREATE TABLE `coursestbl` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` varchar(1000) NOT NULL,
  `college_id` int(11) NOT NULL,
  `course_img` text DEFAULT NULL,
  `quota` int(200) DEFAULT NULL,
  `waiting` int(200) DEFAULT NULL,
  `cet_req` float DEFAULT NULL,
  `gpa_req` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursestbl`
--

INSERT INTO `coursestbl` (`course_id`, `course_name`, `course_description`, `college_id`, `course_img`, `quota`, `waiting`, `cet_req`, `gpa_req`) VALUES
(11, 'Bachelor of Science in Computer Science', 'Computer science is the study of how data and instructions are processed,\r\n                            stored and communicated by computing devices. It involves designing software and addressing\r\n                            fundamental scientific questions about the nature of computation but also involves many\r\n                            aspects of hardware and the architecture of large computer systems.', 1, 'ics_seal.jpg', 120, 20, 80, 80),
(12, 'Bachelor of Science in Information Technology', 'Information technologists help companies and offices in a technological\r\n                            environment stay competitive and active. They help keep all computers in an office running\r\n                            smoothly by conducting repetitive databases and network security activities.', 1, 'ics_seal.jpg', NULL, NULL, 80, 80),
(13, 'Nursing', 'Save Life', 3, 'nursing.png', NULL, NULL, NULL, NULL),
(15, 'Bachelor of Science major in Civil Engineering', 'A six-semester or three–year curriculum prepares the students to do design, construction of physical structures. Students are also equipped and oriented on plumbing, irrigation, flood control and other engineering structure development. This qualifies the graduates to take the junior geodetic, urban planning and plumbing licensure examinations.', 2, 'CivilE.png', NULL, NULL, 80, 80),
(16, 'Bachelor of Science major in Electrical Engineering', 'A six-semester curriculum emphasizes on the design, installation, operation and maintenance of various electrical equipment and apparatuses. It covers applications as to generation, transmission, distribution and utilization of electrical energy for different industrial and commercial uses.', 2, 'EE.png', NULL, NULL, NULL, NULL),
(17, 'Bachelor of Science major in Electronics Engineering', 'A six-semester curriculum emphasizes on the design, installation, operation and maintenance of various electrical equipment and apparatuses. It covers applications as to generation, transmission, distribution and utilization of electrical energy for different industrial and commercial uses.', 2, 'Electronics.png', NULL, NULL, 85, 85),
(21, 'Bachelor of Science major in Industrial Engineering', 'A three-year specialized curriculum which prepare students to do design, improvement, installation and maintenance of integrated systems covering information, materials, methods, and people. The curriculum encompasses the engineering and social sciences, industrial management and human behavior.', 2, 'Industrial E.png', NULL, NULL, NULL, NULL),
(23, 'Bachelor of Science major in Mechanical Engineering', 'A three-year specialized curriculum which emphasizes the professionalism in mechanical engineering and practice. It provides the fundamental knowledge, theoretical as well as the practical handling of various machineries. Students analyze its structures and construction, cycles, functions and operations.', 2, 'ME.png', NULL, NULL, NULL, NULL),
(24, 'Bachelor of Science major in Sanitary Engineering', 'A six-semester or three–year curriculum prepares the students to do design, construction of physical structures. Students are also equipped and oriented on plumbing, irrigation, flood control and other engineering structure development. This qualifies the graduates to take the junior geodetic, urban planning and plumbing licensure examinations.', 2, 'Sanitary E.png', NULL, NULL, NULL, NULL),
(25, 'Bachelor of Science major in Geodetic Engineering', 'A five-year engineering course with two years pre – general engineering course plus three years major course. A licensure examination is required for one to practice as a Geodetic Engineer.', 2, 'Geo.png', NULL, NULL, NULL, NULL),
(26, 'Bachelor of Science major in Computer Engineering', 'A three-year curriculum which prepares students to be highly knowledgeable in computer hardware. The program exposes the students to various approaches in dealing with problems in computer hardware design and other computer based devices.', 2, 'ComE.png', NULL, NULL, NULL, NULL),
(27, 'Bachelor of Science major in Environmental Engineering', 'After taking the 2–year pre–engineering course, students can proceed to take BS Environmental Engineering, for another three years for the major subjects in the course. This course is concerned with the environment, management of the natural resources, care about the biological, chemical and physical reactions in the air, land and water environments and on the latest technology for integrated management systems which relates to reuse, recycle, reduction and recovery measures. This course also covers management of liquid resources (potable and other uses), solid waste, reduction of air and land contamination, toxic and hazardous wastes, protection and preservation of wildlife habitat, endangered species and overall well–being of the ecosystem.', 2, 'Environmental E.png', NULL, NULL, NULL, NULL),
(28, 'Bachelor of Science major in Agricultural and Biosystem Engineering', 'The level of mechanization of agriculture determines the development of agriculture and the development of human society.', 2, 'AgriE.jpg', NULL, NULL, NULL, NULL),
(29, 'Bachelor of Elementary Education (BEED)', '', 16, 'teacher.jpg', NULL, NULL, NULL, NULL),
(30, 'Bachelor of Secondary Education major in English (BSED) ', '', 16, 'teacher.jpg', NULL, NULL, NULL, NULL),
(31, 'Bachelor of Culture and the Arts Education (BCAED) ', '', 16, 'teacher.jpg', NULL, NULL, NULL, NULL),
(32, 'Bachelor of Early Childhood Education (BECE)', '', 16, 'teacher.jpg', NULL, NULL, NULL, NULL),
(33, 'Bachelor of Special Needs Education (BSNED)', '', 16, 'teacher.jpg', NULL, NULL, NULL, NULL),
(34, 'BA MasCom', '', 11, NULL, NULL, NULL, NULL, NULL),
(35, 'BS Accountancy', '', 11, 'Accountancy.jpg', NULL, NULL, NULL, NULL),
(36, 'BS Psychology', '', 11, NULL, NULL, NULL, NULL, NULL),
(37, 'BS Economics', '', 11, NULL, NULL, NULL, NULL, NULL),
(38, 'BA English', '', 11, NULL, NULL, NULL, NULL, NULL),
(39, 'BA Filipino', '', 11, NULL, NULL, NULL, NULL, NULL),
(40, 'BS Political Science', '', 11, NULL, NULL, NULL, NULL, NULL),
(41, 'Biology', '', 14, NULL, NULL, NULL, NULL, NULL),
(42, 'BS Chemistry', '', 14, NULL, NULL, NULL, NULL, NULL),
(43, 'BS Physics', '', 14, NULL, NULL, NULL, NULL, NULL),
(44, 'BS Statistic', '', 14, NULL, NULL, NULL, NULL, NULL),
(45, 'BS Criminology', '', 7, NULL, NULL, NULL, NULL, NULL),
(46, 'BPEd', '', 13, NULL, NULL, NULL, NULL, NULL),
(47, 'Bachelor of Secondary Education major in Filipino (BSED) ', '', 16, 'teacher.jpg', NULL, NULL, NULL, NULL),
(48, 'Bachelor of Secondary Education major in Values Education (BSED) ', '', 16, 'teacher.jpg\r\n', NULL, NULL, NULL, NULL),
(49, 'Bachelor of Secondary Education major in Science (BSED) ', '', 16, 'teacher.jpg', NULL, NULL, NULL, NULL),
(50, 'Bachelor of Secondary Education major in Mathematics (BSED) ', '', 16, 'teacher.jpg', NULL, NULL, NULL, NULL),
(51, 'Bachelor of Secondary Education major in Social Sciences (BSED) ', '', 16, 'teacher.jpg', NULL, NULL, NULL, NULL),
(52, 'Bachelor of Science in Information System', 'Bawal kame dito!', 1, NULL, NULL, NULL, NULL, NULL),
(59, 'BS MedTech', 'Gusto ko sana dito', 3, NULL, NULL, NULL, 75, 75);

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

--
-- Dumping data for table `interviewertbl`
--

INSERT INTO `interviewertbl` (`id`, `ic_name`, `ic_date`, `ic_timefrom`, `ic_timeto`, `college`) VALUES
(5, 'Maam Paulin', '2022-01-06', '07:00:00.0000', '11:00:00.0000', 'ics');

-- --------------------------------------------------------

--
-- Table structure for table `selectedcourse`
--

CREATE TABLE `selectedcourse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `userStatus` varchar(100) DEFAULT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selectedcourse`
--

INSERT INTO `selectedcourse` (`id`, `user_id`, `course_id`, `file_id`, `userStatus`, `date`) VALUES
(28, 8, 11, 33, 'VERIFIED', '2021:05:26'),
(29, 15, 15, 34, 'VERIFIED', '2021:05:28'),
(30, 16, 11, 35, 'PENDING', '2021:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `email`, `user_type`, `password`) VALUES
(1, 'blue', '', '', 'blue@gmail.com', 'ics-ao', '48d6215903dff56238e52e8891380c8f'),
(4, 'violet', '', '', 'violet@gmail.com', 'ic', 'd1d813a48d99f0e102f7d0a1b9068001'),
(5, 'teal', '', '', 'teal@gmail.com', 'admin', '3c4184e82bb3be8fa32669800fb7373c'),
(6, 'cyan', '', '', 'cyan@gmail.com', 'evaluator', '6411532ba4971f378391776a9db629d3'),
(7, 'gold', '', '', 'gold@gmail.com', 'coe-ao', 'e07e81c20cf5935f5225765f0af81755'),
(8, 'silver', 'ronald ', 'fuentebella', 'silver@gmail.com', 'user', '97f014516561ef487ec368d6158eb3f4'),
(9, 'grey', 'jayson', 'beltran', 'grey@gmail.com', 'user', 'ca50000a180a293de0b27acb67a695cb'),
(10, 'mark', 'mark', 'tubat', 'mark@gmail.com', 'user', 'ea82410c7a9991816b5eeeebe195e20a'),
(11, 'josh', 'josh', 'habil', 'josh@gmail.com', 'user', 'f94adcc3ddda04a8f34928d862f404b4'),
(12, 'Ken', 'Kenneth', 'Emmanuel', 'Ken@gmail.com', 'user', '202cb962ac59075b964b07152d234b70'),
(13, 'Mig', 'Migfren', 'Limen', 'Migfren@gmail.com', 'user', '202cb962ac59075b964b07152d234b70'),
(14, 'Aizzy', 'Aizzy Dianne', 'Algupera', 'Aizzy@gmail.com', 'user', '202cb962ac59075b964b07152d234b70'),
(15, 'red', 'color', 'red', 'red@gmail.com', 'user', 'bda9643ac6601722a28f238714274da4'),
(16, 'green', 'color', 'green', 'green@gmail.com', 'user', '9f27410725ab8cc8854a2769c7a516b8'),
(17, 'yello', 'color', 'yellow', 'yello@gmail.com', 'ao', 'd487dd0b55dfcacdd920ccbdaeafa351'),
(18, 'black', 'color', 'black', 'black@gmail.com', '0', '1ffd9e753c8054cc61456ac7fac1ac89'),
(19, 'white', 'color', 'white', 'white@gmail.com', 'ics-ao', 'd508fe45cecaf653904a0e774084bb5c'),
(20, 'Color', 'Orange', 'Orange', 'orange@gmail.com', 'coe-evaluator', 'be0d2904c9e06433f9401ed0211be7e9'),
(21, 'Color', 'Pink', 'Pink', 'pink@gmail.com', 'coe-ic', '4a0b0dcedd48f780778d1cd1bb8f9877'),
(22, 'pitch', 'Color', 'Pitch', 'pitch@gmail.com', 'coe-ic', '8ee0b79fb35b0efe85b44c0ee243f8d5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admissionbatch`
--
ALTER TABLE `admissionbatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`user_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `coursestbl`
--
ALTER TABLE `coursestbl`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `collegeid` (`college_id`);

--
-- Indexes for table `interviewertbl`
--
ALTER TABLE `interviewertbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selectedcourse`
--
ALTER TABLE `selectedcourse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseid` (`course_id`),
  ADD KEY `fileid` (`file_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admissionbatch`
--
ALTER TABLE `admissionbatch`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attachment`
--
ALTER TABLE `attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `coursestbl`
--
ALTER TABLE `coursestbl`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `interviewertbl`
--
ALTER TABLE `interviewertbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `selectedcourse`
--
ALTER TABLE `selectedcourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachment`
--
ALTER TABLE `attachment`
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `coursestbl`
--
ALTER TABLE `coursestbl`
  ADD CONSTRAINT `collegeid` FOREIGN KEY (`college_id`) REFERENCES `college` (`college_id`);

--
-- Constraints for table `selectedcourse`
--
ALTER TABLE `selectedcourse`
  ADD CONSTRAINT `courseid` FOREIGN KEY (`course_id`) REFERENCES `coursestbl` (`course_id`),
  ADD CONSTRAINT `fileid` FOREIGN KEY (`file_id`) REFERENCES `attachment` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
