ALTER TABLE `audit_queries` DROP `ministry_id`, DROP `controlling_office_id`, DROP `controlling_office_name_en`, DROP `controlling_office_name_bn`, DROP `parent_office_id`, DROP `parent_office_name_en`, DROP `parent_office_name_bn`;
ALTER TABLE `ac_memos` ADD `memo_id` INT NOT NULL AFTER `team_id`;
ALTER TABLE `ac_memos` ADD `memo_attachments` LONGTEXT NULL AFTER `comment`;
