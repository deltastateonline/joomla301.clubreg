-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 16, 2013 at 05:35 AM
-- Server version: 5.0.41
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `joomla_301`
--

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_property_sheet`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_property_sheet` (
  `property_id` int(11) NOT NULL auto_increment,
  `property_key` varchar(30) NOT NULL,
  `member_id` int(11) NOT NULL,
  `property_type` varchar(128) NOT NULL,
  `property_make` varchar(128) NOT NULL,
  `property_model` varchar(128) NOT NULL,
  `property_serial` varchar(128) NOT NULL,
  `property_checked_out` date NOT NULL,
  `property_checked_in` date NOT NULL,
  `property_notes` varchar(512) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY  (`property_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `qjogz_clubreg_property_sheet`
--