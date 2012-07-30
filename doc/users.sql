-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2012 at 11:54 AM
-- Server version: 5.5.25a-log
-- PHP Version: 5.4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `pass` varchar(80) NOT NULL,
  `salt` varchar(80) NOT NULL,
  `iter` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL,
  `display_name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `salt`, `iter`, `status`, `email`, `display_name`, `created_at`, `updated_at`) VALUES(1, 'root', '33010f27c43b3faeb40d21f1dee03fd3', 'ab531deb151615fead8516980b5c9874', 14, 2, 'asdf@asdf.com', 'asdf', '2012-06-25 23:52:33', '2012-06-25 23:52:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
