ALTER TABLE `categories` ADD COLUMN `spanish_category_name` VARCHAR(255) NULL AFTER `short_name`, ADD COLUMN `spanish_description` TEXT NULL AFTER `spanish_category_name`, CHANGE `is_show_on_place_ad` `is_show_on_place_ad` TINYINT(1) DEFAULT 0 NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `is_show_on_place_ad`);


ALTER TABLE `user` CHANGE `language_id` `language_id` INT(20) DEFAULT 1 NULL;


ALTER TABLE `courses` CHANGE `course_title` `course_title` VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci NULL, ADD COLUMN `spanish_course_title` VARCHAR(255) NULL AFTER `course_title`;



ALTER TABLE `news` ADD `hospital_id` INT(11) NOT NULL DEFAULT '0' AFTER `id`;

INSERT INTO `notification_identifier`(
    `identifier`,
    `notification_type`,
    `send_type`,
    `title`,
    `message`,
    `created_at`
)
VALUES(
   "news_alert",
    "push",
    "target",
    "news_alert",
    "news_alert",
    NOW()
)