-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 16, 2023 at 11:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_managements`
--

-- --------------------------------------------------------

--
-- Table structure for table `sms_attendance`
--

CREATE TABLE `sms_attendance` (
  `attendance_id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `class_id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `attendance_status` int(11) NOT NULL,
  `attendance_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_classes`
--

CREATE TABLE `sms_classes` (
  `class_id` int(11) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `teacher_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_classes`
--

INSERT INTO `sms_classes` (`class_id`, `class`, `section`, `teacher_id`) VALUES
(1, '1', 'B', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sms_section`
--

CREATE TABLE `sms_section` (
  `section_id` int(11) UNSIGNED NOT NULL,
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_section`
--

INSERT INTO `sms_section` (`section_id`, `section`) VALUES
(5, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `sms_students`
--

CREATE TABLE `sms_students` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `mobile` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `current_address` text NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `father_mobile` int(11) UNSIGNED NOT NULL,
  `father_occupation` varchar(255) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `mother_mobile` int(11) UNSIGNED NOT NULL,
  `mother_occupation` varchar(255) NOT NULL,
  `admission_no` int(11) UNSIGNED NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `admission_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_students`
--

INSERT INTO `sms_students` (`id`, `name`, `gender`, `dob`, `photo`, `mobile`, `email`, `current_address`, `father_name`, `father_mobile`, `father_occupation`, `mother_name`, `mother_mobile`, `mother_occupation`, `admission_no`, `class`, `section`, `admission_date`) VALUES
(1, ' Tran Truong', 'male', '2003-01-01', '1680575341avatar11.jpg', 123456789, '21020418@vnu.edu.vn', 'address.', 'Khanh', 0, '', 'Phong', 0, '', 21020418, '1', 'B', '2021-09-15'),
(3, ' Tran Tat Viet', 'male', '2003-09-11', '1681478164avatar13.jpg', 979235038, '21020132@vnu.edu.vn', 'Address.', 'Toan', 0, '', 'Phong', 0, '', 21020132, '1', 'B', '2021-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `sms_subjects`
--

CREATE TABLE `sms_subjects` (
  `subject_id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_subjects`
--

INSERT INTO `sms_subjects` (`subject_id`, `subject`, `type`, `code`) VALUES
(1, 'English', 'Theoretical', 210);

-- --------------------------------------------------------

--
-- Table structure for table `sms_teacher`
--

CREATE TABLE `sms_teacher` (
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `admission_date` date NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(11) UNSIGNED NOT NULL,
  `current_address` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_teacher`
--

INSERT INTO `sms_teacher` (`teacher_id`, `firstname`, `lastname`, `gender`, `subject`, `class`, `section`, `admission_date`, `dob`, `email`, `mobile`, `current_address`, `photo`) VALUES
(4, 'John', 'Doe', 'female', 'English', '1', 'B', '2010-01-01', '1980-01-01', 'janedoe@vnu.edu.vn', 12346789, 'address.', '1681634010avatar10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sms_user`
--

CREATE TABLE `sms_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_user`
--

INSERT INTO `sms_user` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`) VALUES
(1, 'Viet', 'Tran Tat', 'cucululu', 'trantatviet2003@gmail.com', '$2y$10$AAPlDb4suijBDEqsOyDES.fGfj2b3sZGC4fft89uTNZlvejerXpQ6', '1679902455avatar14.jpg', 1),
(2, 'Truong', 'Tran', 'Xuan Truong', '21020418@vnu.edu.vn', '$2y$10$acBpP4zeJm3sq3Aj7Ad/u.WCRCTseJvyNcbWhjzrzI4IzvSDZhqR6', '1680575341avatar11.jpg', 0),
(4, 'Tat Viet', 'Tran', 'Tat Viet', '21020132@vnu.edu.vn', '$2y$10$oCd6erhfXCsMsZn1t/LS5eGBWyPa2m0c5HyXRTfjQUBG8yq4OUQ5a', '1681478164avatar13.jpg', 0),
(12, 'John', 'Doe', 'Jane', 'janedoe@vnu.edu.vn', '$2y$10$lcaF6IsyLybNFLKNDyRggeU.rgkO.FvtJDGrVoT75DsscyEZowonW', '1681634010avatar10.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `FK_attdStudent` (`student_id`),
  ADD KEY `FK_attdClass` (`class_id`),
  ADD KEY `FK_attdSection` (`section_id`);

--
-- Indexes for table `sms_classes`
--
ALTER TABLE `sms_classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `class` (`class`),
  ADD KEY `FK_classSection` (`section`),
  ADD KEY `FK_classTeacher` (`teacher_id`);

--
-- Indexes for table `sms_section`
--
ALTER TABLE `sms_section`
  ADD PRIMARY KEY (`section_id`),
  ADD UNIQUE KEY `section` (`section`),
  ADD UNIQUE KEY `section_2` (`section`);

--
-- Indexes for table `sms_students`
--
ALTER TABLE `sms_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_studentSection` (`section`),
  ADD KEY `FK_studentClass` (`class`);

--
-- Indexes for table `sms_subjects`
--
ALTER TABLE `sms_subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `sms_teacher`
--
ALTER TABLE `sms_teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `FK_teacherSubject` (`subject`),
  ADD KEY `FK_teacherSection` (`section`),
  ADD KEY `FK_teacherClass` (`class`);

--
-- Indexes for table `sms_user`
--
ALTER TABLE `sms_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  MODIFY `attendance_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_classes`
--
ALTER TABLE `sms_classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_section`
--
ALTER TABLE `sms_section`
  MODIFY `section_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sms_students`
--
ALTER TABLE `sms_students`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_subjects`
--
ALTER TABLE `sms_subjects`
  MODIFY `subject_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sms_teacher`
--
ALTER TABLE `sms_teacher`
  MODIFY `teacher_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_user`
--
ALTER TABLE `sms_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  ADD CONSTRAINT `FK_attdSection` FOREIGN KEY (`section_id`) REFERENCES `sms_section` (`section_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_attdStudent` FOREIGN KEY (`student_id`) REFERENCES `sms_students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sms_classes`
--
ALTER TABLE `sms_classes`
  ADD CONSTRAINT `FK_classSection` FOREIGN KEY (`section`) REFERENCES `sms_section` (`section`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_classTeacher` FOREIGN KEY (`teacher_id`) REFERENCES `sms_teacher` (`teacher_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sms_students`
--
ALTER TABLE `sms_students`
  ADD CONSTRAINT `FK_studentClass` FOREIGN KEY (`class`) REFERENCES `sms_classes` (`class`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_studentSection` FOREIGN KEY (`section`) REFERENCES `sms_section` (`section`) ON UPDATE CASCADE;

--
-- Constraints for table `sms_teacher`
--
ALTER TABLE `sms_teacher`
  ADD CONSTRAINT `FK_teacherClass` FOREIGN KEY (`class`) REFERENCES `sms_classes` (`class`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_teacherSection` FOREIGN KEY (`section`) REFERENCES `sms_section` (`section`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_teacherSubject` FOREIGN KEY (`subject`) REFERENCES `sms_subjects` (`subject`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
