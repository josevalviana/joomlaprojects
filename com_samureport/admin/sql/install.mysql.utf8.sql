DROP TABLE IF EXISTS `#__samureport`;

CREATE TABLE `#__samureport` (
  `id` integer NOT NULL auto_increment,  
  `hospitalid` integer NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL default '0',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_hospitalid` (`hospitalid`),
  KEY `idx_createdby` (`created_by`)
)  DEFAULT CHARSET=utf8;