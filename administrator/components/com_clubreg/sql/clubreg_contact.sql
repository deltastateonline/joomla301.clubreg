ALTER TABLE `qjogz_clubreg_contact_details` ADD `contact_type` VARCHAR( 2 ) NOT NULL AFTER `contact_detail` COMMENT 'Contact type , emergency or extra details or others';

ALTER TABLE `qjogz_clubreg_contact_details` DROP PRIMARY KEY ;

ALTER TABLE `qjogz_clubreg_contact_details` ADD PRIMARY KEY ( `member_id` , `contact_detail` , `contact_type` ) ;

ALTER TABLE `qjogz_clubreg_contact_details` ADD INDEX ( `member_id` , `contact_type` ) ;

update qjogz_clubreg_contact_details set contact_type ='EM' where 
substr(`contact_detail`,1,3) = "em_";

update qjogz_clubreg_contact_details set contact_type ='ED' where 
substr(`contact_detail`,1,6) = "extra_";