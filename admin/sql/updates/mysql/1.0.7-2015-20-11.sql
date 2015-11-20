CREATE TABLE IF NOT EXISTS `#__sppagebuilder_media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;