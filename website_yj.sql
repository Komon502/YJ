-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 08:56 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `A_ID` int(11) NOT NULL,
  `A_Username` varchar(50) NOT NULL,
  `A_Password` varchar(255) NOT NULL,
  `A_Name` varchar(100) NOT NULL,
  `A_Email` varchar(100) NOT NULL,
  `A_Phone` varchar(20) DEFAULT NULL,
  `A_Role` enum('Admin','Staff') DEFAULT 'Staff',
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`A_ID`, `A_Username`, `A_Password`, `A_Name`, `A_Email`, `A_Phone`, `A_Role`, `Created_At`) VALUES
(1, 'test1', '$2y$10$HZ.fMtO8l/dToPAYqMm5q.TElTeMg8tbTTHWLvPgnLr3DBOaObEC6', 'Test', '', '0923956666', '', '2025-09-23 12:04:01');

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
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `CourseName`, `Category`, `Description`, `Duration`, `Fee`, `Teacher`, `Image`) VALUES
(1, 'Content Creator & Youtuber', 'Web Development', 'การทำคอนเทนต์บน YouTube และแพลตฟอร์มอื่นๆ\r\nการร้องเพลง (Singing)\r\nเล่นดนตรี (Piano, Guitar)\r\nเขียนเพลง & แต่งเพลง\r\nการทำ Voice Over และการพูดพิธีกร (MC)\r\nการแสดงโชว์ผ่าน Free VDO Showcase\r\nกิจกรรมพิเศษ: ออก Event ทุกเดือน', '8 ชั่วโมง', 5900.00, 'ครู Ichi', '1758644459_course1.png'),
(2, 'Singing & Personality', 'Music', 'เทคนิคการร้องเพลงพื้นฐาน & ขั้นสูง\r\nการใช้เสียง และการปรับโทนเสียง\r\nการพัฒนา บุคลิกภาพ (Personality Development)\r\nการพูด การแสดง และการสื่อสารบนเวที', '8 ชั่วโมง', 4900.00, 'ครูเบลล่า', '1758647155_course2.png'),
(3, 'Youtuber & Editing', 'Media', 'การสร้างคอนเทนต์ YouTube ตั้งแต่ 0\r\nการใช้ Canva ทำกราฟิก & โปสเตอร์\r\nRoblox Game Content การเล่นและทำคลิปเกม\r\nการใช้ CapCut ตัดต่อวิดีโอ\r\nการเล่าเรื่อง (Storytelling) และการนำเสนอ', '8 ชั่วโมง', 4900.00, 'ครูต๊ะ, ครูโจม', '1758647184_course3.png');

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
  `E_Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `E_Title`, `E_Detail`, `E_StartDate`, `E_EndDate`, `E_Location`, `E_Image`) VALUES
(11, 'Kids Market ', '-', '2025-09-27', '2025-09-28', 'The Mall Korat Creator Contest', '1758648048_kidmarket.jpg'),
(14, 'Kids Market', '-', '2025-09-22', '2025-09-26', 'The Mall Korat Creator Contest', '1758651018_kidmarket.jpg'),
(15, 'Kids Market', '-', '2025-09-01', '2025-09-23', 'The Mall Korat Creator Contest', '1758651038_kidmarket.jpg'),
(16, 'Kids Market', '-', '2025-09-17', '2025-09-22', 'The Mall Korat Creator Contest', '1758652097_kidmarket.jpg'),
(17, 'Kids Market', '-', '2025-09-24', '2025-09-25', 'The Mall Korat Creator Contest', '1758652122_kidmarket.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`A_ID`),
  ADD UNIQUE KEY `A_Username` (`A_Username`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `A_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
