-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 23-01-10 12:57
-- 서버 버전: 10.4.21-MariaDB
-- PHP 버전: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `on_my_way`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `challenges`
--

DROP TABLE IF EXISTS `challenges`;
CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `content` text NOT NULL,
  `place_id` int(11) NOT NULL,
  `conditions` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `challenges`
--

INSERT INTO `challenges` (`id`, `name`, `content`, `place_id`, `conditions`, `score`, `created_date`, `updated_date`) VALUES
(2, 'challenge2', '', 1, NULL, 4, '2023-01-09 21:17:47', '2023-01-10 00:00:00'),
(3, 'challenge3', '', 1, NULL, 5, '2023-01-09 21:17:59', '2023-01-10 00:00:00'),
(4, 'challenge4', '', 2, NULL, 4, '2023-01-09 21:53:54', '2023-01-10 00:00:00'),
(5, 'challenge5', '', 2, '-', 3, '2023-01-10 11:57:24', '2023-01-10 00:00:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `latitude` decimal(18,15) NOT NULL DEFAULT 37.536228509594000,
  `longitude` decimal(18,15) NOT NULL DEFAULT 126.894975568805080
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `places`
--

INSERT INTO `places` (`id`, `name`, `latitude`, `longitude`) VALUES
(1, 'sample place 1', '37.536228509594000', '126.894975568805080'),
(2, 'sample place2', '37.537053744792225', '126.896220113787990');

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `created_date` datetime NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `created_date`, `admin`) VALUES
(1, 'hyeonju', '$2y$10$E3J2qsyWmibYHsqOUt6c1uh2J1zSwR1Cw9aLOon3EFYsbNsnYWkJC', 'Hyeonju', 'Choe', 'test@test.com', '2023-01-09 12:47:36', 0),
(2, 'Hyeonju', '$2y$10$RApN4G45YhDzX/3SOG.7R.geMTAm/ohR0pMI0gPbG1n889EZUeRBa', 'Hyeonju', 'Choe', 'test@test.com', '2023-01-10 12:16:56', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `user_challenge_r`
--

DROP TABLE IF EXISTS `user_challenge_r`;
CREATE TABLE `user_challenge_r` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `user_challenge_r`
--

INSERT INTO `user_challenge_r` (`id`, `user_id`, `challenge_id`) VALUES
(1, 1, 5);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id_foreign_key` (`place_id`);

--
-- 테이블의 인덱스 `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `user_challenge_r`
--
ALTER TABLE `user_challenge_r`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `challenge_id_fk` (`challenge_id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `user_challenge_r`
--
ALTER TABLE `user_challenge_r`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `challenges`
--
ALTER TABLE `challenges`
  ADD CONSTRAINT `place_id_foreign_key` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- 테이블의 제약사항 `user_challenge_r`
--
ALTER TABLE `user_challenge_r`
  ADD CONSTRAINT `challenge_id_fk` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`),
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
