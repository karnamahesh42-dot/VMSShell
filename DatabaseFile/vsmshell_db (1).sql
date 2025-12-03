-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 12:45 PM
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
-- Database: `vsmshell_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`) VALUES
(2, 'Finance'),
(3, 'HR'),
(1, 'IT'),
(4, 'Procurement'),
(5, 'Stores');

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `reference_person_role` enum('Supervisor','Manager','Mediator','Other') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`id`, `name`, `email`, `phone`, `address`, `description`, `reference_person_role`, `status`, `created_by`, `created_at`) VALUES
(1, 'Mahesh', 'satisht@gmail.com', '8919146333', 'Test', 'Test \r\nDescription', 'Manager', 1, 5, '2025-11-26 11:52:14'),
(2, 'Sathish', 'satish@gmail.com', '8919146333', 'kakinada', 'reference Person', 'Mediator', 1, 5, '2025-11-26 12:12:04'),
(3, 'sreenivas', 'srenivas@gmai.com', '8919146333', 'kakinada', 'abc', 'Manager', 1, 5, '2025-11-27 12:01:19'),
(4, 'Krishna V', 'krishnadvasireddy@gmail.com', '9100060606', 'abnc', 'xyz', 'Manager', 1, 5, '2025-11-28 12:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `reference_visitor_requests`
--

CREATE TABLE `reference_visitor_requests` (
  `id` int(11) NOT NULL,
  `rvr_code` varchar(10) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `visit_date` date NOT NULL,
  `visitor_count` int(11) DEFAULT 1,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(2, 'admin'),
(4, 'security'),
(1, 'superadmin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `security_gate_logs`
--

CREATE TABLE `security_gate_logs` (
  `id` int(11) NOT NULL,
  `visitor_request_id` int(11) NOT NULL,
  `v_code` varchar(10) NOT NULL,
  `check_in_time` datetime DEFAULT NULL,
  `check_out_time` datetime DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security_gate_logs`
--

INSERT INTO `security_gate_logs` (`id`, `visitor_request_id`, `v_code`, `check_in_time`, `check_out_time`, `verified_by`, `created_at`) VALUES
(4, 2, 'V000002', '2025-12-01 11:19:33', '2025-12-01 11:21:37', 5, '2025-12-01 11:19:33'),
(5, 3, 'V000003', '2025-12-01 11:44:51', NULL, 5, '2025-12-01 11:44:51'),
(6, 5, 'V000005', '2025-12-01 16:05:56', '2025-12-01 16:11:00', 13, '2025-12-01 16:05:56'),
(7, 6, 'V000006', '2025-12-01 16:07:15', NULL, 13, '2025-12-01 16:07:15'),
(8, 7, 'V000007', '2025-12-02 11:17:01', NULL, 13, '2025-12-02 11:17:01'),
(11, 8, 'V000008', '2025-12-02 12:27:59', NULL, 13, '2025-12-02 12:27:59'),
(13, 10, 'V000010', '2025-12-02 15:06:32', NULL, 13, '2025-12-02 15:06:32'),
(26, 11, 'V000011', '2025-12-03 10:59:15', NULL, 13, '2025-12-03 10:59:15'),
(27, 9, 'V000009', '2025-12-03 11:36:26', NULL, 13, '2025-12-03 11:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `hash_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT current_timestamp(),
  `email` varchar(150) NOT NULL,
  `employee_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `company_name`, `department_id`, `username`, `password`, `role_id`, `active`, `hash_key`, `created_at`, `created_by`, `email`, `employee_code`) VALUES
(1, 'mahesh', 'UKMPL', 1, 'superadmin', '274d015c638f62ba24b19ca23c9c9503', 1, 1, 'HASHKEY123', '2025-11-20 09:28:43', NULL, 'maheshkarna42@gmail.com', '2523011'),
(5, 'Sreenivas', 'UKMPL', 1, 'itadmin', '7f26dfeae2ef1319cc069e939ce87693', 2, 1, 'HASHKEY123', '2025-11-21 05:54:24', 1, 'ukmledp@ramojifilmcity.com', '12345678'),
(6, 'Prakash', 'UKMPL', 3, 'user2', 'e27f4a867eaceaa81eca368d175a7716', 3, 1, 'HASHKEY123', '2025-11-21 22:15:08', 1, 'prakash@gmail.com', '789654159'),
(7, 'Prasad ', 'UKMPL', 3, 'hrhod', 'f271d1efdfba760f7145d4436f845b8e', 2, 1, 'HASHKEY123', '2025-11-22 05:56:17', 1, 'prasad@gmail.com', '951357456'),
(8, 'Sury kumar', 'UKMPL', 1, 'ituser', '8e3f128f3e5075f40cd8b8361cb1d24d', 3, 1, 'HASHKEY123', '2025-11-24 00:22:13', 1, 'kumar@gmail.com', '87456321'),
(9, 'ramesh', 'UKMPL', 2, 'userlog', 'df15e08a109a1ca36c6129c4033dff9a', 3, 1, 'HASHKEY123', '2025-11-24 03:40:59', 1, 'ramesh@gmail.com', '951456357'),
(10, 'sailesh kumar', 'UKMPL', 2, 'hod', 'c0da0e7607981099b9874324911d646b', 2, 1, 'HASHKEY123', '2025-11-27 23:56:49', 5, 'miscentraloffice@ramojifilmcity.com', '741963258'),
(11, 'Satish Kumar', 'UKMPL', 2, 'FINANCEHOD', 'e27f4a867eaceaa81eca368d175a7716', 2, 1, 'HASHKEY123', '2025-11-30 09:57:12', 5, 'gmaccounts@ramojifilmcity.com', '321987456'),
(12, 'pallam raju', 'UKMPL', 3, 'hruser', '5980d6ad05354bd8681adff071323804', 2, 1, 'HASHKEY123', '2025-11-30 15:37:58', 5, 'raju@gmail.com', '456812397'),
(13, 'khan', 'UKMPL', 5, 'security', '7f56499c9bcb7018d17adba024f12b36', 4, 1, NULL, '2025-12-01 10:32:56', 5, 'khan@gmail.com', '89595875'),
(14, 'Kumar', 'UKMPL', 5, 'kumar', 'b9b580e1f1d30f72a52c9696dfa3c1a3', 3, 0, NULL, '2025-12-02 03:46:21', 5, 'kumar@gmail.com', '53532581');

-- --------------------------------------------------------

--
-- Table structure for table `user_hashkeys`
--

CREATE TABLE `user_hashkeys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `pass_key` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `v_code` varchar(10) NOT NULL,
  `group_code` varchar(20) NOT NULL,
  `visitor_name` varchar(200) NOT NULL,
  `visitor_email` varchar(200) NOT NULL,
  `visitor_phone` varchar(50) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `visit_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `expected_from` time DEFAULT NULL,
  `expected_to` time DEFAULT NULL,
  `host_user_id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected','checked_in','checked_out','closed','no_show') DEFAULT 'pending',
  `securityCheckStatus` tinyint(1) NOT NULL DEFAULT 0,
  `spendTime` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `proof_id_type` varchar(100) DEFAULT NULL,
  `proof_id_number` varchar(100) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `vehicle_no` varchar(50) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `vehicle_id_proof` varchar(255) DEFAULT NULL,
  `visitor_id_proof` varchar(255) DEFAULT NULL,
  `visit_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `v_code`, `group_code`, `visitor_name`, `visitor_email`, `visitor_phone`, `purpose`, `visit_date`, `description`, `expected_from`, `expected_to`, `host_user_id`, `reference_id`, `status`, `securityCheckStatus`, `spendTime`, `created_by`, `created_at`, `updated_at`, `proof_id_type`, `proof_id_number`, `qr_code`, `vehicle_no`, `vehicle_type`, `vehicle_id_proof`, `visitor_id_proof`, `visit_time`) VALUES
(1, 'V000001', 'GV000001', 'mahesh', 'mahesh@gmail.com', '8959586333', 'Meeting', '2025-11-30', 'To Meet CITO ', NULL, NULL, 5, NULL, 'pending', 0, NULL, 5, '2025-11-30 21:57:29', '2025-11-30 21:57:29', 'PAN Card', '123456', NULL, '123AP', 'Bike', '', '', '21:55:00'),
(2, 'V000002', 'GV000001', 'ramesh', 'maheshkarna42@gmail.com', '8959586333', 'Meeting', '2025-11-30', 'To Meet CITO ', NULL, NULL, 5, NULL, 'approved', 2, NULL, 5, '2025-11-30 21:57:29', '2025-12-01 11:21:37', 'PAN Card', '321PAN', 'visitor_2_qr.png', '123AP', 'Bike', '', '', '21:56:00'),
(3, 'V000003', 'GV000002', 'prakash', 'prakash@gmail.com', '8965689666', 'Meeting', '2025-12-01', 'To Meet Electrical HOD', NULL, NULL, 5, NULL, 'approved', 1, NULL, 5, '2025-11-30 21:59:26', '2025-12-01 11:44:51', 'PAN Card', '1586PAN', 'visitor_3_qr.png', 'V125APA', 'Car', '', '', '21:58:00'),
(4, 'V000004', 'GV000003', 'vamsi T', 'vamsi@gmail.com', '8959563333', 'Interview', '2025-12-01', 'Project Meet Purpose ', NULL, NULL, 5, NULL, 'approved', 0, NULL, 5, '2025-11-30 22:04:49', '2025-12-01 11:15:56', 'PAN Card', '25655585', 'visitor_4_qr.png', '', 'Car', '', '', '09:09:00'),
(5, 'V000005', 'GV000004', 'prakash', 'developers@ramojifilmcity.com', '8959586333', 'Meeting', '2025-12-02', 'to Meet CITO Garu', NULL, NULL, 9, NULL, 'approved', 2, '00:05:04', 9, '2025-12-01 15:52:41', '2025-12-01 16:11:00', 'Aadhar Card', '245863696632', 'visitor_5_qr.png', 'AP123TYT366', 'Bike', '1764584561_d09a987936442c4e0eb1.png', '1764584561_e50065c48f30de3bd02a.png', '09:50:00'),
(6, 'V000006', 'GV000004', 'ravikumar', 'ukmledp@ramojifilmcity.com', '8959586333', 'Meeting', '2025-12-02', 'to Meet CITO Garu', NULL, NULL, 9, NULL, 'approved', 1, NULL, 9, '2025-12-01 15:52:41', '2025-12-01 16:07:15', 'Aadhar Card', '895958633321', 'visitor_6_qr.png', 'AP123TYT366', 'Bike', '', '', '09:52:00'),
(7, 'V000007', 'GV000005', 'mahesh  karna', 'developers@ramojifilmcity.com', '1593574568', 'Site Inspection', '2025-12-02', 'Site Inspection Purpose ', NULL, NULL, 5, NULL, 'approved', 1, NULL, 5, '2025-12-01 16:57:59', '2025-12-02 11:17:01', 'PAN Card', 'PAN2528AT', 'visitor_7_qr.png', ' AP25TST232', 'Car', '', '', '09:57:00'),
(8, 'V000008', 'GV000006', 'syam', 'karnamahesh42@gmail.com', '8919146333', 'Meeting', '2025-12-02', 'Meeting Purpose', NULL, NULL, 8, NULL, 'approved', 1, NULL, 8, '2025-12-02 11:28:33', '2025-12-02 12:27:59', 'Aadhar Card', '12345678982', 'visitor_V000008_qr.png', ' AP123AP25', 'Bike', '', '', '11:28:00'),
(9, 'V000009', 'GV000007', 'Ramesh Babu', 'karnamahesh42@gmail.com', '8919146333', 'Interview', '2025-12-02', '', NULL, NULL, 8, NULL, 'approved', 1, NULL, 8, '2025-12-02 14:21:40', '2025-12-03 11:36:26', 'Aadhar Card', '519848410144', 'visitor_V000009_qr.png', ' AP25TST236', 'Bike', '', '', '16:21:00'),
(10, 'V000010', 'GV000008', 'Kamesh', 'ukmledp@ramojifilmcity.com', '8949456333', 'Meeting', '2025-12-02', 'SAP Meeting', NULL, NULL, 8, NULL, 'approved', 1, NULL, 8, '2025-12-02 14:43:00', '2025-12-02 15:06:32', 'Aadhar Card', '89855213365', NULL, 'AP125RT525', 'Bike', '', '', '15:42:00'),
(11, 'V000011', 'GV000009', 'Ramu P', 'ukmledp@ramojifilmcity.com', '7894561234', 'Document Submission', '2025-12-02', 'Document Submission  ', NULL, NULL, 8, NULL, 'approved', 0, NULL, 8, '2025-12-02 15:00:44', '2025-12-03 11:35:14', 'Aadhar Card', '582369745244', 'visitor_V000011_qr.png', ' AP25TST232', 'Bike', '', '', '16:00:00'),
(12, 'V000012', 'GV000010', 'Keshav', 'karnamahesh@gmail.com', '8919146333', 'Meeting', '2025-12-02', 'SAP Meeting', NULL, NULL, 8, NULL, 'approved', 0, NULL, 8, '2025-12-02 15:49:38', '2025-12-03 11:33:23', 'Aadhar Card', '8882823455687', 'visitor_V000012_qr.png', '', '', '', '', '16:49:00'),
(13, 'V000013', 'GV000011', 'Ravikumar', 'developers@ramojifilmcity.com', '1593574568', 'General Visit', '2025-12-04', 'Test', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-03 12:51:43', '2025-12-03 14:58:13', 'Aadhar Card', '78945612332', 'visitor_V000013_qr.png', ' AP25TST232', 'Bike', '', '', '13:52:00'),
(14, 'V000014', 'GV000012', 'kamal', 'developers@ramojifilmcity.com', '7894561234', 'Document Submission', '2025-12-04', 'Test', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-03 12:53:01', '2025-12-03 15:00:51', 'PAN Card', '1234654568q', 'visitor_V000014_qr.png', ' AP25TST236', 'Bike', '', '', '13:53:00'),
(15, 'V000015', 'GV000013', 'Pavan', 'developers@ramojifilmcity.com', '1593574568', 'Verification / Approval', '2025-12-03', ' ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-03 15:06:38', '2025-12-03 15:08:43', 'Aadhar Card', '78945612332', 'visitor_V000015_qr.png', '', '', '', '', '16:06:00'),
(16, 'V000016', 'GV000014', 'Kiran', 'developers@ramojifilmcity.com', '9153684555', 'Interview', '2025-12-04', ' ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-03 15:07:12', '2025-12-03 15:11:26', 'Driving License', '1234856', 'visitor_V000016_qr.png', '', '', '', '', '16:07:00'),
(17, 'V000017', 'GV000015', 'Raghava', 'developers@ramojifilmcity.com', '1593574568', 'Meeting', '2025-12-03', 'Test', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-03 15:07:46', '2025-12-03 16:54:14', 'PAN Card', '1234856', 'visitor_V000017_qr.png', '', '', '', '', '16:08:00'),
(18, 'V000018', 'GV000016', 'Praveen ', 'maheshkarna@gmail.com', '7894561234', 'Meeting', '2025-12-03', ' test', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-03 17:02:57', '2025-12-03 17:04:48', 'PAN Card', '12345678', 'visitor_V000018_qr.png', '', '', '', '', '18:02:00'),
(19, 'V000019', 'GV000017', 'kamesh', 'karnamahesh42@gmail.com', '7894561234', 'Interview', '2025-12-04', '', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-03 17:13:32', '2025-12-03 17:13:55', 'Voter ID', '582369745244', 'visitor_V000019_qr.png', '', '', '', '', '18:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` int(11) NOT NULL,
  `visitor_request_id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `old_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `performed_by` int(11) NOT NULL,
  `performed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `visitor_request_id`, `action_type`, `old_status`, `new_status`, `remarks`, `performed_by`, `performed_at`) VALUES
(1, 1, 'Created', NULL, 'pending', '--', 5, '2025-11-30 21:57:29'),
(2, 2, 'Created', NULL, 'pending', '--', 5, '2025-11-30 21:57:29'),
(3, 3, 'Created', NULL, 'pending', '--', 5, '2025-11-30 21:59:26'),
(4, 4, 'Created', NULL, 'pending', '--', 5, '2025-11-30 22:04:49'),
(5, 4, 'approved', 'pending', 'approved', '', 5, '2025-11-30 22:10:14'),
(6, 3, 'approved', 'pending', 'approved', '', 5, '2025-11-30 22:14:41'),
(7, 2, 'approved', 'pending', 'approved', '', 5, '2025-11-30 22:15:44'),
(8, 5, 'Created', NULL, 'pending', '--', 9, '2025-12-01 15:52:41'),
(9, 6, 'Created', NULL, 'pending', '--', 9, '2025-12-01 15:52:41'),
(10, 6, 'approved', 'pending', 'approved', '', 5, '2025-12-01 15:54:02'),
(11, 5, 'approved', 'pending', 'approved', '', 5, '2025-12-01 15:54:10'),
(12, 7, 'Created', NULL, 'pending', '--', 5, '2025-12-01 16:57:59'),
(13, 7, 'approved', 'pending', 'approved', '', 5, '2025-12-01 16:58:18'),
(14, 8, 'Created', NULL, 'pending', '--', 8, '2025-12-02 11:28:33'),
(15, 8, 'approved', 'pending', 'approved', '', 5, '2025-12-02 11:35:25'),
(16, 9, 'Created', NULL, 'pending', '--', 8, '2025-12-02 14:21:40'),
(17, 10, 'Created', NULL, 'pending', '--', 8, '2025-12-02 14:43:00'),
(18, 10, 'approved', 'pending', 'approved', '', 5, '2025-12-02 14:54:10'),
(19, 9, 'approved', 'pending', 'approved', '', 5, '2025-12-02 14:55:27'),
(20, 11, 'Created', NULL, 'pending', '--', 8, '2025-12-02 15:00:44'),
(21, 11, 'approved', 'pending', 'approved', '', 5, '2025-12-02 15:01:07'),
(22, 12, 'Created', NULL, 'pending', '--', 8, '2025-12-02 15:49:38'),
(23, 12, 'approved', 'pending', 'approved', '', 5, '2025-12-02 15:50:49'),
(24, 13, 'Created', NULL, 'pending', '--', 9, '2025-12-03 12:51:43'),
(25, 14, 'Created', NULL, 'pending', '--', 9, '2025-12-03 12:53:01'),
(26, 13, 'approved', 'pending', 'approved', '', 1, '2025-12-03 14:58:12'),
(27, 14, 'approved', 'pending', 'approved', '', 1, '2025-12-03 15:00:51'),
(28, 15, 'Created', NULL, 'pending', '--', 9, '2025-12-03 15:06:38'),
(29, 16, 'Created', NULL, 'pending', '--', 9, '2025-12-03 15:07:12'),
(30, 17, 'Created', NULL, 'pending', '--', 9, '2025-12-03 15:07:46'),
(31, 15, 'approved', 'pending', 'approved', '', 1, '2025-12-03 15:08:42'),
(32, 16, 'approved', 'pending', 'approved', '', 1, '2025-12-03 15:11:25'),
(33, 17, 'approved', 'pending', 'approved', '', 1, '2025-12-03 16:54:13'),
(34, 18, 'Created', NULL, 'pending', '--', 9, '2025-12-03 17:02:57'),
(35, 18, 'approved', 'pending', 'approved', '', 1, '2025-12-03 17:04:47'),
(36, 19, 'Created', NULL, 'pending', '--', 9, '2025-12-03 17:13:32'),
(37, 19, 'approved', 'pending', 'approved', '', 1, '2025-12-03 17:13:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `reference_visitor_requests`
--
ALTER TABLE `reference_visitor_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rvr_code` (`rvr_code`),
  ADD KEY `reference_id` (`reference_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `security_gate_logs`
--
ALTER TABLE `security_gate_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_request_id` (`visitor_request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `v_code` (`v_code`),
  ADD KEY `host_user_id` (`host_user_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_request_id` (`visitor_request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reference_visitor_requests`
--
ALTER TABLE `reference_visitor_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `security_gate_logs`
--
ALTER TABLE `security_gate_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `reference_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `reference_visitor_requests`
--
ALTER TABLE `reference_visitor_requests`
  ADD CONSTRAINT `reference_visitor_requests_ibfk_1` FOREIGN KEY (`reference_id`) REFERENCES `reference` (`id`);

--
-- Constraints for table `security_gate_logs`
--
ALTER TABLE `security_gate_logs`
  ADD CONSTRAINT `security_gate_logs_ibfk_1` FOREIGN KEY (`visitor_request_id`) REFERENCES `visitors` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  ADD CONSTRAINT `user_hashkeys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`host_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `visitors_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
