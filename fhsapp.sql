-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2013 at 02:00 PM
-- Server version: 5.5.32-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fhsapp_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `date` varchar(100) NOT NULL COMMENT 'should we change this??',
  `place` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL COMMENT 'see date',
  `end_date` varchar(100) NOT NULL COMMENT 'see date',
  `subtype_id` int(10) NOT NULL COMMENT 'Go by id',
  `author` int(10) NOT NULL COMMENT 'Go by id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `date`, `place`, `time`, `start_date`, `end_date`, `subtype_id`, `author`) VALUES
(1, 'Essay due', 'You''ve got an essay due in two weeks! It counts for over 150% of your grade, so be sure to get it in! If you''re questioning the percentage, please remember that I am a English teacher, not a math teacher. Now work students!', '2013-10-31', 'Rm 242', 'Period 5', '2013-10-17', '2013-11-01', 5, 2),
(2, 'Read Chpt. 1 - 17 for the next class', 'Please remember we are going to have a very important discussion on the first few chapters of War and Peace. It is essential that you have these chapters read by the next class day.', '2013-10-28', 'Rm 242', 'Period 2', '2013-10-26', '2013-10-29', 2, 2),
(3, 'English Laser Beam Project', 'The third part in our installment about laser beams, please write a poem describing your average day as a laser beam. You will be graded harshly not only on word choice but technical accuracy. These will be presented.', '7-22-13', 'Auditorium', 'Lunch', '7-15-13', '7-23-13', 8, 2),
(4, 'Godzilla Attack', 'There will be a drill testing how prepared you are for a possible Godzilla attack. You will not be warned beforehand,and angry, poisonous Komodo Dragons will be released to simulate Godzilla children. The next person to ask "how is this English class" will be assigned a thirteen page essay. ', '2-10-14 -- 2-15-14', 'Ms. Vinger''s Room', '', '2-10-14', '2-16-14', 1, 2),
(5, '', '', '3/6/14', 'fraklin high school', '12:00', '3/6/14', '3/7/14', 0, 0),
(6, '', '', '3/6/14', 'fraklin high school', '12:00', '3/6/14', '3/7/14', 0, 0),
(7, '', '', '3/6/14', 'fraklin high school', '12:00', '3/6/14', '3/7/14', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `misc`
--

CREATE TABLE IF NOT EXISTS `misc` (
  `name` varchar(20) NOT NULL,
  `value` varchar(10000) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

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
(11, '', 2, 1, 1),
(12, '', 2, 1, 2),
(13, '', 2, 1, 3),
(14, '', 2, 1, 4),
(15, '', 2, 1, 5),
(16, '', 2, 1, 6),
(17, '', 2, 1, 7),
(18, '', 2, 1, 8);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='The teachers.' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `teacher`, `admin`, `club`, `sports`) VALUES
(1, 'fhsapp', 'e91bde1d1f1c4fbab46f3ec44a354f8b', 'pogodrake@gmail.com', 'John Q', 'Citizen', 1, 1, 1, 1),
(2, 'dvinger', '741a26da4f442a6e1096d8cd305b87a7', '', 'Dana', 'Vinger', 1, 0, 0, 0),
(3, 'ddiep', 'e91bde1d1f1c4fbab46f3ec44a354f8b', 'dustindiep0@gmail.com', 'Dustin', 'Diep', 1, 1, 1, 1),
(4, 'Generic', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Generic', 'User', 0, 1, 0, 0),
(7, 'test', 'test', 'dustindiep0@gmail.com', 'test', 'test', 1, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
