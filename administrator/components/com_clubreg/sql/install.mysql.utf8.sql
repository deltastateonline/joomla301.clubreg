-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2013 at 03:53 AM
-- Server version: 5.0.41
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `joomla_301`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_attachments`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_attachments` (
  `attachment_id` int(11) NOT NULL auto_increment,
  `attachment_key` varchar(30) default NULL,
  `primary_id` int(11) NOT NULL,
  `link_type` varchar(15) default 'member',
  `attachment_fname` varchar(255) default NULL,
  `attachment_notes` varchar(255) default NULL,
  `attachment_type` varchar(30) default NULL,
  `params` varchar(1024) default NULL,
  `attachment_savedfname` varchar(255) default NULL,
  `attachment_location` varchar(1024) default NULL,
  `created` datetime default NULL,
  `created_by` int(11) default NULL,
  `attachment_parameter_type` varchar(50) default NULL,
  `attachment_file_type` varchar(50) default NULL,
  `attachment_status` int(11) default NULL,
  `attachment_access_level` int(11) default NULL,
  PRIMARY KEY  (`attachment_id`),
  KEY `link_id` (`primary_id`,`link_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='store files' AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_configs`
--
CREATE TABLE IF NOT EXISTS `#__clubreg_configs` (
  `config_id` int(11) NOT NULL auto_increment,
  `config_name` varchar(255) NOT NULL default '',
  `config_short` varchar(255) NOT NULL default '',
  `config_text` text NOT NULL,
  `config_type` varchar(255) NOT NULL default '',
  `which_config` varchar(255) NOT NULL,
  `config_comments` varchar(255) default NULL,
  `createdby` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL default '1',
  `params` varchar(1024) NOT NULL default '',
  PRIMARY KEY  (`config_id`),
  UNIQUE KEY `config_short` (`config_short`,`which_config`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store all configuration List' AUTO_INCREMENT=155 ;

--
-- Dumping data for table `#__clubreg_configs`
--

INSERT INTO `#__clubreg_configs` (`config_id`, `config_name`, `config_short`, `config_text`, `config_type`, `which_config`, `config_comments`, `createdby`, `created`, `ordering`, `published`, `params`) VALUES
(2, 'Male', 'male', '', '', 'gender', NULL, 62, '2011-03-20 21:23:20', 1, 1, ''),
(8, 'Female', 'female', '', '', 'gender', NULL, 62, '2011-03-23 05:46:54', 2, 1, ''),
(33, 'Mr', 'mr', 'Mister', '', 'title', NULL, 62, '2011-04-02 21:13:29', 5, 1, ''),
(34, 'Ms', 'ms', '', '', 'title', NULL, 62, '2011-04-02 21:13:38', 4, 1, ''),
(35, 'Mrs', 'mrs', '', '', 'title', NULL, 62, '2011-04-02 21:13:47', 6, 1, ''),
(36, 'Dr.', 'dr', '', '', 'title', NULL, 62, '2011-04-02 21:13:57', 2, 1, ''),
(37, 'Chief', 'chief', '', '', 'title', NULL, 62, '2011-04-02 21:14:08', 1, 1, ''),
(38, 'Eng', 'eng', '', '', 'title', NULL, 62, '2011-04-02 21:14:16', 3, 1, ''),
(43, 'Birth Certificate', 'birth_certificate', '', '', 'documents', NULL, 62, '2011-04-16 16:40:09', 2, 1, ''),
(44, 'Police Reports', 'police_reports', '', '', 'documents', NULL, 62, '2011-04-16 16:40:19', 3, 1, ''),
(45, 'Local Govt Area of Origin', 'local_govt_area_of_origin', '', '', 'documents', NULL, 62, '2011-04-16 16:41:13', 4, 1, ''),
(50, 'Enrolment Numbering', 'enrolment_numbering', 'a:3:{s:6:"prefix";s:3:"BMC";s:9:"currentno";i:9;s:7:"padding";i:5;}', '', 'enrolment_numbering', NULL, 62, '2011-04-23 18:30:36', 1, 1, ''),
(56, 'Documents', 'documents', '', '', 'TOPMOST', NULL, 62, '2011-05-04 03:36:04', 5, 1, 'sort_list_by=ordering'),
(57, 'Gender', 'gender', '', '', 'TOPMOST', NULL, 62, '2011-05-04 03:36:21', 5, 1, 'sort_list_by=ordering\nconfig_type=list'),
(61, 'Student Status', 'student_status', '', '', 'TOPMOST', NULL, 62, '2011-05-04 03:37:45', 9, 1, 'sort_list_by=ordering\nconfig_type=list'),
(62, 'Title', 'title', '', '', 'TOPMOST', NULL, 62, '2011-05-04 03:38:01', 10, 99, 'sort_list_by=ordering'),
(63, 'Enrolment Dates', 'enrol_date', '', '', 'TOPMOST', NULL, 62, '2011-05-29 08:45:45', 4, 1, 'sort_list_by=ordering\nconfig_type=list'),
(64, 'Last 7 Days', '7days', '', '', 'enrol_date', NULL, 62, '2011-05-29 08:58:22', 1, 1, ''),
(65, 'Last Month', '30days', '', '', 'enrol_date', NULL, 62, '2011-05-29 08:58:35', 2, 1, ''),
(68, 'Registration Year', 'reg_year', '', '', 'TOPMOST', 'The year the current registration is for', 62, '2011-07-03 17:33:08', 12, 1, 'sort_list_by=ordering\nconfig_type=list'),
(69, '2010-2011', '2010-2011', '', '', 'reg_year', '', 62, '2011-07-03 17:34:36', 1, 1, 'sort_list_by=ordering\nconfig_type=list'),
(70, '2011-2012', '2011-2012', '', '', 'reg_year', '', 62, '2011-07-03 17:35:06', 2, 1, 'sort_list_by=ordering\nconfig_type=list'),
(71, 'Groups', 'groups', '', '', 'TOPMOST', '', 62, '2011-07-03 17:36:38', 13, 1, 'sort_list_by=ordering\nconfig_type=list'),
(72, 'Squirts', 'squirts', '', '', 'groups', '', 62, '2011-07-03 17:37:39', 1, 1, 'sort_list_by=ordering\nconfig_type=list'),
(73, 'Under 6', 'under_6', '', '', 'groups', '', 62, '2011-07-03 17:37:51', 2, 1, 'sort_list_by=ordering\nconfig_type=list'),
(74, 'Club Officials Details', 'club_official_details', '', '', 'TOPMOST', 'Holds a list of possible club memeber controls', 62, '2011-08-13 23:49:46', 16, 1, '{"config_type":"inputfields","sort_list_by":"ordering"}'),
(75, 'School Attending', 'school_attending', '', '', 'club_official_details', '', 62, '2011-08-13 23:50:21', 3, 1, ''),
(76, 'Email Address', 'email_address', '', '', 'club_official_details', '', 62, '2011-08-13 23:50:53', 1, 1, '{"assign_to":"both","control_type":"email","default_value":"","control_width":"","control_class":""}'),
(77, 'Club History', 'club_history', 'type=textarea', '', 'club_official_details', '', 62, '2011-08-13 23:51:28', 2, 1, ''),
(78, 'Quote', 'quote', 'type=textarea', '', 'club_official_details', '', 62, '2011-08-13 23:51:49', 4, 1, '{"assign_to":"both","control_type":"textarea","default_value":"","control_width":"","control_class":"input input-xxlarge"}'),
(79, 'About', 'about', '', '', 'club_official_details', '', 62, '2011-08-13 23:52:30', 5, 1, '{"assign_to":"both","control_type":"textarea","default_value":"","control_width":"","control_class":"input input-xxlarge"}'),
(80, 'Height and Weight', 'height_weight', '', '', 'club_official_details', '', 62, '2011-08-13 23:57:57', 6, 1, ''),
(81, 'Favourite Player', 'fave_player', '', '', 'club_official_details', '', 62, '2011-08-13 23:58:10', 7, 1, ''),
(82, 'Hometown', 'hometown', '', '', 'club_official_details', '', 62, '2011-08-13 23:58:19', 9, 1, ''),
(83, 'Nationality', 'nationality', '', '', 'club_official_details', '', 62, '2011-08-13 23:58:29', 10, 1, ''),
(84, 'Nicknames', 'nicknames', '', '', 'club_official_details', '', 62, '2011-08-13 23:58:37', 8, 1, ''),
(85, 'Residence', 'residence', '', '', 'club_official_details', '', 62, '2011-08-13 23:58:45', 11, 1, '{"assign_to":"both","control_type":"","default_value":"Nigerian","control_width":"","control_class":""}'),
(86, 'Joining Date', 'joining_date', '', '', 'club_official_details', '', 62, '2011-08-13 23:58:54', 13, 1, '{"assign_to":"both","control_type":"monthyear","default_value":"","control_width":"","control_class":""}'),
(87, 'Leaving Date', 'leaving_date', '', '', 'club_official_details', '', 62, '2011-08-13 23:59:03', 14, 1, '{"assign_to":"both","control_type":"monthyear","default_value":"","control_width":"","control_class":""}'),
(88, 'Date of Birth', 'date_of_birth', '', '', 'club_official_details', '', 62, '2011-08-13 23:59:11', 12, 1, '{"assign_to":"both","control_type":"date","default_value":"","control_width":"","control_class":""}'),
(89, 'Member''s Position', 'member_position', 'Team Leader\r\nCoach\r\nPresident\r\nVice President', '', 'club_official_details', '', 62, '2011-08-13 23:59:23', 1, 1, '{"assign_to":"both","control_type":"list","default_value":"","control_width":"","control_class":""}'),
(90, 'Member Number', 'member_number', '', '', 'club_official_details', '', 62, '2011-08-13 23:59:43', 1, 1, ''),
(91, 'Template Status', 'template_status', '', '', 'TOPMOST', '', 62, '2011-08-27 18:04:58', 14, 1, 'sort_list_by=ordering\nconfig_type=list'),
(92, 'Active Template', 'active_template', '', '', 'template_status', '', 62, '2011-08-27 18:05:34', 2, 1, ''),
(93, 'New Template', 'new_template', '', '', 'template_status', '', 62, '2011-08-27 18:05:54', 1, 1, ''),
(94, 'Deleted Template', 'deleted_template', '', '', 'template_status', '', 62, '2011-08-27 18:06:10', 3, 1, ''),
(95, 'Template Usergroup Access', 'template_access', '', '', 'TOPMOST', '', 62, '2011-09-12 05:30:35', 15, 1, 'sort_list_by=ordering\nconfig_type=list'),
(96, 'Everyone', 'everyone', '', '', 'template_access', '', 62, '2011-09-12 05:31:07', 1, 1, ''),
(97, 'Team Members', 'team_members', '', '', 'template_access', '', 62, '2011-09-12 05:31:38', 2, 1, ''),
(98, 'Team Leaders', 'team_leaders', '', '', 'template_access', '', 62, '2011-09-12 05:31:59', 3, 1, ''),
(99, 'Club Guardian Details', 'club_guardian_details', '', '', 'TOPMOST', '', 62, '2011-10-01 21:30:35', 17, 1, 'sort_list_by=ordering\nconfig_type=list'),
(101, 'Club Payment Method', 'club_payment_method', '', '', 'TOPMOST', '', 62, '2011-12-17 18:50:49', 19, 1, 'sort_list_by=ordering\nconfig_type=list'),
(102, 'Club Payment Status', 'club_payment_status', '', '', 'TOPMOST', '', 62, '2011-12-17 18:52:08', 20, 1, 'sort_list_by=ordering\nconfig_type=list'),
(103, 'Club Payment Description', 'club_payment_desc', '', '', 'TOPMOST', '', 62, '2011-12-17 18:52:40', 21, 1, '{"config_type":"paymentitems","sort_list_by":"ordering"}'),
(104, 'Credit Card', 'creditcard', '', '', 'club_payment_method', '', 62, '2011-12-17 18:53:21', 1, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(105, 'Cash Payment', 'cash', '', '', 'club_payment_method', '', 62, '2011-12-17 18:53:41', 2, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(106, 'Other Type (Add details to Notes)', 'other', '', '', 'club_payment_method', '', 62, '2011-12-17 18:54:18', 3, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(107, 'Registration Fees', 'regfees', '', '', 'club_payment_desc', '', 62, '2011-12-17 18:55:32', 1, 1, '{"assign_to":"both","default_value":"","taxrate":"10"}'),
(108, 'Playing Kits', 'playingkit', '', '', 'club_payment_desc', '', 62, '2011-12-17 18:55:59', 2, 1, '{"assign_to":"both","default_value":"0.0","taxrate":"10"}'),
(109, 'Other (Add Details to Notes)', 'other_desc', '', '', 'club_payment_desc', '', 62, '2011-12-17 18:58:00', 3, 1, '{"assign_to":"both","default_value":"200","taxrate":"0"}'),
(110, 'Pending', 'pending', '', '', 'club_payment_status', '', 62, '2011-12-17 18:58:41', 1, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(111, 'Checked', 'checked', '', '', 'club_payment_status', '', 62, '2011-12-17 18:59:10', 2, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(112, 'Cancelled', 'cancelled', '', '', 'club_payment_status', '', 62, '2011-12-17 18:59:37', 3, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(113, 'Deleted', 'deleted', '', '', 'club_payment_status', '', 62, '2011-12-17 19:00:01', 4, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(127, 'Swimmers Level', 'club_player_level', '', '', 'TOPMOST', '', 62, '2012-05-31 09:15:41', 22, 1, 'sort_list_by=ordering\nconfig_type=list'),
(128, 'Amatuer', 'amatuer', '', '', 'club_player_level', '', 62, '2012-05-31 09:16:52', 1, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(129, 'Fee Paying', 'fee_paying', '', '', 'club_player_level', '', 62, '2012-05-31 09:17:29', 2, 0, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(130, 'Club Registration Documents', 'club_documents', '', '', 'TOPMOST', '', 62, '2012-06-01 10:11:32', 23, 1, 'sort_list_by=ordering\nconfig_type=list'),
(131, 'Profile Pics', 'profile_pics', '', '', 'club_documents', '', 62, '2012-06-01 10:12:34', 1, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(132, 'Hold Hamless', 'hold_hamless', '', '', 'club_documents', '', 62, '2012-06-01 10:14:14', 2, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(133, 'Physical/Sports Clearance', 'physical_sports_clearance', '', '', 'club_documents', '', 62, '2012-06-01 10:14:53', 3, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=300px\nis_email=no'),
(134, 'T-Shirt Sizes', 'tshirt_sizes', 'size 6\r\nsize 7\r\nsmall\r\nlarge\r\nextra large', '', 'club_player_details', '', 62, '2012-06-01 10:22:48', 1, 1, '{"assign_to":"both","control_type":"list","default_value":"","control_width":"","control_class":""}'),
(135, 'Swimmer''s School', 'swimmers_school', '', '', 'club_player_details', '', 62, '2012-06-01 10:24:45', 2, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=intext\nis_email=no'),
(136, 'Directory Listing Text', 'directory_listing_text', '', '', 'club_player_details', '', 62, '2012-06-01 10:27:00', 3, 1, '{"assign_to":"senior","control_type":"textarea","default_value":"","control_width":"width:300px","control_class":""}'),
(137, 'Archived', 'archived', 'no\r\nyes', '', 'club_player_details', '', 62, '2012-06-01 10:28:14', 4, 1, '{"assign_to":"both","control_type":"list","default_value":"","control_width":"intext half","control_class":""}'),
(138, 'Membership Enabled', 'membership_enabled', 'no\r\nyes', '', 'club_player_details', '', 62, '2012-06-01 10:30:13', 5, 1, '{"assign_to":"both","control_type":"list","default_value":"","control_width":"intext half","control_class":""}'),
(139, 'Member Since', 'member_since', '', '', 'club_player_details', '', 62, '2012-06-01 10:31:12', 6, 1, '{"assign_to":"both","control_type":"monthyear","default_value":"","control_width":"","control_class":""}'),
(140, 'Club Player Details', 'club_player_details', '', '', 'TOPMOST', '', 62, '2011-10-01 21:32:32', 18, 1, '{"config_type":"inputfields","sort_list_by":"ordering"}'),
(141, 'Joining Date', 'joining_date', '', '', 'club_player_details', '', 62, '2012-06-03 08:45:56', 7, 1, '{"assign_to":"both","control_type":"date","default_value":"","control_width":"","control_class":""}'),
(142, 'Founding Member', 'founding_member', 'no\r\nyes', '', 'club_official_details', '', 62, '2012-06-03 16:03:47', 0, 1, '{"assign_to":"both","control_type":"list","default_value":"","control_width":"","control_class":""}'),
(143, 'Elite', 'elite', '', '', 'club_player_level', '', 62, '2012-06-05 06:08:18', 3, 1, 'config_type=none\ncontrol_type=\ncontrol_width=\nis_email=no'),
(144, 'Radio Stations', 'radio_stations', 'BBC Radio 1\r\n1Xtra\r\nLBC\r\nSea FM\r\nB105\r\nCaptial Radio', '', 'club_player_details', '', 62, '2012-06-07 06:35:10', 8, 1, '{"assign_to":"both","control_type":"list","default_value":"","control_width":"","control_class":""}'),
(145, 'September Dues', 'september_dues', '', '', 'club_payment_desc', '', 62, '2012-06-25 13:52:12', 4, 1, '{"assign_to":"both","default_value":"","taxrate":"12.5"}'),
(146, 'Club Stats List', 'club_stats', 'will be used to hold all the stats items for the club,\r\n\r\nthese will include attendance, hits, positions etc', '', 'TOPMOST', 'will be used to hold all the stats items for the club,\r\n\r\nthese will include attendance, hits, positions etc', 62, '2012-07-15 23:48:58', 24, 1, '{"config_type":"inputfields","sort_list_by":"ordering"}'),
(147, 'Attendance', 'attendance', 'No\r\nYes\r\nMaybe', '', 'club_stats', '', 62, '2012-07-15 23:51:39', 1, 1, 'config_type=list\ncontrol_type=select\ncontrol_width=width:50px;\nis_email=no'),
(148, 'Lap Time', 'lap_time', '', '', 'club_stats', '', 62, '2012-07-15 23:52:32', 2, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=width:70px;\nis_email=no'),
(149, 'Shots Made', 'shots_made', '', '', 'club_stats', '', 62, '2012-07-15 23:53:18', 3, 1, 'config_type=none\ncontrol_type=text\ncontrol_width=width:80px;\nis_email=no'),
(150, 'Medals', 'medals', 'gold\r\nsilver\r\nbronze\r\nribbon', '', 'club_stats', '', 62, '2012-08-05 15:58:34', 4, 1, 'config_type=none\ncontrol_type=select\ncontrol_width=width:50px;\nis_email=no'),
(151, 'Division Type', 'club_grouptype', 'Store the group or division type', '', 'TOPMOST', NULL, 7, '2013-01-06 08:22:09', 25, 1, '{"config_type":"list","sort_list_by":""}'),
(152, 'Junior', 'junior', '', '', 'club_grouptype', NULL, 7, '2013-01-06 08:22:40', 1, 1, '{"assign_to":"junior"}'),
(153, 'Senior', 'senior', '', '', 'club_grouptype', NULL, 7, '2013-01-06 08:23:01', 2, 1, '{"assign_to":"senior"}'),
(154, 'Sport Equipment', 'sport_equipment', '', '', 'club_documents', NULL, 7, '2013-07-21 16:01:25', 4, 1, '{"assign_to":"both"}');

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_contact_details`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_contact_details` (
  `member_id` int(11) NOT NULL,
  `contact_detail` varchar(255) NOT NULL,
  `contact_type` varchar(2) NOT NULL COMMENT 'Contact type , emergency or extra details or others',
  `contact_value` text NOT NULL,
  PRIMARY KEY  (`member_id`,`contact_detail`,`contact_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contact Details';

--
-- Dumping data for table `#__clubreg_contact_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_details_audit`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_details_audit` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__clubreg_details_audit`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_eoimembers`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_eoimembers` (
  `member_id` int(11) NOT NULL auto_increment,
  `surname` varchar(30) default NULL,
  `givenname` varchar(30) default NULL,
  `mobile` varchar(30) default NULL,
  `address` varchar(50) default NULL,
  `suburb` varchar(30) default NULL,
  `postcode` varchar(30) default NULL,
  `phoneno` varchar(30) default NULL,
  `emailaddress` varchar(50) default NULL,
  `send_news` tinyint(4) default NULL,
  `dob` date default NULL,
  `group` int(11) default NULL,
  `subgroup` int(11) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `#__clubreg_eoimembers`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_groups`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_groups` (
  `group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(255) NOT NULL default '',
  `group_short` varchar(30) NOT NULL default '',
  `group_text` text NOT NULL,
  `group_type` varchar(30) NOT NULL default '',
  `which_config` varchar(50) NOT NULL,
  `group_comments` varchar(255) default NULL,
  `group_leader` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL default '1',
  `params` varchar(1024) NOT NULL default '',
  `group_parent` int(11) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY  (`group_id`),
  UNIQUE KEY `config_short` (`group_short`),
  KEY `which_config` (`which_config`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Store all club groups' AUTO_INCREMENT=22 ;

--
-- Dumping data for table `#__clubreg_groups`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_notes`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_notes` (
  `note_id` int(11) NOT NULL auto_increment,
  `note_key` varchar(30) NOT NULL,
  `primary_id` int(11) NOT NULL COMMENT 'can either be for members or groups',
  `notes` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `note_status` tinyint(11) NOT NULL,
  `note_type` varchar(15) NOT NULL default 'member',
  PRIMARY KEY  (`note_id`),
  KEY `member_id` (`primary_id`,`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__clubreg_notes`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_payments`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_payments` (
  `payment_id` int(11) NOT NULL auto_increment,
  `payment_key` varchar(30) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `#__clubreg_payments`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_payments_setup`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_payments_setup` (
  `product_id` int(11) NOT NULL auto_increment,
  `product_name` varchar(50) NOT NULL,
  `product_desc` varchar(1024) default NULL,
  `product_amount` int(11) default NULL,
  `created` datetime default NULL,
  `createdby` int(11) default NULL,
  `published` tinyint(4) NOT NULL default '1',
  `validfrom` date NOT NULL default '0000-00-00',
  `validto` date NOT NULL default '0000-00-00',
  `params` varchar(256) default NULL,
  PRIMARY KEY  (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__clubreg_payments_setup`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_registeredmembers`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_registeredmembers` (
  `member_id` int(11) NOT NULL auto_increment,
  `member_key` varchar(30) NOT NULL,
  `memberid` varchar(50) default ' ' COMMENT 'Member Club Id Number',
  `memberlevel` varchar(50) default ' ' COMMENT 'Member Club level',
  `surname` varchar(30) default NULL,
  `givenname` varchar(30) default NULL,
  `mobile` varchar(30) default NULL,
  `address` varchar(50) default NULL,
  `suburb` varchar(30) default NULL,
  `postcode` varchar(30) default NULL,
  `phoneno` varchar(30) default NULL,
  `emailaddress` varchar(50) default NULL,
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
  `joining_date` date default '0000-00-00',
  `year_registered` year(4) default NULL,
  `member_status` varchar(30) default NULL,
  `parent_id` int(11) default NULL,
  `playertype` varchar(11) default NULL,
  `eoi_id` int(11) default NULL,
  PRIMARY KEY  (`member_id`),
  KEY `parent_id` (`parent_id`),
  KEY `group` (`group`),
  KEY `gender` (`gender`),
  KEY `playertype` (`playertype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__clubreg_registeredmembers`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_saved_comms`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_saved_comms` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='store saved communications' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__clubreg_saved_comms`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_stats_details`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_stats_details` (
  `member_id` int(11) NOT NULL,
  `stats_date` date NOT NULL,
  `stats_detail` varchar(64) NOT NULL,
  `stats_value` varchar(512) NOT NULL,
  PRIMARY KEY  (`member_id`,`stats_date`,`stats_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stats details';

--
-- Dumping data for table `#__clubreg_stats_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_tags`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_tags` (
  `tag_id` int(11) NOT NULL auto_increment,
  `tag_text` varchar(30) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_date` date NOT NULL,
  `created_time` time NOT NULL,
  `createdby` int(11) NOT NULL,
  PRIMARY KEY  (`tag_id`),
  UNIQUE KEY `tag_text` (`tag_text`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `#__clubreg_tags`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_tags_players`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_tags_players` (
  `tag_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY  (`tag_id`,`member_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__clubreg_tags_players`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_teammembers`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_teammembers` (
  `joomla_id` int(11) NOT NULL,
  `status` int(11) NOT NULL default '1',
  `params` varchar(512) default NULL,
  PRIMARY KEY  (`joomla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__clubreg_teammembers`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_teammembers_details`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_teammembers_details` (
  `joomla_id` int(11) NOT NULL,
  `member_detail` varchar(255) NOT NULL,
  `member_value` text NOT NULL,
  PRIMARY KEY  (`joomla_id`,`member_detail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__clubreg_teammembers_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_teammembers_groups`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_teammembers_groups` (
  `joomla_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`joomla_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `#__clubreg_teammembers_groups`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__clubreg_templates`
--

CREATE TABLE IF NOT EXISTS `#__clubreg_templates` (
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
-- Dumping data for table `#__clubreg_templates`
--

INSERT INTO `#__clubreg_templates` (`template_id`, `template_name`, `template_subject`, `template_text`, `template_ptext`, `template_status`, `template_type`, `template_access`, `created`, `created_by`, `checked_out`, `checked_out_time`, `published`, `ordering`, `params`) VALUES
(1, 'Registration Email', 'Thank you for registrating with us', '<p>Dear Member</p>\r\n<p>Thank you for registering with {club_name}.</p>\r\n<p>A team member will get in touch with you in a few days.</p>\r\n<p>Best Regards.</p>\r\n<p>{Sender}</p>', 'Dear Member\r\nThank you for registering with {club_name}.\r\nA team member will get in touch with you in a few days.\r\nBest Regards.\r\n{Sender}', 'new_template', 0, 'everyone', '2011-08-31 07:45:27', 62, 0, '0000-00-00 00:00:00', 1, 1, ''),
(2, 'template name wednesday', 'template subject wednesday', '<p>some kind of communication</p>\r\n<p><strong>another one here</strong></p>\r\n<p><strong>please let it work.</strong></p>\r\n<p>in the middle of the night</p>', 'some kind of communication\r\nanother one here\r\nplease let it work.\r\nin the middle of the night', 'active_template', 0, 'team_members', '2011-08-30 22:21:27', 62, 0, '0000-00-00 00:00:00', 1, 2, ''),
(3, 'Notice of Meeting', 'Next Meeting Invitation', '<p>Dear Member,</p>\r\n<p>A general meeting will be held on {} at {}</p>\r\n<p>Please endevour to attend because matters will be discussed.</p>\r\n<p>Best Regards</p>\r\n<p>General Secretary</p>', 'Dear Member,\r\nA general meeting will be held on {} at {}\r\nPlease endevour to attend because matters will be discussed.\r\nBest Regards\r\nGeneral Secretary', 'new_template', 0, 'team_members', '2011-09-04 18:23:50', 62, 0, '0000-00-00 00:00:00', 1, 3, ''),
(4, 'Expression Of Interest', 'Expression Of Interest For Player', '<p>Thank you for registering your expression of interest.</p>\r\n<p>One of our team leaders will get back to you in due course.</p>\r\n<p>If you have further enquiries please feel free to contact us, using our contact form.</p>\r\n<p>Yours Truly</p>\r\n<p>Site Administrator</p>', 'Thank you for registering your expression of interest.\r\nOne of our team leaders will get back to you in due course.\r\nIf you have further enquiries please feel free to contact us, using our contact form.\r\nYours Truly\r\nSite Administrator', 'active_template', 0, 'everyone', '2011-10-04 06:40:33', 62, 0, '0000-00-00 00:00:00', 1, 4, ''),
(5, 'Urgent Email', 'URGENT MESSAGE RE PRESENTATION', '<h1>ATTENTION ALL SQUIRTZ & SSG PLAYERS</h1>\r\n<h2>WE REGRET TO INFORM YOU THAT THE RESCHEDULED PRESENTATION/ROUND ROBIN EVENT SET DOWN FOR THE 28TH AUGUST IS TO BE CANCELLED DUE TO THE PRESENT & FORECASTED WEEKEND WEATHER CONDITIONS.</h2>\r\n<p>We understand how difficult & frustrating these changes are & therefore, to avoid any further disappointment, we are seeking to organise an indoor venue to hold the presentation regardless of the weather.</p>\r\n<p>These details will be posted as soon as we are able to finalise them.</p>\r\n<p>Again, we apologise for the inconvenience caused.</p>', 'ATTENTION ALL SQUIRTZ & SSG PLAYERS\r\nWE REGRET TO INFORM YOU THAT THE RESCHEDULED PRESENTATION/ROUND ROBIN EVENT SET DOWN FOR THE 28TH AUGUST IS TO BE CANCELLED DUE TO THE PRESENT & FORECASTED WEEKEND WEATHER CONDITIONS.\r\nWe understand how difficult & frustrating these changes are & therefore, to avoid any further disappointment, we are seeking to organise an indoor venue to hold the presentation regardless of the weather.\r\nThese details will be posted as soon as we are able to finalise them.\r\nAgain, we apologise for the inconvenience caused.', 'active_template', 0, 'everyone', '2012-03-01 05:00:19', 62, 0, '0000-00-00 00:00:00', 1, 5, '');
