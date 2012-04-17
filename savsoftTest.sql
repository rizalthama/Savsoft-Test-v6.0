-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2012 at 11:48 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: ``
--

-- --------------------------------------------------------

--
-- Table structure for table `questionBank`
--

CREATE TABLE IF NOT EXISTS `questionBank` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `options` text NOT NULL,
  `answer` text NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `total_question` int(5) NOT NULL,
  `correct_answer` varchar(400) NOT NULL,
  `obtained_percentage` float NOT NULL,
  `time_taken` text NOT NULL,
  `status` int(1) NOT NULL,
  `selected_answers` text NOT NULL,
  `question_ids` text NOT NULL,
  `iniTime` int(100) NOT NULL,
  `submitTime` int(100) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `subject_Name` text NOT NULL,
  `noq` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` text NOT NULL,
  `description` text NOT NULL,
  `test_time` int(11) NOT NULL,
  `group_id` text NOT NULL,
  `type` text NOT NULL,
  `amount` float NOT NULL,
  `answer_view` int(11) NOT NULL,
  `attempts` int(11) NOT NULL,
  `start_time` int(15) NOT NULL,
  `end_time` int(15) NOT NULL,
  `reqpercentage` int(11) NOT NULL,
  `random_question_no` varchar(100) NOT NULL,
  `subject_ids` varchar(100) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `country` varchar(20) NOT NULL,
  `credit` float NOT NULL,
  `status` int(1) NOT NULL,
  `gid` int(11) NOT NULL,
  `su` int(1) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `email`, `password`, `first_name`, `last_name`, `contact_no`, `address`, `country`, `credit`, `status`, `gid`, `su`) VALUES
(1, 'admin@example.com', 'fe01ce2a7fbac8fafaed7c982a04e229', 'FirstName', 'LastName', '1234567890', 'Address', 'India', 1000, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` text NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
