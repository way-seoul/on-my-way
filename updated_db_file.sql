-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 15, 2023 at 12:00 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `on_my_way`
--

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `content` text NOT NULL,
  `place_id` int(11) NOT NULL,
  `conditions` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `users_accomplished` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `name`, `content`, `place_id`, `conditions`, `score`, `users_accomplished`, `created_date`, `updated_date`) VALUES
(2, 'challenge2', '', 1, NULL, 4, NULL, '2023-01-09 21:17:47', '2023-01-10 00:00:00'),
(3, 'challenge3', '', 1, NULL, 5, NULL, '2023-01-09 21:17:59', '2023-01-10 00:00:00'),
(4, 'challenge4', '', 2, NULL, 4, NULL, '2023-01-09 21:53:54', '2023-01-10 00:00:00'),
(5, 'challenge5', '', 2, '-', 3, NULL, '2023-01-10 11:57:24', '2023-01-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `challenge_comments`
--

CREATE TABLE `challenge_comments` (
  `id` int(11) NOT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `challenge_comments`
--

INSERT INTO `challenge_comments` (`id`, `content`, `date_added`, `user_id`, `challenge_id`) VALUES
(11, 'Hi here is my newest comment', '2023-01-17 13:16:58', 1, 5),
(13, 'Lets Add a New Comment here!', '2023-01-17 13:18:09', 1, 2),
(16, 'sadads', '2023-01-17 13:28:46', 1, 3),
(17, 'sadads', '2023-01-17 13:29:30', 1, 3),
(18, 'a new one', '2023-01-18 09:15:57', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `latitude` decimal(18,15) NOT NULL DEFAULT 37.536228509594000,
  `longitude` decimal(18,15) NOT NULL DEFAULT 126.894975568805080
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `latitude`, `longitude`) VALUES
(1, 'sample place 1', '37.536228509594000', '126.894975568805080'),
(2, 'sample place2', '37.537053744792225', '126.896220113787990');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `created_date` datetime NOT NULL,
  `points_total` int(11) DEFAULT 0,
  `admin` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `created_date`, `points_total`, `admin`, `is_deleted`) VALUES
(1, 'admin', '$2y$10$gfk0EJM6FXUIipBlE8p4EOAR49YziUCZ7wC8D/uvLwea/ANCD0PoC', 'admin', 'kim', 'admin@admin.com', '2023-02-02 20:00:00', 0, 1, 0),
(2, 'hyeonju', '$2y$10$E3J2qsyWmibYHsqOUt6c1uh2J1zSwR1Cw9aLOon3EFYsbNsnYWkJC', 'Hyeonju', 'Choe', 'test@test.com', '2023-01-09 12:47:36', 0, 0, 0),
(3, 'Hyeonju', '$2y$10$RApN4G45YhDzX/3SOG.7R.geMTAm/ohR0pMI0gPbG1n889EZUeRBa', 'Hyeonju', 'Choe', 'test@test.com', '2023-01-10 12:16:56', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_challenge_r`
--

CREATE TABLE `user_challenge_r` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_challenge_r`
--

INSERT INTO `user_challenge_r` (`id`, `user_id`, `challenge_id`) VALUES
(1, 1, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `challenge_comments`
--
ALTER TABLE `challenge_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `challenge_id` (`challenge_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_challenge_r`
--
ALTER TABLE `user_challenge_r`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `challenge_id` (`challenge_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `challenge_comments`
--
ALTER TABLE `challenge_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_challenge_r`
--
ALTER TABLE `user_challenge_r`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `challenges`
--
ALTER TABLE `challenges`
  ADD CONSTRAINT `challenges_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `challenge_comments`
--
ALTER TABLE `challenge_comments`
  ADD CONSTRAINT `challenge_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `challenge_comments_ibfk_2` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`);

--
-- Constraints for table `user_challenge_r`
--
ALTER TABLE `user_challenge_r`
  ADD CONSTRAINT `user_challenge_r_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_challenge_r_ibfk_2` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
