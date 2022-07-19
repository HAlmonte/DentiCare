-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 03:01 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

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
-- Table structure for table `tbl_about`
--

CREATE TABLE `tbl_about` (
  `about_id` int(11) NOT NULL,
  `app_name` text COLLATE utf8_unicode_520_ci NOT NULL,
  `address` text COLLATE utf8_unicode_520_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8_unicode_520_ci NOT NULL,
  `info` text COLLATE utf8_unicode_520_ci NOT NULL,
  `logo` text COLLATE utf8_unicode_520_ci NOT NULL,
  `background_image` text COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `tbl_about`
--

INSERT INTO `tbl_about` (`about_id`, `app_name`, `address`, `contact`, `info`, `logo`, `background_image`) VALUES
(1, 'Telemedecine Appointment System', ' 10th Avenue and A. Mabini Street in Poblacion, Caloocan, Metro Manila, Philippines', '09-4156-155', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam dignissim finibus velit, sed feugiat dolor consectetur interdum. Etiam quam lorem, volutpat in quam sit amet, consequat fringilla tortor. Curabitur augue erat, tristique vel metus eget, posuere fermentum nunc. Quisque vitae lacus vitae odio fringilla tempus. Sed neque sapien, feugiat eu varius ac, malesuada quis mi. Etiam ullamcorper turpis id urna pharetra gravida. Phasellus vehicula, nulla ac dignissim elementum, lorem orci tristique leo, eget aliquam leo dolor a leo. Quisque quis risus sit amet leo laoreet mollis sit amet sed orci. Proin eget elit ipsum.', 'medical-pharmacy-logo-design-template-260nw-287587964.jpg1636371996.jpg', '73611776-flat-medical-ambulance-and-hospital-vector-emergeny-clinic-illustration.jpg1636424384.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clinic`
--

CREATE TABLE `tbl_clinic` (
  `clinic_id` int(11) NOT NULL,
  `clinic_name` varchar(50) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `upload_permit` text NOT NULL,
  `address` varchar(200) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_clinic`
--

INSERT INTO `tbl_clinic` (`clinic_id`, `clinic_name`, `doctor_id`, `upload_permit`, `address`, `latitude`, `longitude`, `status`) VALUES
(1, 'Doctors Clinic', 1, 'logo-default.png1638854606.png', 's', '10.983500', '123.215415', 1),
(2, 'Doctor 2 Clinic', 2, '1.jpg1638854849.jpg', 'sa', '10.963469', '123.255026', 1),
(3, 'My Clinic', 3, 'medical-pharmacy-logo-design-template-260nw-287587964.jpg1638927041.jpg', 'Prk. Brgy. City, Region', '10.9070832', '123.3216839', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clinic_schedule`
--

CREATE TABLE `tbl_clinic_schedule` (
  `schedule_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `slots` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_clinic_schedule`
--

INSERT INTO `tbl_clinic_schedule` (`schedule_id`, `clinic_id`, `date`, `slots`) VALUES
(1, 1, '2021-12-11', 4),
(2, 2, '2021-12-11', 10),
(3, 2, '2021-12-16', 2),
(4, 3, '2021-12-11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultation`
--

CREATE TABLE `tbl_consultation` (
  `consultation_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `diagnosis` text NOT NULL,
  `treatment` text NOT NULL,
  `upload_prescription` text NOT NULL,
  `consultation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_consultation`
--

INSERT INTO `tbl_consultation` (`consultation_id`, `appointment_id`, `patient_id`, `diagnosis`, `treatment`, `upload_prescription`, `consultation_date`) VALUES
(1, 2, 1, 'Colds, fever', 'Paracetamol', 'nejmopv0910749_t1.jpeg1638927967.jpeg', '2021-12-08'),
(2, 3, 3, 'Fever', 'Paracetamol', 'nejmopv0910749_t1.jpeg1638928771.jpeg', '2021-12-08');

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
  `address` varchar(200) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `upload_identity` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_doctor`
--

INSERT INTO `tbl_doctor` (`doctor_id`, `first_name`, `last_name`, `middle_name`, `specialization`, `address`, `contact`, `upload_identity`, `username`, `password`, `status`) VALUES
(1, 'John ', 'M.', 'Doe', 'Optalmologist', 'Address', '09546546546', 'download (1).jpg1638854568.jpg', 'd1', '9948c645c094247794f4c7acdbeb2bb6', 1),
(2, 'Ferdinando', 'Q.', 'Magellian', 'Dermatology', 'asd', '09653232312', 'images.png1638854802.png', 'd2', 'b25b0651e4b6e887e5194135d3692631', 1),
(3, 'Doctor1', 'Mymid', 'Mysur', 'Physician', 'Brgy, City, Region', '09435345564', 'karl52d63034e0a8a.png1638926587.png', 'doctor1', '45f678b147fdf275c35b60bac2360984', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `log_id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`log_id`, `activity`, `time`) VALUES
(1, '<b>John M. Doe</b> added doctor <b>John  M. Doe</b>.', '2021-12-07 01:22:47 pm'),
(2, '<b>John M. Doe</b> added clinic <b>Doctors Clinic</b>.', '2021-12-07 01:23:26 pm'),
(3, '<b>John M. Doe</b> added service <b>Eye Operation</b>.', '2021-12-07 01:23:49 pm'),
(4, '<b>John M. Doe</b> added clinic schedule <b>5 slots on 2021-12-11</b>.', '2021-12-07 01:23:58 pm'),
(5, 'Patient <b>John M. Doe</b> added appointment <b>123</b>.', '2021-12-07 01:24:35 pm'),
(6, '<b>John M. Doe</b> added doctor <b>Ferdinando Q. Magellian</b>.', '2021-12-07 01:26:42 pm'),
(7, '<b>John M. Doe</b> added clinic <b>Doctor 2 Clinic</b>.', '2021-12-07 01:27:28 pm'),
(8, '<b>John M. Doe</b> added service <b>Rashes Checkup</b>.', '2021-12-07 01:28:13 pm'),
(9, '<b>John M. Doe</b> added clinic schedule <b>10 slots on 2021-12-11</b>.', '2021-12-07 01:28:28 pm'),
(10, '<b>John M. Doe</b> added patient <b>Sunn L. Goku</b>.', '2021-12-07 01:30:50 pm'),
(11, '<b>John M. Doe</b> added patient <b>Dray L. Green</b>.', '2021-12-07 01:31:27 pm'),
(12, '<b>John M. Doe</b> added clinic schedule <b>2 slots on 2021-12-16</b>.', '2021-12-07 02:07:40 pm'),
(13, '<b>John M. Doe</b> added patient <b>Patient 1 Mymiddle Mylast</b>.', '2021-12-08 09:21:53 am'),
(14, '<b>John M. Doe</b> added doctor <b>Doctor1 Mymid Mysur</b>.', '2021-12-08 09:23:07 am'),
(15, '<b>John M. Doe</b> added clinic <b>My Clinic</b>.', '2021-12-08 09:30:40 am'),
(16, '<b>John M. Doe</b> added service <b>Complete Checkup</b>.', '2021-12-08 09:32:17 am'),
(17, '<b>John M. Doe</b> added clinic schedule <b>5 slots on 2021-12-11</b>.', '2021-12-08 09:32:35 am'),
(18, 'Patient <b>John M. Doe</b> added appointment <b>123</b>.', '2021-12-08 09:35:08 am'),
(19, '<b>Doctor1 Mysur Mymid</b> added consultation Appointment ID <b>2</b>.', '2021-12-08 09:46:07 am'),
(20, 'Patient <b>Doctor1 Mysur Mymid</b> added appointment <b>456</b>.', '2021-12-08 09:47:31 am'),
(21, 'Patient <b>Patient 1 Mylast Mymiddle</b> added appointment <b>45</b>.', '2021-12-08 09:57:13 am'),
(22, '<b>Patient 1 Mylast Mymiddle</b> cancelled reservation <b>45</b>.', '2021-12-08 09:57:47 am'),
(23, '<b>Doctor1 Mysur Mymid</b> added consultation Appointment ID <b>3</b>.', '2021-12-08 09:59:31 am');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `upload_identity` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`patient_id`, `first_name`, `last_name`, `middle_name`, `birthdate`, `address`, `contact`, `upload_identity`, `username`, `password`, `status`) VALUES
(1, 'Sunn', 'L.', 'Goku', '2021-11-29', 's', '09656523231', 'download.png1638855051.png', 'p1', 'ec6ef230f1828039ee794566b9c58adc', 1),
(2, 'Dray', 'L.', 'Green', '2021-10-05', 's', '09787878787', 'download.jpg1638855088.jpg', 'p2', '1d665b9b1467944c128a5575119d1cfd', 1),
(3, 'Patient 1', 'Mymiddle', 'Mylast', '2000-06-20', 'Prk. Brgy. city', '09343245565', 'std1.PNG1638926513.PNG', 'patient1', '8103cfda42d725cd38e8bdf9610ef9a6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `appointment_id` int(11) NOT NULL,
  `appointment_no` varchar(15) NOT NULL,
  `appointment_type` int(1) NOT NULL COMMENT '0=facetoface, 1=virtual',
  `date` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=pending | 1=completed | 2=cancelled '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`appointment_id`, `appointment_no`, `appointment_type`, `date`, `patient_id`, `service_id`, `remarks`, `status`) VALUES
(2, '123', 0, '2021-12-11', 1, 3, 'ok', 1),
(3, '456', 0, '2021-12-11', 3, 3, 'ok', 1),
(4, '45', 0, '2021-12-11', 3, 3, 'ok', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `service_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `service_name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `amount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`service_id`, `clinic_id`, `doctor_id`, `service_name`, `description`, `amount`) VALUES
(1, 1, 1, 'Eye Operation', 's', '100'),
(2, 2, 2, 'Rashes Checkup', 's', '500'),
(3, 3, 3, 'Complete Checkup', 'try', '100');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_status` int(1) NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `contact`, `address`, `account_status`, `avatar`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'John', 'M.', 'Doe', 'ji@gmail.com', '0923423444', 'Prk. 11, Brgy. 45', 1, 'img-default.jpg'),
(9, '1', 'c4ca4238a0b923820dcc509a6f75849b', 'try', 'r', 'r', 'r@fmail.com', '09546545455', 's', 1, 'download (1).png1638406583.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_about`
--
ALTER TABLE `tbl_about`
  ADD PRIMARY KEY (`about_id`);

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
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_about`
--
ALTER TABLE `tbl_about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_clinic`
--
ALTER TABLE `tbl_clinic`
  MODIFY `clinic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_clinic_schedule`
--
ALTER TABLE `tbl_clinic_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_consultation`
--
ALTER TABLE `tbl_consultation`
  MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
