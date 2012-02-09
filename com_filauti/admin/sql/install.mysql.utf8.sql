DROP TABLE IF EXISTS `#__filauti`;

CREATE TABLE `#__filauti` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`sisreg` INT NOT NULL UNIQUE,
	`nome` VARCHAR(255) NOT NULL,
	`idade` INT NOT NULL DEFAULT '0',
	`idade_c` VARCHAR(1) NOT NULL DEFAULT 'A',
	`cid` VARCHAR(10) NOT NULL DEFAULT '',
	`municipioid` INT NOT NULL DEFAULT '0',
	`hospfromid` INT NOT NULL DEFAULT '0',
	`hosptoid` INT NOT NULL DEFAULT '0',
	`promotoria` INT NOT NULL DEFAULT '0',
	`created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;