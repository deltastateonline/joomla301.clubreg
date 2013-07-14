CREATE TABLE IF NOT EXISTS `qjogz_clubreg_documents` (
  `document_id` int(11) NOT NULL auto_increment,
  `link_id` int(11) NOT NULL,
  `document_name` varchar(255) default NULL,
  `document_details` varchar(255) default NULL,
  `document_type` int(11) NOT NULL,
  `document_parameters` varchar(1024) default NULL,
  `document_server_location` int(11) default NULL,
  `document_location` varchar(1024) default NULL,
  `created_date` date default NULL,
  `created_time` time default NULL,
  `createdby` int(11) default NULL,
  `document_parameter_type` varchar(50) default NULL,
  `document_file_type` varchar(50) default NULL,
  `document_status` int(11) default NULL,
  `document_access_level` int(11) default NULL,
  PRIMARY KEY  (`document_id`),
  KEY `link_id` (`link_id`,`document_parameter_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='store files' AUTO_INCREMENT=1 ;