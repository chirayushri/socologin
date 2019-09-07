-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2019 at 03:20 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_members`
--

CREATE TABLE `app_members` (
  `member_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(22) NOT NULL,
  `password` varchar(22) NOT NULL,
  `name` varchar(22) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_members`
--

INSERT INTO `app_members` (`member_id`, `user_id`, `role_id`, `email`, `password`, `name`, `status`, `is_deleted`, `deleted_at`, `created_at`, `modified_at`) VALUES
(42, 19, 17, 'chirayu1@gmail.com', 'Pass@123', 'Chirayu 1', 1, 0, 0, 1563794480, 0),
(43, 1, 20, 'chirayu.team@gmail.com', 'Pass@123', 'Chirayu Team', 1, 0, 0, 1563880757, 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_packages`
--

CREATE TABLE `app_packages` (
  `package_id` int(11) NOT NULL,
  `package_price` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `package_description` text NOT NULL,
  `package_data` text NOT NULL,
  `package_status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_packages`
--

INSERT INTO `app_packages` (`package_id`, `package_price`, `package_name`, `package_description`, `package_data`, `package_status`, `is_deleted`, `deleted_at`, `created_at`, `modified_at`) VALUES
(1, 0, 'Free Trial', 'Free trial plan valid for 3 days only', '{\"view_file\":\"1\",\"view_page\":\"1\",\"view_role\":\"1\",\"view_member\":\"1\"}', 1, 0, 0, 1563788559, 1563877350),
(2, 100, 'Prime', 'Prime Membership Plan For Prime users Valid for 1 year', '{\"view_file\":\"1\",\"edit_file\":\"1\",\"edit_page\":\"1\",\"view_page\":\"1\",\"add_page\":\"1\",\"add_file\":\"1\",\"delete_file\":\"1\",\"delete_page\":\"1\"}', 1, 0, 0, 1563788605, 1563874563);

-- --------------------------------------------------------

--
-- Table structure for table `app_pages`
--

CREATE TABLE `app_pages` (
  `page_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `page_description` text NOT NULL,
  `page_data` text NOT NULL,
  `page_status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_pages`
--

INSERT INTO `app_pages` (`page_id`, `user_id`, `page_name`, `page_description`, `page_data`, `page_status`, `is_deleted`, `deleted_at`, `created_at`, `modified_at`) VALUES
(3, 1, 'School mgmt', 'School management site', '\"\"', 1, 1, 1563887479, 1563885870, 0),
(4, 1, 'Web School', 'Web School Site', '\"\"', 1, 0, 0, 1563887492, 0),
(5, 21, 'Properighter Site', 'Properighter site system describe here .', '[{\"id\":\"w1\",\"name\":\"page 1\",\"slug\":\"page-1\",\"0\":\"object:4\"},{\"id\":\"w2\",\"name\":\"page 2\",\"slug\":\"page-2\",\"0\":\"object:6\"},{\"id\":\"w3\",\"name\":\"page 3\",\"slug\":\"page-3\",\"0\":\"object:8\"},{\"id\":\"w4\",\"name\":\"page 4\",\"slug\":\"page-4\",\"0\":\"object:10\"}]', 1, 0, 0, 1563951466, 0),
(9, 21, 'Web Developement', 'Web Site System', '[{\"0\":\"object:6\",\"id\":\"w1\",\"name\":\"Home\",\"slug\":\"home\"},{\"0\":\"object:7\",\"id\":\"w2\",\"name\":\"Contact us\",\"slug\":\"contact\"},{\"0\":\"object:8\",\"id\":\"w3\",\"name\":\"About uss\",\"slug\":\"aboutus\"}]', 1, 0, 0, 1563959717, 1563959816);

-- --------------------------------------------------------

--
-- Table structure for table `app_roles`
--

CREATE TABLE `app_roles` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(22) NOT NULL,
  `role_features` text NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `deleted_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_roles`
--

INSERT INTO `app_roles` (`role_id`, `user_id`, `title`, `role_features`, `is_deleted`, `created_at`, `modified_at`, `deleted_at`) VALUES
(17, 19, 'Quality Analyst', '{\"add_member\":\"1\",\"view_member\":\"0\",\"edit_member\":\"1\",\"view_role\":\"1\",\"edit_role\":\"1\"}', 0, 1563792642, 0, 0),
(18, 19, 'Data Entry Operator', '{\"view_role\":\"1\",\"view_member\":\"1\"}', 0, 1563792657, 0, 0),
(19, 19, 'Super Admin', '{\"add_package\":\"1\",\"edit_package\":\"1\",\"view_package\":\"1\",\"delete_package\":\"1\",\"add_member\":\"1\",\"edit_member\":\"1\",\"delete_member\":\"1\",\"view_member\":\"1\",\"add_role\":\"1\",\"edit_role\":\"1\",\"delete_role\":\"1\",\"view_role\":\"1\",\"view_file\":\"1\",\"delete_file\":\"1\",\"edit_file\":\"1\",\"add_file\":\"1\",\"add_page\":\"1\",\"edit_page\":\"1\",\"delete_page\":\"1\",\"view_page\":\"1\"}', 0, 1563873237, 0, 0),
(20, 1, 'Analyst', '{\"view_member\":\"1\",\"view_role\":\"1\",\"add_member\":\"1\",\"view_page\":\"1\",\"delete_page\":\"0\",\"edit_page\":\"1\",\"view_file\":\"1\",\"add_page\":\"1\"}', 0, 1563880731, 1563943362, 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `email` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `name` varchar(222) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '1',
  `picture` varchar(222) DEFAULT NULL,
  `oauth_id` int(11) DEFAULT NULL,
  `logged_type` enum('app','facebook','google','twitter') NOT NULL DEFAULT 'app',
  `forgot_code` varchar(222) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_expired` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`user_id`, `parent_id`, `package_id`, `email`, `password`, `name`, `gender`, `picture`, `oauth_id`, `logged_type`, `forgot_code`, `status`, `is_expired`, `is_deleted`, `created_date`, `modified_date`) VALUES
(1, 0, 0, 'chirayushri@gmail.com', '$2y$10$822vPhTaDJSGGj2I7PMu4uGPmt0AH5vHfXF.XQfgu0kXBs2frBuGG', 'Chirayu shrivastav', 0, '', 0, 'app', '$2y$10$FvmzfJ1kGXodllIFb/.m8uAN5sHG6vZH/tUPgiMMA69M4g2kdtDP2', 1, 0, 0, 1562160137, 1562589120),
(14, 0, 0, 'demo@local.com', '$2y$10$haZmvmRB5yZzIgLv2M/XQO0DCNgZGPg/qQNrZcwgi5TimCeIFNxBq', 'Demo Usr', 0, '', 0, 'app', '$2y$10$gZFaDw.QdmqZFvNbr1LS6.SouMzB21dcLHR6bcX8B6liIpx5A8t36', 0, 0, 0, 1562161753, 0),
(17, 0, 0, 'chijwrvastav7711@gmail.com', '$2y$10$dKdKFQ3H0JoKKsPesLpsw.NOYecgatGSiwg0UDYdKvjgH7SnghbJu', 'Chirayu Shrivastav', 0, 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2269719659780339&height=50&width=50&ext=1565958922&hash=AeQDkdu6N6tV_sYz', 0, 'facebook', '', 1, 0, 0, 1562586640, 1563366922),
(18, 0, 0, 'chirayu.code@gmail.com', '$2y$10$SrHLvRjTlRC341qtnrj4J.OKcBJE2ktH2oSyfpZBxtHtYnTpGAncm', 'Chirayu Shrivastav', 0, 'https://lh3.googleusercontent.com/-bThKF05cplw/AAAAAAAAAAI/AAAAAAAAAEY/0fWTekXFGBA/photo.jpg', 0, 'google', '', 1, 0, 0, 1562586677, 1562588592),
(19, 0, 1, 'mrcoder.premium@gmail.com', '$2y$10$822vPhTaDJSGGj2I7PMu4uGPmt0AH5vHfXF.XQfgu0kXBs2frBuGG', 'Mr Coder', 0, '', 0, 'app', 'bXJjb2Rlci5wcmVtaXVtQGdtYWlsLmNvbQ==_____9104753f2ebb65378c70aa2e2a47b25d', 1, 0, 0, 1562923671, 0),
(21, 1, 0, 'chirayu.team@gmail.com', '$2y$10$i4sZAvspas.JXaW27Aggj.tlKxD5pr/aRjtUxj1a.oP8OEWS6Qlui', 'Chirayu Team', 1, NULL, NULL, 'app', NULL, 1, NULL, 0, 1563880757, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_members`
--
ALTER TABLE `app_members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `app_packages`
--
ALTER TABLE `app_packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `app_pages`
--
ALTER TABLE `app_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `app_roles`
--
ALTER TABLE `app_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_members`
--
ALTER TABLE `app_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `app_packages`
--
ALTER TABLE `app_packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_pages`
--
ALTER TABLE `app_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `app_roles`
--
ALTER TABLE `app_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
