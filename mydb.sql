-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2014 at 02:33 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='List of admin users' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `user_name`, `password`, `created_at`, `modified_at`) VALUES
(1, 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', '2013-10-23 00:00:00', '2013-10-24 14:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `seen_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`from_user_id`,`to_user_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_chat_user1_idx` (`from_user_id`),
  KEY `fk_chat_user2_idx` (`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `neighborhood`
--

CREATE TABLE IF NOT EXISTS `neighborhood` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `is_join_restricted` tinyint(1) DEFAULT NULL COMMENT '1 = Yes, 0 = No',
  `is_public` tinyint(1) DEFAULT NULL COMMENT '1 = public,0 = private',
  `location_longitude` decimal(10,0) DEFAULT NULL,
  `location_latitude` decimal(10,0) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `users_count` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `neighborhood`
--

INSERT INTO `neighborhood` (`id`, `name`, `location`, `is_join_restricted`, `is_public`, `location_longitude`, `location_latitude`, `created_at`, `modified_at`, `users_count`) VALUES
(13, 'Test 11', 'Test location', 1, 0, NULL, NULL, '2014-05-29 09:10:40', '2014-05-29 09:10:40', NULL),
(14, 'Test 22', 'Test location', 0, 0, NULL, NULL, '2014-05-29 09:10:57', '2014-05-29 09:10:57', NULL),
(15, 'Test 33', 'Test location', 0, 1, NULL, NULL, '2014-05-29 09:11:11', '2014-05-29 09:11:11', NULL),
(16, 'Test 44', 'Test location', 1, 1, NULL, NULL, '2014-05-29 09:11:21', '2014-05-29 09:11:21', NULL),
(17, 'Test 55', 'Test location', 0, 1, NULL, NULL, '2014-05-29 09:11:31', '2014-05-29 09:11:31', NULL),
(18, 'Test 66', 'Test location', 0, 0, NULL, NULL, '2014-05-29 09:11:41', '2014-05-29 09:11:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `neighborhood_blocked_user`
--

CREATE TABLE IF NOT EXISTS `neighborhood_blocked_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `neighborhood_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `neighborhood_blocked_user`
--

INSERT INTO `neighborhood_blocked_user` (`id`, `neighborhood_id`, `user_id`, `created_at`, `modified_at`) VALUES
(3, 13, 9, '2014-05-29 12:22:12', '2014-05-29 12:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `neighborhood_has_user`
--

CREATE TABLE IF NOT EXISTS `neighborhood_has_user` (
  `neighborhood_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`neighborhood_id`,`user_id`),
  KEY `fk_neighborhood_has_user_user1_idx` (`user_id`),
  KEY `fk_neighborhood_has_user_neighborhood1_idx` (`neighborhood_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `neighborhood_has_user`
--

INSERT INTO `neighborhood_has_user` (`neighborhood_id`, `user_id`, `created_at`, `modified_at`) VALUES
(13, 9, '2014-05-29 09:10:40', '2014-05-29 09:10:40'),
(14, 9, '2014-05-29 09:10:58', '2014-05-29 09:10:58'),
(15, 13, '2014-05-29 09:11:11', '2014-05-29 09:11:11'),
(16, 13, '2014-05-29 09:11:21', '2014-05-29 09:11:21'),
(17, 14, '2014-05-29 09:11:31', '2014-05-29 09:11:31'),
(18, 14, '2014-05-29 09:11:41', '2014-05-29 09:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `neighborhood_invite`
--

CREATE TABLE IF NOT EXISTS `neighborhood_invite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_to` int(11) NOT NULL,
  `user_id_from` int(11) NOT NULL,
  `neighborhood_id` int(11) NOT NULL,
  `invite_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Pending,1 = Accept, 2 = Decline',
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`,`user_id_to`,`neighborhood_id`,`user_id_from`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_neighborhood_join_request_user1_idx` (`user_id_to`),
  KEY `fk_neighborhood_join_request_neighborhood1_idx` (`neighborhood_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `neighborhood_invite`
--

INSERT INTO `neighborhood_invite` (`id`, `user_id_to`, `user_id_from`, `neighborhood_id`, `invite_status`, `created_at`, `modified_at`) VALUES
(1, 13, 14, 17, 2, '2014-05-29 00:00:00', '2014-05-29 14:59:52'),
(2, 13, 9, 13, 1, '2014-05-29 00:00:00', '2014-05-29 14:57:59'),
(3, 14, 9, 13, 0, '2014-05-29 00:00:00', '2014-05-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL COMMENT 'text, picture, video',
  `text` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `media` varchar(255) DEFAULT NULL,
  `likes_count` int(11) DEFAULT NULL,
  `comments_count` varchar(45) DEFAULT NULL,
  `location_latitude` decimal(10,0) DEFAULT NULL,
  `location_longitude` decimal(10,0) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_post_user1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `type`, `text`, `thumbnail`, `media`, `likes_count`, `comments_count`, `location_latitude`, `location_longitude`, `created_at`, `modified_at`) VALUES
(1, 13, 'text', 'This is a first text', NULL, NULL, 5, '6', NULL, NULL, '2014-05-30 00:00:00', '2014-05-30 00:00:00'),
(2, 13, 'picture', 'This is a second image', 'test_thump.jpg', 'test media', 8, '9', NULL, NULL, '2014-05-30 00:00:00', '2014-05-30 00:00:00'),
(3, 14, 'video', 'Test video text', 'test_thumbnail2.jpg', 'test 2 media', 6, '7', NULL, NULL, '2014-05-30 00:00:00', '2014-05-30 00:00:00'),
(4, 14, 'text', 'Test third text', 'test_thump3.jpg', 'Test Media', 9, '9', NULL, NULL, '2014-05-30 00:00:00', '2014-05-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE IF NOT EXISTS `post_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`,`post_id`,`user_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_post_has_user_user2_idx` (`user_id`),
  KEY `fk_post_has_user_post2_idx` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE IF NOT EXISTS `post_like` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`post_id`,`user_id`),
  KEY `fk_post_has_user_user1_idx` (`user_id`),
  KEY `fk_post_has_user_post1_idx` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

CREATE TABLE IF NOT EXISTS `service_provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `is_verified` tinyint(1) DEFAULT NULL COMMENT '1= verified',
  `location_latitude` decimal(10,0) DEFAULT NULL,
  `location_longitude` decimal(10,0) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `service_provider`
--

INSERT INTO `service_provider` (`id`, `name`, `is_verified`, `location_latitude`, `location_longitude`, `created_at`, `modified_at`) VALUES
(1, 'Test', 1, NULL, NULL, '2014-05-30 00:00:00', '2014-05-31 12:15:55'),
(2, 'Test 11', 1, NULL, NULL, '2014-05-30 00:00:00', '2014-05-31 12:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_category`
--

CREATE TABLE IF NOT EXISTS `service_provider_category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_provider_category`
--

INSERT INTO `service_provider_category` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Test Cat', '2014-05-30 00:00:00', '2014-05-30 00:00:00'),
(2, 'Test Cat 22', '2014-05-30 00:00:00', '2014-05-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_has_service_provider_category`
--

CREATE TABLE IF NOT EXISTS `service_provider_has_service_provider_category` (
  `service_provider_id` int(11) NOT NULL,
  `service_provider_category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`service_provider_id`,`service_provider_category_id`),
  KEY `fk_service_provider_has_service_provider_category_service_p_idx` (`service_provider_category_id`),
  KEY `fk_service_provider_has_service_provider_category_service_p_idx1` (`service_provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_provider_has_service_provider_category`
--

INSERT INTO `service_provider_has_service_provider_category` (`service_provider_id`, `service_provider_category_id`, `created_at`, `modified_at`) VALUES
(1, 1, '2014-05-30 00:00:00', '2014-05-30 00:00:00'),
(1, 2, '2014-05-30 00:00:00', '2014-05-30 00:00:00'),
(2, 1, '2014-05-30 00:00:00', '2014-05-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `facebook_token` text NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `facebook_token`, `first_name`, `last_name`, `address`, `city`, `state`, `zipcode`, `phone_no`, `created_at`, `modified_at`) VALUES
(9, 'test@test.com', 'test', 'e10adc3949ba59abbe56e057f20f883e', 'abcd1234', 'Test', 'Test', '', '', '', '', NULL, '2014-05-28 07:59:27', '2014-05-28 07:59:27'),
(13, 'test1@test.com', 'test11', 'e10adc3949ba59abbe56e057f20f883e', 'efgh5678', 'Test11', 'Test12', 'Test Address', 'Test City', 'Test State', '12345', '223344', '2014-05-29 09:07:51', '2014-05-29 09:07:51'),
(14, 'test2@test.com', 'test22', 'e10adc3949ba59abbe56e057f20f883e', 'ijklmn90', 'Test21', 'Test22', 'Test Address', 'Lost Angeles', 'USA', '12345', '334455', '2014-05-29 09:07:57', '2014-05-29 09:07:57'),
(15, 'test3@test.com', 'test33', 'e10adc3949ba59abbe56e057f20f883e', 'opqrstu', 'Test3', 'Test3', 'Test Address', 'Test City', 'Test State', '12345', '112233', '2014-05-31 09:18:22', '2014-05-31 09:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_alert`
--

CREATE TABLE IF NOT EXISTS `user_alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `post_comment_post_id` int(11) DEFAULT NULL,
  `alert` text,
  PRIMARY KEY (`id`,`recipient_id`,`user_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_alert_user1_idx` (`user_id`),
  KEY `fk_alert_user2_idx` (`recipient_id`),
  KEY `fk_user_alert_post1_idx` (`post_id`),
  KEY `fk_user_alert_post_comment1_idx` (`post_comment_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_alert`
--

INSERT INTO `user_alert` (`id`, `recipient_id`, `user_id`, `created_at`, `modified_at`, `type`, `post_id`, `post_comment_post_id`, `alert`) VALUES
(7, 9, 13, '2014-05-30 00:00:00', '2014-05-30 00:00:00', NULL, NULL, NULL, 'Likes Your Picture'),
(9, 14, 13, '2014-05-30 00:00:00', '2014-05-30 00:00:00', NULL, NULL, NULL, 'Commented on your video'),
(10, 9, 14, '2014-05-30 00:00:00', '2014-05-30 00:00:00', NULL, NULL, NULL, 'Likes Your Video');

-- --------------------------------------------------------

--
-- Table structure for table `user_block_user`
--

CREATE TABLE IF NOT EXISTS `user_block_user` (
  `user_id` int(11) NOT NULL,
  `block_user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`block_user_id`),
  KEY `fk_user_has_user_user2_idx` (`block_user_id`),
  KEY `fk_user_has_user_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_has_service_provider`
--

CREATE TABLE IF NOT EXISTS `user_has_service_provider` (
  `user_id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`service_provider_id`),
  KEY `fk_user_has_service_provider_service_provider1_idx` (`service_provider_id`),
  KEY `fk_user_has_service_provider_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_has_service_provider`
--

INSERT INTO `user_has_service_provider` (`user_id`, `service_provider_id`, `created_at`, `modified_at`) VALUES
(14, 1, '2014-05-31 00:00:00', '2014-05-31 00:00:00'),
(15, 2, '2014-05-31 00:00:00', '2014-05-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `user_id` int(11) NOT NULL,
  `about` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `location_latitude` decimal(10,0) DEFAULT NULL,
  `location_longitude` decimal(10,0) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_picture`
--

CREATE TABLE IF NOT EXISTS `user_profile_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_stats`
--

CREATE TABLE IF NOT EXISTS `user_stats` (
  `user_id` int(11) NOT NULL,
  `posts_count` int(11) DEFAULT NULL,
  `neighborhoods_count` int(11) DEFAULT NULL,
  `neighbors_count` int(11) DEFAULT NULL,
  `lists_count` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_chat_user1` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chat_user2` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `neighborhood_has_user`
--
ALTER TABLE `neighborhood_has_user`
  ADD CONSTRAINT `fk_neighborhood_has_user_neighborhood1` FOREIGN KEY (`neighborhood_id`) REFERENCES `neighborhood` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_neighborhood_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `neighborhood_invite`
--
ALTER TABLE `neighborhood_invite`
  ADD CONSTRAINT `fk_neighborhood_join_request_neighborhood1` FOREIGN KEY (`neighborhood_id`) REFERENCES `neighborhood` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_neighborhood_join_request_user1` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD CONSTRAINT `fk_post_has_user_post2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_has_user_user2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `post_like`
--
ALTER TABLE `post_like`
  ADD CONSTRAINT `fk_post_has_user_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `service_provider_has_service_provider_category`
--
ALTER TABLE `service_provider_has_service_provider_category`
  ADD CONSTRAINT `fk_service_provider_has_service_provider_category_service_pro1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_provider` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_service_provider_has_service_provider_category_service_pro2` FOREIGN KEY (`service_provider_category_id`) REFERENCES `service_provider_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_alert`
--
ALTER TABLE `user_alert`
  ADD CONSTRAINT `fk_alert_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alert_user2` FOREIGN KEY (`recipient_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_alert_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_alert_post_comment1` FOREIGN KEY (`post_comment_post_id`) REFERENCES `post_comment` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_block_user`
--
ALTER TABLE `user_block_user`
  ADD CONSTRAINT `fk_user_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_user_user2` FOREIGN KEY (`block_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_has_service_provider`
--
ALTER TABLE `user_has_service_provider`
  ADD CONSTRAINT `fk_user_has_service_provider_service_provider1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_provider` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_service_provider_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `fk_user_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_stats`
--
ALTER TABLE `user_stats`
  ADD CONSTRAINT `fk_user_stats_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
