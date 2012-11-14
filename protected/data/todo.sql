-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2012 at 10:43 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_items`
--

DROP TABLE IF EXISTS `list_items`;
CREATE TABLE IF NOT EXISTS `list_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key of table',
  `content` text NOT NULL COMMENT 'the main todo content (what the user sees)',
  `member_id` int(11) NOT NULL COMMENT 'id of user posted the item',
  `completed` smallint(6) NOT NULL COMMENT 'defines whether item is completed (1) or not (0)',
  `deleted` smallint(6) NOT NULL COMMENT 'defines whether item is deleted (1) or not (0)',
  `created_at` datetime NOT NULL COMMENT 'date of creation',
  `updated_at` datetime NOT NULL COMMENT 'date updated',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `completed` (`completed`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `list_items`
--

INSERT INTO `list_items` (`id`, `content`, `member_id`, `completed`, `deleted`, `created_at`, `updated_at`) VALUES
(2, 'asdasdasd2', 1, 0, 1, '2012-11-13 23:25:16', '2012-11-13 23:28:48'),
(3, 'Test XSS\r\n<script>alert(''XSS'');</script>', 1, 0, 0, '2012-11-14 00:16:12', '2012-11-14 22:01:41'),
(4, 'QWEQC QW\r\nasdfasd\r\nasdas\r\n', 1, 1, 1, '2012-11-14 01:35:31', '2012-11-14 01:43:13'),
(5, 'asdasdas\r\nsdafsdf\r\n324523\r\nf', 1, 1, 1, '2012-11-14 01:40:11', '2012-11-14 01:46:06'),
(6, 'weqrqwer wqer\r\nweqr\r\nqwe\r\nr\r\nqwer\r\nqwe', 1, 1, 1, '2012-11-14 01:40:20', '0000-00-00 00:00:00'),
(7, 'hgjfhjgfghfjh', 1, 1, 0, '2012-11-14 01:45:04', '0000-00-00 00:00:00'),
(8, 'this is my first item\r\nyeahhh! 222', 1, 0, 0, '2012-11-14 21:14:13', '2012-11-14 21:28:16'),
(9, 'Call Mom ASAP!!!', 1, 1, 0, '2012-11-14 21:20:25', '2012-11-14 22:00:17'),
(10, 'Μήνυμα στα Ελληνικά', 1, 1, 0, '2012-11-14 21:43:32', '2012-11-14 22:00:42'),
(11, 'Book Air tickets to London\r\n\r\nhttp://www.airtickets.gr\r\n', 1, 1, 0, '2012-11-14 21:50:43', '2012-11-14 22:01:26'),
(12, '[Tom] do the laundry by Saturday', 2, 1, 0, '2012-11-14 21:54:09', '0000-00-00 00:00:00'),
(13, 'Finish "Brave New World" by Aldus Huxley', 2, 0, 0, '2012-11-14 21:54:51', '0000-00-00 00:00:00'),
(14, 'Test UTF-8\r\nγράφοντας Ελληνικά', 2, 0, 0, '2012-11-14 21:55:29', '0000-00-00 00:00:00'),
(15, 'test XSS attacks\r\n<script>alert(''Attack!!!'');</sript>', 2, 1, 0, '2012-11-14 21:56:30', '0000-00-00 00:00:00'),
(16, 'test injections\r\nx''; DROP TABLE members; --', 2, 1, 0, '2012-11-14 21:58:48', '2012-11-14 21:59:04'),
(17, 'test item', 1, 0, 0, '2012-11-14 22:32:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key of table',
  `username` varchar(255) NOT NULL COMMENT 'username',
  `password` varchar(255) NOT NULL COMMENT 'user''s password',
  `email` varchar(255) DEFAULT NULL COMMENT 'user''s email address',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `email`) VALUES
(1, 'dimitris', '202cb962ac59075b964b07152d234b70', NULL),
(2, 'tom', '202cb962ac59075b964b07152d234b70', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
