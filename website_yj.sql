-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2025 at 07:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_yj`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_history`
--

CREATE TABLE `approval_history` (
  `id` int(11) NOT NULL,
  `item_type` enum('event','course') NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` enum('pending','approved','disapproved') NOT NULL DEFAULT 'pending',
  `reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approval_history`
--

INSERT INTO `approval_history` (`id`, `item_type`, `item_id`, `status`, `reason`, `created_at`) VALUES
(1, 'event', 37, 'pending', '', '2025-09-29 07:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(255) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Duration` varchar(100) DEFAULT NULL,
  `Fee` decimal(10,2) DEFAULT NULL,
  `Teacher` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','disapproved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `CourseName`, `Category`, `Description`, `Duration`, `Fee`, `Teacher`, `Image`, `status`) VALUES
(1, 'Content Creator & Youtuber', 'Web Development', 'การทำคอนเทนต์บน YouTube และแพลตฟอร์มอื่นๆ\r\nการร้องเพลง (Singing)\r\nเล่นดนตรี (Piano, Guitar)\r\nเขียนเพลง & แต่งเพลง\r\nการทำ Voice Over และการพูดพิธีกร (MC)\r\nการแสดงโชว์ผ่าน Free VDO Showcase\r\nกิจกรรมพิเศษ: ออก Event ทุกเดือน', '8 ชั่วโมง', 5900.00, 'ครู Ichi', '1758644459_course1.png', 'approved'),
(2, 'Singing & Personality', 'Music', 'เทคนิคการร้องเพลงพื้นฐาน & ขั้นสูง\r\nการใช้เสียง และการปรับโทนเสียง\r\nการพัฒนา บุคลิกภาพ (Personality Development)\r\nการพูด การแสดง และการสื่อสารบนเวที', '8 ชั่วโมง', 4900.00, 'ครูเบลล่า', '1758647155_course2.png', 'approved'),
(3, 'Youtuber & Editing', 'Media', 'การสร้างคอนเทนต์ YouTube ตั้งแต่ 0\r\nการใช้ Canva ทำกราฟิก & โปสเตอร์\r\nRoblox Game Content การเล่นและทำคลิปเกม\r\nการใช้ CapCut ตัดต่อวิดีโอ\r\nการเล่าเรื่อง (Storytelling) และการนำเสนอ', '8 ชั่วโมง', 4900.00, 'ครูต๊ะ, ครูโจม', '1758647184_course3.png', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `E_Title` varchar(255) NOT NULL,
  `E_Detail` text NOT NULL,
  `E_StartDate` date NOT NULL,
  `E_EndDate` date NOT NULL,
  `E_Location` varchar(255) NOT NULL,
  `E_Image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','disapproved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `E_Title`, `E_Detail`, `E_StartDate`, `E_EndDate`, `E_Location`, `E_Image`, `status`) VALUES
(37, 'Kids Market ', 'event แรก', '2025-09-28', '2025-09-30', 'The Mall Korat Creator Contest', '1759128372_kidmarket.jpg', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `item_type` enum('course','event') NOT NULL,
  `item_id` int(11) NOT NULL,
  `action` enum('approved','disapproved') NOT NULL,
  `reason` text DEFAULT NULL,
  `owner` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `item_type`, `item_id`, `action`, `reason`, `owner`, `created_at`) VALUES
(1, 'course', 1, 'approved', NULL, 'owner', '2025-09-26 13:45:21'),
(2, 'course', 2, 'approved', NULL, 'owner', '2025-09-26 13:45:30'),
(3, 'course', 2, 'approved', NULL, 'owner', '2025-09-26 13:46:57'),
(4, 'course', 3, 'approved', NULL, 'owner', '2025-09-26 13:47:02'),
(5, 'event', 23, 'approved', NULL, 'owner', '2025-09-26 13:49:56'),
(6, 'event', 34, 'approved', NULL, 'owner', '2025-09-26 13:50:51'),
(7, 'event', 34, 'approved', NULL, 'owner', '2025-09-26 14:02:22'),
(8, 'event', 35, 'approved', NULL, 'owner', '2025-09-26 14:03:13'),
(9, 'event', 35, 'approved', NULL, 'owner', '2025-09-26 14:03:57'),
(10, 'event', 36, 'approved', NULL, 'owner', '2025-09-26 14:08:34'),
(11, 'event', 36, 'disapproved', 'name wrong', 'owner', '2025-09-26 14:36:58'),
(12, 'event', 36, 'approved', NULL, 'owner', '2025-09-26 14:37:45'),
(13, 'event', 37, 'approved', NULL, 'owner', '2025-09-29 13:46:46'),
(14, 'event', 37, 'approved', NULL, 'owner', '2025-09-29 14:06:51'),
(15, 'course', 3, 'approved', NULL, 'owner', '2025-09-29 14:09:36'),
(16, 'event', 37, 'approved', NULL, 'owner', '2025-09-29 14:15:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval_history`
--
ALTER TABLE `approval_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval_history`
--
ALTER TABLE `approval_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
