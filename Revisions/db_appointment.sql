-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2021 at 02:58 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clinic`
--

CREATE TABLE `tbl_clinic` (
  `clinic_id` int(11) NOT NULL,
  `clinic_name` varchar(50) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `upload_permit` text NOT NULL,
  `com_address` varchar(200) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clinic_schedule`
--

CREATE TABLE `tbl_clinic_schedule` (
  `schedule_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `sched_date` date NOT NULL,
  `slots_avail` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clinic_services`
--

CREATE TABLE `tbl_clinic_services` (
  `service_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `service_name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultation`
--

CREATE TABLE `tbl_consultation` (
  `consultation_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `diagnosis` varchar(200) NOT NULL,
  `treatment` varchar(200) NOT NULL,
  `upload_prescription` text NOT NULL,
  `consultation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor`
--

CREATE TABLE `tbl_doctor` (
  `doctor_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `specialization` text NOT NULL,
  `com_address` varchar(200) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `upload_identity` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `com_address` varchar(200) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `upload_identity` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `appointment_id` int(11) NOT NULL,
  `appointment_no` varchar(15) NOT NULL,
  `a_type` int(1) NOT NULL COMMENT '0=facetoface, 1=virtual',
  `a_date` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_clinic`
--
ALTER TABLE `tbl_clinic`
  ADD PRIMARY KEY (`clinic_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `tbl_clinic_schedule`
--
ALTER TABLE `tbl_clinic_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `tbl_clinic_services`
--
ALTER TABLE `tbl_clinic_services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `clinic_id` (`clinic_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `tbl_consultation`
--
ALTER TABLE `tbl_consultation`
  ADD PRIMARY KEY (`consultation_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `clinic_id` (`clinic_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_clinic`
--
ALTER TABLE `tbl_clinic`
  MODIFY `clinic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_clinic_schedule`
--
ALTER TABLE `tbl_clinic_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_clinic_services`
--
ALTER TABLE `tbl_clinic_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_consultation`
--
ALTER TABLE `tbl_consultation`
  MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
