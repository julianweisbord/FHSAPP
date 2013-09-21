-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2013 at 12:28 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fhsapp`
--
CREATE DATABASE IF NOT EXISTS `fhsapp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fhsapp`;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `date` date NOT NULL COMMENT 'should we change this??',
  `location` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `start_date` date NOT NULL COMMENT 'see date',
  `end_date` date NOT NULL COMMENT 'see date',
  `author` int(10) NOT NULL COMMENT 'Go by id',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `date`, `location`, `time`, `start_date`, `end_date`, `author`, `timestamp`) VALUES
(19, 'Club info', '<p>Every Tuesday!</p>', '2013-09-24', 'Rm 273', '', '2013-09-21', '2013-09-25', 1, '2013-09-21 19:57:29'),
(20, 'Swimming!', '<p>At Mt. Scott.</p>', '2013-09-23', 'Mt. Scott', '', '2013-09-20', '2013-09-24', 1, '2013-09-21 19:58:53'),
(21, 'Stuff', '<p>Testing if one click works.</p>', '2013-09-23', '', '', '2013-09-20', '2013-09-23', 1, '2013-09-21 20:00:01'),
(17, 'Test', '<p>Testing things.</p>', '2013-09-13', 'Here', 'Now', '2013-09-12', '2013-09-14', 1, '2013-09-14 01:42:51'),
(18, 'Another Test', '<p>Stuff</p>', '2013-09-21', 'Here', 'NOW', '2013-09-20', '2013-09-22', 1, '2013-09-21 19:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `anno_subtype`
--

CREATE TABLE IF NOT EXISTS `anno_subtype` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `anno_id` int(10) NOT NULL,
  `subtype_id` int(10) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `anno_subtype`
--

INSERT INTO `anno_subtype` (`index`, `anno_id`, `subtype_id`) VALUES
(21, 17, 40),
(22, 17, 41),
(23, 17, 46),
(24, 17, 133),
(25, 17, 137),
(26, 18, 42),
(27, 18, 44),
(28, 19, 133),
(29, 20, 137),
(30, 21, 46);

-- --------------------------------------------------------

--
-- Table structure for table `example`
--

CREATE TABLE IF NOT EXISTS `example` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `text` varchar(100) NOT NULL,
  `radio` varchar(5) NOT NULL,
  `checkbox` varchar(5) NOT NULL,
  `select` varchar(10) NOT NULL,
  `textarea` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `example`
--

INSERT INTO `example` (`id`, `text`, `radio`, `checkbox`, `select`, `textarea`) VALUES
(1, 'First', 'r1', 'on', 'opt1', 'ajdqofjqiofpwjdio'),
(2, 'First', 'r1', 'on', 'opt1', 'ajdqofjqiofpwjdio');

-- --------------------------------------------------------

--
-- Table structure for table `misc`
--

CREATE TABLE IF NOT EXISTS `misc` (
  `name` varchar(20) NOT NULL,
  `value` varchar(10000) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `misc`
--

INSERT INTO `misc` (`name`, `value`, `id`) VALUES
('excluded_dates', '2013-07-15,2013-07-17', 1),
('start_date', '2013-07-15', 2),
('end_date', '2013-08-15', 3);

-- --------------------------------------------------------

--
-- Table structure for table `subtype`
--

CREATE TABLE IF NOT EXISTS `subtype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type_id` int(100) NOT NULL,
  `author_id` int(11) NOT NULL,
  `period` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `subtype`
--

INSERT INTO `subtype` (`id`, `name`, `type_id`, `author_id`, `period`) VALUES
(1, 'Test English 1-2', 2, 2, 1),
(2, 'Test English 1-2', 2, 2, 2),
(3, 'Test English 3-4', 2, 2, 3),
(4, 'Test English 3-4', 2, 2, 4),
(5, 'Test English 1-2', 2, 2, 5),
(6, 'Test English 5-6', 2, 2, 6),
(7, 'Test English 3-4', 2, 2, 7),
(8, 'Test English 3-4', 2, 2, 8),
(9, 'MESA', 3, 3, 0),
(10, 'Cross Country', 4, 3, 0),
(11, 'College, Career, and Counseling Info', 1, 1, 0),
(12, 'Important Continuing Items', 1, 1, 0),
(13, 'New/Timely Entries', 1, 1, 0),
(14, 'Library', 1, 1, 0),
(15, 'SUN News', 1, 1, 0),
(133, 'MESA', 3, 1, 0),
(137, 'Swimming', 4, 1, 0),
(40, 'Testing', 2, 1, 1),
(41, 'Test', 2, 1, 2),
(42, 'Test Period', 2, 1, 3),
(43, 'More Tests', 2, 1, 4),
(44, 'Testing Testing', 2, 1, 5),
(45, 'Test Period', 2, 1, 6),
(46, 'Still Testing', 2, 1, 7),
(47, '', 2, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'General'),
(2, 'Classes'),
(3, 'Clubs'),
(4, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `teacher` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `club` tinyint(1) NOT NULL,
  `sports` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='The teachers.' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `teacher`, `admin`, `club`, `sports`) VALUES
(1, '', 'e91bde1d1f1c4fbab46f3ec44a354f8b', '', '', '', 1, 1, 1, 1),
(2, 'dvinger', 'qwer', 'dustindiep0@gmail.com', 'Dana', 'Vinger', 1, 0, 0, 0),
(3, 'ddiep', 'e91bde1d1f1c4fbab46f3ec44a354f8b', 'dustindiep0@gmail.com', 'Dustin', 'Diep', 1, 1, 1, 1),
(4, 'dvinger2', 'qwer', 'dustindiep0@gmail.com', 'Dana', 'Vinger', 1, 1, 0, 0),
(5, 'Generic', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Generic', 'User', 1, 1, 1, 1),
(6, 'gTeacher', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Generic', 'Teacher', 1, 0, 0, 0),
(7, 'gClub', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Generic', 'Club', 0, 0, 1, 0),
(8, 'gSports', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Generic', 'Sports', 0, 0, 0, 1),
(9, 'email', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Email', 'Test', 1, 0, 0, 0),
(10, 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Test', 'Subject', 1, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
