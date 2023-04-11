-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 04, 2023 at 02:21 AM
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
  `id` int(11) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `teacher_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_classes`
--

INSERT INTO `sms_classes` (`id`, `section_id`, `class`, `teacher_id`) VALUES
(1, 1, '1', NULL);

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
(1, 'A');

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
  `subject_id` int(11) UNSIGNED DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `admission_date` date NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(11) UNSIGNED NOT NULL,
  `current_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Viet', 'Tran Tat', 'cucululu', 'trantatviet2003@gmail.com', '$2y$10$AAPlDb4suijBDEqsOyDES.fGfj2b3sZGC4fft89uTNZlvejerXpQ6', '1679902455avatar14.jpg', 1);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`class`),
  ADD KEY `FK_classTeacher` (`teacher_id`),
  ADD KEY `class` (`class`),
  ADD KEY `FK_classSection` (`section_id`);

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
  ADD KEY `Fk_studentClass` (`class`),
  ADD KEY `FK_studentSection` (`section`);

--
-- Indexes for table `sms_subjects`
--
ALTER TABLE `sms_subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `sms_teacher`
--
ALTER TABLE `sms_teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `FK_teacherSubject` (`subject_id`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_section`
--
ALTER TABLE `sms_section`
  MODIFY `section_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_students`
--
ALTER TABLE `sms_students`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_subjects`
--
ALTER TABLE `sms_subjects`
  MODIFY `subject_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sms_teacher`
--
ALTER TABLE `sms_teacher`
  MODIFY `teacher_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_user`
--
ALTER TABLE `sms_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  ADD CONSTRAINT `FK_attdClass` FOREIGN KEY (`class_id`) REFERENCES `sms_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_attdSection` FOREIGN KEY (`section_id`) REFERENCES `sms_section` (`section_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_attdStudent` FOREIGN KEY (`student_id`) REFERENCES `sms_students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sms_classes`
--
ALTER TABLE `sms_classes`
  ADD CONSTRAINT `FK_classSection` FOREIGN KEY (`section_id`) REFERENCES `sms_section` (`section_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_classTeacher` FOREIGN KEY (`teacher_id`) REFERENCES `sms_teacher` (`teacher_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sms_students`
--
ALTER TABLE `sms_students`
  ADD CONSTRAINT `FK_studentSection` FOREIGN KEY (`section`) REFERENCES `sms_section` (`section`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_studentClass` FOREIGN KEY (`class`) REFERENCES `sms_classes` (`class`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sms_teacher`
--
ALTER TABLE `sms_teacher`
  ADD CONSTRAINT `FK_teacherSubject` FOREIGN KEY (`subject_id`) REFERENCES `sms_subjects` (`subject_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
