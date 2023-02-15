START TRANSACTION;
 
SET default_storage_engine=InnoDB;
SET FOREIGN_KEY_CHECKS=0;
SET time_zone = "+00:00";
 
CREATE DATABASE IF NOT EXISTS on_my_way DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE on_my_way;
 
DROP TABLE IF EXISTS challenges;
CREATE TABLE challenges (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(30) DEFAULT NULL,
  content text NOT NULL,
  place_id int(11) NOT NULL,
  conditions varchar(100) DEFAULT NULL,
  score int(11) DEFAULT NULL,
  users_accomplished int(11) DEFAULT NULL,
  created_date datetime NOT NULL DEFAULT current_timestamp(),
  updated_date datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id)
);
 
DROP TABLE IF EXISTS challenge_comments;
CREATE TABLE challenge_comments (
  id int(11) NOT NULL AUTO_INCREMENT,
  content varchar(10000) DEFAULT NULL,
  date_added datetime NOT NULL,
  user_id int(11) NOT NULL,
  challenge_id int(11) NOT NULL,
  PRIMARY KEY (id)
);
 
 
DROP TABLE IF EXISTS places;
CREATE TABLE places (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(30) DEFAULT NULL,
  latitude decimal(18,15) NOT NULL DEFAULT 37.536228509594000,
  longitude decimal(18,15) NOT NULL DEFAULT 126.894975568805080,
  PRIMARY KEY (id)
);
 
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(64) NOT NULL,
  password varchar(64) NOT NULL,
  first_name varchar(64) NOT NULL,
  last_name varchar(64) NOT NULL,
  email varchar(64) NOT NULL,
  created_date datetime NOT NULL,
  points_total int(11) DEFAULT '0',
  admin tinyint(1) NOT NULL,
  PRIMARY KEY (id)
);
 
DROP TABLE IF EXISTS user_challenge_r;
CREATE TABLE user_challenge_r (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  challenge_id int(11) NOT NULL,
  PRIMARY KEY (id)
);
 
INSERT INTO `challenges` (`id`, `name`, `content`, `place_id`, `conditions`, `score`, `users_accomplished`, `created_date`, `updated_date`) VALUES
(2, 'Get to Wcoding', '', 1, NULL, 4, 8, '2023-01-09 21:17:47', '2023-01-10 00:00:00'),
(6, 'Visit Reichstag', '', 3, NULL, 100, 0, '2023-02-15 10:24:53', '2023-02-15 10:24:53'),
(7, 'Visit Oriental Pearl Tower', '', 5, NULL, 100, 0, '2023-02-15 10:26:36', '2023-02-15 10:26:36'),
(8, 'Climb the Tokyo skytree', '', 7, NULL, 1000, 0, '2023-02-15 11:01:33', '2023-02-15 11:01:33'),
(9, 'Visit the Kremlin', '', 6, NULL, 500, 0, '2023-02-15 11:04:00', '2023-02-15 11:04:00');
 
INSERT INTO `challenge_comments` (`id`, `content`, `date_added`, `user_id`, `challenge_id`) VALUES
(13, 'Lets Add a New Comment here!', '2023-01-17 13:18:09', 1, 2);
 
INSERT INTO `places` (`id`, `name`, `latitude`, `longitude`) VALUES
(1, 'Wcoding', '37.536228509594000', '126.894975568805080'),
(3, 'Berlin', '52.520007000000000', '13.404954000000000'),
(5, 'Shanghai', '31.230416000000000', '121.473701000000000'),
(6, 'Moscow', '55.755826000000000', '37.617300000000000'),
(7, 'Tokyo', '35.689487000000000', '139.691706000000000');
 
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `created_date`, `points_total`, `admin`) VALUES
(1, 'admin', '$2y$10$gfk0EJM6FXUIipBlE8p4EOAR49YziUCZ7wC8D/uvLwea/ANCD0PoC', 'admin', 'kim', 'admin@admin.com', '2023-02-02 20:00:00', 0, 1),
(2, 'hyeonju', '$2y$10$E3J2qsyWmibYHsqOUt6c1uh2J1zSwR1Cw9aLOon3EFYsbNsnYWkJC', 'Hyeonju', 'Choe', 'test@test.com', '2023-01-09 12:47:36', 0, 0),
(3, 'Hyeonju', '$2y$10$RApN4G45YhDzX/3SOG.7R.geMTAm/ohR0pMI0gPbG1n889EZUeRBa', 'Hyeonju', 'Choe', 'test@test.com', '2023-01-10 12:16:56', 0, 0),
(5, 'test', '$2y$10$xGq6WNa6XeRmJVIBLx7qMuVr.9mWmllx8aAdwJ.fhFV7iBpCKY6A6', 'test', 'test', 'test@test.com', '2023-02-15 13:26:02', 4, 0);

 
ALTER TABLE challenges 
  ADD FOREIGN KEY (place_id) REFERENCES places(id);
 
ALTER TABLE challenge_comments 
  ADD FOREIGN KEY (user_id) REFERENCES users(id),
  ADD FOREIGN KEY (challenge_id) REFERENCES challenges(id);
 
ALTER TABLE user_challenge_r
  ADD FOREIGN KEY (user_id) REFERENCES users(id),
  ADD FOREIGN KEY (challenge_id) REFERENCES challenges(id);
  
SET FOREIGN_KEY_CHECKS=1;
COMMIT;