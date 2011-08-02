DROP TABLE IF EXISTS `#__hospitals`;
DROP TABLE IF EXISTS `#__equipments`;
DROP TABLE IF EXISTS `#__specialties`;
DROP TABLE IF EXISTS `#__hospital_shifts`;

CREATE TABLE `#__hospitals` (
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

CREATE TABLE `#__equipments` (
	`id` INTEGER NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `#__specialties` (
	`id` INTEGER NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `#__hospital_shifts` (
	`id` INTEGER NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL DEFAULT '',
	`shift_start` time NOT NULL default '00:00:00',
	`shift_end` time NOT NULL default '00:00:00',
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;