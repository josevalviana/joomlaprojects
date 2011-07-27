DROP TABLE IF EXISTS `#__vehicle`;

CREATE TABLE `#__vehicle` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	`catid` int(11) NOT NULL DEFAULT '0',
	`created` datetime NOT NULL default '0000-00-00 00:00:00',
	`created_by` int(10) unsigned NOT NULL default '0',
	`created_by_alias` varchar(255) NOT NULL default '',
	`modified` datetime NOT NULL default '0000-00-00 00:00:00',
	`modified_by` int(10) unsigned NOT NULL default '0',
	PRIMARY KEY (`id`),
	KEY `idx_catid` (`catid`),
	KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;