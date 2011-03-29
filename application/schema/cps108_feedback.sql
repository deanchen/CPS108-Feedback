-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2011 at 08:27 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cps108_feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `id` varchar(32) NOT NULL,
  `name` varchar(128) NOT NULL,
  `data` mediumtext NOT NULL,
  `origin` varchar(6) NOT NULL,
  `target` varchar(6) NOT NULL,
  `template` varchar(128) NOT NULL,
  `date_assigned` date NOT NULL,
  `date_due` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--


-- --------------------------------------------------------

--
-- Table structure for table `form_templates`
--

CREATE TABLE IF NOT EXISTS `form_templates` (
  `name` varchar(128) NOT NULL,
  `type` enum('student','ta') NOT NULL,
  `data` mediumtext NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_templates`
--

INSERT INTO `form_templates` (`name`, `type`, `data`, `date_created`) VALUES
('Default Student Template', 'student', 'a:7:{s:8:"did_well";a:3:{s:5:"label";s:68:"What did I do well last week that I should continue doing next week?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:10:"did_poorly";a:3:{s:5:"label";s:66:"What did I do poorly last week that I should stop doing next week?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:9:"did_learn";a:3:{s:5:"label";s:63:"What did I learn this week that I should start doing next week?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:7:"pro_con";a:3:{s:5:"label";s:88:"What are the pros and cons of the the most difficult design decision you made this week?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:11:"team_review";a:3:{s:5:"label";s:64:"How did working in a team help or hinder completing the project?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:11:"team_member";a:3:{s:5:"label";s:63:"What can I do start doing next week to be a better team member?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:9:"questions";a:3:{s:5:"label";s:63:"What can I do start doing next week to be a better team member?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}}', '2011-02-28'),
('Default TA Template', 'ta', 'a:5:{s:6:"rating";a:3:{s:5:"label";s:59:"How would rate the student''s progress this week (1-5 scale)";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:20:"rating_justification";a:3:{s:5:"label";s:45:"Provide a brief justification for your rating";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:8:"did_well";a:3:{s:5:"label";s:56:"What is the student doing well that should be continued?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:10:"did_poorly";a:3:{s:5:"label";s:56:"What is the student doing poorly that should be stopped?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}s:7:"improve";a:3:{s:5:"label";s:81:"What should the student start trying to do to really improve their design skills?";s:4:"type";s:13:"form_textarea";s:10:"attributes";a:0:{}}}', '2011-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `net_id` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `type` enum('student','ta') NOT NULL,
  PRIMARY KEY (`net_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`net_id`, `name`, `email`, `phone`, `type`) VALUES
('zc17', '', '', '', 'student'),
('sdb18', '', '', '', 'ta'),
('aec26', '', '', '', 'ta'),
('sxc', '', '', '', 'ta'),
('rje5', '', '', '', 'ta'),
('de22', '', '', '', 'ta'),
('acg15', '', '', '', 'ta'),
('bsg8', '', '', '', 'ta'),
('ajk32', '', '', '', 'ta'),
('cdm26', '', '', '', 'ta'),
('cct8', '', '', '', 'ta'),
('mra13', '', '', '', 'student'),
('ahb7', '', '', '', 'student'),
('wab12', '', '', '', 'student'),
('cc249', '', '', '', 'student'),
('drc25', '', '', '', 'student'),
('dwc9', '', '', '', 'student'),
('awd7', '', '', '', 'student'),
('sgd5', '', '', '', 'student'),
('jre11', '', '', '', 'student'),
('sf79', '', '', '', 'student'),
('taf10', '', '', '', 'student'),
('jzg', '', '', '', 'student'),
('yg11', '', '', '', 'student'),
('cgh5', '', '', '', 'student'),
('cnh7', '', '', '', 'student'),
('cjj8', '', '', '', 'student'),
('mpl10', '', '', '', 'student'),
('hl69', '', '', '', 'student'),
('nck4', '', '', '', 'student'),
('awm10', '', '', '', 'student'),
('jm222', '', '', '', 'student'),
('arp25', '', '', '', 'student'),
('ams84', '', '', '', 'student'),
('djs22', '', '', '', 'student'),
('krt10', '', '', '', 'student'),
('kw86', '', '', '', 'student'),
('aw95', '', '', '', 'student'),
('yx18', '', '', '', 'student'),
('lx20', '', '', '', 'student'),
('hz41', '', '', '', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
  `student` varchar(16) NOT NULL,
  `ta` varchar(16) NOT NULL,
  PRIMARY KEY (`student`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`student`, `ta`) VALUES
('mra13', 'sdb18'),
('sgd5', 'sdb18'),
('nck4', 'sdb18'),
('cc249', 'aec26'),
('drc25', 'aec26'),
('dwc9', 'aec26'),
('hz41', 'aec26'),
('wab12', 'sxc'),
('awd7', 'sxc'),
('jre11', 'sxc'),
('tnd6', 'rje5'),
('taf10', 'rje5'),
('jzg', 'rje5'),
('yg11', 'de22'),
('cgh5', 'de22'),
('cnh7', 'de22'),
('cjj8', 'acg15'),
('mpl10', 'acg15'),
('hl69', 'acg15'),
('awm10', 'acg15'),
('ahb7', 'bsg8'),
('jm222', 'bsg8'),
('arp25', 'bsg8'),
('ams84', 'ajk32'),
('djs22', 'ajk32'),
('krt10', 'ajk32'),
('lx20', 'ajk32'),
('kw86', 'cdm26'),
('aw95', 'cdm26'),
('sf79', 'cct8'),
('yx18', 'cct8');
