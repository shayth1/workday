-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2022 at 08:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


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

CREATE TABLE `auth_tokens`
(
  `id` int
(11) UNSIGNED NOT NULL,
  `user_email` varchar
(255) NOT NULL,
  `auth_type` varchar
(255) NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp
() ON
UPDATE current_timestamp(),
  `expires_at
` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_tokens`
--

INSERT INTO `auth_tokens` (`
id`,
`user_email
`, `auth_type`, `selector`, `token`, `created_at`, `expires_at`) VALUES
(63, 'admin@admin.com', 'remember_me', '2981bb4e67b5db5f', '$2y$10$LWYHStKP.JMBf.GMym9cWesZ64DxAKlLxDowNdw7jyRA6TVjDp30q', '2022-03-19 05:16:04', '2022-03-29 05:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project`
(
  `project_id` int
(11) NOT NULL,
  `project_name` varchar
(255) NOT NULL,
  `project_sdate` date NOT NULL,
  `project_edate` date NOT NULL,
  `project_owner` int
(11) NOT NULL,
  `project_status` varchar
(255) NOT NULL,
  `project_logo` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`
project_id`,
`project_name
`, `project_sdate`, `project_edate`, `project_owner`, `project_status`, `project_logo`) VALUES
(1, 'ssss', '2022-03-03', '2022-03-23', 31, 'Active', '623576536ab322.03986307.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task`
(
  `task_id` int
(11) NOT NULL,
  `task_project` int
(11) NOT NULL,
  `task_name` varchar
(255) NOT NULL,
  `task_cdate` date NOT NULL,
  `task_estimated` float NOT NULL,
  `task_actual` float DEFAULT NULL,
  `assign_to` int
(11) DEFAULT NULL,
  `task_discription` longtext NOT NULL,
  `priority` varchar
(255) NOT NULL,
  `task_status` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`
task_id`,
`task_project
`, `task_name`, `task_cdate`, `task_estimated`, `task_actual`, `assign_to`, `task_discription`, `priority`, `task_status`) VALUES
(1, 1, 'Task One', '2019-03-22', 24, 0, 0, 'discription', 'Medium', 'New'),
(2, 1, '', '0000-00-00', 0, NULL, NULL, 'discription', 'Urgent', 'New'),
(3, 1, 'Task 2', '0000-00-00', 1.5, NULL, NULL, 'discription', 'Low', 'New'),
(4, 1, 'Task 4', '2022-03-19', 3.5, NULL, NULL, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut aliquid ea eligendi fuga aspernatur dolorum optio molestias, incidunt iure alias voluptatum quidem odio provident, a quam rem neque recusandae deleniti.', 'Urgent', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
  `id` int
(11) UNSIGNED NOT NULL,
  `username` varchar
(255) NOT NULL,
  `email` varchar
(255) NOT NULL,
  `password` varchar
(255) NOT NULL,
  `first_name` varchar
(255) DEFAULT NULL,
  `last_name` varchar
(255) DEFAULT NULL,
  `gender` char
(1) DEFAULT NULL,
  `headline` varchar
(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profile_image` varchar
(255) NOT NULL DEFAULT '_defaultUser.png',
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp
() ON
UPDATE current_timestamp(),
  `deleted_at
` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`
id`,
`username`,
`email`,
`password`,
`first_name`,
`last_name`,
`gender
`, `headline`, `bio`, `profile_image`, `verified_at`, `created_at`, `updated_at`, `deleted_at`, `last_login_at`) VALUES
(31, 'admin', 'admin@admin.com', '$2y$10$jhIOk4NVdBile/NwhAU9We/f0aoohx.cG9CizmIALRz0aCKJa5s6a', 'Supahot', 'Soverysupahot', 'm', '0799978266', 'This is the bio of a supa hot user. Now i will say needless stuff to make this longer so this looks like a bio and not anything other than a bio.', '_defaultUser.png', '2022-03-09 11:41:52', '2022-03-18 10:25:25', '2022-03-19 05:16:03', NULL, '2022-03-19 05:16:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
ADD PRIMARY KEY
(`id`),
ADD UNIQUE KEY `id`
(`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
ADD PRIMARY KEY
(`project_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
ADD PRIMARY KEY
(`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY
(`id`),
ADD UNIQUE KEY `username`
(`username`),
ADD UNIQUE KEY `email`
(`email`),
ADD UNIQUE KEY `id`
(`id`,`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int
(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int
(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
