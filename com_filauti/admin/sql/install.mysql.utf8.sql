DROP TABLE IF EXISTS `#__filauti_evolucoes`;
DROP TABLE IF EXISTS `#__filauti`;
DROP TABLE IF EXISTS `#__municipios`;
DROP TABLE IF EXISTS `#__estados`;

CREATE TABLE `#__estados` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`sigla` VARCHAR(2) NOT NULL,
	`denominacao` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `idx_denominacao` (`denominacao`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `#__municipios` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`ufid` INT NOT NULL DEFAULT '0',
	`denominacao` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `idx_denominacao` (`denominacao`),
	FOREIGN KEY (`ufid`) REFERENCES `#__estados`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `#__filauti` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`sisreg` INT NOT NULL UNIQUE,
	`nome` VARCHAR(255) NOT NULL,
        `solicitante` VARCHAR(255) NOT NULL,
        `crm` VARCHAR(10) NOT NULL,
        `sexo` TINYINT(1) UNSIGNED NOT NULL default '0',
	`idade` INT NOT NULL DEFAULT '0',
	`idade_c` TINYINT(3) NOT NULL DEFAULT '0',
	`cid` VARCHAR(255) NOT NULL DEFAULT '',
	`munid` INT NOT NULL DEFAULT '0',
	`hospfromid` INT NOT NULL DEFAULT '0',
	`hosptoid` INT NOT NULL DEFAULT '0',
	`promotoria` TINYINT(1) UNSIGNED NOT NULL default '0',
	`encerrado` TINYINT(1) UNSIGNED NOT NULL default '0',
        `motencerra` TINYINT(1) UNSIGNED NOT NULL default '0',
	`encerramento` datetime NOT NULL default '0000-00-00 00:00:00',
	`created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0',
    `modified` datetime NOT NULL default '0000-00-00 00:00:00',
    `modified_by` int(10) unsigned NOT NULL default '0',
    PRIMARY KEY (`id`),
    KEY `idx_nome` (`nome`),
    FOREIGN KEY (`munid`) REFERENCES `#__municipios`(`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE `#__filauti_evolucoes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `filaid` INT NOT NULL default '0',
    `prioridade` INT NOT NULL default '0',  
    `ventilacao` TINYINT(1) UNSIGNED NOT NULL default '0',
    `arritmia` TINYINT(1) UNSIGNED NOT NULL default '0',
    `iam` TINYINT(1) UNSIGNED NOT NULL default '0',
    `icc` TINYINT(1) UNSIGNED NOT NULL default '0',
    `vasoativa` TINYINT(1) UNSIGNED NOT NULL default '0',
    `hemodialise` TINYINT(1) UNSIGNED NOT NULL default '0',
    `hepatica` TINYINT(1) UNSIGNED NOT NULL default '0',
    `sepse` TINYINT(1) UNSIGNED NOT NULL default '0',
    `isolamento` TINYINT(1) UNSIGNED NOT NULL default '0',
    `doador` TINYINT(1) UNSIGNED NOT NULL default '0',
    `gcs` TINYINT(2) UNSIGNED NOT NULL default '15',
    `tcc` TINYINT(1) UNSIGNED NOT NULL default '0',
    `convulsao` TINYINT(1) UNSIGNED NOT NULL default '0',
    `avc` TINYINT(1) UNSIGNED NOT NULL default '0',
    `mencef` TINYINT(1) UNSIGNED NOT NULL default '0',
    `acidose` TINYINT(1) UNSIGNED NOT NULL default '0',
    `pcr` TINYINT(1) UNSIGNED NOT NULL default '0',
    `posop` TINYINT(1) UNSIGNED NOT NULL default '0',
    `monitor` TINYINT(1) UNSIGNED NOT NULL default '0',
    `misc` mediumtext,
    `created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0', 
    PRIMARY KEY (`id`),
    FOREIGN KEY (`filaid`) REFERENCES `#__filauti`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
