-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2019 at 11:09 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OrganizR`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL,
  `event_id` int(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `event_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 1, 1, 'Hello! This is our first event! A party that anyone can take place! Don''t forget to bring your friends and let your opinions come to life in the comment section! Thank You, OrganizR Team!', '2018-12-20 10:01:20'),
(7, 1, 10, 'Nice! This is awesome!', '2018-12-20 16:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE IF NOT EXISTS `Events` (
  `id` int(4) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `organiser_id` int(11) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `main_photo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`id`, `name`, `description`, `organiser_id`, `country`, `city`, `price`, `start_date`, `end_date`, `main_photo`) VALUES
(1, 'OrganizR Start Party!', 'As a start to our new platform we will be throwing a brand new party in Bucharest-Romania.\nDon''t forget that anyone is free to enter, so don''t forget to bring up your friends and family!', 2, 'Romania', 'Bucharest', 0, '2018-11-27 20:00:00', '2018-11-28 02:00:00', 1),
(3, 'TestEvent', 'Test', 8, 'Test', 'Test', 100, '2018-12-12 12:00:00', '2018-12-13 12:00:00', 3),
(4, 'Paris Fun', 'Hello! We welcome you to our new event!', 9, 'France', 'Paris', 200, '2018-12-25 15:00:00', '2018-12-22 10:00:00', 6),
(5, 'TestEvent', 'Test', 10, 'Test', 'Test', -300, '2019-01-16 12:00:00', '2019-01-07 12:00:00', 16);

-- --------------------------------------------------------

--
-- Table structure for table `Organiser`
--

CREATE TABLE IF NOT EXISTS `Organiser` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Organiser`
--

INSERT INTO `Organiser` (`id`, `name`, `rating`, `description`, `admin_id`) VALUES
(2, 'OrganizR', 0, 'Organisers', 1),
(3, 'Another Test', 0, 'TEST', 6),
(7, 'Cristi', 0, 'cristian', 10),
(9, 'Ultra Magic', 0, 'By gunpowder', 11),
(10, 'Organiz', 0, 'Test', 12);

-- --------------------------------------------------------

--
-- Table structure for table `Organiser_Members`
--

CREATE TABLE IF NOT EXISTS `Organiser_Members` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `organiser_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Organiser_Members`
--

INSERT INTO `Organiser_Members` (`id`, `member_id`, `organiser_id`) VALUES
(23, 1, 2),
(26, 1, 7),
(28, 1, 10),
(29, 6, 10),
(30, 7, 10),
(25, 10, 9),
(24, 11, 9),
(27, 12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `Photo`
--

CREATE TABLE IF NOT EXISTS `Photo` (
  `id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Photo`
--

INSERT INTO `Photo` (`id`, `location`) VALUES
(0, 'no-photo-available.png'),
(1, 'partan.jpg'),
(2, 'tmp/img-5c10cab7408ad.jpg'),
(3, 'tmp/img-5c111ef718148.jpg'),
(4, 'tmp/prof-5c17c9dba8dd1.jpg'),
(5, 'profiles/prof-5c17ca5430b83.jpg'),
(6, 'tmp/img-5c1bc0e2119f9.jpg'),
(7, 'tmp/img-5c28eb003a5c4.jpeg'),
(10, 'tmp/img-5c29d59b69d68.jpeg'),
(11, 'tmp/img-5c29db39c913e.png'),
(12, 'tmp/img-5c29db800b191.png'),
(14, 'tmp/img-5c29dddd80528.png'),
(15, 'profiles/prof-5c2e01295b231.png'),
(16, 'tmp/img-5c3dbe7890a9c.png');

-- --------------------------------------------------------

--
-- Table structure for table `RATING`
--

CREATE TABLE IF NOT EXISTS `RATING` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `stars` int(2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RATING`
--

INSERT INTO `RATING` (`id`, `event_id`, `stars`, `user_id`) VALUES
(1, 1, 4, 1),
(5, 1, 5, 10),
(6, 4, 5, 1),
(7, 5, 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(4) NOT NULL,
  `page` varchar(255) DEFAULT NULL,
  `pageviews` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `page`, `pageviews`) VALUES
(1, 'Register.php', 19),
(2, 'registerOrganiser.php', 13),
(3, 'Events.php\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(55) NOT NULL,
  `pwd` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `birthday` date NOT NULL,
  `newsletter` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `auth_code` varchar(255) NOT NULL,
  `profile_photo` int(11) DEFAULT NULL,
  `super_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `pwd`, `email`, `birthday`, `newsletter`, `verified`, `auth_code`, `profile_photo`, `super_admin`) VALUES
(1, 'System', 'System201', 'system@gmail.com', '1990-12-28', 0, 1, '0', 5, 1),
(6, 'devUser', '555demo555', 'demo@demo.com', '1983-11-17', 0, 0, 'auth_5be47c294f1a0', NULL, 0),
(7, 'devUser55', '555demo555', 'demo123@demo.com', '1983-11-17', 0, 0, 'auth_5be47c616e7da', NULL, 0),
(10, 'Cristi123', 'Cristi123@123', 'cristian1997ion@yahoo.com', '1997-12-28', 0, 1, 'auth_5c0643f8620cf', 15, 0),
(11, 'deathranger15@gmail.com', 'Demon201', 'deathranger15@gmail.com', '1967-10-05', 0, 1, 'auth_5c1bbffbc489c', NULL, 0),
(12, 'sala214', 'Demon201', 'cristian.ion@vivre.eu', '1997-01-22', 0, 1, 'auth_5c3dbd6cd80b9', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_photo` (`main_photo`);

--
-- Indexes for table `Organiser`
--
ALTER TABLE `Organiser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_admin_id` (`admin_id`);

--
-- Indexes for table `Organiser_Members`
--
ALTER TABLE `Organiser_Members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id` (`member_id`,`organiser_id`),
  ADD KEY `organiser_id_fk` (`organiser_id`);

--
-- Indexes for table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RATING`
--
ALTER TABLE `RATING`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_id` (`event_id`,`user_id`),
  ADD KEY `member_id` (`user_id`);

--
-- Indexes for table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_photo` (`profile_photo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Organiser`
--
ALTER TABLE `Organiser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Organiser_Members`
--
ALTER TABLE `Organiser_Members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `Photo`
--
ALTER TABLE `Photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `RATING`
--
ALTER TABLE `RATING`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `stats`
--
ALTER TABLE `stats`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `Events`
--
ALTER TABLE `Events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`main_photo`) REFERENCES `Photo` (`id`);

--
-- Constraints for table `Organiser`
--
ALTER TABLE `Organiser`
  ADD CONSTRAINT `FK_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Organiser_Members`
--
ALTER TABLE `Organiser_Members`
  ADD CONSTRAINT `member_id_fk` FOREIGN KEY (`member_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `organiser_id_fk` FOREIGN KEY (`organiser_id`) REFERENCES `Organiser` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `RATING`
--
ALTER TABLE `RATING`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `Events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`profile_photo`) REFERENCES `Photo` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
