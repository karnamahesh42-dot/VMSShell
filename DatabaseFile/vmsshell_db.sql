-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2025 at 02:21 AM
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
-- Database: `vmsshell_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `is_active`, `created_at`) VALUES
(1, 'UKMPL', 1, '2025-12-27 16:56:32'),
(2, 'DHPL', 1, '2025-12-27 16:56:32'),
(3, 'ETPL', 1, '2025-12-27 16:56:32'),
(4, 'Eenadu', 1, '2025-12-27 16:56:32'),
(5, 'ETV Bharat', 1, '2025-12-27 16:56:32'),
(6, 'Priya Foods', 1, '2025-12-27 16:56:32'),
(7, 'Wellness Center', 1, '2025-12-27 16:56:32'),
(8, 'Ramoji Foundation', 1, '2025-12-27 16:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `company_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `company_id`) VALUES
(1, 'IT', NULL),
(2, 'Finance', NULL),
(3, 'HR', NULL),
(4, 'Procurement', NULL),
(5, 'Stores', NULL),
(6, 'Security', NULL),
(7, 'Maya', NULL),
(8, 'Tourism', NULL),
(9, 'Events', NULL),
(10, 'Films', NULL),
(11, 'CMD Secretariat', NULL),
(12, 'MD Secretariat', NULL),
(13, 'Director Secretariat', NULL),
(14, 'Agro', NULL),
(15, 'GMHK', NULL),
(16, 'Staff Canteen', NULL),
(17, 'Priya Dairy', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expired_visitor_passes`
--

CREATE TABLE `expired_visitor_passes` (
  `id` int(11) NOT NULL,
  `visitor_request_id` int(11) NOT NULL,
  `v_code` varchar(50) DEFAULT NULL,
  `header_code` varchar(50) DEFAULT NULL,
  `expired_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expired_visitor_passes`
--

INSERT INTO `expired_visitor_passes` (`id`, `visitor_request_id`, `v_code`, `header_code`, `expired_at`, `created_at`) VALUES
(1, 3, NULL, 'GV000002', '2025-12-27 14:27:36', '2025-12-27 14:27:36'),
(2, 4, NULL, 'GV000003', '2025-12-27 14:27:36', '2025-12-27 14:27:36'),
(3, 6, NULL, 'GV000005', '2025-12-28 00:09:40', '2025-12-28 00:09:40'),
(4, 7, NULL, 'GV000006', '2025-12-28 00:09:40', '2025-12-28 00:09:40'),
(5, 8, NULL, 'GV000006', '2025-12-28 00:09:40', '2025-12-28 00:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `purposes`
--

CREATE TABLE `purposes` (
  `id` int(11) NOT NULL,
  `purpose_name` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purposes`
--

INSERT INTO `purposes` (`id`, `purpose_name`, `status`) VALUES
(1, 'General Visit', 1),
(2, 'Location Recce', 1),
(3, 'Wedding', 1),
(4, 'Vendor Visit', 1),
(5, 'Delivery', 1),
(6, 'Meeting', 1),
(7, 'Interview', 1),
(8, 'Document Submission', 1),
(9, 'Verification / Approval', 1),
(10, 'Event Visit', 1),
(11, 'Tourism Visit', 1),
(12, 'Personal Visit', 1),
(13, 'Site Inspection', 1),
(14, 'Maintenance / Service', 1),
(15, 'Other', 1);

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
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(5) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security_gate_logs`
--

INSERT INTO `security_gate_logs` (`id`, `visitor_request_id`, `v_code`, `check_in_time`, `check_out_time`, `verified_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'V000001', '2025-12-26 14:54:23', NULL, 13, '2025-12-26 14:54:23', NULL, NULL),
(2, 2, 'V000002', '2025-12-26 14:57:20', '2025-12-26 14:59:10', 13, '2025-12-26 14:57:20', NULL, '2025-12-26 09:29:10'),
(3, 5, 'V000005', '2025-12-26 17:50:28', '2025-12-26 17:53:22', 13, '2025-12-26 17:50:28', NULL, '2025-12-26 12:23:22'),
(4, 10, 'V000010', '2025-12-28 00:25:41', NULL, 13, '2025-12-28 00:25:41', NULL, NULL),
(5, 9, 'V000009', '2025-12-28 00:27:15', NULL, 13, '2025-12-28 00:27:15', NULL, NULL),
(6, 12, 'V000012', '2025-12-28 00:36:00', NULL, 13, '2025-12-28 00:36:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
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

INSERT INTO `users` (`id`, `priority`, `name`, `company_name`, `department_id`, `username`, `password`, `role_id`, `active`, `hash_key`, `created_at`, `created_by`, `email`, `employee_code`) VALUES
(1, 0, 'Superadmin', 'UKMPL', 1, 'superadmin', '274d015c638f62ba24b19ca23c9c9503', 1, 1, 'HASHKEY123', '2025-11-20 09:28:43', NULL, 'maheshkarna42@gmail.com', '2523011'),
(5, 2, 'Sreenivas', 'UKMPL', 1, 'sreenivas', '5f3dd4f062ed308119614e7e3e82d4c1', 2, 1, 'HASHKEY123', '2025-11-21 05:54:24', 1, 'ukmledp@ramojifilmcity.com', '12345678'),
(6, 10, 'Prakash', 'UKMPL', 3, 'hruser2', '1b0041377a27ec89d4ff989d048f5e85', 3, 1, 'HASHKEY123', '2025-11-21 22:15:08', 1, 'prakash@gmail.com', '789654159'),
(7, 0, 'Prasad ', 'UKMPL', 3, 'hrhod', 'f271d1efdfba760f7145d4436f845b8e', 2, 1, 'HASHKEY123', '2025-11-22 05:56:17', 1, 'prasad@gmail.com', '951357456'),
(8, 10, 'Sury kumar', 'UKMPL', 1, 'suryakumar', '45b97ac60ca6e41341d1bfe4f39d5227', 3, 1, 'HASHKEY123', '2025-11-24 00:22:13', 1, 'kumar@gmail.com', '87456321'),
(9, 10, 'Radhika', 'UKMPL', 2, 'radhika', '2a14558094169ea7f79f928213fd9a20', 3, 1, 'HASHKEY123', '2025-11-24 03:40:59', 1, 'radhika@gmail.com', '951456357'),
(10, 10, 'Sailesh Kumar', 'UKMPL', 2, 'sailesh', '439dd07182ce0dcd1f225293d85be464', 2, 1, 'HASHKEY123', '2025-11-27 23:56:49', 5, 'miscentraloffice@ramojifilmcity.com', '741963258'),
(11, 2, 'Satish Kumar', 'UKMPL', 2, 'satish', '135c44d20155d3a67bc984f17492a3d3', 2, 1, 'HASHKEY123', '2025-11-30 09:57:12', 5, 'gmaccounts@ramojifilmcity.com', '321987456'),
(12, 10, 'pallam raju', 'UKMPL', 3, 'hruser', '5980d6ad05354bd8681adff071323804', 3, 1, 'HASHKEY123', '2025-11-30 15:37:58', 5, 'raju@gmail.com', '456812397'),
(13, 10, 'khan', 'UKMPL', 6, 'security', '7f56499c9bcb7018d17adba024f12b36', 4, 1, NULL, '2025-12-01 10:32:56', 5, 'khan@gmail.com', '89595875'),
(14, 10, 'Kumar', 'UKMPL', 5, 'kumar', 'b9b580e1f1d30f72a52c9696dfa3c1a3', 3, 0, NULL, '2025-12-02 03:46:21', 5, 'kumar@gmail.com', '53532581'),
(15, 10, 'Mahesh Karna', 'UKMPL', 1, 'mahesh', 'b9a7b941299a521d0a5abb9cee30bfec', 3, 1, 'HASHKEY123', '2025-12-09 11:46:10', 1, 'karnamahesh42@gmail.com', '123456'),
(16, 3, 'Lokesh', 'UKMPL', 2, 'lokesh', 'd273c8b0aa7f42e27fe0ea75f896167a', 2, 1, 'HASHKEY123', '2025-12-12 15:37:09', 1, 'lokesh@gmail.com', '87456321'),
(18, 1, 'K Ravindara Rao', 'UKMPL', 2, 'kravindra', '6c185769e88bffa03bed6a8129277205', 2, 1, 'HASHKEY123', '2025-12-13 09:29:06', 1, 'ravindra@gmail.com', '789564264'),
(19, 1, 'Krishna Vasireddy', 'UKMPL', 1, 'krishna', '130f10ca4711756506b4ac65a3e002c6', 2, 1, 'HASHKEY123', '2025-12-16 08:54:25', 1, 'krishna@gmail.com', '12345678'),
(20, 10, 'kalapana', 'UKMPL', 4, 'kalapana', '7070f111b4631c091525ab32cf50d225', 3, 1, 'HASHKEY123', '2025-12-26 05:21:07', 1, 'kalapana@gmail.com', '12345678985'),
(21, 10, 'P Ramanjaneyulu ', 'Eenadu', 2, 'rama', 'a6a7a63c51d014449351318a744711e0', 2, 1, 'HASHKEY123', '2025-12-27 18:11:48', 1, 'ramanajaneyulu@gmail.com', '78954682'),
(22, 10, 'Soujanya', 'Eenadu', 2, 'soujanya', '27c8134aa75e222dc87397b6b7684bce', 3, 1, 'HASHKEY123', '2025-12-27 18:13:14', 1, 'soujanya@gmail.com', '78954685');

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
-- Table structure for table `user_password_vault`
--

CREATE TABLE `user_password_vault` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password_enc` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_password_vault`
--

INSERT INTO `user_password_vault` (`id`, `user_id`, `password_enc`, `created_at`) VALUES
(1, 20, 'kalapana@123', '2025-12-26 10:51:07'),
(2, 5, 'sreenivas@321', '2025-12-26 11:26:51'),
(3, 1, 'superadmin@123', '2025-12-26 11:27:38'),
(4, 21, 'rama@123', '2025-12-27 23:41:48'),
(5, 22, 'soujanya@123', '2025-12-27 23:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `request_header_id` int(11) DEFAULT NULL,
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
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `meeting_status` tinyint(1) NOT NULL DEFAULT 0,
  `meeting_completed_at` datetime DEFAULT NULL,
  `validity` int(2) NOT NULL DEFAULT 1,
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
  `visit_time` time DEFAULT NULL,
  `v_phopto_path` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `request_header_id`, `v_code`, `group_code`, `visitor_name`, `visitor_email`, `visitor_phone`, `purpose`, `visit_date`, `description`, `expected_from`, `expected_to`, `host_user_id`, `reference_id`, `status`, `meeting_status`, `meeting_completed_at`, `validity`, `securityCheckStatus`, `spendTime`, `created_by`, `created_at`, `updated_at`, `proof_id_type`, `proof_id_number`, `qr_code`, `vehicle_no`, `vehicle_type`, `vehicle_id_proof`, `visitor_id_proof`, `visit_time`, `v_phopto_path`) VALUES
(1, 1, 'V000001', 'GV000001', 'Sivakumar', 'karnamahesh42@gmail.com', '7894561234', 'Interview', '2025-12-26', 'Interview Purpose ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 1, 1, NULL, 9, '2025-12-26 14:37:02', '2025-12-26 14:55:20', 'Aadhar Card', '51984841144', 'visitor_V000001_qr.png', ' AP25TST232', 'Bike', '', '', '14:45:00', 'v_pic_V000001_1766741118.jpg'),
(2, 2, 'V000002', 'GV000002', 'Prakash', 'karnamahesh42@gmail.com', '9876543210', 'Location Recce', '2025-12-26', 'Location Recce Purpose', NULL, NULL, 9, NULL, 'approved', 1, '2025-12-26 14:58:57', 1, 2, '00:01:50', 9, '2025-12-26 14:38:39', '2025-12-26 14:59:10', 'Aadhaar Card', '123456789012', 'visitor_V000002_qr.png', 'TN10AB1234', 'Bike', '', '', '14:37:00', 'v_pic_V000002_1766741279.jpg'),
(3, 2, 'V000003', 'GV000002', 'Sharath', 'karnamahesh42@gmail.com', '9876501234', 'Location Recce', '2025-12-26', 'Location Recce Purpose', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-26 14:38:39', '2025-12-27 14:27:36', 'PAN Card', 'ABCDE1234F', 'visitor_V000003_qr.png', 'TN09XY9876', 'Bike', '', '', '14:37:00', ''),
(4, 3, 'V000004', 'GV000003', 'Kamesh', 'karnamahesh42@gmail.com', '8919146333', 'Delivery', '2025-12-26', 'Delivery Visit', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-26 14:40:22', '2025-12-27 14:27:36', 'Aadhar Card', '535168435468', 'visitor_V000004_qr.png', 'AP25DF6536', 'Car', '', '', '14:39:00', ''),
(5, 4, 'V000005', 'GV000004', 'Surya Kumar', 'pothina.surya@gmail.com', '8919146336', 'General Visit', '2025-12-26', 'Test Visit ', NULL, NULL, 9, NULL, 'approved', 1, '2025-12-26 17:52:30', 1, 2, '00:02:54', 9, '2025-12-26 17:48:00', '2025-12-26 17:53:22', 'Aadhar Card', '12346578969', 'visitor_V000005_qr.png', 'AP123456', 'Bike', '', '', '17:46:00', 'v_pic_V000005_1766751671.jpg'),
(6, 5, 'V000006', 'GV000005', 'Kalesh', 'karnamahesh42@gmail.com', '8919146333', 'Meeting', '2025-12-27', 'Test', NULL, NULL, 22, NULL, 'approved', 0, NULL, 0, 0, NULL, 22, '2025-12-27 23:55:55', '2025-12-28 00:09:40', 'Aadhar Card', '156514649', 'visitor_V000006_qr.png', '25525', 'Bike', '', '', '23:54:00', ''),
(7, 6, 'V000007', 'GV000006', 'Prakash', 'ramanagaanjaneyulu@gmail.com', '9876543210', 'General Visit', '2025-12-27', 'Tets@Gmail', NULL, NULL, 22, NULL, 'approved', 0, NULL, 0, 0, NULL, 22, '2025-12-27 23:58:53', '2025-12-28 00:09:40', 'Aadhaar Card', '123456789012', 'visitor_V000007_qr.png', 'TN10AB1234', 'Car', '', '', '23:56:00', ''),
(8, 6, 'V000008', 'GV000006', 'Sharath', 'ramanagaanjaneyulu@gmail.com', '9876501234', 'General Visit', '2025-12-27', 'Tets@Gmail', NULL, NULL, 22, NULL, 'approved', 0, NULL, 0, 0, NULL, 22, '2025-12-27 23:58:53', '2025-12-28 00:09:40', 'PAN Card', 'ABCDE1234F', 'visitor_V000008_qr.png', 'TN09XY9876', 'Bike', '', '', '23:56:00', ''),
(9, 7, 'V000009', 'GV000007', 'Prakash p', 'john@example.com', '9876543210', 'Interview', '2025-12-28', 'Test', NULL, NULL, 21, NULL, 'approved', 0, NULL, 1, 1, NULL, 21, '2025-12-28 00:11:55', '2025-12-28 00:27:25', 'Aadhaar Card', '123456789012', 'visitor_V000009_qr.png', 'TN10AB1234', 'Car', '', '', '00:11:00', 'v_pic_V000009_1766861842.jpg'),
(10, 7, 'V000010', 'GV000007', 'Sharath k', 'mary@example.com', '9876501234', 'Interview', '2025-12-28', 'Test', NULL, NULL, 21, NULL, 'approved', 0, NULL, 1, 1, NULL, 21, '2025-12-28 00:11:55', '2025-12-28 00:25:53', 'PAN Card', 'ABCDE1234F', 'visitor_V000010_qr.png', 'TN09XY9876', 'Bike', '', '', '00:11:00', 'v_pic_V000010.jpg'),
(11, 8, 'V000011', 'GV000008', 'Prakash PVS', 'john@example.com', '9876543210', 'Delivery', '2025-12-28', 'Test', NULL, NULL, 21, NULL, 'approved', 0, NULL, 1, 0, NULL, 21, '2025-12-28 00:35:48', '2025-12-28 00:35:48', 'Aadhaar Card', '123456789012', 'visitor_V000011_qr.png', 'TN10AB1234', 'Car', '', '', '00:35:00', ''),
(12, 8, 'V000012', 'GV000008', 'Sharath PVS', 'mary@example.com', '9876501234', 'Delivery', '2025-12-28', 'Test', NULL, NULL, 21, NULL, 'approved', 0, NULL, 1, 1, NULL, 21, '2025-12-28 00:35:48', '2025-12-28 00:36:20', 'PAN Card', 'ABCDE1234F', 'visitor_V000012_qr.png', 'TN09XY9876', 'Bike', '', '', '00:35:00', 'v_pic_V000012.jpg'),
(13, 9, 'V000013', 'GV000009', 'Ramesh Kumar', 'karnamahesh42@gmail.com', '7894561233', 'General Visit', '2025-12-28', 'Test Group Qr', NULL, NULL, 21, NULL, 'approved', 0, NULL, 1, 0, NULL, 21, '2025-12-28 16:02:50', '2025-12-28 16:02:50', 'Aadhaar Card', '7777777777777', 'visitor_V000013_qr.png', 'AP2565DSD', 'Bus', '', '', '16:02:00', ''),
(14, 9, 'V000014', 'GV000009', 'Ramesh Khan', 'karnamahesh42@gmail.com', '7894561233', 'General Visit', '2025-12-28', 'Test Group Qr', NULL, NULL, 21, NULL, 'approved', 0, NULL, 1, 0, NULL, 21, '2025-12-28 16:02:51', '2025-12-28 16:02:51', 'Aadhaar Card', '3333333333333', 'visitor_V000014_qr.png', 'AP2565DSD', 'Bus', '', '', '16:02:00', ''),
(15, 9, 'V000015', 'GV000009', 'Ramesh prasad', 'karnamahesh42@gmail.com', '7894561233', 'General Visit', '2025-12-28', 'Test Group Qr', NULL, NULL, 21, NULL, 'approved', 0, NULL, 1, 0, NULL, 21, '2025-12-28 16:02:51', '2025-12-28 16:02:51', 'Aadhaar Card', '8888888888888', 'visitor_V000015_qr.png', 'AP2565DSD', 'Bus', '', '', '16:02:00', ''),
(16, 9, 'V000016', 'GV000009', 'Ramesh SD', 'karnamahesh42@gmail.com', '7894561233', 'General Visit', '2025-12-28', 'Test Group Qr', NULL, NULL, 21, NULL, 'approved', 0, NULL, 1, 0, NULL, 21, '2025-12-28 16:02:52', '2025-12-28 16:02:52', 'Aadhaar Card', '4444444444444', 'visitor_V000016_qr.png', 'AP2565DSD', 'Bus', '', '', '16:02:00', ''),
(17, 9, 'V000017', 'GV000009', 'Ramesh P', 'karnamahesh42@gmail.com', '7894561233', 'General Visit', '2025-12-28', 'Test Group Qr', NULL, NULL, 21, NULL, 'approved', 0, NULL, 1, 0, NULL, 21, '2025-12-28 16:02:53', '2025-12-28 16:02:53', 'Aadhaar Card', '5555555555555', 'visitor_V000017_qr.png', 'AP2565DSD', 'Bus', '', '', '16:02:00', '');

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
(1, 1, 'Created', NULL, 'pending', '--', 9, '2025-12-26 14:37:02'),
(2, 2, 'Created', NULL, 'pending', '--', 9, '2025-12-26 14:38:39'),
(3, 3, 'Created', NULL, 'pending', '--', 9, '2025-12-26 14:38:39'),
(4, 4, 'Created', NULL, 'pending', '--', 9, '2025-12-26 14:40:22'),
(5, 4, 'approved', 'pending', 'approved', NULL, 18, '2025-12-26 14:43:34'),
(6, 1, 'approved', 'pending', 'approved', NULL, 18, '2025-12-26 14:44:12'),
(7, 2, 'approved', 'pending', 'approved', NULL, 11, '2025-12-26 14:50:46'),
(8, 3, 'approved', 'pending', 'approved', NULL, 11, '2025-12-26 14:50:47'),
(9, 5, 'Created', NULL, 'pending', '--', 9, '2025-12-26 17:48:00'),
(10, 5, 'approved', 'pending', 'approved', NULL, 18, '2025-12-26 17:49:01'),
(11, 6, 'Created', NULL, 'pending', '--', 22, '2025-12-27 23:55:55'),
(12, 7, 'Created', NULL, 'pending', '--', 22, '2025-12-27 23:58:53'),
(13, 8, 'Created', NULL, 'pending', '--', 22, '2025-12-27 23:58:53'),
(14, 7, 'approved', 'pending', 'approved', NULL, 21, '2025-12-27 23:59:16'),
(15, 8, 'approved', 'pending', 'approved', NULL, 21, '2025-12-27 23:59:17'),
(16, 6, 'approved', 'pending', 'approved', NULL, 21, '2025-12-27 23:59:22'),
(17, 9, 'Created', NULL, 'approved', '--', 21, '2025-12-28 00:11:55'),
(18, 10, 'Created', NULL, 'approved', '--', 21, '2025-12-28 00:11:55'),
(19, 11, 'Created', NULL, 'approved', '--', 21, '2025-12-28 00:35:48'),
(20, 12, 'Created', NULL, 'approved', '--', 21, '2025-12-28 00:35:48'),
(21, 13, 'Created', NULL, 'approved', '--', 21, '2025-12-28 16:02:50'),
(22, 14, 'Created', NULL, 'approved', '--', 21, '2025-12-28 16:02:51'),
(23, 15, 'Created', NULL, 'approved', '--', 21, '2025-12-28 16:02:51'),
(24, 16, 'Created', NULL, 'approved', '--', 21, '2025-12-28 16:02:52'),
(25, 17, 'Created', NULL, 'approved', '--', 21, '2025-12-28 16:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_request_header`
--

CREATE TABLE `visitor_request_header` (
  `id` int(11) NOT NULL,
  `header_code` varchar(50) NOT NULL,
  `requested_by` varchar(100) NOT NULL,
  `referred_by` int(11) DEFAULT NULL,
  `requested_date` date NOT NULL,
  `requested_time` time NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `total_visitors` int(11) DEFAULT 0,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `updated_by` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `company` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_request_header`
--

INSERT INTO `visitor_request_header` (`id`, `header_code`, `requested_by`, `referred_by`, `requested_date`, `requested_time`, `department`, `purpose`, `description`, `email`, `total_visitors`, `status`, `updated_by`, `remarks`, `created_at`, `updated_at`, `company`) VALUES
(1, 'GV000001', '9', 18, '2025-12-26', '14:45:00', 'Finance', 'Interview', 'Interview Purpose ', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-26 14:37:02', '2025-12-26 14:44:12', 'UKMPL'),
(2, 'GV000002', '9', 11, '2025-12-26', '14:37:00', 'Finance', 'Location Recce', 'Location Recce Purpose', 'karnamahesh42@gmail.com', 2, 'approved', NULL, NULL, '2025-12-26 14:38:39', '2025-12-26 14:50:47', 'UKMPL'),
(3, 'GV000003', '9', 18, '2025-12-26', '14:39:00', 'Finance', 'Delivery', 'Delivery Visit', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-26 14:40:22', '2025-12-26 14:43:34', 'UKMPL'),
(4, 'GV000004', '9', 18, '2025-12-26', '17:46:00', 'Finance', 'General Visit', 'Test Visit ', 'pothina.surya@gmail.com', 1, 'approved', NULL, NULL, '2025-12-26 17:48:00', '2025-12-26 17:49:01', 'UKMPL'),
(5, 'GV000005', '22', 21, '2025-12-27', '23:54:00', 'Finance', 'Meeting', 'Test', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-27 23:55:55', '2025-12-27 23:59:22', 'Eenadu'),
(6, 'GV000006', '22', 21, '2025-12-27', '23:56:00', 'Finance', 'General Visit', 'Tets@Gmail', 'test@gmail.com', 2, 'approved', NULL, NULL, '2025-12-27 23:58:53', '2025-12-27 23:59:17', 'Eenadu'),
(7, 'GV000007', '21', 21, '2025-12-28', '00:11:00', 'Finance', 'Interview', 'Test', 'test@gmail.com', 2, 'approved', NULL, '', '2025-12-28 00:11:54', '2025-12-28 00:11:54', 'Eenadu'),
(8, 'GV000008', '21', 21, '2025-12-28', '00:35:00', 'Finance', 'Delivery', 'Test', 'test@gmail.com', 2, 'approved', NULL, '', '2025-12-28 00:35:47', '2025-12-28 00:35:47', 'Eenadu'),
(9, 'GV000009', '21', 21, '2025-12-28', '16:02:00', 'Finance', 'General Visit', 'Test Group Qr', 'karnamahesh42@gmail.com', 5, 'approved', NULL, '', '2025-12-28 16:02:49', '2025-12-28 16:02:49', 'Eenadu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `expired_visitor_passes`
--
ALTER TABLE `expired_visitor_passes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purposes`
--
ALTER TABLE `purposes`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `visitor_request_id` (`visitor_request_id`);

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
-- Indexes for table `user_password_vault`
--
ALTER TABLE `user_password_vault`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `v_code` (`v_code`),
  ADD KEY `host_user_id` (`host_user_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `fk_visitors_header` (`request_header_id`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_request_id` (`visitor_request_id`);

--
-- Indexes for table `visitor_request_header`
--
ALTER TABLE `visitor_request_header`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `expired_visitor_passes`
--
ALTER TABLE `expired_visitor_passes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purposes`
--
ALTER TABLE `purposes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_password_vault`
--
ALTER TABLE `user_password_vault`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `visitor_request_header`
--
ALTER TABLE `visitor_request_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
