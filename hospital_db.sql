-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2026 at 07:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Doctor') DEFAULT 'Doctor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Dr. Amit', 'amit@gmail.com', 'hashed_password', 'Doctor', '2026-02-28 17:23:54'),
(2, 'SHUBHAM GANESH SONAWANE ', 'shubhsonawane6070@gmail.com', '$2y$10$GLuU3FcqokjLCbYYwQcYw.ZmhDaumD60X4aDp7IJjiYhKXBK976I6', 'Admin', '2026-02-28 17:29:13'),
(3, 'omkar', 'omkar@gmail.com', '$2y$10$YAHaWa1I0N63E9X9aS/P1OYXBNH.aVf0C817tvl6xB2WBJWON2bpK', 'Admin', '2026-02-28 17:36:13'),
(4, 'shubham sonawane', 'shubham@gmail.com', '$2y$10$69tYyQEy.uW9xSIO8LwKS.3MVi5JAOrMWcmk2QXgjkDRKRRQ3FaXy', 'Doctor', '2026-02-28 17:40:01');

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `bed_id` int(11) NOT NULL,
  `bed_type` varchar(50) DEFAULT NULL,
  `total_beds` int(11) DEFAULT NULL,
  `available_beds` int(11) DEFAULT NULL,
  `status` enum('Available','Full') DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`bed_id`, `bed_type`, `total_beds`, `available_beds`, `status`) VALUES
(1, 'ICU', 20, 11, 'Available'),
(2, 'General', 100, 12, 'Available'),
(3, 'Ventilator', 15, 10, 'Available'),
(4, 'Emergency', 30, 11, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_status`
--

CREATE TABLE `hospital_status` (
  `id` int(11) NOT NULL,
  `emergency_patients` int(11) DEFAULT NULL,
  `icu_beds` int(11) DEFAULT NULL,
  `staff_on_duty` int(11) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_status`
--

INSERT INTO `hospital_status` (`id`, `emergency_patients`, `icu_beds`, `staff_on_duty`, `last_updated`) VALUES
(1, 56, 12, 59, '2026-02-28 17:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `disease` varchar(100) DEFAULT NULL,
  `admission_type` varchar(50) DEFAULT NULL,
  `bed_type` varchar(50) DEFAULT NULL,
  `status` enum('Admitted','Discharged') DEFAULT 'Admitted',
  `admission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `patient_login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `patient_name`, `age`, `disease`, `admission_type`, `bed_type`, `status`, `admission_date`, `patient_login_id`) VALUES
(1, 'Ganesh ragnath sonawane', 22, 'Fever', 'Emergency', 'General', 'Admitted', '2026-02-28 18:29:31', NULL),
(2, '', 19, 'korona', 'Emergency', 'Ventilator', 'Admitted', '2026-02-28 18:39:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `patients_login`
--

CREATE TABLE `patients_login` (
  `patient_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_login`
--

INSERT INTO `patients_login` (`patient_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, ' Ganesh  ragnath sonawane ', 'ganesh@gmail.com', '$2y$10$WEPohQdwaKKhC100J4i6BuGe9.7/aW9wii654q4/zx/a2tojSdXA2', '2026-02-28 18:17:01'),
(2, 'Amit k Zend', 'amit@gmail.com', '$2y$10$UjDWjjK7asf8JM1DBxf7he3IC8rXdwR60d4b6258tzb32JrPXSYAi', '2026-02-28 18:38:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`bed_id`);

--
-- Indexes for table `hospital_status`
--
ALTER TABLE `hospital_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patients_login`
--
ALTER TABLE `patients_login`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients_login`
--
ALTER TABLE `patients_login`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
