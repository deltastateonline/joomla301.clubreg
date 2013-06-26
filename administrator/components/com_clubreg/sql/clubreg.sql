-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2012 at 06:06 PM
-- Server version: 5.0.41
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `joomla_15_22`
--

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_contact_details`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_contact_details` (
  `member_id` int(11) NOT NULL,
  `contact_detail` varchar(255) NOT NULL,
  `contact_value` text NOT NULL,
  PRIMARY KEY  (`member_id`,`contact_detail`),
  KEY `contact_detail` (`contact_detail`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contact Details';

--
-- Dumping data for table `qjogz_clubreg_contact_details`
--

INSERT INTO `qjogz_clubreg_contact_details` (`member_id`, `contact_detail`, `contact_value`) VALUES
(10, 'em_address', ''),
(10, 'em_emailaddress', ''),
(10, 'em_givenname', ''),
(10, 'em_medical', ''),
(10, 'em_mobile', ''),
(10, 'em_phoneno', ''),
(10, 'em_postcode', ''),
(10, 'em_suburb', ''),
(10, 'em_surname', ''),
(10, 'extra_archived', 'no'),
(10, 'extra_directory_listing_text', ''),
(10, 'extra_joining_date', '16/06/2009'),
(10, 'extra_membership_enabled', 'yes'),
(10, 'extra_member_since_month', '2'),
(10, 'extra_member_since_year', ''),
(10, 'extra_radio_stations', 'Sea FM'),
(10, 'extra_swimmers_school', 'Mermaid Beach High School'),
(10, 'extra_tshirt_sizes', 'small'),
(16, 'em_address', ''),
(16, 'em_emailaddress', ''),
(16, 'em_givenname', ''),
(16, 'em_medical', ''),
(16, 'em_mobile', ''),
(16, 'em_phoneno', ''),
(16, 'em_postcode', ''),
(16, 'em_suburb', ''),
(16, 'em_surname', ''),
(16, 'extra_archived', 'no'),
(16, 'extra_directory_listing_text', ''),
(16, 'extra_joining_date', '29/06/2012'),
(16, 'extra_membership_enabled', 'yes'),
(16, 'extra_member_since_month', '12'),
(16, 'extra_member_since_year', '2011'),
(16, 'extra_radio_stations', 'B105'),
(16, 'extra_swimmers_school', 'Peckham'),
(16, 'extra_tshirt_sizes', 'size 7'),
(23, 'em_address', ''),
(23, 'em_emailaddress', ''),
(23, 'em_givenname', ''),
(23, 'em_medical', ''),
(23, 'em_mobile', ''),
(23, 'em_phoneno', ''),
(23, 'em_postcode', ''),
(23, 'em_suburb', ''),
(23, 'em_surname', ''),
(23, 'extra_archived', 'no'),
(23, 'extra_directory_listing_text', ''),
(23, 'extra_joining_date', '27/06/2012'),
(23, 'extra_membership_enabled', 'yes'),
(23, 'extra_member_since_month', '2'),
(23, 'extra_member_since_year', '1988'),
(23, 'extra_radio_stations', '1Xtra'),
(23, 'extra_swimmers_school', 'University of Camden'),
(23, 'extra_tshirt_sizes', 'large'),
(23, 'next_address', ''),
(23, 'next_emailaddress', ''),
(23, 'next_givenname', ''),
(23, 'next_mobile', ''),
(23, 'next_phoneno', ''),
(23, 'next_postcode', ''),
(23, 'next_suburb', ''),
(23, 'next_surname', ''),
(24, 'em_address', 'long river'),
(24, 'em_emailaddress', 'timmy@bbc.co.uk'),
(24, 'em_givenname', 'land'),
(24, 'em_medical', 'nuts\r\nmushrooms'),
(24, 'em_mobile', '923333'),
(24, 'em_phoneno', '0343443'),
(24, 'em_postcode', 'sun'),
(24, 'em_suburb', 'green mile'),
(24, 'em_surname', 'timber'),
(24, 'extra_archived', 'no'),
(24, 'extra_directory_listing_text', ''),
(24, 'extra_joining_date', '29/06/2012'),
(24, 'extra_membership_enabled', 'no'),
(24, 'extra_member_since_month', '4'),
(24, 'extra_member_since_year', '2012'),
(24, 'extra_radio_stations', 'Captial Radio'),
(24, 'extra_swimmers_school', 'University of Hull'),
(24, 'extra_tshirt_sizes', 'extra large'),
(24, 'next_address', 'some where'),
(24, 'next_emailaddress', 'today@hotmail.com'),
(24, 'next_givenname', 'Elliot'),
(24, 'next_mobile', '123093443'),
(24, 'next_phoneno', '09343434'),
(24, 'next_postcode', '50945'),
(24, 'next_suburb', 'hamptons'),
(24, 'next_surname', 'Kissy'),
(32, 'em_address', ''),
(32, 'em_emailaddress', ''),
(32, 'em_givenname', ''),
(32, 'em_medical', ''),
(32, 'em_mobile', ''),
(32, 'em_phoneno', ''),
(32, 'em_postcode', ''),
(32, 'em_suburb', ''),
(32, 'em_surname', ''),
(32, 'extra_archived', 'no'),
(32, 'extra_directory_listing_text', ''),
(32, 'extra_joining_date', '29/06/2012'),
(32, 'extra_membership_enabled', 'yes'),
(32, 'extra_member_since_month', '11'),
(32, 'extra_member_since_year', '1978'),
(32, 'extra_radio_stations', 'BBC Radio 1'),
(32, 'extra_swimmers_school', 'Kisser School'),
(32, 'extra_tshirt_sizes', 'size 6'),
(33, 'extra_archived', 'no'),
(33, 'extra_directory_listing_text', 'I like ben 10, Bugs Bunny, Batman, Superman'),
(33, 'extra_joining_date', '13/06/2012'),
(33, 'extra_membership_enabled', 'yes'),
(33, 'extra_member_since_month', '1'),
(33, 'extra_member_since_year', '1908'),
(33, 'extra_radio_stations', 'Sea FM'),
(33, 'extra_swimmers_school', 'Wombats state school'),
(33, 'extra_tshirt_sizes', 'size 6'),
(38, 'em_address', ''),
(38, 'em_emailaddress', ''),
(38, 'em_givenname', ''),
(38, 'em_medical', ''),
(38, 'em_mobile', ''),
(38, 'em_phoneno', ''),
(38, 'em_postcode', ''),
(38, 'em_suburb', ''),
(38, 'em_surname', ''),
(38, 'extra_archived', 'yes'),
(38, 'extra_directory_listing_text', ''),
(38, 'extra_joining_date', '26/06/2012'),
(38, 'extra_membership_enabled', 'no'),
(38, 'extra_member_since_month', '2'),
(38, 'extra_member_since_year', '2012'),
(38, 'extra_radio_stations', 'Sea FM'),
(38, 'extra_swimmers_school', 'Georger state school'),
(38, 'extra_tshirt_sizes', 'size 7'),
(43, 'em_address', ''),
(43, 'em_emailaddress', ''),
(43, 'em_givenname', ''),
(43, 'em_medical', ''),
(43, 'em_mobile', ''),
(43, 'em_phoneno', ''),
(43, 'em_postcode', ''),
(43, 'em_suburb', ''),
(43, 'em_surname', ''),
(43, 'extra_archived', 'yes'),
(43, 'extra_directory_listing_text', 'Cat steven'),
(43, 'extra_joining_date', '06/06/2012'),
(43, 'extra_membership_enabled', 'no'),
(43, 'extra_member_since_month', '9'),
(43, 'extra_member_since_year', '1987'),
(43, 'extra_swimmers_school', 'coomera spring state school'),
(43, 'extra_tshirt_sizes', 'small'),
(44, 'extra_archived', 'no'),
(44, 'extra_directory_listing_text', 'Sing for tomorrow.\r\nPlan B'),
(44, 'extra_joining_date', '02/02/2001'),
(44, 'extra_membership_enabled', 'no'),
(44, 'extra_member_since_month', '2'),
(44, 'extra_member_since_year', '2001'),
(44, 'extra_swimmers_school', 'Coomera Spring State School'),
(44, 'extra_tshirt_sizes', 'size 6'),
(45, 'em_address', 'Hans Street'),
(45, 'em_emailaddress', 'simon@hotmail.com.au'),
(45, 'em_givenname', 'West'),
(45, 'em_medical', 'Peanuts'),
(45, 'em_mobile', '0755023845'),
(45, 'em_phoneno', '043423222'),
(45, 'em_postcode', '43023'),
(45, 'em_suburb', 'Tivoli'),
(45, 'em_surname', 'Simon'),
(45, 'extra_archived', 'no'),
(45, 'extra_directory_listing_text', 'what is the matter h''s'),
(45, 'extra_membership_enabled', 'yes'),
(45, 'extra_member_since_month', '2'),
(45, 'extra_member_since_year', '1976'),
(45, 'extra_swimmers_school', 'maimi high school'),
(45, 'extra_tshirt_sizes', 'size 6'),
(47, 'em_address', ''),
(47, 'em_emailaddress', ''),
(47, 'em_givenname', ''),
(47, 'em_medical', ''),
(47, 'em_mobile', ''),
(47, 'em_phoneno', ''),
(47, 'em_postcode', ''),
(47, 'em_suburb', ''),
(47, 'em_surname', ''),
(47, 'extra_archived', 'yes'),
(47, 'extra_directory_listing_text', ''),
(47, 'extra_joining_date', '27/06/2012'),
(47, 'extra_membership_enabled', 'no'),
(47, 'extra_member_since_month', '-1'),
(47, 'extra_member_since_year', ''),
(47, 'extra_radio_stations', 'LBC'),
(47, 'extra_swimmers_school', 'Hicham High'),
(47, 'extra_tshirt_sizes', 'size 7'),
(48, 'em_address', ''),
(48, 'em_emailaddress', ''),
(48, 'em_givenname', ''),
(48, 'em_medical', ''),
(48, 'em_mobile', ''),
(48, 'em_phoneno', ''),
(48, 'em_postcode', ''),
(48, 'em_suburb', ''),
(48, 'em_surname', ''),
(48, 'extra_archived', 'yes'),
(48, 'extra_directory_listing_text', ''),
(48, 'extra_joining_date', '13/06/2012'),
(48, 'extra_membership_enabled', 'no'),
(48, 'extra_member_since_month', '7'),
(48, 'extra_member_since_year', '1987'),
(48, 'extra_radio_stations', 'Sea FM'),
(48, 'extra_swimmers_school', 'white school for boys'),
(48, 'extra_tshirt_sizes', 'small'),
(49, 'em_address', 'chicago'),
(49, 'em_emailaddress', 'shola@hotmail.com'),
(49, 'em_givenname', 'armer'),
(49, 'em_medical', 'none'),
(49, 'em_mobile', ''),
(49, 'em_phoneno', '945555'),
(49, 'em_postcode', 'action'),
(49, 'em_suburb', 'seatelle'),
(49, 'em_surname', 'sholah'),
(50, 'em_address', ''),
(50, 'em_emailaddress', ''),
(50, 'em_givenname', ''),
(50, 'em_medical', ''),
(50, 'em_mobile', ''),
(50, 'em_phoneno', ''),
(50, 'em_postcode', ''),
(50, 'em_suburb', ''),
(50, 'em_surname', ''),
(50, 'extra_archived', 'yes'),
(50, 'extra_directory_listing_text', ''),
(50, 'extra_joining_date', '19/06/2012'),
(50, 'extra_membership_enabled', 'no'),
(50, 'extra_member_since_month', '3'),
(50, 'extra_member_since_year', ''),
(50, 'extra_swimmers_school', ''),
(50, 'extra_tshirt_sizes', 'size 7'),
(50, 'next_address', ''),
(50, 'next_emailaddress', ''),
(50, 'next_givenname', ''),
(50, 'next_mobile', ''),
(50, 'next_phoneno', ''),
(50, 'next_postcode', ''),
(50, 'next_suburb', ''),
(50, 'next_surname', '');

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_details_audit`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_details_audit` (
  `id` int(11) NOT NULL auto_increment,
  `primary_id` int(11) NOT NULL,
  `short_desc` varchar(30) NOT NULL,
  `audit_details` text NOT NULL,
  `created_date` date NOT NULL,
  `created_time` time NOT NULL,
  `createdby` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `primary_id` (`primary_id`),
  KEY `primary_id_2` (`primary_id`,`short_desc`),
  KEY `primary_id_3` (`primary_id`,`created_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=305 ;

--
-- Dumping data for table `qjogz_clubreg_details_audit`
--

INSERT INTO `qjogz_clubreg_details_audit` (`id`, `primary_id`, `short_desc`, `audit_details`, `created_date`, `created_time`, `createdby`) VALUES
(1, 24, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"24";s:7:"surname";s:7:"Brandis";s:9:"givenname";s:4:"Paul";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:1:"1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2011-11-14', '06:54:05', 62),
(2, 26, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"26";s:7:"surname";s:7:"Natalie";s:9:"givenname";s:4:"Barr";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:18:"nate@yahoo7.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:2:"15";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";N;s:10:"created_by";N;s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2011-11-15', '06:48:48', 62),
(3, 27, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"27";s:7:"surname";s:4:"Niel";s:9:"givenname";s:5:"Henry";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:18:"niel@yahoo7.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:2:"15";s:8:"as_above";N;s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-15 06:53:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2011-11-17', '07:15:58', 62),
(4, 27, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"27";s:7:"surname";s:4:"Niel";s:9:"givenname";s:5:"Henry";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:18:"niel@yahoo7.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:2:"15";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-15 06:53:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2011-11-18', '05:14:13', 62),
(5, 27, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"27";s:7:"surname";s:4:"Niel";s:9:"givenname";s:5:"Henry";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:18:"niel@yahoo7.com.au";s:9:"send_news";s:2:"-1";s:3:"dob";N;s:5:"group";s:2:"15";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-15 06:53:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2011-11-18', '05:17:50', 62),
(6, 18, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"18";s:7:"surname";s:8:"Victoria";s:9:"givenname";s:0:"";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"3";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"15";}', '2011-11-19', '06:41:13', 62),
(7, 18, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"18";s:7:"surname";s:8:"Victoria";s:9:"givenname";s:7:"laidlaw";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2011-05-19";s:5:"group";s:1:"3";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"15";}', '2011-11-19', '06:42:14', 62),
(8, 15, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"15";s:7:"surname";s:7:"Brenden";s:9:"givenname";s:7:"Laidlaw";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:22:"brenden@hotmail.com.au";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"12";}', '2011-11-19', '07:19:57', 62),
(9, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:31:29', 62),
(10, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:31:37', 62),
(11, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"-1";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:37:06', 62),
(12, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"-1";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:37:18', 62),
(13, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:39:08', 62),
(14, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:39:40', 62),
(15, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"-1";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:39:50', 62),
(16, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:42:42', 62),
(17, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"-1";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:44:07', 62),
(18, 31, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"-1";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-11-25', '07:44:13', 62),
(19, 6, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:1:"6";s:7:"surname";s:4:"mike";s:9:"givenname";s:6:"andrew";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:16:"mike@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"20";}', '2011-11-30', '06:19:38', 62),
(20, 9, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:1:"9";s:7:"surname";s:8:"Agbagara";s:9:"givenname";s:7:"Omokhoa";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:21:"omokhoa@insurtech.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:1:"1";}', '2011-11-30', '06:20:23', 62),
(21, 30, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"30";s:7:"surname";s:8:"Agbagara";s:9:"givenname";s:3:"Ese";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-10-28";s:5:"group";s:1:"3";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-16 06:04:04";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-02', '08:12:41', 62),
(22, 19, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"19";s:7:"surname";s:4:"mike";s:9:"givenname";s:6:"andrew";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:16:"mike@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"23";}', '2011-12-02', '08:51:13', 62),
(23, 6, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:1:"6";s:7:"surname";s:4:"mike";s:9:"givenname";s:6:"andrew";s:6:"mobile";s:0:"";s:7:"address";s:17:"Ray White Complex";s:6:"suburb";s:8:"Labrador";s:8:"postcode";s:4:"4215";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:16:"mike@hotmail.com";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"20";}', '2011-12-02', '08:51:33', 62),
(24, 12, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"12";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Nicky";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:17:"nicky@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:1:"5";}', '2011-12-02', '08:52:03', 62),
(25, 27, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"27";s:7:"surname";s:4:"Niel";s:9:"givenname";s:5:"Henry";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:18:"niel@yahoo7.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:2:"15";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-15 06:53:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2011-12-02', '08:54:22', 62),
(26, 10, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"10";s:7:"surname";s:9:"Agbagbara";s:9:"givenname";s:6:"Leyton";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"3";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"2";}', '2011-12-03', '05:39:37', 62),
(27, 10, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"10";s:7:"surname";s:9:"Agbagbara";s:9:"givenname";s:6:"Leyton";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"3";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"2";}', '2011-12-03', '05:40:08', 62),
(28, 10, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"10";s:7:"surname";s:9:"Agbagbara";s:9:"givenname";s:6:"Leyton";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"3";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"2";}', '2011-12-03', '05:40:32', 62),
(29, 10, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"10";s:7:"surname";s:9:"Agbagbara";s:9:"givenname";s:6:"Leyton";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"3";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"2";}', '2011-12-03', '05:41:44', 62),
(30, 13, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"13";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:7:"Jasmine";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"6";}', '2011-12-03', '05:42:20', 62),
(31, 11, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"11";s:7:"surname";s:9:"Agbagbara";s:9:"givenname";s:5:"Dylan";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"3";}', '2011-12-06', '06:39:52', 62),
(32, 11, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"11";s:7:"surname";s:9:"Agbagbara";s:9:"givenname";s:5:"Dylan";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"3";}', '2011-12-06', '06:40:33', 62),
(33, 11, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"11";s:7:"surname";s:9:"Agbagbara";s:9:"givenname";s:5:"Dylan";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2009";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"3";}', '2011-12-06', '06:41:50', 62),
(34, 27, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"27";s:7:"surname";s:4:"Niel";s:9:"givenname";s:5:"Henry";s:6:"mobile";s:0:"";s:7:"address";s:10:"West Point";s:6:"suburb";s:11:"Island Road";s:8:"postcode";s:4:"3022";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:18:"niel@yahoo7.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:2:"15";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-15 06:53:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2011-12-06', '06:43:40', 62),
(35, 27, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"27";s:7:"surname";s:4:"Niel";s:9:"givenname";s:5:"Henry";s:6:"mobile";s:0:"";s:7:"address";s:10:"West Point";s:6:"suburb";s:11:"Island Road";s:8:"postcode";s:4:"3022";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:18:"niel@yahoo7.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:2:"15";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-15 06:53:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2006";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2011-12-07', '08:21:22', 62),
(36, 15, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"15";s:7:"surname";s:7:"Brenden";s:9:"givenname";s:7:"Laidlaw";s:6:"mobile";s:8:"09343434";s:7:"address";s:16:"Helensvale Place";s:6:"suburb";s:10:"Helensvale";s:8:"postcode";s:4:"4215";s:7:"phoneno";s:9:"043934322";s:12:"emailaddress";s:22:"brenden@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"12";}', '2011-12-07', '09:05:48', 62),
(37, 15, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"15";s:7:"surname";s:7:"Brenden";s:9:"givenname";s:7:"Laidlaw";s:6:"mobile";s:8:"09343434";s:7:"address";s:16:"Helensvale Place";s:6:"suburb";s:10:"Helensvale";s:8:"postcode";s:4:"4214";s:7:"phoneno";s:9:"043934322";s:12:"emailaddress";s:22:"brenden@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"12";}', '2011-12-07', '09:07:19', 62),
(38, 12, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"12";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Nicky";s:6:"mobile";s:0:"";s:7:"address";s:15:"Preston Cresent";s:6:"suburb";s:7:"Coomera";s:8:"postcode";s:4:"4209";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:17:"nicky@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:1:"5";}', '2011-12-07', '09:17:12', 62),
(39, 12, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"12";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Nicky";s:6:"mobile";s:0:"";s:7:"address";s:15:"Preston Cresent";s:6:"suburb";s:7:"Coomera";s:8:"postcode";s:4:"4209";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:17:"nicky@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:1:"5";}', '2011-12-07', '09:35:59', 62),
(40, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '10:11:01', 62),
(41, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '10:11:20', 62),
(42, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '10:50:06', 62),
(43, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '10:50:16', 62),
(44, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '11:05:22', 62),
(45, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '11:05:43', 62),
(46, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '11:49:11', 62),
(47, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '11:49:33', 62),
(48, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '11:49:55', 62),
(49, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '11:54:07', 62),
(50, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '11:58:19', 62),
(51, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '12:03:05', 62),
(52, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '12:03:18', 62),
(53, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '12:03:44', 62),
(54, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '12:04:18', 62),
(55, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '12:05:04', 62),
(56, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '12:05:22', 62),
(57, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-07', '12:12:00', 62),
(58, 37, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"37";s:7:"surname";s:5:"James";s:9:"givenname";s:4:"Main";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2009-12-07";s:5:"group";s:1:"1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"28";}', '2011-12-07', '12:12:00', 62),
(59, 38, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"38";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:1:"3";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2011-12-07', '12:12:00', 62),
(60, 43, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"43";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"May";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2007";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-07', '12:12:00', 62),
(61, 34, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"34";s:7:"surname";s:6:"Wretch";s:9:"givenname";s:10:"Thirty Two";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-03 05:44:15";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-10', '13:39:44', 62),
(62, 35, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"35";s:7:"surname";s:8:"Chipmunk";s:9:"givenname";s:3:"Jam";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-03 05:44:43";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-10', '14:19:31', 62),
(63, 35, 'updated junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"35";s:7:"surname";s:8:"Chipmunk";s:9:"givenname";s:3:"Jam";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-03 05:44:43";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-10', '14:40:26', 62),
(64, 2, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"2";s:9:"member_id";s:2:"44";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:5:"90888";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-11";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:12:"some clothes";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-11 21:37:25";s:10:"created_by";s:2:"62";}', '2011-12-11', '22:30:43', 62),
(65, 3, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"3";s:9:"member_id";s:2:"44";s:14:"payment_method";s:4:"cash";s:19:"payment_transact_no";s:7:"8934-90";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-11";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:14:"boots - Size 9";s:14:"payment_amount";s:4:"5000";s:7:"created";s:19:"2011-12-11 22:13:35";s:10:"created_by";s:2:"62";}', '2011-12-11', '22:35:02', 62),
(66, 3, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"3";s:9:"member_id";s:2:"44";s:14:"payment_method";s:4:"cash";s:19:"payment_transact_no";s:7:"8934-90";s:14:"payment_status";s:7:"checked";s:12:"payment_date";s:10:"2011-12-11";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:14:"boots - Size 9";s:14:"payment_amount";s:4:"5000";s:7:"created";s:19:"2011-12-11 22:13:35";s:10:"created_by";s:2:"62";}', '2011-12-11', '22:36:18', 62),
(67, 2, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"2";s:9:"member_id";s:2:"44";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:5:"90888";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-11";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:12:"some clothes";s:14:"payment_amount";s:5:"12400";s:7:"created";s:19:"2011-12-11 21:37:25";s:10:"created_by";s:2:"62";}', '2011-12-11', '22:42:33', 62),
(68, 2, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"2";s:9:"member_id";s:2:"44";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:5:"90888";s:14:"payment_status";s:7:"checked";s:12:"payment_date";s:10:"2011-12-11";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:12:"some clothes";s:14:"payment_amount";s:5:"12400";s:7:"created";s:19:"2011-12-11 21:37:25";s:10:"created_by";s:2:"62";}', '2011-12-11', '22:47:48', 62),
(69, 3, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"3";s:9:"member_id";s:2:"44";s:14:"payment_method";s:4:"cash";s:19:"payment_transact_no";s:7:"8934-90";s:14:"payment_status";s:7:"checked";s:12:"payment_date";s:10:"2011-12-11";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:15:"boots - Size 91";s:14:"payment_amount";s:4:"5000";s:7:"created";s:19:"2011-12-11 22:13:35";s:10:"created_by";s:2:"62";}', '2011-12-11', '22:52:09', 62),
(70, 2, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"2";s:9:"member_id";s:2:"44";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:5:"90888";s:14:"payment_status";s:7:"checked";s:12:"payment_date";s:10:"2011-12-11";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:12:"some clothes";s:14:"payment_amount";s:5:"12400";s:7:"created";s:19:"2011-12-11 21:37:25";s:10:"created_by";s:2:"62";}', '2011-12-11', '22:52:41', 62),
(71, 3, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"3";s:9:"member_id";s:2:"44";s:14:"payment_method";s:4:"cash";s:19:"payment_transact_no";s:7:"8934-90";s:14:"payment_status";s:7:"checked";s:12:"payment_date";s:10:"2011-12-11";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:15:"boots - Size 91";s:14:"payment_amount";s:4:"5000";s:7:"created";s:19:"2011-12-11 22:13:35";s:10:"created_by";s:2:"62";}', '2011-12-11', '22:52:53', 62),
(72, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"checked";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:03:26', 62),
(73, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"checked";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:06:40', 62),
(74, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:07:28', 62),
(75, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-01";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:13:04', 62),
(76, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:14:37', 62),
(77, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:15:21', 62);
INSERT INTO `qjogz_clubreg_details_audit` (`id`, `primary_id`, `short_desc`, `audit_details`, `created_date`, `created_time`, `createdby`) VALUES
(78, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:20:09', 62),
(79, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:23:56', 62),
(80, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:28:06', 62),
(81, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:28:45', 62),
(82, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:29:10', 62),
(83, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12000";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:30:54', 62),
(84, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12100";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:32:29', 62),
(85, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12100";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:33:07', 62),
(86, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12100";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:35:04', 62),
(87, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12100";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:35:26', 62),
(88, 4, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"4";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:4:"9876";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:16:"Nice looking kid";s:14:"payment_amount";s:5:"12500";s:7:"created";s:19:"2011-12-12 05:57:09";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:35:39', 62),
(89, 5, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"5";s:9:"member_id";s:2:"34";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:5:"89777";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-12";s:12:"payment_desc";s:3:"kit";s:13:"payment_notes";s:0:"";s:14:"payment_amount";s:4:"6300";s:7:"created";s:19:"2011-12-12 06:35:56";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:36:10', 62),
(90, 6, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:1:"6";s:9:"member_id";s:2:"37";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:5:"65888";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-01";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:0:"";s:14:"payment_amount";s:4:"3600";s:7:"created";s:19:"2011-12-12 06:37:00";s:10:"created_by";s:2:"62";}', '2011-12-12', '06:37:15', 62),
(91, 15, 'updated invoice', 'O:8:"stdClass":11:{s:10:"payment_id";s:2:"15";s:9:"member_id";s:2:"20";s:14:"payment_method";s:4:"cash";s:19:"payment_transact_no";s:5:"45233";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2011-12-15";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:0:"";s:14:"payment_amount";s:5:"34000";s:7:"created";s:19:"2011-12-15 22:54:33";s:10:"created_by";s:2:"62";}', '2011-12-15', '22:55:06', 62),
(92, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-18', '18:04:51', 62),
(93, 37, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"37";s:7:"surname";s:5:"James";s:9:"givenname";s:4:"Main";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2009-12-07";s:5:"group";s:1:"1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"28";}', '2011-12-18', '18:04:51', 62),
(94, 38, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"38";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:1:"3";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2011-12-18', '18:04:51', 62),
(95, 43, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"43";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2007";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-18', '18:04:51', 62),
(96, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-18', '18:04:58', 62),
(97, 37, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"37";s:7:"surname";s:5:"James";s:9:"givenname";s:4:"Main";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2009-12-07";s:5:"group";s:1:"1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"28";}', '2011-12-18', '18:04:58', 62),
(98, 38, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"38";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2011-12-18', '18:04:58', 62),
(99, 43, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"43";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2007";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-18', '18:04:58', 62),
(100, 45, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"45";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2007";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-18', '18:04:58', 62),
(101, 36, 'updated guardian', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"36";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:0:"";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2011-12-18', '18:05:26', 62),
(102, 37, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"37";s:7:"surname";s:5:"James";s:9:"givenname";s:4:"Main";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2009-12-07";s:5:"group";s:1:"1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"28";}', '2011-12-18', '18:05:26', 62),
(103, 38, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"38";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2011-12-18', '18:05:26', 62),
(104, 43, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"43";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2007";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-18', '18:05:26', 62),
(105, 45, 'updated g_junior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"45";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2007";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-18', '18:05:26', 62),
(106, 23, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"23";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Jamar";s:6:"mobile";s:8:"07550987";s:7:"address";s:15:"22 Venessa Blvd";s:6:"suburb";s:10:"Springwood";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:10:"0412908700";s:12:"emailaddress";s:17:"jamar@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"8";}', '2011-12-20', '07:14:07', 62),
(107, 24, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"24";s:7:"surname";s:7:"Brandis";s:9:"givenname";s:4:"Paul";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2011-12-20', '07:14:31', 62),
(108, 24, 'updated senior', 'O:8:"stdClass":23:{s:9:"member_id";s:2:"24";s:7:"surname";s:7:"Brandis";s:9:"givenname";s:4:"Paul";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2006";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2011-12-20', '07:14:37', 62),
(109, 24, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"24";s:7:"surname";s:7:"Brandis";s:9:"givenname";s:4:"Paul";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2011-12-21', '07:03:27', 62),
(110, 24, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"24";s:7:"surname";s:7:"Brandis";s:9:"givenname";s:4:"Paul";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2011-12-21', '07:05:51', 62),
(111, 24, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"24";s:7:"surname";s:7:"Brandis";s:9:"givenname";s:4:"Paul";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2011-12-21', '07:05:59', 62),
(112, 34, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"34";s:7:"surname";s:6:"Wretch";s:9:"givenname";s:10:"Thirty Two";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2006-07-10";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-03 05:44:15";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-21', '07:08:30', 62),
(113, 23, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"23";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Jamar";s:6:"mobile";s:8:"07550987";s:7:"address";s:15:"22 Venessa Blvd";s:6:"suburb";s:10:"Springwood";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:10:"0412908700";s:12:"emailaddress";s:17:"jamar@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"8";}', '2011-12-21', '07:13:26', 62),
(114, 24, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"24";s:7:"surname";s:7:"Brandis";s:9:"givenname";s:4:"Paul";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"11";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2011-12-21', '07:13:58', 62),
(115, 45, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"45";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2007";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-21', '20:15:47', 62),
(116, 48, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"48";s:7:"surname";s:7:"Ikumbor";s:9:"givenname";s:4:"Osas";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-24', '03:41:52', 62),
(117, 13, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"13";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:7:"Jasmine";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-07-19";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"6";}', '2011-12-24', '03:42:09', 62),
(118, 46, 'updated guardian', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"46";s:7:"surname";s:11:"Christopher";s:9:"givenname";s:7:"Ekhator";s:6:"mobile";s:0:"";s:7:"address";s:5:"Iyama";s:6:"suburb";s:10:"Benin City";s:8:"postcode";s:5:"50000";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:17:"chris@hotmail.com";s:9:"send_news";s:1:"0";s:3:"dob";N;s:5:"group";N;s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";N;s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";N;}', '2011-12-24', '04:15:34', 62),
(119, 47, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"47";s:7:"surname";s:7:"Ekhator";s:9:"givenname";s:5:"Cyril";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"1976-09-20";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-24', '04:15:34', 62),
(120, 48, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"48";s:7:"surname";s:7:"Ikumbor";s:9:"givenname";s:4:"Osas";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-24', '04:15:34', 62),
(121, 12, 'updated guardian', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"12";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Nicky";s:6:"mobile";s:0:"";s:7:"address";s:15:"Preston Cresent";s:6:"suburb";s:7:"Coomera";s:8:"postcode";s:4:"4209";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:17:"nicky@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:1:"5";}', '2011-12-24', '04:16:58', 62),
(122, 13, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"13";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:7:"Jasmine";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-07-19";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"6";}', '2011-12-24', '04:16:58', 62),
(123, 14, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"14";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Aston";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2011-03-13";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"7";}', '2011-12-24', '04:16:58', 62),
(124, 31, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-24', '04:16:59', 62),
(125, 33, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"33";s:7:"surname";s:7:"Another";s:9:"givenname";s:3:"Kid";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-03 04:39:34";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-24', '04:16:59', 62),
(126, 44, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"44";s:7:"surname";s:6:"Simple";s:9:"givenname";s:4:"Plan";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-06";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-11 19:05:46";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-24', '04:16:59', 62),
(127, 46, 'updated guardian', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"46";s:7:"surname";s:11:"Christopher";s:9:"givenname";s:7:"Ekhator";s:6:"mobile";s:0:"";s:7:"address";s:5:"Iyama";s:6:"suburb";s:10:"Benin City";s:8:"postcode";s:5:"50000";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:17:"chris@hotmail.com";s:9:"send_news";s:1:"0";s:3:"dob";N;s:5:"group";N;s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";N;s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";N;}', '2011-12-24', '04:32:09', 62),
(128, 47, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"47";s:7:"surname";s:7:"Ekhator";s:9:"givenname";s:5:"Cyril";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"1976-09-20";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-24', '04:32:09', 62),
(129, 48, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"48";s:7:"surname";s:7:"Ikumbor";s:9:"givenname";s:4:"Osas";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2011-12-24', '04:32:09', 62),
(130, 16, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"16";s:7:"surname";s:5:"Ellen";s:9:"givenname";s:7:"Laidlaw";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-11-13";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"13";}', '2012-01-02', '05:56:09', 62),
(131, 13, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"13";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:7:"Jasmine";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-07-19";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"6";}', '2012-01-02', '05:56:33', 62),
(132, 17, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"17";s:7:"surname";s:9:"Charlotte";s:9:"givenname";s:7:"Laidlaw";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2010-05-07";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"14";}', '2012-01-02', '05:57:05', 62),
(133, 11, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"11";s:7:"surname";s:9:"Agbagbara";s:9:"givenname";s:5:"Dylan";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2009";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"3";}', '2012-01-02', '05:58:29', 62),
(134, 15, 'updated guardian', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"15";s:7:"surname";s:7:"Brenden";s:9:"givenname";s:7:"Laidlaw";s:6:"mobile";s:8:"09343434";s:7:"address";s:16:"Helensvale Place";s:6:"suburb";s:10:"Helensvale";s:8:"postcode";s:4:"4214";s:7:"phoneno";s:9:"043934322";s:12:"emailaddress";s:22:"brenden@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"12";}', '2012-01-02', '05:59:11', 62),
(135, 16, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"16";s:7:"surname";s:5:"Ellen";s:9:"givenname";s:8:"Standlaw";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-11-13";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"13";}', '2012-01-02', '05:59:11', 62),
(136, 17, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"17";s:7:"surname";s:6:"Charly";s:9:"givenname";s:8:"Standlaw";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2010-05-07";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"14";}', '2012-01-02', '05:59:11', 62),
(137, 18, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"18";s:7:"surname";s:8:"Victoria";s:9:"givenname";s:7:"laidlaw";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2011-05-19";s:5:"group";s:1:"3";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"15";}', '2012-01-02', '05:59:11', 62),
(138, 35, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"35";s:7:"surname";s:8:"Chipmunk";s:9:"givenname";s:3:"Jam";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-03 05:44:43";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '05:59:11', 62),
(139, 9, 'updated guardian', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"9";s:7:"surname";s:8:"Agbagara";s:9:"givenname";s:7:"Omokhoa";s:6:"mobile";s:0:"";s:7:"address";s:17:"Springdale street";s:6:"suburb";s:8:"Oxenford";s:8:"postcode";s:4:"4209";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:21:"omokhoa@insurtech.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:1:"1";}', '2012-01-02', '06:00:01', 62),
(140, 10, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"10";s:7:"surname";s:9:"Agbagbara";s:9:"givenname";s:6:"Leyton";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"3";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"2";}', '2012-01-02', '06:00:02', 62),
(141, 11, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"11";s:7:"surname";s:6:"Antone";s:9:"givenname";s:5:"Dylan";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2009";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"3";}', '2012-01-02', '06:00:02', 62),
(142, 12, 'updated guardian', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"12";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Nicky";s:6:"mobile";s:0:"";s:7:"address";s:15:"Preston Cresent";s:6:"suburb";s:7:"Coomera";s:8:"postcode";s:4:"4209";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:17:"nicky@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:1:"5";}', '2012-01-02', '06:00:44', 62),
(143, 13, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"13";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Jamie";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-07-19";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"6";}', '2012-01-02', '06:00:44', 62),
(144, 14, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"14";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Aston";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2011-03-13";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"7";}', '2012-01-02', '06:00:44', 62),
(145, 31, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"5";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '06:00:44', 62),
(146, 33, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"33";s:7:"surname";s:7:"Another";s:9:"givenname";s:3:"Kid";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"5";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-03 04:39:34";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '06:00:44', 62),
(147, 44, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"44";s:7:"surname";s:6:"Simple";s:9:"givenname";s:4:"Plan";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-06";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-11 19:05:46";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '06:00:44', 62),
(148, 6, 'updated guardian', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"6";s:7:"surname";s:4:"Mike";s:9:"givenname";s:6:"Andrew";s:6:"mobile";s:0:"";s:7:"address";s:17:"Ray White Complex";s:6:"suburb";s:8:"Labrador";s:8:"postcode";s:4:"4215";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:16:"mike@hotmail.com";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"20";}', '2012-01-02', '06:01:15', 62),
(149, 8, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"8";s:7:"surname";s:6:"Andrew";s:9:"givenname";s:4:"3000";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-06-12";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"22";}', '2012-01-02', '06:01:16', 62),
(150, 7, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"7";s:7:"surname";s:6:"please";s:9:"givenname";s:4:"work";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"21";}', '2012-01-02', '06:01:16', 62),
(151, 30, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"30";s:7:"surname";s:8:"Agbagara";s:9:"givenname";s:3:"Ese";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-10-28";s:5:"group";s:1:"3";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-16 06:04:04";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '06:01:16', 62),
(152, 32, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"32";s:7:"surname";s:3:"Ray";s:9:"givenname";s:5:"White";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2007-11-06";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-30 06:18:28";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '06:01:16', 62);
INSERT INTO `qjogz_clubreg_details_audit` (`id`, `primary_id`, `short_desc`, `audit_details`, `created_date`, `created_time`, `createdby`) VALUES
(153, 6, 'updated guardian', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"6";s:7:"surname";s:4:"Mike";s:9:"givenname";s:6:"Andrew";s:6:"mobile";s:0:"";s:7:"address";s:17:"Ray White Complex";s:6:"suburb";s:8:"Labrador";s:8:"postcode";s:4:"4215";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:16:"mike@hotmail.com";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"20";}', '2012-01-02', '06:01:24', 62),
(154, 8, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"8";s:7:"surname";s:6:"Andrew";s:9:"givenname";s:4:"3000";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-06-12";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"22";}', '2012-01-02', '06:01:24', 62),
(155, 7, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"7";s:7:"surname";s:6:"please";s:9:"givenname";s:4:"work";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"21";}', '2012-01-02', '06:01:24', 62),
(156, 30, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"30";s:7:"surname";s:6:"Antone";s:9:"givenname";s:3:"Ese";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-10-28";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-16 06:04:04";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '06:01:24', 62),
(157, 32, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"32";s:7:"surname";s:3:"Ray";s:9:"givenname";s:5:"White";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2007-11-06";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-30 06:18:28";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '06:01:25', 62),
(158, 6, 'updated guardian', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"6";s:7:"surname";s:4:"Mike";s:9:"givenname";s:6:"Andrew";s:6:"mobile";s:0:"";s:7:"address";s:17:"Ray White Complex";s:6:"suburb";s:8:"Labrador";s:8:"postcode";s:4:"4215";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:16:"mike@hotmail.com";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"20";}', '2012-01-02', '06:05:15', 62),
(159, 8, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"8";s:7:"surname";s:6:"Andrew";s:9:"givenname";s:4:"3000";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-06-12";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"22";}', '2012-01-02', '06:05:15', 62),
(160, 7, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"7";s:7:"surname";s:6:"please";s:9:"givenname";s:4:"work";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"21";}', '2012-01-02', '06:05:15', 62),
(161, 30, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"30";s:7:"surname";s:6:"Antone";s:9:"givenname";s:3:"Ese";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-10-28";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-16 06:04:04";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '06:05:16', 62),
(162, 32, 'updated g_junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"32";s:7:"surname";s:3:"Ray";s:9:"givenname";s:5:"White";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2007-11-06";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-30 06:18:28";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2013";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-02', '06:05:16', 62),
(163, 23, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"23";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Jamar";s:6:"mobile";s:8:"07550987";s:7:"address";s:15:"22 Venessa Blvd";s:6:"suburb";s:10:"Springwood";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:10:"0412908700";s:12:"emailaddress";s:17:"jamar@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"11";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"8";}', '2012-01-02', '06:07:44', 62),
(164, 24, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"24";s:7:"surname";s:7:"Brandis";s:9:"givenname";s:4:"Paul";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2012-01-02', '06:08:15', 62),
(165, 49, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"49";s:7:"surname";s:7:"omoruyi";s:9:"givenname";s:4:"mike";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-24 04:32:09";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-08', '18:27:38', 62),
(166, 49, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"49";s:7:"surname";s:7:"omoruyi";s:9:"givenname";s:4:"mike";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-24 04:32:09";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-08', '18:28:38', 62),
(167, 49, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"49";s:7:"surname";s:7:"omoruyi";s:9:"givenname";s:4:"mike";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-24 04:32:09";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-08', '18:29:31', 62),
(168, 2, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"2";s:9:"member_id";s:2:"24";s:11:"note_status";s:1:"0";s:5:"notes";s:114:"put in some data here.\r\n\r\nwhat is wrong with this data\r\n\r\nanother set of details here\r\n\r\nin that case will it work";s:7:"created";s:19:"2012-01-08 22:00:29";s:10:"created_by";s:2:"62";}', '2012-01-08', '22:01:02', 62),
(169, 1, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"1";s:9:"member_id";s:2:"24";s:11:"note_status";s:1:"0";s:5:"notes";s:31:"some data will be better							";s:7:"created";s:19:"2012-01-08 21:53:20";s:10:"created_by";s:2:"62";}', '2012-01-08', '22:26:04', 62),
(170, 1, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"1";s:9:"member_id";s:2:"24";s:11:"note_status";s:1:"0";s:5:"notes";s:85:"some data will be better some more details will be nice if thie aother witne ere					";s:7:"created";s:19:"2012-01-08 21:53:20";s:10:"created_by";s:2:"62";}', '2012-01-08', '22:26:26', 62),
(171, 4, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"4";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"0";s:5:"notes";s:32:"if this is not right then fix it";s:7:"created";s:19:"2012-01-09 07:06:33";s:10:"created_by";s:2:"62";}', '2012-01-09', '07:11:50', 62),
(172, 4, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"4";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"0";s:5:"notes";s:47:"if this is not right then fix it\n\nthere is more";s:7:"created";s:19:"2012-01-09 07:06:33";s:10:"created_by";s:2:"62";}', '2012-01-09', '07:12:06', 62),
(173, 4, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"4";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"0";s:5:"notes";s:47:"if this is not right then fix it\n\nthere is more";s:7:"created";s:19:"2012-01-09 07:06:33";s:10:"created_by";s:2:"62";}', '2012-01-09', '07:18:01', 62),
(174, 4, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"4";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"0";s:5:"notes";s:70:"if this is not right then fix it\n\nthere is more\nagain inside the mater";s:7:"created";s:19:"2012-01-09 07:06:33";s:10:"created_by";s:2:"62";}', '2012-01-09', '07:19:40', 62),
(175, 4, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"4";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"0";s:5:"notes";s:69:"if this is not right then fix it\nthere is more\nagain inside the mater";s:7:"created";s:19:"2012-01-09 07:06:33";s:10:"created_by";s:2:"62";}', '2012-01-09', '07:31:45', 62),
(176, 4, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"4";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"0";s:5:"notes";s:69:"if this is not right then fix it\nthere is more\nagain inside the mater";s:7:"created";s:19:"2012-01-09 07:06:33";s:10:"created_by";s:2:"62";}', '2012-01-09', '07:42:11', 62),
(177, 4, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"4";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"1";s:5:"notes";s:69:"if this is not right then fix it\nthere is more\nagain inside the mater";s:7:"created";s:19:"2012-01-09 07:06:33";s:10:"created_by";s:2:"62";}', '2012-01-09', '08:00:33', 62),
(178, 5, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"5";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"0";s:5:"notes";s:16:"simple note hser";s:7:"created";s:19:"2012-01-09 07:36:07";s:10:"created_by";s:2:"62";}', '2012-01-09', '08:01:16', 62),
(179, 4, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"4";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"1";s:5:"notes";s:82:"if this is not right then fix it\nthere is more\nagain inside the mater\n\nanother one";s:7:"created";s:19:"2012-01-09 07:06:33";s:10:"created_by";s:2:"62";}', '2012-01-11', '06:14:33', 62),
(180, 47, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"47";s:7:"surname";s:7:"Ekhator";s:9:"givenname";s:5:"Cyril";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"1976-09-20";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-11', '06:38:52', 62),
(181, 47, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"47";s:7:"surname";s:7:"Ekhator";s:9:"givenname";s:5:"Cyril";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"1976-09-20";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-11', '06:39:33', 62),
(182, 47, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"47";s:7:"surname";s:7:"Ekhator";s:9:"givenname";s:5:"Cyril";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"1976-09-20";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-01-11', '06:41:18', 62),
(183, 1, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"1";s:9:"member_id";s:2:"24";s:11:"note_status";s:1:"0";s:5:"notes";s:87:"some data will be better some more details will be \n\nnice if thie aother witne ere					";s:7:"created";s:19:"2012-01-08 21:53:20";s:10:"created_by";s:2:"62";}', '2012-01-11', '06:50:52', 62),
(184, 1, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"1";s:9:"member_id";s:2:"24";s:11:"note_status";s:1:"0";s:5:"notes";s:87:"some data will be better some more details will be \r\nnice if thie aother witne ere					";s:7:"created";s:19:"2012-01-08 21:53:20";s:10:"created_by";s:2:"62";}', '2012-01-11', '06:51:00', 62),
(185, 8, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"8";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"1";s:5:"notes";s:60:"this has been a bad day.\r\n\r\nevery cloud has a silver lining.";s:7:"created";s:19:"2012-01-14 12:47:42";s:10:"created_by";s:2:"62";}', '2012-01-14', '13:32:11', 62),
(186, 8, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"8";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"1";s:5:"notes";s:60:"this has been a bad day.\r\n\r\nevery cloud has a silver lining.";s:7:"created";s:19:"2012-01-14 12:47:42";s:10:"created_by";s:2:"62";}', '2012-01-14', '13:32:19', 62),
(187, 8, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"8";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"1";s:5:"notes";s:60:"this has been a bad day.\r\n\r\nevery cloud has a silver lining.";s:7:"created";s:19:"2012-01-14 12:47:42";s:10:"created_by";s:2:"62";}', '2012-01-14', '13:32:24', 62),
(188, 9, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"9";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"1";s:5:"notes";s:49:"Canadian like to be alone.\r\nI have karate lessons";s:7:"created";s:19:"2012-01-14 12:48:47";s:10:"created_by";s:2:"62";}', '2012-01-14', '13:32:30', 62),
(189, 8, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"8";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"1";s:5:"notes";s:60:"this has been a bad day.\r\n\r\nevery cloud has a silver lining.";s:7:"created";s:19:"2012-01-14 12:47:42";s:10:"created_by";s:2:"62";}', '2012-01-14', '13:32:43', 62),
(190, 8, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"8";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"1";s:5:"notes";s:72:"this has been a bad day.\r\nevery cloud has a silver lining.\r\nanother line";s:7:"created";s:19:"2012-01-14 12:47:42";s:10:"created_by";s:2:"62";}', '2012-01-14', '13:48:04', 62),
(191, 9, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"9";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"1";s:5:"notes";s:49:"Canadian like to be alone.\r\nI have karate lessons";s:7:"created";s:19:"2012-01-14 12:48:47";s:10:"created_by";s:2:"62";}', '2012-01-15', '07:21:15', 62),
(192, 8, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"8";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"1";s:5:"notes";s:73:"this has been a bad day.\r\nevery cloud has a silver lining.\r\nanother line.";s:7:"created";s:19:"2012-01-14 12:47:42";s:10:"created_by";s:2:"62";}', '2012-01-15', '07:21:25', 62),
(193, 8, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"8";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"0";s:5:"notes";s:73:"this has been a bad day.\r\nevery cloud has a silver lining.\r\nanother line.";s:7:"created";s:19:"2012-01-14 12:47:42";s:10:"created_by";s:2:"62";}', '2012-01-15', '07:21:52', 62),
(194, 9, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"9";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"0";s:5:"notes";s:49:"Canadian like to be alone.\r\nI have karate lessons";s:7:"created";s:19:"2012-01-14 12:48:47";s:10:"created_by";s:2:"62";}', '2012-01-15', '07:21:57', 62),
(195, 9, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"9";s:9:"member_id";s:2:"48";s:11:"note_status";s:1:"1";s:5:"notes";s:49:"Canadian like to be alone.\r\nI have karate lessons";s:7:"created";s:19:"2012-01-14 12:48:47";s:10:"created_by";s:2:"62";}', '2012-01-15', '08:13:55', 62),
(196, 5, 'updated note', 'O:8:"stdClass":6:{s:7:"note_id";s:1:"5";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"0";s:5:"notes";s:29:"simple note hser\n\nonly for me";s:7:"created";s:19:"2012-01-09 07:36:07";s:10:"created_by";s:2:"62";}', '2012-01-15', '18:34:25', 62),
(197, 16, 'updated note', 'O:8:"stdClass":7:{s:7:"note_id";s:2:"16";s:9:"member_id";s:2:"50";s:11:"note_status";s:1:"1";s:9:"note_type";s:1:"0";s:5:"notes";s:6:"teebow";s:7:"created";s:19:"2012-01-17 05:44:09";s:10:"created_by";s:2:"62";}', '2012-01-17', '05:44:20', 62),
(198, 45, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"45";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2007";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-01', '06:19:11', 62),
(199, 43, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"43";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2007";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-01', '06:19:11', 62),
(200, 32, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"32";s:7:"surname";s:3:"Ray";s:9:"givenname";s:5:"White";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2007-11-06";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-30 06:18:28";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2013";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-01', '06:20:15', 62),
(201, 48, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"48";s:7:"surname";s:7:"Ikumbor";s:9:"givenname";s:4:"Osas";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-01', '06:22:08', 62),
(202, 17, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"17";s:7:"surname";s:6:"Charly";s:9:"givenname";s:8:"Standlaw";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2010-05-07";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"14";}', '2012-02-01', '06:22:08', 62),
(203, 16, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"16";s:7:"surname";s:5:"Ellen";s:9:"givenname";s:8:"Standlaw";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-11-13";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"13";}', '2012-02-01', '06:22:08', 62),
(204, 8, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:1:"8";s:7:"surname";s:6:"Andrew";s:9:"givenname";s:4:"3000";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-06-12";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:25:09";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:25:09";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"22";}', '2012-02-01', '06:22:08', 62),
(205, 47, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"47";s:7:"surname";s:7:"Ekhator";s:9:"givenname";s:5:"Cyril";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"1976-09-20";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-02', '04:09:55', 62),
(206, 45, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"45";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-02', '04:09:55', 62),
(207, 44, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"44";s:7:"surname";s:6:"Simple";s:9:"givenname";s:4:"Plan";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-06";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-11 19:05:46";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-02', '04:09:55', 62),
(208, 43, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"43";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-02', '04:09:55', 62),
(209, 37, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"37";s:7:"surname";s:5:"James";s:9:"givenname";s:4:"Main";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2009-12-07";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"28";}', '2012-02-02', '04:09:55', 62),
(210, 38, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"38";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2012-02-02', '04:09:55', 62),
(211, 35, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"35";s:7:"surname";s:8:"Chipmunk";s:9:"givenname";s:3:"Jam";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-03 05:44:43";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-02', '04:09:55', 62),
(212, 34, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"34";s:7:"surname";s:6:"Wretch";s:9:"givenname";s:10:"Thirty Two";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2006-07-10";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-03 05:44:15";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-02', '04:09:55', 62),
(213, 33, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"33";s:7:"surname";s:7:"Another";s:9:"givenname";s:3:"Kid";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"5";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-03 04:39:34";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-02', '04:09:55', 62),
(214, 31, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"31";s:7:"surname";s:6:"Jessie";s:9:"givenname";s:3:"Jay";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-11-23";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"5";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-18 05:46:47";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-02', '04:09:55', 62),
(215, 14, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"14";s:7:"surname";s:6:"Samson";s:9:"givenname";s:5:"Aston";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2011-03-13";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"7";}', '2012-02-02', '04:09:55', 62),
(216, 13, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"13";s:7:"surname";s:6:"Samson";s:9:"givenname";s:5:"Jamie";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-07-19";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"6";}', '2012-02-02', '04:09:55', 62),
(217, 21, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"21";s:7:"surname";s:7:"Clifton";s:9:"givenname";s:4:"Bell";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2011-10-04";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"25";}', '2012-02-02', '04:10:42', 62),
(218, 20, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"20";s:7:"surname";s:4:"Trey";s:9:"givenname";s:4:"Song";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2011-10-26";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"24";}', '2012-02-02', '04:10:42', 62),
(219, 49, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"49";s:7:"surname";s:7:"omoruyi";s:9:"givenname";s:4:"mike";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-24 04:32:09";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-02', '04:20:55', 62),
(220, 11, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"11";s:7:"surname";s:6:"Antone";s:9:"givenname";s:5:"Dylan";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2009";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"3";}', '2012-02-02', '04:50:46', 62),
(221, 16, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"16";s:7:"surname";s:5:"Ellen";s:9:"givenname";s:8:"Standlaw";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-11-13";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"13";}', '2012-02-07', '05:36:48', 62),
(222, 11, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"11";s:7:"surname";s:6:"Antone";s:9:"givenname";s:5:"Dylan";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"3";}', '2012-02-07', '20:58:07', 62),
(223, 11, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"11";s:7:"surname";s:6:"Antone";s:9:"givenname";s:5:"Dylan";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"3";}', '2012-02-07', '20:58:20', 62),
(224, 43, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"43";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-02-07', '21:01:16', 62),
(225, 38, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"38";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2012-02-07', '21:01:47', 62),
(226, 38, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"38";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2012-02-07', '21:05:15', 62),
(227, 38, 'batch updated ', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"38";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2012-02-18', '13:35:49', 62),
(228, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:33:09', 62),
(229, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:35:09', 62),
(230, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:35:49', 62),
(231, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:43:28', 62),
(232, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:43:42', 62),
(233, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:44:43', 62),
(234, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:44:58', 62),
(235, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:45:16', 62),
(236, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:45:32', 62),
(237, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:45:55', 62),
(238, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:46:27', 62),
(239, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:46:49', 62);
INSERT INTO `qjogz_clubreg_details_audit` (`id`, `primary_id`, `short_desc`, `audit_details`, `created_date`, `created_time`, `createdby`) VALUES
(240, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:47:17', 62),
(241, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:48:46', 62),
(242, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:49:18', 62),
(243, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:50:25', 62),
(244, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:50:46', 62),
(245, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:51:17', 62),
(246, 50, 'updated senior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"50";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-02-26', '14:51:52', 62),
(247, 20, 'updated note', 'O:8:"stdClass":7:{s:7:"note_id";s:2:"20";s:9:"member_id";s:2:"44";s:11:"note_status";s:1:"0";s:9:"note_type";s:1:"0";s:5:"notes";s:19:"I get a good feeing";s:7:"created";s:19:"2012-03-24 10:36:13";s:10:"created_by";s:2:"62";}', '2012-03-24', '10:36:49', 62),
(248, 44, 'updated junior', 'O:8:"stdClass":24:{s:9:"member_id";s:2:"44";s:7:"surname";s:6:"Simple";s:9:"givenname";s:4:"Plan";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-06";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-11 19:05:46";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-05-27', '19:17:01', 62),
(249, 43, 'updated junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"43";s:8:"memberid";s:1:" ";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-05-28', '20:01:16', 62),
(250, 43, 'updated junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"43";s:8:"memberid";s:1:" ";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-05-28', '20:03:09', 62),
(251, 43, 'updated junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"43";s:8:"memberid";s:11:"87871445454";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-05-28', '20:03:19', 62),
(252, 43, 'updated junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"43";s:8:"memberid";s:8:"88454545";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-05-28', '20:04:19', 62),
(253, 36, 'updated guardian', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"36";s:8:"memberid";s:1:" ";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:8:"03654111";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:0:"";s:7:"phoneno";s:9:"041369877";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2012-05-30', '22:06:51', 62),
(254, 37, 'updated g_junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"37";s:8:"memberid";s:1:" ";s:7:"surname";s:5:"James";s:9:"givenname";s:4:"Main";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2009-12-07";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"28";}', '2012-05-30', '22:06:51', 62),
(255, 38, 'updated g_junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"38";s:8:"memberid";s:1:" ";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2012-05-30', '22:06:51', 62),
(256, 43, 'updated g_junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"43";s:8:"memberid";s:8:"88454545";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-05-30', '22:06:51', 62),
(257, 45, 'updated g_junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"45";s:8:"memberid";s:1:" ";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-05-30', '22:06:51', 62),
(258, 36, 'updated guardian', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"36";s:8:"memberid";s:1:" ";s:7:"surname";s:8:"Producer";s:9:"givenname";s:5:"James";s:6:"mobile";s:8:"03654111";s:7:"address";s:9:"BBC 1xtra";s:6:"suburb";s:12:"Thames House";s:8:"postcode";s:6:"898777";s:7:"phoneno";s:9:"041369877";s:12:"emailaddress";s:20:"james@hotmail.com.au";s:9:"send_news";s:1:"0";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:2:"-1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:2:"-1";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";s:2:"27";}', '2012-05-30', '22:10:53', 62),
(259, 37, 'updated g_junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"37";s:8:"memberid";s:2:"-1";s:7:"surname";s:5:"James";s:9:"givenname";s:4:"Main";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2009-12-07";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"28";}', '2012-05-30', '22:10:53', 62),
(260, 38, 'updated g_junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"38";s:8:"memberid";s:2:"-1";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2012-05-30', '22:10:53', 62),
(261, 43, 'updated g_junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"43";s:8:"memberid";s:2:"-1";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-05-30', '22:10:53', 62),
(262, 45, 'updated g_junior', 'O:8:"stdClass":25:{s:9:"member_id";s:2:"45";s:8:"memberid";s:2:"-1";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-05-30', '22:10:53', 62),
(263, 24, 'updated senior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"24";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:8:"Brandist";s:9:"givenname";s:7:"Pauline";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2012-06-02', '04:53:03', 62),
(264, 24, 'updated senior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"24";s:8:"memberid";s:0:"";s:11:"memberlevel";s:2:"-1";s:7:"surname";s:8:"Brandist";s:9:"givenname";s:7:"Pauline";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2012-06-02', '04:54:16', 62),
(265, 49, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"49";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:7:"omoruyi";s:9:"givenname";s:4:"mike";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-24 04:32:09";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-02', '04:56:25', 62),
(266, 43, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"43";s:8:"memberid";s:2:"-1";s:11:"memberlevel";s:1:" ";s:7:"surname";s:5:"James";s:9:"givenname";s:5:"May 6";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-14";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 12:05:22";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-03', '09:53:27', 62),
(267, 50, 'updated senior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"50";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-06-03', '10:07:31', 62),
(268, 50, 'updated senior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"50";s:8:"memberid";s:8:"90343844";s:11:"memberlevel";s:2:"-1";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-06-03', '10:16:01', 62),
(269, 48, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"48";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:7:"Ikumbor";s:9:"givenname";s:4:"Osas";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-03', '10:32:24', 62),
(270, 48, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"48";s:8:"memberid";s:0:"";s:11:"memberlevel";s:7:"amatuer";s:7:"surname";s:7:"Ikumbor";s:9:"givenname";s:4:"Osas";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2012-06-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-03', '10:32:37', 62),
(271, 50, 'updated senior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"50";s:8:"memberid";s:8:"90343844";s:11:"memberlevel";s:7:"amatuer";s:7:"surname";s:6:"Alleno";s:9:"givenname";s:6:"Steven";s:6:"mobile";s:0:"";s:7:"address";s:0:"";s:6:"suburb";s:0:"";s:8:"postcode";s:4:"3012";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:26:"steve.alleno@spring.com.au";s:9:"send_news";s:1:"1";s:3:"dob";N;s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2012-01-02 06:11:27";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";N;}', '2012-06-09', '04:58:36', 62),
(272, 24, 'updated senior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"24";s:8:"memberid";s:0:"";s:11:"memberlevel";s:2:"-1";s:7:"surname";s:8:"Brandist";s:9:"givenname";s:7:"Pauline";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:16:"paul@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2012-06-09', '04:59:16', 62),
(273, 23, 'updated senior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"23";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Jamar";s:6:"mobile";s:8:"07550987";s:7:"address";s:14:"22 Venessa Ave";s:6:"suburb";s:10:"Springward";s:8:"postcode";s:4:"4231";s:7:"phoneno";s:10:"0412908700";s:12:"emailaddress";s:17:"jamar@hotmail.com";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"11";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"8";}', '2012-06-09', '05:00:04', 62),
(276, 6, 'Email_Sent_1339578535', 'O:8:"stdClass":5:{s:10:"message_by";N;s:12:"message_from";N;s:15:"message_subject";N;s:12:"message_body";N;s:17:"message_addresses";N;}', '2012-06-13', '19:08:55', 62),
(277, 6, 'Email_Sent_1339578610', 'O:8:"stdClass":5:{s:10:"message_by";N;s:12:"message_from";N;s:15:"message_subject";N;s:12:"message_body";N;s:17:"message_addresses";N;}', '2012-06-13', '19:10:10', 62),
(278, 6, 'Email_Sent_1339578736', 'O:8:"stdClass":5:{s:10:"message_by";s:13:"Administrator";s:12:"message_from";s:26:"admin@deltastateonline.com";s:15:"message_subject";s:34:"Thank you for registrating with us";s:12:"message_body";s:165:"<p>Dear Member</p>\r\n<p>Thank you for registering with {club_name}.</p>\r\n<p>A team member will get in touch with you in a few days.</p>\r\n<p>Best Regards. {Sender}</p>";s:17:"message_addresses";a:3:{i:0;s:21:"kekeominu@yahoo.co.uk";i:1;s:27:"ok_agbagbara@hotmail.com.au";i:2;s:27:"nimble@deltastateonline.com";}}', '2012-06-13', '19:12:16', 62),
(279, 6, 'Email_Sent_1339646080', 'O:8:"stdClass":5:{s:10:"message_by";s:13:"Administrator";s:12:"message_from";s:26:"admin@deltastateonline.com";s:15:"message_subject";s:34:"Thank you for registrating with us";s:12:"message_body";s:165:"<p>Dear Member</p>\r\n<p>Thank you for registering with {club_name}.</p>\r\n<p>A team member will get in touch with you in a few days.</p>\r\n<p>Best Regards. {Sender}</p>";s:17:"message_addresses";a:3:{i:0;s:21:"kekeominu@yahoo.co.uk";i:1;s:27:"ok_agbagbara@hotmail.com.au";i:2;s:27:"nimble@deltastateonline.com";}}', '2012-06-14', '13:54:40', 62),
(280, 6, 'Email_Sent_1339646241', 'O:8:"stdClass":5:{s:10:"message_by";s:13:"Administrator";s:12:"message_from";s:26:"admin@deltastateonline.com";s:15:"message_subject";s:34:"Thank you for registrating with us";s:12:"message_body";s:165:"<p>Dear Member</p>\r\n<p>Thank you for registering with {club_name}.</p>\r\n<p>A team member will get in touch with you in a few days.</p>\r\n<p>Best Regards. {Sender}</p>";s:17:"message_addresses";a:3:{i:0;s:21:"kekeominu@yahoo.co.uk";i:1;s:27:"ok_agbagbara@hotmail.com.au";i:2;s:27:"nimble@deltastateonline.com";}}', '2012-06-14', '13:57:21', 62),
(281, 32, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"32";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:3:"Ray";s:9:"givenname";s:5:"White";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2007-11-06";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-30 06:18:28";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"6";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-22', '14:33:12', 62),
(282, 48, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"48";s:8:"memberid";s:0:"";s:11:"memberlevel";s:7:"amatuer";s:7:"surname";s:7:"Ikumbor";s:9:"givenname";s:4:"Osas";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2012-06-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-22', '14:34:26', 62),
(283, 47, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"47";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:7:"Ekhator";s:9:"givenname";s:5:"Cyril";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"1976-09-20";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"6";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-22', '14:35:26', 62),
(284, 38, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"38";s:8:"memberid";s:2:"-1";s:11:"memberlevel";s:1:" ";s:7:"surname";s:5:"James";s:9:"givenname";s:3:"Sub";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-12-03";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"29";}', '2012-06-22', '14:37:22', 62),
(285, 16, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"16";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:5:"Ellen";s:9:"givenname";s:10:"Standlaw 1";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2007-11-13";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"13";}', '2012-06-22', '14:38:11', 62),
(286, 24, 'updated senior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"24";s:8:"memberid";s:0:"";s:11:"memberlevel";s:1:"0";s:7:"surname";s:8:"Brandist";s:9:"givenname";s:7:"Pauline";s:6:"mobile";s:9:"041390233";s:7:"address";s:11:"meadowbrook";s:6:"suburb";s:6:"meakin";s:8:"postcode";s:4:"4131";s:7:"phoneno";s:9:"041390233";s:12:"emailaddress";s:27:"ok_agbagbara@hotmail.com.au";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"12";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"9";}', '2012-06-22', '14:39:24', 62),
(287, 23, 'updated senior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"23";s:8:"memberid";s:0:"";s:11:"memberlevel";s:1:"0";s:7:"surname";s:7:"Samuels";s:9:"givenname";s:5:"Jamar";s:6:"mobile";s:8:"07550987";s:7:"address";s:14:"22 Venessa Ave";s:6:"suburb";s:10:"Springward";s:8:"postcode";s:4:"4231";s:7:"phoneno";s:10:"0412908700";s:12:"emailaddress";s:21:"kekeominu@yahoo.co.uk";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"2";s:8:"subgroup";s:2:"11";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-11-05 19:38:30";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:30";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2011";s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:6:"senior";s:6:"eoi_id";s:1:"8";}', '2012-06-22', '14:40:27', 62),
(288, 10, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"10";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:6:"Antone";s:9:"givenname";s:6:"Leyton";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";s:2:"-1";s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-11-05 19:38:15";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-11-05 19:38:15";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:1:"9";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:1:"2";}', '2012-06-22', '14:42:04', 62),
(289, 25, 'updated invoice', 'O:8:"stdClass":12:{s:10:"payment_id";s:2:"25";s:9:"member_id";s:2:"49";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:6:"343434";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2012-06-23";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:15:"some notes here";s:14:"payment_amount";s:5:"20000";s:7:"created";s:19:"2012-06-23 05:12:19";s:10:"created_by";s:2:"62";s:14:"payment_season";s:4:"2012";}', '2012-06-23', '05:13:39', 62),
(290, 20, 'updated invoice', 'O:8:"stdClass":12:{s:10:"payment_id";s:2:"20";s:9:"member_id";s:2:"48";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:7:"8374343";s:14:"payment_status";s:7:"pending";s:12:"payment_date";s:10:"2012-01-14";s:12:"payment_desc";s:10:"playingkit";s:13:"payment_notes";s:14:"calm your self";s:14:"payment_amount";s:5:"35000";s:7:"created";s:19:"2012-01-14 13:07:09";s:10:"created_by";s:2:"62";s:14:"payment_season";N;}', '2012-06-23', '05:51:38', 62),
(291, 19, 'updated invoice', 'O:8:"stdClass":12:{s:10:"payment_id";s:2:"19";s:9:"member_id";s:2:"48";s:14:"payment_method";s:10:"creditcard";s:19:"payment_transact_no";s:8:"98343434";s:14:"payment_status";s:7:"checked";s:12:"payment_date";s:10:"2012-01-14";s:12:"payment_desc";s:7:"regfees";s:13:"payment_notes";s:42:"what is the matter with the payment method";s:14:"payment_amount";s:4:"3493";s:7:"created";s:19:"2012-01-14 13:06:41";s:10:"created_by";s:2:"62";s:14:"payment_season";N;}', '2012-06-23', '05:51:47', 62),
(292, 45, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"45";s:8:"memberid";s:2:"-1";s:11:"memberlevel";s:1:" ";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-25', '14:44:47', 62),
(293, 49, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"49";s:8:"memberid";s:9:"something";s:11:"memberlevel";s:10:"fee_paying";s:7:"surname";s:7:"omoruyi";s:9:"givenname";s:4:"mike";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-24 04:32:09";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-28', '05:51:41', 62),
(294, 45, 'batch updated ', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"45";s:8:"memberid";s:2:"-1";s:11:"memberlevel";s:1:"0";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-28', '06:27:26', 62),
(295, 44, 'batch updated ', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"44";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:6:"Simple";s:9:"givenname";s:4:"Plan";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-06";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-11 19:05:46";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"12";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-28', '06:27:26', 62),
(296, 37, 'batch updated ', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"37";s:8:"memberid";s:2:"-1";s:11:"memberlevel";s:1:" ";s:7:"surname";s:5:"James";s:9:"givenname";s:4:"Main";s:6:"mobile";s:2:"-1";s:7:"address";s:2:"-1";s:6:"suburb";s:2:"-1";s:8:"postcode";s:2:"-1";s:7:"phoneno";s:2:"-1";s:12:"emailaddress";s:2:"-1";s:9:"send_news";s:2:"-1";s:3:"dob";s:10:"2009-12-07";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";s:2:"-1";s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-07 09:45:18";s:10:"created_by";s:2:"62";s:8:"approved";s:19:"2011-12-07 09:45:18";s:11:"approved_by";s:2:"62";s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";s:2:"28";}', '2012-06-29', '05:50:35', 62),
(297, 35, 'batch updated ', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"35";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:8:"Chipmunk";s:9:"givenname";s:3:"Jam";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-03 05:44:43";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"15";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-29', '05:50:35', 62),
(298, 34, 'batch updated ', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"34";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:6:"Wretch";s:9:"givenname";s:10:"Thirty Two";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2006-07-10";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-03 05:44:15";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"19";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-06-29', '05:50:35', 62),
(299, 49, 'delete_stats', 'O:8:"stdClass":1:{s:8:"old_data";a:3:{i:0;a:4:{s:9:"member_id";s:2:"49";s:10:"stats_date";s:10:"2012-07-14";s:12:"stats_detail";s:16:"stats_attendance";s:11:"stats_value";s:2:"No";}i:1;a:4:{s:9:"member_id";s:2:"49";s:10:"stats_date";s:10:"2012-07-14";s:12:"stats_detail";s:14:"stats_lap_time";s:11:"stats_value";s:0:"";}i:2;a:4:{s:9:"member_id";s:2:"49";s:10:"stats_date";s:10:"2012-07-14";s:12:"stats_detail";s:16:"stats_shots_made";s:11:"stats_value";s:0:"";}}}', '2012-08-05', '07:38:26', 62),
(300, 45, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"45";s:8:"memberid";s:2:"-1";s:11:"memberlevel";s:7:"amatuer";s:7:"surname";s:6:"Design";s:9:"givenname";s:6:"People";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2011-12-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-18 18:04:51";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"36";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-09-23', '05:00:55', 62),
(301, 46, 'updated guardian', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"46";s:8:"memberid";s:1:" ";s:11:"memberlevel";s:1:" ";s:7:"surname";s:11:"Christopher";s:9:"givenname";s:7:"Ekhator";s:6:"mobile";s:0:"";s:7:"address";s:5:"Iyama";s:6:"suburb";s:10:"Benin City";s:8:"postcode";s:5:"50000";s:7:"phoneno";s:0:"";s:12:"emailaddress";s:17:"chris@hotmail.com";s:9:"send_news";s:1:"0";s:3:"dob";N;s:5:"group";N;s:8:"subgroup";s:2:"-1";s:8:"as_above";N;s:6:"gender";N;s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";N;s:13:"member_status";s:10:"registered";s:9:"parent_id";N;s:10:"playertype";s:8:"guardian";s:6:"eoi_id";N;}', '2012-09-29', '12:26:29', 62),
(302, 48, 'updated g_junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"48";s:8:"memberid";s:10:"09232-9232";s:11:"memberlevel";s:7:"amatuer";s:7:"surname";s:7:"Ikumbor";s:9:"givenname";s:4:"Osas";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"2012-06-28";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:6:"female";s:7:"created";s:19:"2011-12-18 18:17:44";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-09-29', '12:26:29', 62),
(303, 49, 'updated g_junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"49";s:8:"memberid";s:9:"something";s:11:"memberlevel";s:7:"amatuer";s:7:"surname";s:7:"omoruyi";s:9:"givenname";s:4:"mike";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-24 04:32:09";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-09-29', '12:26:29', 62),
(304, 49, 'updated junior', 'O:8:"stdClass":26:{s:9:"member_id";s:2:"49";s:8:"memberid";s:2:"-1";s:11:"memberlevel";s:2:"-1";s:7:"surname";s:7:"omoruyi";s:9:"givenname";s:4:"mike";s:6:"mobile";N;s:7:"address";N;s:6:"suburb";N;s:8:"postcode";N;s:7:"phoneno";N;s:12:"emailaddress";N;s:9:"send_news";N;s:3:"dob";s:10:"0000-00-00";s:5:"group";s:1:"1";s:8:"subgroup";s:1:"4";s:8:"as_above";N;s:6:"gender";s:4:"male";s:7:"created";s:19:"2011-12-24 04:32:09";s:10:"created_by";s:2:"62";s:8:"approved";N;s:11:"approved_by";N;s:15:"year_registered";s:4:"2012";s:13:"member_status";s:10:"registered";s:9:"parent_id";s:2:"46";s:10:"playertype";s:6:"junior";s:6:"eoi_id";N;}', '2012-10-08', '04:54:32', 62);

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_eoimembers`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_eoimembers` (
  `member_id` int(11) NOT NULL auto_increment,
  `surname` varchar(30) default NULL,
  `givenname` varchar(30) default NULL,
  `mobile` varchar(30) default NULL,
  `address` varchar(50) default NULL,
  `suburb` varchar(30) default NULL,
  `postcode` varchar(30) default NULL,
  `phoneno` varchar(30) default NULL,
  `emailaddress` varchar(30) default NULL,
  `send_news` tinyint(4) default NULL,
  `dob` date default NULL,
  `group` int(11) default NULL,
  `as_above` tinyint(4) default NULL,
  `gender` varchar(6) default NULL,
  `created` datetime default NULL,
  `created_by` int(11) default NULL,
  `approved` datetime default NULL,
  `approved_by` int(11) default NULL,
  `year_registered` varchar(30) default NULL,
  `member_status` varchar(30) default NULL,
  `parent_id` int(11) default NULL,
  `playertype` varchar(11) default NULL,
  PRIMARY KEY  (`member_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `qjogz_clubreg_eoimembers`
--

INSERT INTO `qjogz_clubreg_eoimembers` (`member_id`, `surname`, `givenname`, `mobile`, `address`, `suburb`, `postcode`, `phoneno`, `emailaddress`, `send_news`, `dob`, `group`, `as_above`, `gender`, `created`, `created_by`, `approved`, `approved_by`, `year_registered`, `member_status`, `parent_id`, `playertype`) VALUES
(1, 'Agbagara', 'Omokhoa', '', '', '', '', '', 'omokhoa@insurtech.com', -1, '0000-00-00', -1, -1, '-1', '2011-10-04 07:49:12', NULL, NULL, NULL, NULL, 'eoi', NULL, 'guardian'),
(2, 'Agbagbara', 'Leyton', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 3, -1, 'male', '2011-10-04 07:49:12', NULL, NULL, NULL, NULL, 'eoi', 1, 'junior'),
(3, 'Agbagbara', 'Dylan', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 1, -1, 'male', '2011-10-04 07:49:12', NULL, NULL, NULL, NULL, 'eoi', 1, 'junior'),
(4, 'Agbagbara', 'Omokhoa', '04139034333', 'unit 3 olsen ave', 'labrador gold coast', '4209''s', '0413923557', 'simple@hotmail.com.au', 0, '0000-00-00', 14, -1, 'male', '2011-10-08 07:52:24', NULL, NULL, NULL, NULL, 'eoi', NULL, 'senior'),
(5, 'Samuels', 'Nicky', '', '', '', '', '', 'nicky@hotmail.com', -1, '0000-00-00', -1, -1, '-1', '2011-10-16 17:03:46', NULL, NULL, NULL, NULL, 'eoi', NULL, 'guardian'),
(6, 'Samuels', 'Jasmine', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 1, -1, 'female', '2011-10-16 17:03:46', NULL, NULL, NULL, NULL, 'eoi', 5, 'junior'),
(7, 'Samuels', 'Aston', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', -1, -1, 'male', '2011-10-16 17:03:46', NULL, NULL, NULL, NULL, 'eoi', 5, 'junior'),
(8, 'Samuels', 'Jamar', '', '', '', '', '', 'jamar@hotmail.com', 0, '0000-00-00', 2, -1, 'female', '2011-10-16 17:42:54', NULL, NULL, NULL, NULL, 'eoi', NULL, 'senior'),
(9, 'Brandis', 'Paul', '041390233', 'meadowbrook', 'meakin', '4131', '041390233', 'paul@hotmail.com', -1, '0000-00-00', 2, -1, 'male', '2011-10-17 12:56:36', NULL, NULL, NULL, NULL, 'eoi', NULL, 'senior'),
(10, 'Tagg', 'Lee Mark', '04235544421', 'white street', 'Tenah Merah', '4210', '0423554442', 'mark@hotmail.com', -1, '0000-00-00', 14, -1, 'male', '2011-10-17 12:57:52', NULL, NULL, NULL, NULL, 'eoi', NULL, 'senior'),
(11, 'Steve', 'Allen', '', 'LBC towers', 'west minister', 'se 13', '', 'steve@hotmail.com', 0, '0000-00-00', 16, -1, 'male', '2011-10-17 12:59:16', NULL, NULL, NULL, NULL, 'eoi', NULL, 'senior'),
(12, 'Brenden', 'Laidlaw', '', '', '', '', '', 'brenden@hotmail.com.au', -1, '0000-00-00', -1, -1, '-1', '2011-10-22 20:10:14', NULL, NULL, NULL, NULL, 'eoi', NULL, 'guardian'),
(13, 'Ellen', '', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 1, -1, 'female', '2011-10-22 20:10:14', NULL, NULL, NULL, NULL, 'eoi', 12, 'junior'),
(14, 'Charlotte', '', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 1, -1, 'male', '2011-10-22 20:10:14', NULL, NULL, NULL, NULL, 'eoi', 12, 'junior'),
(15, 'Victoria', '', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 3, -1, 'female', '2011-10-22 20:10:14', NULL, NULL, NULL, NULL, 'eoi', 12, 'junior'),
(16, 'Paul', 'Besgrove', '', '', '', '', '', 'paulbesgrove@hotmail.com', -1, '0000-00-00', -1, -1, '-1', '2011-10-28 06:10:30', NULL, NULL, NULL, NULL, 'eoi', NULL, 'guardian'),
(17, 'Andrew', 'Besgrove', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 1, -1, '-1', '2011-10-28 06:10:30', NULL, NULL, NULL, NULL, 'eoi', 16, 'junior'),
(18, 'Snoop', 'Dogg', '', '', 'Helensvale', '4215', '', 'snoop@hotmail.com', -1, '0000-00-00', -1, -1, '-1', '2011-10-28 06:25:42', NULL, NULL, NULL, NULL, 'eoi', NULL, 'guardian'),
(19, 'Lil', 'Bow Wow', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 3, -1, 'male', '2011-10-28 06:25:42', NULL, NULL, NULL, NULL, 'eoi', 18, 'junior'),
(20, 'mike', 'andrew', '', '', '', '', '', 'mike@hotmail.com', -1, '0000-00-00', -1, -1, '-1', '2011-10-28 06:30:29', NULL, NULL, NULL, NULL, 'eoi', NULL, 'guardian'),
(21, 'please', 'work', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 1, -1, 'male', '2011-10-28 06:30:29', NULL, NULL, NULL, NULL, 'eoi', 20, 'junior'),
(22, 'not', 'NOw', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 1, -1, 'female', '2011-10-28 06:30:29', NULL, NULL, NULL, NULL, 'eoi', 20, 'junior'),
(23, 'mike', 'andrew', '', '', '', '', '', 'mike@hotmail.com', -1, '0000-00-00', -1, -1, '-1', '2011-10-28 06:34:09', NULL, NULL, NULL, NULL, 'eoi', NULL, 'guardian'),
(24, 'please', 'work', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2011-10-26', 1, -1, 'male', '2011-10-28 06:34:09', NULL, NULL, NULL, NULL, 'eoi', 23, 'junior'),
(25, 'not', 'NOw', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2011-10-04', 1, -1, 'female', '2011-10-28 06:34:09', NULL, NULL, NULL, NULL, 'eoi', 23, 'junior'),
(26, 'Cole', 'Jay', '', '', '', '', '', 'jaycole@yahoo.co.uk', -1, '0000-00-00', -1, -1, 'female', '2011-11-13 04:42:24', NULL, NULL, NULL, NULL, 'eoi', NULL, 'senior'),
(27, 'Producer', 'James', '', '', '', '', '', 'james@hotmail.com.au', -1, '0000-00-00', -1, -1, '-1', '2011-12-07 09:39:34', NULL, NULL, NULL, NULL, 'eoi', NULL, 'guardian'),
(28, 'James', 'Main', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', -1, -1, '-1', '2011-12-07 09:39:34', NULL, NULL, NULL, NULL, 'eoi', 27, 'junior'),
(29, 'James', 'Sub', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', -1, -1, '-1', '2011-12-07 09:39:34', NULL, NULL, NULL, NULL, 'eoi', 27, 'junior'),
(30, 'Westwood', 'Timothy', '', '', '', '', '', 'tim@bbc.co.uk', -1, '0000-00-00', 2, -1, 'male', '2012-01-04 04:29:44', NULL, NULL, NULL, NULL, 'eoi', NULL, 'senior'),
(31, 'Becky', 'Dressport', '', '', '', '', '', 'becky@hotmail.com.au', -1, '0000-00-00', 2, -1, 'female', '2012-01-08 18:42:07', NULL, NULL, NULL, NULL, 'eoi', NULL, 'senior');

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_groups`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_groups` (
  `group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(255) NOT NULL default '',
  `group_short` varchar(30) NOT NULL default '',
  `group_text` text NOT NULL,
  `group_type` varchar(30) NOT NULL default '',
  `which_config` varchar(50) NOT NULL,
  `group_comments` varchar(255) default NULL,
  `group_leader` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL default '1',
  `params` varchar(1024) NOT NULL default '',
  `group_parent` int(11) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY  (`group_id`),
  UNIQUE KEY `config_short` (`group_short`),
  KEY `which_config` (`which_config`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Store all club groups' AUTO_INCREMENT=18 ;

--
-- Dumping data for table `qjogz_clubreg_groups`
--

INSERT INTO `qjogz_clubreg_groups` (`group_id`, `group_name`, `group_short`, `group_text`, `group_type`, `which_config`, `group_comments`, `group_leader`, `createdby`, `created`, `ordering`, `publish`, `params`, `group_parent`, `checked_out`, `checked_out_time`) VALUES
(1, 'Under 5s', 'under_5s', 'what is wrong here', '', '', 'i have no idea', 75, 62, '2011-07-12 04:02:16', 1, 1, 'start_time=9.30\ngrouptype=junior', 0, 0, '0000-00-00 00:00:00'),
(2, 'Over 35s', 'over_35s', '', '', '', '', 62, 62, '2011-07-12 04:07:30', 2, 1, 'start_time=\ngrouptype=senior', 0, 0, '0000-00-00 00:00:00'),
(3, 'Under 7s', 'under_7s', 'please show me', '', '', 'something is wrong', 68, 62, '2011-07-12 04:09:08', 1, 1, 'start_time=09:09\ngrouptype=junior', 0, 0, '0000-00-00 00:00:00'),
(4, 'Group Sept to Dec', 'group_sept_to_dec', '', '', '', '', 0, 62, '2011-07-16 12:33:09', 0, 1, 'start_time=', 1, 62, '2012-06-27 03:52:10'),
(5, 'Group Jan to June', 'group_jan_to_june', '', '', '', '', 0, 62, '2011-07-16 13:29:49', 2, 1, 'start_time=9.30\ngrouptype=junior', 1, 62, '2011-12-21 20:15:34'),
(6, 'From June', 'from_june', '', '', '', '', 0, 62, '2011-07-17 11:52:21', 3, 1, 'start_time=\ngrouptype=junior', 1, 62, '2011-12-21 20:15:20'),
(7, 'Delete Me', 'change_me', '', '', '', '', 0, 62, '2011-07-17 12:45:22', 4, 0, 'start_time=\ngrouptype=junior', 1, 62, '2011-12-21 20:15:27'),
(8, 'Early Monring', 'early_monring', '', '', '', '', 0, 62, '2011-07-19 21:23:37', 1, 1, 'start_time=', 3, 62, '2011-08-04 02:01:56'),
(9, 'Late Afternoon', 'late_afternoon', '', '', '', '', 0, 62, '2011-07-19 21:24:34', 2, 1, 'start_time=', 3, 62, '2011-07-20 05:31:42'),
(11, 'First Team', 'first_team', '', '', '', '', 72, 62, '2011-07-20 15:33:54', 1, 1, 'start_time=8.30 am\ngrouptype=senior', 2, 62, '2011-12-21 19:38:38'),
(10, 'Something Else', 'something_else', '', '', '', '', 0, 62, '2011-07-20 13:33:01', 3, 1, 'start_time=', 3, 62, '2011-07-20 05:30:20'),
(12, 'First Reserve', 'first_reserve', '', '', '', '', 72, 62, '2011-07-20 15:34:06', 2, 1, 'start_time=\ngrouptype=senior', 2, 62, '2011-12-21 19:32:19'),
(13, 'Chavy Family', 'chavy_family', '', '', '', '', 0, 62, '2011-08-07 17:58:06', 3, 99, 'start_time=', 0, 0, '0000-00-00 00:00:00'),
(14, 'Sunday Team A', 'sunday_team_a', '', '', '', '', 62, 62, '2011-08-14 00:40:20', 4, 1, 'start_time=\ngrouptype=senior', 0, 0, '0000-00-00 00:00:00'),
(15, 'Sunday Team B', 'sunday_team_b', '', '', '', '', 63, 62, '2011-08-14 00:44:59', 5, 1, 'start_time=\ngrouptype=senior', 0, 0, '0000-00-00 00:00:00'),
(16, 'Sunday Team C', 'sunday_team_c', '', '', '', '', 63, 62, '2011-08-14 00:49:34', 6, 1, 'start_time=\ngrouptype=senior', 0, 0, '0000-00-00 00:00:00'),
(17, 'Second Reserve', 'second_reserve', '', '', '', '', 72, 62, '2011-12-22 06:32:16', 3, 1, 'start_time=\ngrouptype=senior', 2, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_notes`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_notes` (
  `note_id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `note_status` tinyint(11) NOT NULL,
  `note_type` int(11) NOT NULL,
  PRIMARY KEY  (`note_id`),
  KEY `member_id` (`member_id`,`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `qjogz_clubreg_notes`
--

INSERT INTO `qjogz_clubreg_notes` (`note_id`, `member_id`, `notes`, `created`, `created_by`, `note_status`, `note_type`) VALUES
(1, 24, 'some data will be better some more details will be \r\nnice if thie aother witne ere					', '2012-01-08 21:53:20', 62, 1, 0),
(2, 24, 'put in some data here.\r\nwhat is wrong with this data\r\nanother set of details here\r\nin that case will it work', '2012-01-08 22:00:29', 62, 0, 0),
(3, 24, 'another will thie notere', '2012-01-08 22:24:17', 62, 0, 0),
(4, 50, 'if this is not right then fix it\r\nthere is more\r\nagain inside the mater\r\nmore details\r\nanother one', '2012-01-09 07:06:33', 62, 99, 0),
(5, 50, 'simple note hser\nonly for me', '2012-01-09 07:36:07', 62, 1, 0),
(6, 47, 'release the activist. by bob brown', '2012-01-11 06:31:47', 62, 1, 0),
(7, 49, 'custom vessel', '2012-01-11 07:33:41', 62, 0, 0),
(8, 48, 'this has been a bad day.\r\nevery cloud has a silver lining.\r\nanother line.', '2012-01-14 12:47:42', 62, 0, 0),
(9, 48, 'Canadian like to be alone.\r\nI have karate lessons', '2012-01-14 12:48:47', 62, 0, 0),
(10, 48, 'Added a new note wonder what will happen', '2012-01-15 07:53:30', 62, 1, 0),
(11, 48, '', '2012-01-15 07:53:51', 62, 99, 0),
(12, 50, 'Downgrade the credit ratings', '2012-01-15 08:17:06', 62, 0, 0),
(13, 50, 'Eurozone slapped', '2012-01-15 08:17:30', 62, 0, 0),
(14, 50, 'space ship first', '2012-01-15 18:00:12', 62, 1, 0),
(15, 50, 'place the man in the can', '2012-01-15 18:00:24', 62, 0, 0),
(16, 50, 'teebow', '2012-01-17 05:44:09', 62, 0, 0),
(17, 45, 'I have been wondering when this is going to get approved', '2012-01-30 05:45:50', 62, 1, 0),
(18, 45, 'I hope this gets through with out much trouble', '2012-01-30 05:46:41', 62, 0, 0),
(19, 45, 'finally the rain will stop on the gold coast today', '2012-01-30 05:47:10', 62, 0, 0),
(20, 44, 'I get a good feeing', '2012-03-24 10:36:13', 62, 1, 0),
(21, 21, 'some silly notes here', '2012-05-27 19:46:09', 62, 0, 0),
(22, 44, 'Love Boat is on channel 11.\nAce sits in for tim westwood on 1xtra', '2012-06-05 02:48:11', 62, 0, 0),
(23, 44, 'Plane crash in Nigeria.\nGoodluck Jonathan declares 3 days of morning.\nRBA meets today.', '2012-06-05 02:49:30', 62, 0, 0),
(24, 44, 'Watching ABC News 24\nListening to Movado', '2012-06-05 03:02:34', 62, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_payments`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_payments` (
  `payment_id` int(11) NOT NULL auto_increment,
  `member_id` int(11) default NULL,
  `payment_method` varchar(30) default NULL,
  `payment_transact_no` varchar(30) default NULL,
  `payment_status` varchar(30) default NULL,
  `payment_date` date default NULL,
  `payment_season` year(4) default NULL,
  `payment_desc` varchar(30) default NULL,
  `payment_notes` varchar(512) default NULL,
  `payment_amount` int(11) default NULL,
  `created` datetime default NULL,
  `created_by` int(11) default NULL,
  PRIMARY KEY  (`payment_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `qjogz_clubreg_payments`
--

INSERT INTO `qjogz_clubreg_payments` (`payment_id`, `member_id`, `payment_method`, `payment_transact_no`, `payment_status`, `payment_date`, `payment_season`, `payment_desc`, `payment_notes`, `payment_amount`, `created`, `created_by`) VALUES
(1, 43, '0', '3654', 'pending', '2011-12-11', NULL, 'regfees', 'another notes', 12000, '2011-12-11 21:12:33', 62),
(2, 44, 'creditcard', '90888', 'checked', '2011-12-01', NULL, 'regfees', 'some clothes', 12400, '2011-12-11 21:37:25', 62),
(3, 44, 'cash', '8934-90', 'checked', '2011-12-02', NULL, 'kit', 'boots - Size 91', 5000, '2011-12-11 22:13:35', 62),
(4, 34, 'cash', '9876', 'checked', '2011-12-01', NULL, 'regfees', 'Nice looking kid', 12500, '2011-12-12 05:57:09', 62),
(5, 34, 'creditcard', '89777', 'pending', '2011-12-12', NULL, 'kit', '', 16300, '2011-12-12 06:35:56', 62),
(6, 37, 'creditcard', '65888', 'pending', '2011-12-12', NULL, 'regfees', 'some notes should be here', 3600, '2011-12-12 06:37:00', 62),
(7, 13, 'creditcard', '2548777', 'checked', '2011-12-13', NULL, 'regfees', '', 12500, '2011-12-13 05:55:34', 62),
(13, 14, 'creditcard', '9384343', 'pending', '2011-12-15', NULL, '', '', 0, '2011-12-15 07:26:56', 62),
(14, 32, 'creditcard', '2455', 'pending', '2011-12-15', NULL, 'regfees', '', 12000, '2011-12-15 22:52:52', 62),
(15, 20, 'cash', '45-9344-0', 'pending', '2011-12-15', NULL, 'regfees', '', 12000, '2011-12-15 22:54:33', 62),
(16, 24, 'creditcard', '14588', 'checked', '2011-12-21', NULL, 'regfees', '', 8700, '2011-12-21 07:14:26', 62),
(17, 50, 'creditcard', '9454545', 'checked', '2012-01-09', NULL, 'regfees', 'what is the matter', 34000, '2012-01-09 07:00:48', 62),
(18, 47, 'creditcard', '876655', 'pending', '2012-01-11', NULL, 'regfees', '', 27000, '2012-01-11 06:31:25', 62),
(19, 48, 'creditcard', '98343434', 'checked', '2012-01-14', 2012, 'regfees', 'what is the matter with the payment method', 3493, '2012-01-14 13:06:41', 62),
(20, 48, 'creditcard', '8374343', 'pending', '2012-01-14', 2011, 'playingkit', 'calm your self', 35000, '2012-01-14 13:07:09', 62),
(21, 45, 'creditcard', '874555', 'pending', '2012-01-30', NULL, 'regfees', 'One more kid', 8734, '2012-01-30 05:42:22', 62),
(22, 45, 'cash', '34343', 'checked', '2012-01-30', NULL, 'playingkit', 'Paid for shoes, shirts but not socks', 9832, '2012-01-30 05:43:10', 62),
(23, 50, 'cash', '4545', 'checked', '2012-06-03', NULL, 'regfees', '', 6500, '2012-06-03 10:12:46', 62),
(24, 44, 'creditcard', '934343', 'checked', '2012-06-05', NULL, 'playingkit', 'RBA will stay put', 30000, '2012-06-05 03:03:20', 62),
(25, 49, 'creditcard', '343434', 'pending', '2012-06-23', 2011, 'regfees', 'some notes here', 20000, '2012-06-23 05:12:19', 62),
(26, 43, 'cash', '8785-985', 'checked', '2012-06-25', 2012, 'september_dues', '', 20000, '2012-06-25 14:12:31', 62);

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_registeredmembers`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_registeredmembers` (
  `member_id` int(11) NOT NULL auto_increment,
  `memberid` varchar(50) default ' ' COMMENT 'Member Club Id Number',
  `memberlevel` varchar(50) default ' ' COMMENT 'Member Club level',
  `surname` varchar(30) default NULL,
  `givenname` varchar(30) default NULL,
  `mobile` varchar(30) default NULL,
  `address` varchar(50) default NULL,
  `suburb` varchar(30) default NULL,
  `postcode` varchar(30) default NULL,
  `phoneno` varchar(30) default NULL,
  `emailaddress` varchar(30) default NULL,
  `send_news` tinyint(4) default NULL,
  `dob` date default NULL,
  `group` int(11) default NULL,
  `subgroup` int(11) default '-1',
  `as_above` tinyint(4) default NULL,
  `gender` varchar(6) default NULL,
  `created` datetime default NULL,
  `created_by` int(11) default NULL,
  `approved` datetime default NULL,
  `approved_by` int(11) default NULL,
  `year_registered` varchar(30) default NULL,
  `member_status` varchar(30) default NULL,
  `parent_id` int(11) default NULL,
  `playertype` varchar(11) default NULL,
  `eoi_id` int(11) default NULL,
  PRIMARY KEY  (`member_id`),
  KEY `parent_id` (`parent_id`),
  KEY `group` (`group`),
  KEY `gender` (`gender`),
  KEY `playertype` (`playertype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `qjogz_clubreg_registeredmembers`
--

INSERT INTO `qjogz_clubreg_registeredmembers` (`member_id`, `memberid`, `memberlevel`, `surname`, `givenname`, `mobile`, `address`, `suburb`, `postcode`, `phoneno`, `emailaddress`, `send_news`, `dob`, `group`, `subgroup`, `as_above`, `gender`, `created`, `created_by`, `approved`, `approved_by`, `year_registered`, `member_status`, `parent_id`, `playertype`, `eoi_id`) VALUES
(10, '254-098', 'amatuer', 'Antone', 'Leyton', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2012-06-28', 1, 4, -1, 'male', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, '2012', 'registered', 9, 'junior', 2),
(9, ' ', ' ', 'Antone', 'Omo', '', 'Springvalley street', 'Oxenford', '4209', '', 'antone@hotmail.com', -1, '0000-00-00', -1, -1, -1, '-1', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, NULL, 'registered', NULL, 'guardian', 1),
(8, ' ', ' ', 'Andrew', '3000', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2007-06-12', 1, 4, -1, 'female', '2011-11-05 19:25:09', 62, '2011-11-05 19:25:09', 62, '2012', 'registered', 6, 'junior', 22),
(7, ' ', ' ', 'please', 'work', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 1, -1, -1, 'male', '2011-11-05 19:25:09', 62, '2011-11-05 19:25:09', 62, '2012', 'registered', 6, 'junior', 21),
(6, ' ', ' ', 'Mike', 'Andrew', '', 'Ray White Complex', 'Labrador', '4215', '', 'mike@hotmail.com', 0, '0000-00-00', -1, -1, -1, '-1', '2011-11-05 19:25:09', 62, '2011-11-05 19:25:09', 62, NULL, 'registered', NULL, 'guardian', 20),
(11, ' ', ' ', 'Antone', 'Dylan', '-1', '-1', '-1', '-1', '-1', '-1', -1, '0000-00-00', 1, -1, -1, 'male', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, '2012', 'registered', 9, 'junior', 3),
(12, ' ', ' ', 'Samson', 'Nicky', '', 'Preston Cresent', 'Coomera', '4209', '', 'nicky@hotmail.com', -1, '0000-00-00', -1, -1, -1, '-1', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, NULL, 'registered', NULL, 'guardian', 5),
(13, ' ', ' ', 'Samson', 'Jamie', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2007-07-19', 1, 6, -1, 'female', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, '2012', 'registered', 12, 'junior', 6),
(14, ' ', ' ', 'Samson', 'Aston', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2011-03-13', 1, 4, -1, 'male', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, '2012', 'registered', 12, 'junior', 7),
(15, ' ', ' ', 'Brenden', 'Standlaw', '09343434', 'Helense Place', 'St Helensvale', '4214', '043934322', 'brenden@hotmail.com.au', 0, '0000-00-00', -1, -1, -1, '-1', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, NULL, 'registered', NULL, 'guardian', 12),
(16, '239-1122', 'elite', 'Ellen', 'Standlaw 1', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2007-11-13', 1, 4, -1, 'female', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, '2012', 'registered', 15, 'junior', 13),
(17, ' ', ' ', 'Charly', 'Standlaw', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2010-05-07', 1, 4, -1, 'female', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, '2012', 'registered', 15, 'junior', 14),
(18, ' ', ' ', 'Victoria', 'Standlaw', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2011-05-19', -1, -1, -1, 'female', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, '2012', 'registered', 15, 'junior', 15),
(19, ' ', ' ', 'Micheal', 'Andrew', '', '', '', '', '', 'mike@hotmail.com', -1, '0000-00-00', -1, -1, -1, '-1', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, NULL, 'registered', NULL, 'guardian', 23),
(20, ' ', ' ', 'Trey', 'Song', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2011-10-26', 1, -1, -1, 'male', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, '2012', 'registered', 19, 'junior', 24),
(21, ' ', ' ', 'Clifton', 'Bell', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2011-10-04', 1, -1, -1, 'male', '2011-11-05 19:38:15', 62, '2011-11-05 19:38:15', 62, '2012', 'registered', 19, 'junior', 25),
(22, ' ', ' ', 'Agbagbara', 'Omokhoa', '04139034333', 'unit 3 olsen ave', 'labrador gold coast', '4209''s', '0413923557', 'simple@hotmail.com.au', -1, '0000-00-00', 15, -1, -1, 'male', '2011-11-05 19:38:30', 62, '2011-11-05 19:38:30', 62, NULL, 'registered', NULL, 'senior', 4),
(23, '78-98-22', 'elite', 'Samuels', 'Jamar', '07550987', '22 Venessa Ave', 'Springward', '4231', '0412908700', 'kekeominu@yahoo.co.uk', -1, '0000-00-00', 2, 11, -1, 'female', '2011-11-05 19:38:30', 62, '2011-11-05 19:38:30', 62, '2011', 'registered', NULL, 'senior', 8),
(24, '54343-888', 'amatuer', 'Brandist', 'Pauline', '041390233', 'meadowbrook', 'meakin', '4131', '041390233', 'ok_agbagbara@hotmail.com.au', -1, '0000-00-00', 2, 12, -1, 'female', '2011-11-05 19:38:30', 62, '2011-11-05 19:38:30', 62, '2011', 'registered', NULL, 'senior', 9),
(30, ' ', ' ', 'Antone', 'Ese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-10-28', -1, -1, NULL, 'male', '2011-11-16 06:04:04', 62, NULL, NULL, '2012', 'registered', 6, 'junior', NULL),
(31, ' ', ' ', 'Jessie', 'Jay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-11-23', 1, 5, NULL, 'female', '2011-11-18 05:46:47', 62, NULL, NULL, '2012', 'registered', 12, 'junior', NULL),
(27, ' ', ' ', 'Niel', 'Henry', '', 'West Point', 'Island Road', '3022', '', 'niel@yahoo7.com.au', 1, NULL, 15, -1, NULL, 'male', '2011-11-15 06:53:51', 62, NULL, NULL, '2006', 'registered', NULL, 'senior', NULL),
(32, '973.9934', 'amatuer', 'Ray', 'White', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-11-06', 1, 4, NULL, 'male', '2011-11-30 06:18:28', 62, NULL, NULL, '2012', 'registered', 6, 'junior', NULL),
(33, ' ', ' ', 'Another', 'Kid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-28', 1, 5, NULL, 'female', '2011-12-03 04:39:34', 62, NULL, NULL, '2012', 'registered', 12, 'junior', NULL),
(34, ' ', 'elite', 'Wretch', 'Thirty Two', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-07-10', 1, 5, NULL, 'male', '2011-12-03 05:44:15', 62, NULL, NULL, '2013', 'registered', 19, 'junior', NULL),
(35, ' ', 'elite', 'Chipmunk', 'Jam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', 1, 5, NULL, 'male', '2011-12-03 05:44:43', 62, NULL, NULL, '2013', 'registered', 15, 'junior', NULL),
(36, ' ', ' ', 'Producer', 'James', '03654111', 'BBC 1xtra', 'Thames House', '898777', '041369877', 'james@hotmail.com.au', 0, '0000-00-00', -1, -1, -1, '-1', '2011-12-07 09:45:18', 62, '2011-12-07 09:45:18', 62, NULL, 'registered', NULL, 'guardian', 27),
(37, '-1', 'elite', 'James', 'Main', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2009-12-07', 1, 5, -1, 'female', '2011-12-07 09:45:18', 62, '2011-12-07 09:45:18', 62, '2013', 'registered', 36, 'junior', 28),
(38, '2349-098', 'amatuer', 'James', 'Sub', '-1', '-1', '-1', '-1', '-1', '-1', -1, '2007-12-03', 1, 4, -1, 'male', '2011-12-07 09:45:18', 62, '2011-12-07 09:45:18', 62, '2012', 'registered', 36, 'junior', 29),
(43, 'another', '0', 'James', 'May 6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-14', 1, -1, NULL, 'male', '2011-12-07 12:05:22', 62, NULL, NULL, '2012', 'registered', 36, 'junior', NULL),
(44, ' ', 'amatuer', 'Simple', 'Plan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-06', 1, 4, NULL, 'male', '2011-12-11 19:05:46', 62, NULL, NULL, '2012', 'registered', 12, 'junior', NULL),
(45, '-1', 'amatuer', 'Design', 'People', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-28', 1, 4, NULL, 'male', '2011-12-18 18:04:51', 62, NULL, NULL, '2012', 'registered', 19, 'junior', NULL),
(46, ' ', ' ', 'Christopher', 'Ekhator', '01453658', 'Iyama', 'Benin City', '50000', '0413698555', 'chris@hotmail.com', 0, NULL, NULL, -1, NULL, NULL, '2011-12-18 18:17:44', 62, NULL, NULL, NULL, 'registered', NULL, 'guardian', NULL),
(47, '098-2322', 'elite', 'Ekhator', 'Cyril', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1976-09-20', 1, 6, NULL, 'male', '2011-12-18 18:17:44', 62, NULL, NULL, '2012', 'registered', 19, 'junior', NULL),
(48, '-1', '-1', 'Ikumbor', 'Osas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-28', 1, 4, NULL, 'female', '2011-12-18 18:17:44', 62, NULL, NULL, '2012', 'registered', 46, 'junior', NULL),
(49, '874', 'amatuer', 'omoruyi', 'mike', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-10-23', 1, 4, NULL, 'male', '2011-12-24 04:32:09', 62, NULL, NULL, '2012', 'registered', 46, 'junior', NULL),
(50, '90343844', 'amatuer', 'Alleno', 'Steven', '', '', '', '3012', '', 'nimble@deltastateonline.com', 1, NULL, 2, 12, NULL, 'male', '2012-01-02 06:11:27', 62, NULL, NULL, '2012', 'registered', NULL, 'senior', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_saved_comms`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_saved_comms` (
  `comm_id` int(11) NOT NULL auto_increment,
  `template_id` int(11) NOT NULL,
  `comm_groups` tinytext NOT NULL,
  `comm_subject` tinytext NOT NULL,
  `comm_message` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `comm_status` tinyint(4) NOT NULL default '0',
  `sent_date` datetime default '0000-00-00 00:00:00',
  `sent_by` int(11) default '0',
  PRIMARY KEY  (`comm_id`),
  KEY `template_id` (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='store saved communications' AUTO_INCREMENT=17 ;

--
-- Dumping data for table `qjogz_clubreg_saved_comms`
--

INSERT INTO `qjogz_clubreg_saved_comms` (`comm_id`, `template_id`, `comm_groups`, `comm_subject`, `comm_message`, `created`, `created_by`, `comm_status`, `sent_date`, `sent_by`) VALUES
(5, 1, '2', 'Thank you for registrating with us', 'Dear Member\r\nThank you for registering with {club_name}.\r\nA team member will get in touch with you in a few days.\r\nBest Regards.\r\n{Sender}', '2012-05-29 06:20:37', 62, 0, '0000-00-00 00:00:00', 0),
(6, 1, '2', 'Thank you for registrating with us', '<p>Dear Member</p>\r\n<p>Thank you for registering with {club_name}.</p>\r\n<p>A team member will get in touch with you in a few days.</p>\r\n<p>Best Regards. {Sender}</p>', '2012-06-09 05:01:21', 62, 1, '2012-06-14 13:57:21', 62),
(7, 1, '14', 'Thank you for registrating with us', 'Dear Member\r\nThank you for registering with {club_name}.\r\nA team member will get in touch with you in a few days.\r\nBest Regards.\r\n{Sender}', '2012-05-29 06:39:38', 62, 0, '0000-00-00 00:00:00', 0),
(8, 1, '14', 'Thank you for registrating with us', 'Dear Member\r\nThank you for registering with {club_name}.\r\nA team member will get in touch with you in a few days.\r\nBest Regards.\r\n{Sender}', '2012-05-29 06:40:04', 62, 0, '0000-00-00 00:00:00', 0),
(9, 1, '14', 'Thank you for registrating with us', 'Dear Member\r\nThank you for registering with {club_name}.\r\nA team member will get in touch with you in a few days.\r\nBest Regards.\r\n{Sender}', '2012-05-29 06:42:26', 62, 0, '0000-00-00 00:00:00', 0),
(10, 1, '14', 'Thank you for registrating with us', 'Dear Member\r\nThank you for registering with {club_name}.\r\nA team member will get in touch with you in a few days.\r\nBest Regards.\r\n{Sender}', '2012-05-29 06:42:54', 62, 0, '0000-00-00 00:00:00', 0),
(11, 1, '14', 'Thank you for registrating with us', 'Dear Member\r\nThank you for registering with {club_name}.\r\nA team member will get in touch with you in a few days.\r\nBest Regards.\r\n{Sender}', '2012-05-29 06:43:38', 62, 0, '0000-00-00 00:00:00', 0),
(12, 1, '14', 'Thank you for registrating with us', 'Dear Member\r\nThank you for registering with {club_name}.\r\nA team member will get in touch with you in a few days.\r\nBest Regards.\r\n{Sender}', '2012-05-29 06:43:48', 62, 0, '0000-00-00 00:00:00', 0),
(13, 4, '', 'Expression Of Interest', 'Thank you for registering your expression of interest.\r\nOne of our team leaders will get back to you in due course.\r\nIf you have further enquiries please feel free to contact us, using our contact form.\r\nYours Truly\r\nSite Administrator', '2012-05-29 06:48:29', 62, 0, '0000-00-00 00:00:00', 0),
(14, 5, '2', 'URGENT MESSAGE RE PRESENTATION', '<h1>ATTENTION ALL SQUIRTZ &amp; SSG PLAYERS</h1>\r\n<h2>WE REGRET TO INFORM YOU THAT THE RESCHEDULED PRESENTATION/ROUND ROBIN EVENT SET DOWN FOR THE 28TH AUGUST IS TO BE CANCELLED DUE TO THE PRESENT &amp; FORECASTED WEEKEND WEATHER CONDITIONS.</h2>\r\n<p>We understand how difficult &amp; frustrating these changes are &amp; therefore, to avoid any further disappointment, we are seeking to organise an indoor venue to hold the presentation regardless of the weather.</p>\r\n<p>These details will be posted as soon as we are able to finalise them.</p>\r\n<p>Again, we apologise for the inconvenience caused.</p>', '2012-05-29 06:50:22', 62, 0, '0000-00-00 00:00:00', 0),
(15, 1, '2,14,1', 'Some simple email', '<p> </p>\r\n<div class="moz-text-html" lang="x-unicode">\r\n<table border="0" cellspacing="0" cellpadding="0" width="100%">\r\n<tbody>\r\n<tr>\r\n<td align="left" valign="middle"><span style="font-family: arial; font-size: 9.5pt; font-weight: bold;">Daily White Papers and Webcasts</span><br /><span style="font-family: arial; font-size: 8pt; font-weight: bold;">May 28, 2012</span></td>\r\n<td align="right" valign="middle"><img src="http://images.bitpipe.com/common/images/service_of_bp.gif" border="0" alt="A service of Bitpipe.com" title="A service of Bitpipe.com" align="middle" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<br /><span style="font-family: arial; font-size: 8pt; font-weight: normal;">Daily white papers, case studies, webcasts and product information on the topics you are interested in. <br /></span><br /><br /><span style="font-family: arial; font-size: 9pt; font-weight: normal;"><a href="http://go.techtarget.com/r/17480395/12963826/1"><span style="text-decoration: underline;"><span style="color: #0066cc;">The Top 10 Technical Considerations for Evaluating E-Commerce Platforms</span></span></a><br /></span><span style="font-style: italic; font-family: arial; font-size: 8pt; font-weight: normal;">by Oracle Corporation</span> <br /><span style="font-family: arial; font-size: 8pt; font-weight: normal;">This paper offers ten considerations to help guide the selection criteria for your next e-commerce platform - which should ideally be the last e-commerce platform you would ever need to buy. Continue reading to learn these two technical considerations for evaluating e-commerce platforms. </span><br /><br /><span style="font-family: arial; font-size: 9pt; font-weight: normal;"><a href="http://go.techtarget.com/r/17480581/12963826/2"><span style="text-decoration: underline;"><span style="color: #0066cc;">Emerging PaaS security tactics</span></span></a><br /></span><span style="font-style: italic; font-family: arial; font-size: 8pt; font-weight: normal;">by HP Enterprise Security</span> <br /><span style="font-family: arial; font-size: 8pt; font-weight: normal;">Like all other cloud deployments, PaaS introduces some security concerns because of underlying security features that are beyond the customer’s control. This e-guide explores these challenges and lists security areas that can affect the risk profile of deployed applications, as well as offers key advice for mitigating risk. </span><br /><br /><span style="font-family: arial; font-size: 9pt; font-weight: normal;"><a href="http://go.techtarget.com/r/17480300/12963826/3"><span style="text-decoration: underline;"><span style="color: #0066cc;">Maintaining wireless network availability in hospitals</span></span></a><br /></span><span style="font-style: italic; font-family: arial; font-size: 8pt; font-weight: normal;">by SearchHealthIT.com</span> <br /><span style="font-family: arial; font-size: 8pt; font-weight: normal;">This eBook provides health care organizations with relevant information regarding WANS, LANS, mobile broadband, making machine-to-machine connections, adding bandwidth for tomorrow, and tech policies that will ensure the success of your facility. </span><br /><br /><span style="font-family: arial; font-size: 9pt; font-weight: normal;"><a href="http://go.techtarget.com/r/17480659/12963826/4"><span style="text-decoration: underline;"><span style="color: #0066cc;">IDC Case Study: Optimizing eCommerce Decisions at TIAA-CREF</span></span></a><br /></span><span style="font-style: italic; font-family: arial; font-size: 8pt; font-weight: normal;">by Oracle Corporation</span> <br /><span style="font-family: arial; font-size: 8pt; font-weight: normal;">This IDC case study examines the benefits TIAA-CREF, a Fortune 100 financial services firm, gained from automating their eCommerce marketing. By deploying Oracle Real-Time Decisions, TIAA-CREF was able to apply intelligent process automation to customize online customer interactions. </span><br /><br /><br />\r\n<hr width="100%" size="3" />\r\n<span style="font-family: arial; font-size: 11px; font-weight: normal;"><br />ABOUT THIS E-NEWSLETTER<br />This newsletter is published by Bitpipe.com, part of the TechTarget network. TechTarget provides IT professionals with the resources they need to perform their jobs: Web sites, newsletters, forums, blogs, white papers, webcasts, events and more.<br /><br />Copyright 2012 TechTarget. All rights reserved. Designated trademarks and brands are the property of their respective owners.<br /><br /><a href="http://myka.bitpipe.com/myka-web/unsubscribe/verify?unsubscribeCode=ef6fd18c7e036b36b2a9a3985d139236&amp;token=1260575&amp;userEmailInstanceId=6ca6dc450b6e46aa95006776790f135d&amp;upid=1421178"><span style="text-decoration: underline;"><span style="color: #0066cc;">Unsubscribe from this newsletter</span></span></a> <br />NOTE: This will not affect any other subscriptions you have signed up for.<br /><br />TechTarget, Member Services, 275 Grove Street, Newton, MA 02466<br />Contact: Webmaster@techtarget.com<br /><br />When you access content from this newsletter, your information may be shared with the sponsors or future sponsors of that content as described in our <a href="http://www.techtarget.com/html/privacy_policy.html"><span style="text-decoration: underline;"><span style="color: #0066cc;">Privacy Policy</span></span></a> .<br /><br /></span><img src="http://go.techtarget.com/clear.jpg?g=345172&amp;u=12963826" border="0" width="1" height="1" /></div>', '2012-05-29 06:53:03', 62, 0, '0000-00-00 00:00:00', 0),
(16, 5, '2,14', 'Added Today', '<h1>ATTENTION ALL SQUIRTZ &amp; SSG PLAYERS</h1>\r\n<h2>WE REGRET TO INFORM YOU THAT THE RESCHEDULED PRESENTATION/ROUND ROBIN EVENT SET DOWN FOR THE 28TH AUGUST IS TO BE CANCELLED DUE TO THE PRESENT &amp; FORECASTED WEEKEND WEATHER CONDITIONS.</h2>\r\n<p>We understand how difficult &amp; frustrating these changes are &amp; therefore, to avoid any further disappointment, we are seeking to organise an indoor venue to hold the presentation regardless of the weather.</p>\r\n<p>These details will be posted as soon as we are able to finalise them.</p>\r\n<p>Again, we apologise for the inconvenience caused.</p>\r\n<p>{sender}</p>\r\n<p>{sitename}</p>\r\n<p>%sitename%</p>', '2012-06-18 05:38:19', 62, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_stats_details`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_stats_details` (
  `member_id` int(11) NOT NULL,
  `stats_date` date NOT NULL,
  `stats_detail` varchar(64) NOT NULL,
  `stats_value` varchar(512) NOT NULL,
  PRIMARY KEY  (`member_id`,`stats_date`,`stats_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stats details';

--
-- Dumping data for table `qjogz_clubreg_stats_details`
--

INSERT INTO `qjogz_clubreg_stats_details` (`member_id`, `stats_date`, `stats_detail`, `stats_value`) VALUES
(10, '2012-07-27', 'stats_attendance', 'No'),
(10, '2012-07-27', 'stats_lap_time', '2'),
(10, '2012-07-27', 'stats_medals', 'gold'),
(10, '2012-07-27', 'stats_shots_made', ''),
(16, '2012-08-05', 'stats_attendance', 'Yes'),
(16, '2012-08-05', 'stats_lap_time', '1.54'),
(16, '2012-08-05', 'stats_medals', 'gold'),
(16, '2012-08-05', 'stats_shots_made', '9'),
(32, '2012-07-27', 'stats_attendance', '-1'),
(32, '2012-07-27', 'stats_lap_time', '1'),
(32, '2012-07-27', 'stats_medals', 'gold'),
(32, '2012-07-27', 'stats_shots_made', ''),
(32, '2012-08-04', 'stats_attendance', 'No'),
(32, '2012-08-04', 'stats_lap_time', '1:30'),
(32, '2012-08-04', 'stats_medals', 'gold'),
(32, '2012-08-04', 'stats_shots_made', '10'),
(34, '2012-08-05', 'stats_attendance', 'No'),
(34, '2012-08-05', 'stats_lap_time', '2.00'),
(34, '2012-08-05', 'stats_medals', 'silver'),
(34, '2012-08-05', 'stats_shots_made', '7'),
(35, '2012-08-05', 'stats_attendance', 'Yes'),
(35, '2012-08-05', 'stats_lap_time', '3.09'),
(35, '2012-08-05', 'stats_medals', 'bronze'),
(35, '2012-08-05', 'stats_shots_made', '3'),
(37, '2012-08-05', 'stats_attendance', 'Maybe'),
(37, '2012-08-05', 'stats_lap_time', '3.15'),
(37, '2012-08-05', 'stats_medals', 'ribbon'),
(37, '2012-08-05', 'stats_shots_made', '23'),
(38, '2012-07-27', 'stats_attendance', 'Yes'),
(38, '2012-07-27', 'stats_lap_time', '3'),
(38, '2012-07-27', 'stats_medals', 'silver'),
(38, '2012-07-27', 'stats_shots_made', ''),
(44, '2012-07-27', 'stats_attendance', 'Yes'),
(44, '2012-07-27', 'stats_lap_time', '4.6'),
(44, '2012-07-27', 'stats_medals', 'bronze'),
(44, '2012-07-27', 'stats_shots_made', ''),
(44, '2012-08-01', 'stats_attendance', 'Yes'),
(44, '2012-08-01', 'stats_lap_time', ''),
(44, '2012-08-01', 'stats_shots_made', ''),
(44, '2012-08-05', 'stats_attendance', 'No'),
(44, '2012-08-05', 'stats_lap_time', '5'),
(44, '2012-08-05', 'stats_shots_made', '3'),
(44, '2012-08-23', 'stats_attendance', 'Maybe'),
(44, '2012-08-23', 'stats_lap_time', '6'),
(44, '2012-08-23', 'stats_shots_made', '4'),
(45, '2012-07-27', 'stats_attendance', '-1'),
(45, '2012-07-27', 'stats_lap_time', '3'),
(45, '2012-07-27', 'stats_medals', 'ribbon'),
(45, '2012-07-27', 'stats_shots_made', ''),
(45, '2012-07-28', 'stats_attendance', 'Yes'),
(45, '2012-07-28', 'stats_lap_time', '15'),
(45, '2012-07-28', 'stats_shots_made', '5'),
(47, '2012-08-05', 'stats_attendance', 'Yes'),
(47, '2012-08-05', 'stats_lap_time', '5.00'),
(47, '2012-08-05', 'stats_medals', 'ribbon'),
(47, '2012-08-05', 'stats_shots_made', '3'),
(48, '2012-07-27', 'stats_attendance', 'Maybe'),
(48, '2012-07-27', 'stats_lap_time', '5.4'),
(48, '2012-07-27', 'stats_medals', 'ribbon'),
(48, '2012-07-27', 'stats_shots_made', '32'),
(49, '2012-07-07', 'stats_attendance', 'Yes'),
(49, '2012-07-07', 'stats_lap_time', ''),
(49, '2012-07-07', 'stats_shots_made', '5'),
(49, '2012-07-21', 'stats_attendance', 'Yes'),
(49, '2012-07-21', 'stats_lap_time', ''),
(49, '2012-07-21', 'stats_shots_made', '10'),
(49, '2012-07-27', 'stats_attendance', 'Yes'),
(49, '2012-07-27', 'stats_lap_time', '2.8'),
(49, '2012-07-27', 'stats_medals', 'bronze'),
(49, '2012-07-27', 'stats_shots_made', ''),
(50, '2012-07-21', 'stats_attendance', 'No'),
(50, '2012-07-21', 'stats_lap_time', ''),
(50, '2012-07-21', 'stats_shots_made', ''),
(50, '2012-07-28', 'stats_attendance', 'Yes'),
(50, '2012-07-28', 'stats_lap_time', ''),
(50, '2012-07-28', 'stats_shots_made', ''),
(50, '2012-08-04', 'stats_attendance', 'Yes'),
(50, '2012-08-04', 'stats_lap_time', ''),
(50, '2012-08-04', 'stats_shots_made', '');

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_tags`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_tags` (
  `tag_id` int(11) NOT NULL auto_increment,
  `tag_text` varchar(30) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_date` date NOT NULL,
  `created_time` time NOT NULL,
  `createdby` int(11) NOT NULL,
  PRIMARY KEY  (`tag_id`),
  UNIQUE KEY `tag_text` (`tag_text`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `qjogz_clubreg_tags`
--

INSERT INTO `qjogz_clubreg_tags` (`tag_id`, `tag_text`, `published`, `created_date`, `created_time`, `createdby`) VALUES
(1, 'blue ball', 1, '2012-02-26', '12:08:37', 62),
(2, 'striker', 1, '2012-02-26', '12:59:33', 62),
(3, 'player', 1, '2012-02-26', '13:01:13', 62),
(4, 'paper', 1, '2012-02-26', '13:02:57', 62),
(5, 'paper4', 1, '2012-02-26', '13:03:12', 62),
(6, 'white', 1, '2012-02-26', '13:38:35', 62),
(7, 'whiter', 1, '2012-02-26', '13:38:55', 62),
(8, 'green', 1, '2012-02-26', '13:40:48', 62),
(9, 'what', 1, '2012-02-26', '13:56:21', 62),
(10, 'ignore', 1, '2012-02-26', '13:57:30', 62),
(11, 'pleas', 1, '2012-02-26', '13:58:34', 62),
(12, 'work', 1, '2012-02-26', '13:59:44', 62),
(13, 'essex', 1, '2012-02-26', '14:04:11', 62),
(14, 'girly', 1, '2012-02-26', '14:07:36', 62),
(15, 'credit card', 1, '2012-02-26', '14:33:20', 62),
(16, 'toad', 1, '2012-02-26', '14:33:41', 62),
(17, 'white man', 1, '2012-02-26', '16:43:03', 62),
(18, 'crap', 1, '2012-02-26', '16:49:11', 62),
(19, 'andrew black', 1, '2012-02-26', '17:08:06', 62),
(20, 'kristy white', 1, '2012-02-26', '17:48:39', 62);

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_tags_players`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_tags_players` (
  `tag_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY  (`tag_id`,`member_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qjogz_clubreg_tags_players`
--

INSERT INTO `qjogz_clubreg_tags_players` (`tag_id`, `member_id`) VALUES
(1, 23),
(1, 37),
(1, 43),
(1, 45),
(1, 48),
(2, 23),
(2, 31),
(2, 44),
(3, 23),
(3, 31),
(3, 44),
(3, 49),
(4, 23),
(4, 44),
(5, 23),
(5, 44),
(5, 49),
(6, 23),
(6, 24),
(7, 13),
(8, 44),
(9, 23),
(9, 24),
(10, 23),
(10, 50),
(11, 23),
(11, 31),
(11, 44),
(13, 44),
(15, 23),
(15, 37),
(15, 50),
(16, 44),
(17, 13),
(18, 37),
(18, 48),
(18, 49),
(19, 43),
(19, 44),
(19, 45),
(20, 50);

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_teammembers`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_teammembers` (
  `joomla_id` int(11) NOT NULL,
  `status` int(11) NOT NULL default '1',
  `params` varchar(512) default NULL,
  PRIMARY KEY  (`joomla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qjogz_clubreg_teammembers`
--

INSERT INTO `qjogz_clubreg_teammembers` (`joomla_id`, `status`, `params`) VALUES
(62, 1, 'vieweoi=yes\nregistereoi=yes\ndeleteeoi=yes\nmanageusers=yes\nsendcommunication=yes\ndeletereg=yes'),
(63, 1, NULL),
(65, 0, NULL),
(67, 0, NULL),
(68, 1, 'vieweoi=no\nregistereoi=yes\ndeleteeoi=no\nmanageusers=yes\nsendcommunication=no\ndeletereg=no'),
(72, 1, NULL),
(75, 1, NULL),
(77, 1, 'vieweoi=no\nregistereoi=no\ndeleteeoi=no\nmanageusers=no\nsendcommunication=yes\ndeletereg=no'),
(78, 1, NULL),
(81, 0, NULL),
(82, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_teammembers_details`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_teammembers_details` (
  `joomla_id` int(11) NOT NULL,
  `member_detail` varchar(255) NOT NULL,
  `member_value` text NOT NULL,
  PRIMARY KEY  (`joomla_id`,`member_detail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qjogz_clubreg_teammembers_details`
--

INSERT INTO `qjogz_clubreg_teammembers_details` (`joomla_id`, `member_detail`, `member_value`) VALUES
(72, 'quote', 'Night air has the strangest feeling'),
(72, 'nicknames', 'Daily dose of Dubstep'),
(72, 'member_position', 'cub president'),
(72, 'member_number', '89787'),
(72, 'joining_date', 'sept 20 2011'),
(72, 'date_of_birth', '17/09/1976'),
(72, 'hometown', 'Bristol'),
(68, 'school_attending', 'University of Camper'),
(78, 'about', 'in a previous signs'),
(78, 'email_address', 'simple@hotmail.com.au'),
(68, 'date_of_birth', '19 August 1987'),
(62, 'residence', 'Some where in the east 12'),
(62, 'nicknames', 'You the man'),
(72, 'about', 'type in something here that is quite long so that it will be break into multi line'),
(72, 'residence', 'white''s another'),
(72, 'school_attending', 'university of hull'),
(72, 'email_address', 'mistajam@bbc.co.uk'),
(67, 'nationality', 'Nigerian'),
(75, 'residence', 'Upper Coomera'),
(75, 'school_attending', 'University Demonstration Secondary School'),
(75, 'quote', 'Tear Down these walls'),
(75, 'nicknames', 'Fine Boy No Pimples'),
(75, 'nationality', 'Nigerian'),
(75, 'member_position', 'Vice President'),
(75, 'member_number', 'SN 0993434'),
(75, 'leaving_date', 'August 19 2012'),
(75, 'joining_date', 'Sept 20 2011'),
(75, 'hometown', 'Asaba City'),
(75, 'height_weight', '6 foot, 250kg'),
(75, 'fave_player', 'Messi '),
(75, 'email_address', 'murder@hotmail.com.au'),
(75, 'date_of_birth', 'Sept 17 1987'),
(75, 'club_history', 'Long time member, Been very handy with the tools, also one of the best mentors'),
(75, 'about', 'Nothing to see here'),
(62, 'fave_player', 'Dane Swan'),
(62, 'height_weight', '6 foot, 250lbs'),
(62, 'member_number', 'SCN 9302762'),
(62, 'quote', 'I so wish you were here to see me succeed\r\n\r\nMore of this'),
(62, 'about', 'The CSS3 border-radius property allows web developers to easily utilise rounder corners in their design elements, without the need for corner images or the use of multiple div tags, and is perhaps one of the most talked about aspects of CSS3.\r\nSince first'),
(62, 'member_position', 'Vice president'),
(68, 'residence', 'Samoa'),
(68, 'quote', 'Money Pullup only, Rack on racks, stuffed in the mixers'),
(68, 'member_position', 'Vice President'),
(68, 'member_number', 'HY98766'),
(68, 'height_weight', '1.8m 250lbs'),
(68, 'joining_date', '1987'),
(68, 'email_address', 'nimble@deltastateonline.com'),
(62, 'email_address', 'simple@hotmail.com'),
(62, 'founding_member', 'no'),
(62, 'date_of_birth', '17/09/1976'),
(62, 'joining_date_month', '2'),
(62, 'joining_date_year', '32222'),
(62, 'leaving_date', '26/09/2012');

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_teammembers_groups`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_teammembers_groups` (
  `joomla_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`joomla_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qjogz_clubreg_teammembers_groups`
--

INSERT INTO `qjogz_clubreg_teammembers_groups` (`joomla_id`, `group_id`, `status`) VALUES
(62, 1, 1),
(62, 2, 1),
(62, 3, 0),
(62, 14, 0),
(62, 15, 0),
(62, 16, 0),
(63, 15, 1),
(65, 2, 0),
(65, 15, 0),
(67, 2, 0),
(67, 15, 0),
(68, 1, 1),
(68, 2, 1),
(68, 3, 1),
(68, 14, 1),
(68, 15, 1),
(72, 1, 0),
(72, 3, 1),
(72, 14, 1),
(75, 1, 1),
(75, 14, 1),
(75, 15, 1),
(75, 16, 1),
(77, 1, 1),
(77, 3, 1),
(77, 14, 1),
(78, 1, 0),
(78, 2, 0),
(78, 14, 0),
(78, 15, 0),
(78, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qjogz_clubreg_templates`
--

CREATE TABLE IF NOT EXISTS `qjogz_clubreg_templates` (
  `template_id` int(11) unsigned NOT NULL auto_increment,
  `template_name` varchar(255) NOT NULL default '',
  `template_subject` varchar(255) NOT NULL default '',
  `template_text` mediumtext NOT NULL,
  `template_ptext` mediumtext NOT NULL,
  `template_status` varchar(30) NOT NULL default '0',
  `template_type` int(11) unsigned NOT NULL default '0',
  `template_access` varchar(30) default NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(3) NOT NULL default '1',
  `ordering` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`template_id`),
  KEY `idx_temptype` (`template_type`),
  KEY `idx_tempstatus` (`template_status`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `qjogz_clubreg_templates`
--

INSERT INTO `qjogz_clubreg_templates` (`template_id`, `template_name`, `template_subject`, `template_text`, `template_ptext`, `template_status`, `template_type`, `template_access`, `created`, `created_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`) VALUES
(1, 'Registration Email', 'Thank you for registrating with us', '<p>Dear Member</p>\r\n<p>Thank you for registering with {club_name}.</p>\r\n<p>A team member will get in touch with you in a few days.</p>\r\n<p>Best Regards.</p>\r\n<p>{Sender}</p>', 'Dear Member\r\nThank you for registering with {club_name}.\r\nA team member will get in touch with you in a few days.\r\nBest Regards.\r\n{Sender}', 'new_template', 0, 'everyone', '2011-08-31 07:45:27', 62, 62, '2012-06-17 19:39:22', 1, 1, ''),
(2, 'template name wednesday', 'template subject wednesday', '<p>some kind of communication</p>\r\n<p><strong>another one here</strong></p>\r\n<p><strong>please let it work.</strong></p>\r\n<p>in the middle of the night</p>', 'some kind of communication\r\nanother one here\r\nplease let it work.\r\nin the middle of the night', 'active_template', 0, '-1', '2011-08-30 22:21:27', 62, 62, '2011-09-15 21:27:25', 0, 2, ''),
(3, 'Notice of Meeting', 'Next Meeting Invitation', '<p>Dear Member,</p>\r\n<p>A general meeting will be held on {} at {}</p>\r\n<p>Please endevour to attend because matters will be discussed.</p>\r\n<p>Best Regards</p>\r\n<p>General Secretary</p>', 'Dear Member,\r\nA general meeting will be held on {} at {}\r\nPlease endevour to attend because matters will be discussed.\r\nBest Regards\r\nGeneral Secretary', 'new_template', 0, 'team_members', '2011-09-04 18:23:50', 62, 62, '2012-06-17 19:20:19', 1, 3, ''),
(4, 'Expression Of Interest', 'Expression Of Interest', '<p>Thank you for registering your expression of interest.</p>\r\n<p>One of our team leaders will get back to you in due course.</p>\r\n<p>If you have further enquiries please feel free to contact us, using our contact form.</p>\r\n<p>Yours Truly</p>\r\n<p>Site Administrator</p>', 'Thank you for registering your expression of interest.\r\nOne of our team leaders will get back to you in due course.\r\nIf you have further enquiries please feel free to contact us, using our contact form.\r\nYours Truly\r\nSite Administrator', 'active_template', 0, 'everyone', '2011-10-04 06:40:33', 62, 62, '2012-06-17 19:19:34', 1, 4, ''),
(5, 'Urgent Email', 'URGENT MESSAGE RE PRESENTATION', '<h1>ATTENTION ALL SQUIRTZ & SSG PLAYERS</h1>\r\n<h2>WE REGRET TO INFORM YOU THAT THE RESCHEDULED PRESENTATION/ROUND ROBIN EVENT SET DOWN FOR THE 28TH AUGUST IS TO BE CANCELLED DUE TO THE PRESENT & FORECASTED WEEKEND WEATHER CONDITIONS.</h2>\r\n<p>We understand how difficult & frustrating these changes are & therefore, to avoid any further disappointment, we are seeking to organise an indoor venue to hold the presentation regardless of the weather.</p>\r\n<p>These details will be posted as soon as we are able to finalise them.</p>\r\n<p>Again, we apologise for the inconvenience caused.</p>', 'ATTENTION ALL SQUIRTZ & SSG PLAYERS\r\nWE REGRET TO INFORM YOU THAT THE RESCHEDULED PRESENTATION/ROUND ROBIN EVENT SET DOWN FOR THE 28TH AUGUST IS TO BE CANCELLED DUE TO THE PRESENT & FORECASTED WEEKEND WEATHER CONDITIONS.\r\nWe understand how difficult & frustrating these changes are & therefore, to avoid any further disappointment, we are seeking to organise an indoor venue to hold the presentation regardless of the weather.\r\nThese details will be posted as soon as we are able to finalise them.\r\nAgain, we apologise for the inconvenience caused.', 'active_template', 0, 'everyone', '2012-03-01 05:00:19', 62, 62, '2012-06-17 19:28:50', 1, 5, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
