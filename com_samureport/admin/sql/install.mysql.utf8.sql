DROP TABLE IF EXISTS `#__samureport_equipments`;
DROP TABLE IF EXISTS `#__samureport_vehicles`;
DROP TABLE IF EXISTS `#__samureport_staff`;
DROP TABLE IF EXISTS `#__samureport_reasons`;
DROP TABLE IF EXISTS `#__samureport`;

CREATE TABLE `#__samureport` (
  `id` integer NOT NULL auto_increment,  
  `hospitalid` integer NOT NULL default '0',
  `shiftid` integer NOT NULL default '0',
  `contact_phone` varchar(20) NOT NULL default '',
  `contact_person` varchar(50) NOT NULL default '',
  `staff_chief` varchar(50) NOT NULL default '',
  `misc` mediumtext,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL default '0',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_hospitalid` (`hospitalid`),
  KEY `idx_shiftif` (`shiftid`),
  KEY `idx_createdby` (`created_by`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `#__samureport_equipments` (
	`id` integer NOT NULL auto_increment,
	`equipmentid` integer NOT NULL default '0',
	`reportid` integer NOT NULL default '0',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`reportid`) REFERENCES `#__samureport`(`id`) ON DELETE CASCADE,
	KEY `idx_equipmentid` (`equipmentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `#__samureport_vehicles` (
	`id` integer NOT NULL auto_increment,
	`vehicleid` integer NOT NULL default '0',
	`reportid` integer NOT NULL default '0',
	`quantity` integer NOT NULL default '0',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`reportid`) REFERENCES `#__samureport`(`id`) ON DELETE CASCADE,
	KEY `idx_vehicleid` (`vehicleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `#__samureport_staff` (
	`id` integer NOT NULL auto_increment,
	`reportid` integer NOT NULL default '0',
	`profid` integer NOT NULL default '0',
	`specid` integer NOT NULL default '0',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`reportid`) REFERENCES `#__samureport`(`id`) ON DELETE CASCADE,
	KEY `idx_profid` (`profid`),
	KEY `idx_specid` (`specid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `#__samureport_reasons` (
	`id` integer NOT NULL auto_increment,
	`reportid` integer NOT NULL default '0',
	`proffromid` integer NOT NULL default '0',
	`proftoid` integer NOT NULL default '0',
	`reasonid` integer NOT NULL default '0',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`reportid`) REFERENCES `#__samureport`(`id`) ON DELETE CASCADE,
	KEY `idx_proffromid` (`proffromid`),
	KEY `idx_proftoid` (`proftoid`),
	KEY `idx_reasonid` (`reasonid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;