--
-- MySQL tables and data
--

CREATE TABLE IF NOT EXISTS `log_categories` (
  `id`       int(11) NOT NULL auto_increment,
  `name`     varchar(50) NOT NULL,
  `order`    int(11) NOT NULL,
  `visible`  tinyint(1) NOT NULL,
  `created`  datetime NOT NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `log_categories` (`id`, `name`, `order`, `visible`, `created`, `modified`) VALUES
(1, 'Debug',       10, 1, NOW(), NULL),
(2, 'Info',        20, 1, NOW(), NULL),
(3, 'Warning',     30, 1, NOW(), NULL),
(4, 'Error',       40, 1, NOW(), NULL),
(5, 'Visit',       50, 1, NOW(), NULL),
(6, 'Request',     60, 1, NOW(), NULL),
(7, 'Bot request', 70, 1, NOW(), NULL),
(8, 'RSS',         80, 1, NOW(), NULL);

CREATE TABLE IF NOT EXISTS `logs` (
  `id`              int(11) NOT NULL auto_increment,
  `log_category_id` int(11) NOT NULL,
  `message1`        varchar(512) collate utf8_unicode_ci NOT NULL,
  `message2`        varchar(512) collate utf8_unicode_ci default NULL,
  `message3`        varchar(512) collate utf8_unicode_ci default NULL,
  `message4`        varchar(512) collate utf8_unicode_ci default NULL,
  `message5`        varchar(512) collate utf8_unicode_ci default NULL,
  `message6`        varchar(512) collate utf8_unicode_ci default NULL,
  `message7`        varchar(512) collate utf8_unicode_ci default NULL,
  `message8`        varchar(512) collate utf8_unicode_ci default NULL,
  `created`         datetime NOT NULL,
  `modified`        datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
