-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2012 at 04:06 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `joomla_15_22`
--

-- --------------------------------------------------------

--
-- Table structure for table `l6fbk_simple_configs`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_configs` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_short` varchar(30) NOT NULL DEFAULT '',
  `config_text` text NOT NULL,
  `config_type` varchar(30) NOT NULL DEFAULT '',
  `which_config` varchar(50) NOT NULL,
  `config_comments` varchar(255) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `params` varchar(1024) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_id`),
  UNIQUE KEY `config_short` (`config_short`,`which_config`),
  KEY `which_config` (`which_config`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Store all configuration List' AUTO_INCREMENT=48 ;

--
-- Dumping data for table `#__clubreg_configs`
--

INSERT INTO `#__clubreg_configs` (`config_id`, `config_name`, `config_short`, `config_text`, `config_type`, `which_config`, `config_comments`, `createdby`, `created`, `ordering`, `published`, `params`) VALUES
(1, 'Groups', 'groups', '', '', 'TOPMOST', '', 62, '2011-12-17 09:18:31', 13, 1, 'sort_list_by=ordering\nconfig_type=list'),
(2, 'Club Member Details', 'club_member_details', '', '', 'TOPMOST', 'Holds a list of possible club memeber controls', 62, '2011-12-17 09:18:31', 16, 1, 'sort_list_by=ordering\nconfig_type=list'),
(3, 'Template Status', 'template_status', '', '', 'TOPMOST', '', 62, '2011-12-17 09:18:31', 14, 1, 'sort_list_by=ordering\nconfig_type=list'),
(4, 'Template Usergroup Access', 'template_access', '', '', 'TOPMOST', '', 62, '2011-12-17 09:18:31', 15, 1, 'sort_list_by=ordering\nconfig_type=list'),
(5, 'Club Guardian Details', 'club_guardian_details', '', '', 'TOPMOST', '', 62, '2011-12-17 09:18:31', 17, 1, 'sort_list_by=ordering\nconfig_type=list'),
(6, 'Club Player Details', 'club_player_details', '', '', 'TOPMOST', '', 62, '2011-12-17 09:18:31', 18, 1, 'sort_list_by=ordering\nconfig_type=list'),
(7, 'Club Payment Method', 'club_payment_method', '', '', 'TOPMOST', '', 62, '2011-12-17 09:18:31', 19, 1, 'sort_list_by=ordering\nconfig_type=list'),
(8, 'Club Payment Status', 'club_payment_status', '', '', 'TOPMOST', '', 62, '2011-12-17 09:18:31', 20, 1, 'sort_list_by=ordering\nconfig_type=list'),
(9, 'Club Payment Description', 'club_payment_desc', '', '', 'TOPMOST', '', 62, '2011-12-17 09:18:31', 21, 1, 'sort_list_by=ordering\nconfig_type=list'),
(10, 'Email Address', 'email_address', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 1, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=yes'),
(11, 'Member''s Position', 'member_position', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 1, 1, ''),
(12, 'Member Number', 'member_number', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 1, 1, ''),
(13, 'Club History', 'club_history', 'type=textarea', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 2, 1, ''),
(14, 'School Attending', 'school_attending', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 3, 1, ''),
(15, 'Quote', 'quote', 'type=textarea', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 4, 1, 'config_type=list\ncontrol_type=textarea\ncontrol_width=400px'),
(16, 'About', 'about', 'type=textarea\r\nrows=5\r\nwidth=200px', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 5, 1, 'config_type=none\ncontrol_type=textarea\ncontrol_width=400px'),
(17, 'Height and Weight', 'height_weight', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 6, 1, ''),
(18, 'Favourite Player', 'fave_player', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 7, 1, ''),
(19, 'Nicknames', 'nicknames', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 8, 1, ''),
(20, 'Hometown', 'hometown', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 9, 1, ''),
(21, 'Nationality', 'nationality', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 10, 1, ''),
(22, 'Residence', 'residence', '', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 11, 1, ''),
(23, 'Date of Birth', 'date_of_birth', 'type=date', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 12, 1, ''),
(24, 'Joining Date', 'joining_date', 'type=date', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 13, 1, ''),
(25, 'Leaving Date', 'leaving_date', 'type=date', '', 'club_member_details', '', 62, '2011-12-17 21:21:04', 14, 1, ''),
(26, 'Registration Fees', 'regfees', '', '', 'club_payment_desc', '', 62, '2011-12-17 21:21:04', 1, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(27, 'Playing Kits', 'playingkit', '', '', 'club_payment_desc', '', 62, '2011-12-17 21:21:04', 2, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(28, 'Other (Add Details to Notes)', 'other_desc', '', '', 'club_payment_desc', '', 62, '2011-12-17 21:21:04', 3, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(29, 'Credit Card', 'creditcard', '', '', 'club_payment_method', '', 62, '2011-12-17 21:21:04', 1, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(30, 'Cash Payment', 'cash', '', '', 'club_payment_method', '', 62, '2011-12-17 21:21:04', 2, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(31, 'Other Type (Add details to Notes)', 'other', '', '', 'club_payment_method', '', 62, '2011-12-17 21:21:04', 3, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(32, 'Pending', 'pending', '', '', 'club_payment_status', '', 62, '2011-12-17 21:21:04', 1, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(33, 'Checked', 'checked', '', '', 'club_payment_status', '', 62, '2011-12-17 21:21:04', 2, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(34, 'Cancelled', 'cancelled', '', '', 'club_payment_status', '', 62, '2011-12-17 21:21:04', 3, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(35, 'Deleted', 'deleted', '', '', 'club_payment_status', '', 62, '2011-12-17 21:21:04', 4, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(36, 'Male', 'male', '', '', 'gender', NULL, 62, '2011-12-17 21:21:04', 1, 1, ''),
(37, 'Female', 'female', '', '', 'gender', NULL, 62, '2011-12-17 21:21:04', 2, 1, ''),
(38, 'Squirts', 'squirts', '', '', 'groups', '', 62, '2011-12-17 21:21:04', 1, 1, 'sort_list_by=ordering\nconfig_type=list'),
(39, 'Under 6', 'under_6', '', '', 'groups', '', 62, '2011-12-17 21:21:04', 2, 1, 'sort_list_by=ordering\nconfig_type=list'),
(40, '2010-2011', '2010-2011', '', '', 'reg_year', '', 62, '2011-12-17 21:21:04', 1, 1, 'sort_list_by=ordering\nconfig_type=list'),
(41, '2011-2012', '2011-2012', '', '', 'reg_year', '', 62, '2011-12-17 21:21:04', 2, 1, 'sort_list_by=ordering\nconfig_type=list'),
(42, 'Everyone', 'everyone', '', '', 'template_access', '', 62, '2011-12-17 21:21:04', 1, 1, ''),
(43, 'Team Members', 'team_members', '', '', 'template_access', '', 62, '2011-12-17 21:21:04', 2, 1, ''),
(44, 'Team Leaders', 'team_leaders', '', '', 'template_access', '', 62, '2011-12-17 21:21:04', 3, 1, ''),
(45, 'New Template', 'new_template', '', '', 'template_status', '', 62, '2011-12-17 21:21:04', 1, 1, ''),
(46, 'Active Template', 'active_template', '', '', 'template_status', '', 62, '2011-12-17 21:21:04', 2, 1, ''),
(47, 'Deleted Template', 'deleted_template', '', '', 'template_status', '', 62, '2011-12-17 21:21:04', 3, 1, '');


INSERT INTO `#__clubreg_configs` (`config_name`, `config_short`, `config_text`, `config_type`, `which_config`, `config_comments`, `createdby`, `created`, `ordering`, `published`, `params`) VALUES ('Club Relationships', 'club_relationships', '', '', 'TOPMOST', NULL, 7, '2015-09-10 07:19:47', 31, 1, '{"assign_to":"both"}');

