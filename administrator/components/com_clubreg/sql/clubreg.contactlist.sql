-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2016 at 08:13 PM
-- Server version: 5.6.21-log
-- PHP Version: 5.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `joomla_301`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_contactlist`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_contactlist` (
`contactlist_id` int(11) NOT NULL,
  `contactlist_key` varchar(30) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `contactlist_email` varchar(64) DEFAULT NULL,
  `contactlist_phoneno` varchar(64) DEFAULT NULL,
  `contactlist_fname` varchar(64) DEFAULT NULL,
  `contactlist_sname` varchar(64) DEFAULT NULL,
  `contactlist_notify` int(11) DEFAULT NULL,
  `contactlist_status` int(11) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `#__clubreg_contactlist`
--
ALTER TABLE `#__clubreg_contactlist`
 ADD PRIMARY KEY (`contactlist_id`), ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `#__clubreg_contactlist`
--
ALTER TABLE `#__clubreg_contactlist`
MODIFY `contactlist_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;