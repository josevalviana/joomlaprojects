DROP TABLE IF EXISTS `#__professional`;

CREATE TABLE `#__professional` (
  `id` integer NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `address`text,
  `suburb` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `country` varchar(100) default NULL,
  `postcode` varchar(100) default NULL,
  `telephone` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `misc` mediumtext,
  `email_to` varchar(255) default NULL,
  `catid` integer NOT NULL default '0',
  `webpage` varchar(255) NOT NULL default '',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL default '0',
  `created_by_alias` varchar(255) NOT NULL default '',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY (`id`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_catid` (`catid`)
) DEFAULT CHARSET=utf8;