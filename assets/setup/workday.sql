-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 12:29 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

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
(64, 'shayth@shayth.com', 'account_verify', 'b8864e3fc97d9d9a', '$2y$10$J.C.WVA1zFTGazNyPip1Q.8uSe50ylX/s5pJ.R7IrEa1yyW5gYV76', '2022-03-23 17:27:15', '2022-03-23 18:27:15'),
(65, 'shayth@shayth.com', 'remember_me', 'e3cd7f07e594480e', '$2y$10$XUZTQV.kTE9FgqGeFrTdAuCQtUisv4AzgMd3YgrOI4LgeLrEoCOre', '2022-03-23 17:27:22', '2022-04-02 16:27:22');

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
(2, 1, 32, 'a7a');

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
(1, 'ssss', '2022-03-03', '2022-03-23', 31, 'Active', '623576536ab322.03986307.jpeg');

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
(2, 1, '', '0000-00-00', 0, NULL, NULL, 'discription', 'Urgent', 'New', NULL),
(3, 1, 'Task 2', '0000-00-00', 1.5, NULL, NULL, 'discription', 'Low', 'New', NULL),
(4, 1, 'Task 4', '2022-03-19', 3.5, NULL, NULL, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut aliquid ea eligendi fuga aspernatur dolorum optio molestias, incidunt iure alias voluptatum quidem odio provident, a quam rem neque recusandae deleniti.', 'Urgent', 'New', NULL),
(5, 1, 'Fainal Test', '2022-03-25', 12, 2, 32, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae similique dignissimos vero nam laudantium laborum fugit enim tempora ducimus? Repellendus, cum ratione itaque omnis dignissimos odio officia reprehenderit dolores sint.', 'Medium', 'New', '2022-03-31');

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
(31, 'admin', 'admin@admin.com', '$2y$10$jhIOk4NVdBile/NwhAU9We/f0aoohx.cG9CizmIALRz0aCKJa5s6a', 'Supahot', 'Soverysupahot', 'm', '0799978266', 'React, .Net, C#, ABAP, SAP,Angular', '623b78fcdfe9a3.50873298.png', '2022-03-09 11:41:52', '2022-03-18 10:25:25', '2022-03-25 11:13:35', NULL, '2022-03-19 05:16:03'),
(32, 'shayth', 'shayth@shayth.com', '$2y$10$jnRMeOqpCa20aY1Xrkq8luoZx116hFxskbuRKahWWx4nxbD4XUdpW', 'shayth', 'bani baker', 'm', '0799978266', 'React, .Net, C#, ABAP, SAP,Angular', '_defaultUser.png', '2022-03-23 17:27:15', '2022-03-23 17:27:15', '2022-03-25 11:19:41', NULL, '2022-03-25 11:19:41');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
