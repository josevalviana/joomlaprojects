DROP TABLE IF EXISTS `#__censouti`;

CREATE TABLE `#__censouti` (
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`sisreg` INTEGER NOT NULL,
	`nome` VARCHAR(255) NOT NULL,
	`created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0',
    `modified` datetime NOT NULL default '0000-00-00 00:00:00',
    `modified_by` int(10) unsigned NOT NULL default '0',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `#__censouti` (`sisreg`, `nome`, `created`, `created_by`) VALUES (12345, 'CLAUDIO', NOW(), 76);
INSERT INTO `#__censouti` (`sisreg`, `nome`, `created`, `created_by`) VALUES (54321, 'MESSIAS', NOW(), 76);