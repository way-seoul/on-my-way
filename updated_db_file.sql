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
 
INSERT INTO challenges (id, name, content, place_id, conditions, score, created_date, updated_date) VALUES
(2, 'challenge2', '', 1, NULL, 4, '2023-01-09 21:17:47', '2023-01-10 00:00:00'),
(3, 'challenge3', '', 1, NULL, 5, '2023-01-09 21:17:59', '2023-01-10 00:00:00'),
(4, 'challenge4', '', 2, NULL, 4, '2023-01-09 21:53:54', '2023-01-10 00:00:00'),
(5, 'challenge5', '', 2, '-', 3, '2023-01-10 11:57:24', '2023-01-10 00:00:00');
 
INSERT INTO challenge_comments (id, content, date_added, user_id, challenge_id) VALUES
(11, 'Hi here is my newest comment', '2023-01-17 13:16:58', 1, 5),
(13, 'Lets Add a New Comment here!', '2023-01-17 13:18:09', 1, 2),
(16, 'sadads', '2023-01-17 13:28:46', 1, 3),
(17, 'sadads', '2023-01-17 13:29:30', 1, 3),
(18, 'a new one', '2023-01-18 09:15:57', 1, 5);
 
INSERT INTO places (id, name, latitude, longitude) VALUES
(1, 'sample place 1', '37.536228509594000', '126.894975568805080'),
(2, 'sample place2', '37.537053744792225', '126.896220113787990');
 
INSERT INTO users (id, username, password, first_name, last_name, email, created_date, admin) VALUES
(1, 'hyeonju', '$2y$10$E3J2qsyWmibYHsqOUt6c1uh2J1zSwR1Cw9aLOon3EFYsbNsnYWkJC', 'Hyeonju', 'Choe', 'test@test.com', '2023-01-09 12:47:36', 0),
(2, 'Hyeonju', '$2y$10$RApN4G45YhDzX/3SOG.7R.geMTAm/ohR0pMI0gPbG1n889EZUeRBa', 'Hyeonju', 'Choe', 'test@test.com', '2023-01-10 12:16:56', 0);
 
INSERT INTO user_challenge_r (id, user_id, challenge_id) VALUES
(1, 1, 5);
 
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