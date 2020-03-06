CREATE TABLE `#__clubreg_tags_members` (
	`tag_id` INT(11) NOT NULL,
	`member_id` INT(11) NOT NULL,
	`member_key` VARCHAR(32) NOT NULL,
	`retired` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`tag_id`, `member_id`, `member_key`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
