ALTER TABLE `#__clubreg_notes` ADD `note_key` VARCHAR( 30 ) NOT NULL AFTER `note_id` ;
ALTER TABLE `#__clubreg_notes` CHANGE  `member_id`  `primary_id` INT( 11 ) NOT NULL COMMENT  'can either be for members or groups';
ALTER TABLE `#__clubreg_notes` CHANGE  `note_type`  `note_type` VARCHAR( 15 ) NOT NULL DEFAULT  'member';
UPDATE `#__clubreg_notes` SET `note_type`='member' WHERE 1
