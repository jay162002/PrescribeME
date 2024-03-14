-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 10:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `active`
--

CREATE TABLE `active` (
  `t` varchar(255) NOT NULL,
  `active_value` varchar(5) NOT NULL,
  `apt_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `t` varchar(255) NOT NULL,
  `appointment_id` int(5) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `appt_date` varchar(30) NOT NULL,
  `appt_time` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `t` varchar(255) NOT NULL,
  `ctr` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`t`, `ctr`) VALUES
('jdtwitter1602@gmail.com', 3004);

-- --------------------------------------------------------

--
-- Table structure for table `date_check`
--

CREATE TABLE `date_check` (
  `t` varchar(255) NOT NULL,
  `dt` varchar(50) NOT NULL,
  `ctr` int(11) NOT NULL,
  `payment` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `date_check_pharma`
--

CREATE TABLE `date_check_pharma` (
  `t` varchar(255) NOT NULL,
  `dt` varchar(50) NOT NULL,
  `ctr` int(11) NOT NULL,
  `payment` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fellow_doctors`
--

CREATE TABLE `fellow_doctors` (
  `t` varchar(255) NOT NULL,
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `clinic_name` varchar(255) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fellow_doctors`
--

INSERT INTO `fellow_doctors` (`t`, `id`, `name`, `phone`, `specialization`, `clinic_name`, `addr`, `city`, `state`) VALUES
('jdtwitter1602@gmail.com', 3045, 'Dr. Atharva Patel', '9106578125', 'Orthopadic', 'Atharva Hospital', 'Shop No 6 Poonamco Op Soc Sai Nagar Vasai, Gandhinagar,Gujarat', 'Gandhinagar', 'Gujarat'),
('jdtwitter1602@gmail.com', 3059, 'Dr. Varun Salat', '7891252230', 'Psychologist', 'Fortis Hospital', 'Ghoda Ghat Chowk, Bhawanipatna,Ahmedabad.', 'Ahmedabad', 'Gujarat'),
('jdtwitter1602@gmail.com', 3060, 'Dr. Margi Dabhi', '8642205156', 'Dentist', 'orasurge dental hospital', '143  Amir House Wode House Road, Near Colaba Bus Stat Colaba, Gandhinagar', 'Gandhinagar', 'Gujarat'),
('jdtwitter1602@gmail.com', 3071, 'Dr. Pooja Darji', '9106894125', 'Paramedic', 'Kauvery Paramedical Hospital', '1134,Dalamal Tower Nariman Point,400021,Ahmedabad', 'Ahmedabad', 'Gujarat');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `t` varchar(255) NOT NULL,
  `id` int(5) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `last_visit` varchar(30) NOT NULL,
  `dt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_total_due`
--

CREATE TABLE `patient_total_due` (
  `t` varchar(255) NOT NULL,
  `id` int(5) NOT NULL,
  `total_due_amt` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `t` varchar(255) NOT NULL,
  `patient_id` int(5) NOT NULL,
  `status` varchar(20) NOT NULL,
  `revenue_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist_cred`
--

CREATE TABLE `pharmacist_cred` (
  `t` varchar(255) NOT NULL,
  `id` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist_dashboard`
--

CREATE TABLE `pharmacist_dashboard` (
  `t` varchar(255) NOT NULL,
  `pres_id` int(30) NOT NULL,
  `id` int(5) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `appt_time` varchar(20) NOT NULL,
  `appt_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist_revenue`
--

CREATE TABLE `pharmacist_revenue` (
  `t` varchar(255) NOT NULL,
  `pres_id` int(30) NOT NULL,
  `id` int(5) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `date` varchar(20) NOT NULL,
  `med_fees` varchar(50) NOT NULL,
  `total_amt` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `t` varchar(255) NOT NULL,
  `id` int(5) NOT NULL,
  `pres_id` int(30) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_complain`
--

CREATE TABLE `prescription_complain` (
  `t` varchar(255) NOT NULL,
  `pres_id` int(30) NOT NULL,
  `id` int(5) NOT NULL,
  `complain` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `severity` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_diagnosis`
--

CREATE TABLE `prescription_diagnosis` (
  `t` varchar(255) NOT NULL,
  `pres_id` int(30) NOT NULL,
  `id` int(5) NOT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_other_details`
--

CREATE TABLE `prescription_other_details` (
  `t` varchar(255) NOT NULL,
  `pres_id` int(30) NOT NULL,
  `id` int(5) NOT NULL,
  `advice` varchar(255) DEFAULT NULL,
  `consultation_fees` int(255) NOT NULL,
  `additional_fees` int(255) NOT NULL,
  `total_fees` int(255) NOT NULL,
  `next_visit_date` varchar(255) DEFAULT NULL,
  `miss_behave_checked` varchar(10) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_rx`
--

CREATE TABLE `prescription_rx` (
  `t` varchar(255) NOT NULL,
  `pres_id` int(30) NOT NULL,
  `id` int(5) NOT NULL,
  `medicine` varchar(255) DEFAULT NULL,
  `dose` varchar(255) DEFAULT NULL,
  `when_rx` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_vitals`
--

CREATE TABLE `prescription_vitals` (
  `t` varchar(255) NOT NULL,
  `pres_id` varchar(30) NOT NULL,
  `id` int(5) NOT NULL,
  `weight` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `pulse` float DEFAULT NULL,
  `temperature` float DEFAULT NULL,
  `bp` float DEFAULT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receptionist_cred`
--

CREATE TABLE `receptionist_cred` (
  `t` varchar(255) NOT NULL,
  `id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE `revenue` (
  `t` varchar(255) NOT NULL,
  `revenue_id` int(20) NOT NULL,
  `id` int(5) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone_no` varchar(12) NOT NULL,
  `date` varchar(20) NOT NULL,
  `con_fees` int(30) NOT NULL,
  `addi_fees` int(30) NOT NULL,
  `total_fees` int(30) NOT NULL,
  `paid_amt` int(30) NOT NULL,
  `amt_duo` int(30) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_login_details`
--

CREATE TABLE `user_login_details` (
  `user_id` int(13) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `sign_up_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active`
--
ALTER TABLE `active`
  ADD UNIQUE KEY `active_value` (`active_value`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `fellow_doctors`
--
ALTER TABLE `fellow_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_total_due`
--
ALTER TABLE `patient_total_due`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`revenue_id`);

--
-- Indexes for table `pharmacist_cred`
--
ALTER TABLE `pharmacist_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacist_dashboard`
--
ALTER TABLE `pharmacist_dashboard`
  ADD PRIMARY KEY (`pres_id`);

--
-- Indexes for table `pharmacist_revenue`
--
ALTER TABLE `pharmacist_revenue`
  ADD PRIMARY KEY (`pres_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD UNIQUE KEY `pres_id` (`pres_id`);

--
-- Indexes for table `prescription_complain`
--
ALTER TABLE `prescription_complain`
  ADD PRIMARY KEY (`pres_id`);

--
-- Indexes for table `prescription_diagnosis`
--
ALTER TABLE `prescription_diagnosis`
  ADD PRIMARY KEY (`pres_id`);

--
-- Indexes for table `prescription_other_details`
--
ALTER TABLE `prescription_other_details`
  ADD PRIMARY KEY (`pres_id`);

--
-- Indexes for table `prescription_rx`
--
ALTER TABLE `prescription_rx`
  ADD PRIMARY KEY (`pres_id`);

--
-- Indexes for table `prescription_vitals`
--
ALTER TABLE `prescription_vitals`
  ADD PRIMARY KEY (`pres_id`);

--
-- Indexes for table `receptionist_cred`
--
ALTER TABLE `receptionist_cred`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `revenue`
--
ALTER TABLE `revenue`
  ADD PRIMARY KEY (`revenue_id`);

--
-- Indexes for table `user_login_details`
--
ALTER TABLE `user_login_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pharmacist_cred`
--
ALTER TABLE `pharmacist_cred`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `receptionist_cred`
--
ALTER TABLE `receptionist_cred`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_login_details`
--
ALTER TABLE `user_login_details`
  MODIFY `user_id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
