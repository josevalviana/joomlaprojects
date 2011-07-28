DROP TABLE IF EXISTS `#__hospitals`;

CREATE TABLE `#__hospitals` (
  `id` integer NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL default '0',
  `created_by_alias` varchar(255) NOT NULL default '',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY (`id`),
  KEY `idx_createdby` (`created_by`)
) DEFAULT CHARSET=utf8;