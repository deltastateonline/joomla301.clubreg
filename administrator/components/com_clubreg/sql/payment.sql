-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2012 at 11:12 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `joomla_301`
--

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_payments_setup`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_payments_setup` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `product_desc` varchar(1024) DEFAULT NULL,
  `product_amount` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `validfrom` date NOT NULL DEFAULT '0000-00-00',
  `validto` date NOT NULL DEFAULT '0000-00-00',
  `params` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
