<?php

global $JOURNAL3_TABLES;

$JOURNAL3_TABLES = array(
	'journal3_setting' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`store_id` INT(11) NOT NULL,
				`setting_group` VARCHAR(128) NOT NULL,
				`setting_name` VARCHAR(128) NOT NULL,
				`setting_value` TEXT NOT NULL,
				`serialized` INT(1) NOT NULL,
				PRIMARY KEY (`store_id`, `setting_group`, `setting_name`)
        	) ENGINE=MyISAM DEFAULT CHARSET=utf8
		',

	'journal3_layout' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`layout_id` INT(11) NOT NULL AUTO_INCREMENT,
				`layout_data` MEDIUMTEXT NOT NULL,
				PRIMARY KEY (`layout_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8
		',

	'journal3_module' => '
			CREATE TABLE IF NOT EXISTS `%s` (
            	`module_id` INT(11) NOT NULL AUTO_INCREMENT,
            	`module_type` VARCHAR(64) NOT NULL,
            	`module_name` VARCHAR(128) NOT NULL,
            	`module_data` MEDIUMTEXT NOT NULL,
            	PRIMARY KEY (`module_id`)
        	) ENGINE=MyISAM DEFAULT CHARSET=utf8
		',

	'journal3_skin' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`skin_id` INT(11) NOT NULL AUTO_INCREMENT,
				`skin_name` VARCHAR(128) NOT NULL,			
				PRIMARY KEY (`skin_id`)
        	) ENGINE=MyISAM DEFAULT CHARSET=utf8
		',

	'journal3_skin_setting' => '
			CREATE TABLE IF NOT EXISTS `%s` (			  
				`skin_id` INT(11) NOT NULL,
				`setting_name` VARCHAR(128) NOT NULL,			
				`setting_value` TEXT NOT NULL,
				`serialized` INT(1) NOT NULL,
				PRIMARY KEY (`skin_id`, `setting_name`)
        	) ENGINE=MyISAM DEFAULT CHARSET=utf8
		',

	'journal3_variable' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`variable_name` VARCHAR(64) NOT NULL,
				`variable_label` VARCHAR(64) NOT NULL,
				`variable_type` VARCHAR(64) NOT NULL,
				`variable_value` TEXT NOT NULL,
				`serialized` INT(1) NOT NULL,
				PRIMARY KEY (`variable_name`, `variable_type`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8
		',

	'journal3_style' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`style_name` VARCHAR(64) NOT NULL,
				`style_label` VARCHAR(64) NOT NULL,
				`style_type` VARCHAR(64) NOT NULL,
				`style_value` MEDIUMTEXT NOT NULL,
				`serialized` INT(1) NOT NULL,
				PRIMARY KEY (`style_name`, `style_type`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8
		',

	'journal3_blog_category' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`category_id` int(11) NOT NULL AUTO_INCREMENT,
				`parent_id` int(11),
				`image` varchar(256),
				`status` tinyint(1),
				`sort_order` int(11),
				PRIMARY KEY (`category_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_category_description' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`category_id` int(11),
				`language_id` int(11),
				`name` varchar(256),
				`description` mediumtext,
				`meta_title` varchar(256),
				`meta_keywords` varchar(256),
				`meta_description` text,
				`keyword` varchar(256),
				PRIMARY KEY (`category_id`,`language_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_category_to_layout' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`category_id` int(11) NOT NULL AUTO_INCREMENT,
				`store_id` int(11),
				`layout_id` int(11),
				PRIMARY KEY (`category_id`, `store_id`),
				KEY (`layout_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_category_to_store' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`category_id` int(11),
				`store_id` int(11)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_post' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`post_id` int(11) NOT NULL AUTO_INCREMENT,
				`author_id` int(11),
				`image` varchar(256),
				`comments` tinyint(1),
				`status` tinyint(1),
				`sort_order` int(11),
				`date_created` datetime,
				`date_updated` datetime,
				`views` int(11),
				PRIMARY KEY (`post_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_post_description' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`post_id` int(11),
				`language_id` int(11),
				`name` varchar(256),
				`description` mediumtext,
				`meta_title` varchar(256),
				`meta_keywords` varchar(256),
				`meta_description` text,
				`keyword` varchar(256),
				`tags` varchar(256),
				PRIMARY KEY (`post_id`,`language_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_post_to_category' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`post_id` int(11),
				`category_id` int(11),
				PRIMARY KEY (`post_id`,`category_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_post_to_layout' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`post_id` int(11) NOT NULL AUTO_INCREMENT,
				`store_id` int(11),
				`layout_id` int(11),
				PRIMARY KEY (`post_id`, `store_id`),
				KEY (`layout_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_post_to_store' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`post_id` int(11),
				`store_id` int(11)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_post_to_product' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`post_id` int(11),
				`product_id` int(11),
				PRIMARY KEY (`post_id`,`product_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_blog_comments' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`comment_id` int(11) NOT NULL AUTO_INCREMENT,
				`parent_id` int(11),
				`post_id` int(11),
				`customer_id` int(11),
				`author_id` int(11),
				`name` varchar(256),
				`email` varchar(256),
				`website` varchar(256),
				`comment` text,
				`status` tinyint(1),
				`date` datetime,
				PRIMARY KEY (`comment_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_newsletter' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(256),
				`email` varchar(256),
				`ip` varchar(40),			  
                `store_id` INT(11),
				PRIMARY KEY (`newsletter_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_message' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`message_id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(256),
				`email` varchar(256),
				`fields` TEXT NOT NULL,
                `store_id` INT(11),
                `url` varchar(256),
                `date` datetime,
				PRIMARY KEY (`message_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',

	'journal3_product_attribute' => '
			CREATE TABLE IF NOT EXISTS `%s` (
				`product_id` INT(11) NOT NULL,
				`attribute_id` INT(11) NOT NULL,
				`language_id` INT(11) NOT NULL,
				`text` VARCHAR(256) NOT NULL,
				`sort_order` INT(3) NOT NULL DEFAULT 0,
				PRIMARY KEY (`product_id`,`attribute_id`,`language_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8
		',
);
