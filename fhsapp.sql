-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2013 at 11:15 PM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `date`, `location`, `time`, `start_date`, `end_date`, `author`, `timestamp`) VALUES
(33, 'blablablabla', '<p>ajdslfjadlf;dsakf;ldsajkls</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-05', 1, '2013-11-02 21:52:00'),
(28, 'More dummies', '<p>Dummy data.</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-04', 1, '2013-11-02 20:24:05'),
(30, 'Whee!', '<p>DUMMY</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-05', 1, '2013-11-02 20:24:45'),
(31, 'Dummy Dummy', '<p>blablabla</p>', '0000-00-00', '', '', '2013-11-07', '2013-11-19', 1, '2013-11-02 21:51:30'),
(32, 'asdf', '<p>asdfasdfasdf</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-05', 1, '2013-11-02 21:51:41'),
(26, 'Main Tester Change', '<p>This shall be used for testing everything. Right now, testing the edit functionality in the checkbox. Start with checking everything. For change, only check the first one. 1</p>', '2013-10-03', '', '', '2013-10-11', '2013-10-15', 1, '2013-10-13 19:57:23'),
(34, 'Something or other', '<p>asfsfefeffdasf</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-05', 1, '2013-11-02 21:52:16'),
(35, 'Filler', '<p>fliilifnakdfl;ak</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-04', 1, '2013-11-02 21:52:31'),
(36, 'memivvidoajf', '<p>cheese</p>', '0000-00-00', '', '', '2013-11-08', '2013-11-13', 1, '2013-11-02 21:52:46'),
(37, 'meep', '<p>blooooooop</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-13', 1, '2013-11-02 21:53:02'),
(38, 'cmon', '<p>stufstufstufstf</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-06', 1, '2013-11-02 21:53:20'),
(39, 'chesse peleel', '<p>fire</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-05', 1, '2013-11-02 21:53:37'),
(40, 'msmsmsmsmsmsmmsms', '<p>lejofpeifopef</p>', '0000-00-00', '', '', '2013-11-01', '2013-11-06', 1, '2013-11-02 21:53:50'),
(42, 'General Test', '<p>Let''s see what happens.</p>', '2013-11-01', '', '', '2013-11-09', '2013-11-12', 1, '2013-11-11 21:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `anno_subtype`
--

CREATE TABLE IF NOT EXISTS `anno_subtype` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `anno_id` int(10) NOT NULL,
  `subtype_id` int(10) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=194 ;

--
-- Dumping data for table `anno_subtype`
--

INSERT INTO `anno_subtype` (`index`, `anno_id`, `subtype_id`) VALUES
(129, 26, 40),
(134, 28, 42),
(135, 28, 46),
(136, 28, 133),
(137, 29, 40),
(138, 29, 43),
(139, 29, 46),
(140, 29, 133),
(141, 30, 41),
(142, 30, 42),
(143, 30, 44),
(144, 30, 133),
(145, 30, 137),
(146, 27, 40),
(147, 27, 41),
(148, 27, 43),
(149, 27, 45),
(150, 27, 137),
(151, 31, 40),
(152, 31, 43),
(153, 31, 46),
(154, 32, 41),
(155, 32, 44),
(156, 33, 41),
(157, 33, 43),
(158, 33, 45),
(159, 34, 40),
(160, 34, 41),
(161, 34, 42),
(162, 34, 43),
(163, 34, 44),
(164, 34, 46),
(165, 35, 40),
(166, 35, 42),
(167, 35, 44),
(168, 35, 46),
(169, 36, 40),
(170, 36, 42),
(171, 36, 46),
(172, 36, 137),
(173, 37, 42),
(174, 37, 44),
(175, 38, 40),
(176, 38, 41),
(177, 38, 43),
(178, 38, 46),
(179, 39, 40),
(180, 39, 43),
(181, 39, 46),
(182, 40, 40),
(183, 40, 41),
(184, 40, 44),
(185, 41, 40),
(186, 41, 42),
(187, 41, 45),
(188, 41, 133),
(189, 42, 11),
(190, 42, 12),
(191, 42, 13),
(192, 42, 14),
(193, 42, 15);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `misc`
--

INSERT INTO `misc` (`name`, `value`, `id`) VALUES
('excluded_dates', '2013-07-15,2013-07-17', 1),
('start_date', '2013-07-15', 2),
('end_date', '2013-08-15', 3),
('SurveyUrl', 'http://dialog.fuseinsight.com/topic/start/franklin_app_Dw', 4);

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
(1, 'fhsapp', 'e91bde1d1f1c4fbab46f3ec44a354f8b', 'dustindiep0@gmail.com', 'Supreme', 'Admin', 1, 1, 1, 1),
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
