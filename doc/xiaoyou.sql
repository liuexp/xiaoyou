-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2012 at 11:52 AM
-- Server version: 5.5.25a-log
-- PHP Version: 5.4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xiaoyou`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned DEFAULT NULL,
  `realname` varchar(200) NOT NULL,
  `type` enum('register','new profile','update profile','update avatar','new contact','new experience','new honor','new paper','update contact','update experience','update honor','update paper','invite','new tweet') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `priority` int(11) NOT NULL,
  `type` enum('news','post','culture','infrastructure','halloffame') NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `article_comments`
--

DROP TABLE IF EXISTS `article_comments`;
CREATE TABLE IF NOT EXISTS `article_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned NOT NULL,
  `type` enum('douban','email','facebook','qq','renren','twitter','weibo','tele','mobile','msn') NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
CREATE TABLE IF NOT EXISTS `experiences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned NOT NULL,
  `start_year` char(4) NOT NULL,
  `start_month` int(11) DEFAULT NULL,
  `end_year` char(4) DEFAULT NULL,
  `end_month` int(11) DEFAULT NULL,
  `type` enum('bachelor','master','doctor','postdoc','work') NOT NULL,
  `major` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `mentor` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `honors`
--

DROP TABLE IF EXISTS `honors`;
CREATE TABLE IF NOT EXISTS `honors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned NOT NULL,
  `year` char(4) NOT NULL,
  `month` int(11) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

DROP TABLE IF EXISTS `invitations`;
CREATE TABLE IF NOT EXISTS `invitations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `invitecode` varchar(100) NOT NULL,
  `is_mail_sent` tinyint(1) NOT NULL,
  `user_registered` tinyint(1) NOT NULL,
  `inviter_profile_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `inviter_profile_id` (`inviter_profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

DROP TABLE IF EXISTS `mails`;
CREATE TABLE IF NOT EXISTS `mails` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender` bigint(20) unsigned NOT NULL,
  `receiver` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `parent` bigint(20) NOT NULL DEFAULT '-1',
  `read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

DROP TABLE IF EXISTS `msgs`;
CREATE TABLE IF NOT EXISTS `msgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` bigint(20) unsigned NOT NULL,
  `receiver` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

DROP TABLE IF EXISTS `names`;
CREATE TABLE IF NOT EXISTS `names` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `start_year` char(4) DEFAULT NULL,
  `class_number` varchar(100) DEFAULT NULL,
  `student_number` varchar(100) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `registered` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `start_year` (`start_year`),
  KEY `class_number` (`class_number`),
  KEY `realname` (`realname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

DROP TABLE IF EXISTS `papers`;
CREATE TABLE IF NOT EXISTS `papers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `authors` varchar(200) NOT NULL,
  `publish_place` varchar(200) NOT NULL,
  `publish_year` char(4) NOT NULL,
  `is_first_author` tinyint(1) NOT NULL,
  `is_at_sjtu` tinyint(1) NOT NULL,
  `is_best_paper` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login_name` varchar(100) NOT NULL,
  `display_name` varchar(20) NOT NULL,
  `student_number` varchar(100) DEFAULT NULL,
  `start_year` char(4) NOT NULL,
  `class_number` varchar(4) DEFAULT NULL,
  `birthday` date NOT NULL,
  `gender` char(1) NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `post_number` varchar(200) DEFAULT NULL,
  `advices` text,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `subscription` text,
  `privacy_control` int(11) NOT NULL DEFAULT '0',
  `field` smallint(6) DEFAULT NULL,
  `institute` varchar(200) DEFAULT NULL,
  `position` varchar(200) DEFAULT NULL,
  `major` varchar(200) DEFAULT NULL,
  `mentor` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_name` (`login_name`),
  UNIQUE KEY `student_number` (`student_number`),
  KEY `start_year` (`start_year`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
CREATE TABLE IF NOT EXISTS `tweets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tweet_comments`
--

DROP TABLE IF EXISTS `tweet_comments`;
CREATE TABLE IF NOT EXISTS `tweet_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tweet_id` bigint(20) unsigned NOT NULL,
  `profile_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`),
  KEY `tweet_id` (`tweet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article_comments`
--
ALTER TABLE `article_comments`
  ADD CONSTRAINT `article_comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_comments_ibfk_2` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `honors`
--
ALTER TABLE `honors`
  ADD CONSTRAINT `honors_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `papers`
--
ALTER TABLE `papers`
  ADD CONSTRAINT `papers_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tweet_comments`
--
ALTER TABLE `tweet_comments`
  ADD CONSTRAINT `tweet_comments_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tweet_comments_ibfk_2` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
