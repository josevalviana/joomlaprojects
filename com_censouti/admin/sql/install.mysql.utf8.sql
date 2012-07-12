DROP TABLE IF EXISTS `#__censouti`;

CREATE TABLE `#__censouti` (
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`sisreg` INTEGER NOT NULL,
	`nome` VARCHAR(255) NOT NULL,
	`hospital_id` INT NOT NULL default '0',
	`admissao` date NOT NULL default '0000-00-00',
	`diagnostico` VARCHAR(255) NOT NULL,
	`evolucao` TINYINT(1) NOT NULL default '0',
	`alta` TINYINT(1) NOT NULL default '0',
	`dt_alta` date NOT NULL default '0000-00-00',
	`created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0',
    `modified` datetime NOT NULL default '0000-00-00 00:00:00',
    `modified_by` int(10) unsigned NOT NULL default '0',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
