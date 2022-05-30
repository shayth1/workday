-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 05:45 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workday`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `auth_type` varchar(255) NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_tokens`
--

INSERT INTO `auth_tokens` (`id`, `user_email`, `auth_type`, `selector`, `token`, `created_at`, `expires_at`) VALUES
(66, 'fatima@fatima.com', 'account_verify', 'a2b52a706e00e76d', '$2y$10$6S3Tp/h0ac1Cj1yJysPEI.KyA/saHxPZukfq778qMKRCJBlmPQyCu', '2022-05-28 18:51:34', '2022-05-28 19:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_task` int(11) NOT NULL,
  `comment_user` int(11) NOT NULL,
  `comment_text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_task`, `comment_user`, `comment_text`) VALUES
(1, 1, 31, 'test Comment'),
(3, 11, 31, 'its done '),
(4, 12, 31, ''),
(5, 12, 31, 'its done'),
(6, 12, 32, 'no we have ticket in line 27 in connect');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_sdate` date NOT NULL,
  `project_edate` date NOT NULL,
  `project_owner` int(11) NOT NULL,
  `project_status` varchar(255) NOT NULL,
  `project_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_sdate`, `project_edate`, `project_owner`, `project_status`, `project_logo`) VALUES
(2, 'liiinaa', '2022-05-27', '2022-05-30', 31, 'Active', 'project.png'),
(3, 'test', '2022-05-28', '2022-05-30', 33, 'Active', 'project.png'),
(4, 'testing', '2022-05-28', '2022-05-30', 31, 'Active', 'project.png'),
(5, 'yaqout', '2022-05-28', '2022-05-31', 31, 'Active', 'project.png'),
(6, 'fatima', '2022-05-29', '2022-05-31', 31, 'Active', 'project.png'),
(7, 'YAQOOT TEST', '2022-05-30', '2022-06-11', 31, 'Active', 'project.png'),
(8, 'fatima Project 22', '2022-05-10', '2022-05-31', 31, 'Active', 'project.png'),
(9, ' Project', '0000-00-00', '0000-00-00', 32, 'Active', 'project.png'),
(10, '2222', '0000-00-00', '0000-00-00', 31, 'Active', 'project.png');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_project` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_cdate` date NOT NULL,
  `task_estimated` float NOT NULL,
  `task_actual` float DEFAULT NULL,
  `assign_to` int(11) DEFAULT NULL,
  `task_discription` longtext NOT NULL,
  `priority` varchar(255) NOT NULL,
  `task_status` varchar(255) NOT NULL,
  `task_due` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_project`, `task_name`, `task_cdate`, `task_estimated`, `task_actual`, `assign_to`, `task_discription`, `priority`, `task_status`, `task_due`) VALUES
(1, 1, 'Task One', '2019-03-22', 24, 7, 31, 'discription', 'Medium', 'in-Progress', NULL),
(3, 1, 'Task 2', '0000-00-00', 1.5, NULL, NULL, 'discription', 'Low', 'New', NULL),
(4, 1, 'Task 4', '2022-03-19', 3.5, NULL, NULL, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut aliquid ea eligendi fuga aspernatur dolorum optio molestias, incidunt iure alias voluptatum quidem odio provident, a quam rem neque recusandae deleniti.', 'Urgent', 'New', NULL),
(6, 1, 'fatima', '2022-05-28', 24, 20, 31, 'test', 'Medium', 'New', '2022-05-28'),
(7, 3, 'fatima', '2022-05-28', 24, 15, 32, 'test', 'Medium', 'New', '2022-05-28'),
(8, 5, 'test 2', '2022-05-28', 48, NULL, 32, '', 'High', 'New', '2022-05-28'),
(9, 6, '', '2022-05-28', 72, NULL, NULL, '', 'Urgent', 'New', '2022-05-25'),
(10, 5, 'login page', '2022-05-28', 72, 70, 32, '', 'Urgent', 'New', '2022-05-25'),
(11, 5, 'front end ', '2022-05-28', 0, 0, 32, 'add colors ', 'High', 'New', '2022-06-06'),
(12, 7, 'software test', '2022-05-30', 29, NULL, 32, 'design homepage', 'Medium', 'Testing', '2022-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profile_image` varchar(255) NOT NULL DEFAULT '_defaultUser.png',
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `gender`, `headline`, `bio`, `profile_image`, `verified_at`, `created_at`, `updated_at`, `deleted_at`, `last_login_at`) VALUES
(31, 'lina', 'admin@admin.com', '$2y$10$jhIOk4NVdBile/NwhAU9We/f0aoohx.cG9CizmIALRz0aCKJa5s6a', 'lina', 'hamdan', 'f', '0796104250', 'React, .Net, C#, ABAP, SAP,Angular', '62931f5cb3a0b0.46501713.png', '2022-03-09 11:41:52', '2022-03-18 10:25:25', '2022-05-30 14:41:40', NULL, '2022-05-30 14:41:40'),
(32, 'yaqout', 'yaqout@yaqout.com', '$2y$10$jhIOk4NVdBile/NwhAU9We/f0aoohx.cG9CizmIALRz0aCKJa5s6a', 'yaqout', 'salahat', 'f', '0781111710', 'React, .Net, C#, ABAP, SAP,Angular', 'a.png', '2022-03-23 17:27:15', '2022-03-23 17:27:15', '2022-05-30 14:42:01', NULL, '2022-05-30 14:42:01'),
(33, 'fatima', 'fatima@fatima.com', '$2y$10$EqIz44Q7/QReQaiCkRQVku1kpGvpei.JX7UINtAq23wQaKLB/FO7a', 'fatima', 'mustafa', 'f', '0791526367', '', '62927095cfdd82.93591027.png', '2022-05-28 18:51:33', '2022-05-28 18:51:33', '2022-05-28 19:06:10', NULL, '2022-05-28 19:06:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id` (`id`,`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
