-- CREATE TABLE `fe_users` (
  -- `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  -- `user_code` int(10) unsigned DEFAULT NULL,
  -- `parent_id` int(11) DEFAULT -1,
  -- `levels_under_skin` int(4) DEFAULT -1,
  -- `user_type_x_id` tinyint(1) NOT NULL DEFAULT 1,
  -- `first_name` varchar(50) COLLATE utf8mb4 NOT NULL,
  -- `last_name` varchar(50) COLLATE utf8mb4 NOT NULL,
  -- `gender` tinyint(1) NOT NULL DEFAULT -1,
  -- `date_registered` int(11) NOT NULL,
  -- `username` varchar(30) COLLATE utf8mb4 NOT NULL,
  -- `password` varchar(32) COLLATE utf8mb4 NOT NULL,
  -- `current_status_x_id` tinyint(4) NOT NULL DEFAULT 1,
  -- `default_language_x_id` tinyint(4) NOT NULL DEFAULT 1,
  -- `country_x_id` smallint(3) unsigned NOT NULL,
  -- `email` varchar(64) COLLATE utf8mb4 DEFAULT NULL,
  -- `birth_date` date DEFAULT NULL,
  -- `currency_x_id` smallint(2) NOT NULL,
  -- `timezone_x_id` smallint(3) NOT NULL,
  -- `secret_question` int(11) DEFAULT NULL,
  -- `secret_answer` varchar(50) COLLATE utf8mb4 DEFAULT NULL,
  -- `last_password_change` int(11) DEFAULT NULL,
  -- `brand_id` int(5) DEFAULT -1,
  -- `test_user` tinyint(1) NOT NULL DEFAULT 0,
  -- PRIMARY KEY (`id`),
  -- KEY `index_user_code` (`user_code`),
  -- KEY `index_username` (`username`),
  -- KEY `index_date_registered` (`date_registered`),
  -- KEY `index_brand_id` (`brand_id`),
  -- KEY `index_email` (`email`),
  -- KEY `index_firstname_lastname` (`first_name`,`last_name`),
  -- KEY `index_lastname_firstname` (`last_name`,`first_name`),
  -- KEY `index_brand_id_date_registered` (`brand_id`,`date_registered`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `api_users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` VARCHAR(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` JSON NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `api_users` (`username`, `password`, `roles`)
SELECT 'nteixeira', '$2y$10$E8X9/JzpYp82QH2ZKz2H.Oi7Eap2MVRvN.t8Z8sw4HlpDKs78Vmbe', '["ROLE_API_USER"]'
FROM DUAL
WHERE NOT EXISTS (
    SELECT 1 FROM `api_users` WHERE username = 'nteixeira'
);
