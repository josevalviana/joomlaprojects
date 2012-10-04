CREATE TABLE IF NOT EXISTS `#__auditoria` (
    `id` INTEGER NOT NULL auto_increment,
    `hospital` INTEGER unsigned NOT NULL default '0', 
    `turno` INTEGER unsigned NOT NULL default '0',
    `telefone` VARCHAR(255) default NULL,
    `intercorrencia` text default NULL,
    `created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0',
    `modified` datetime NOT NULL default '0000-00-00 00:00:00',
    `modified_by` int(10) unsigned NOT NULL default '0',
    PRIMARY KEY (`id`),
    KEY `idx_createdby` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__auditoria_atividades` (
    `id` INTEGER NOT NULL auto_increment,
    `auditoria` INTEGER NOT NULL,
    `sisreg` INTEGER NOT NULL,
    `nome` VARCHAR(255) NOT NULL,
    `diagnostico` VARCHAR(255) NOT NULL,
    `observacao` text default NULL,
    `created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0',
    `modified` datetime NOT NULL default '0000-00-00 00:00:00',
    `modified_by` int(10) unsigned NOT NULL default '0',
    PRIMARY KEY (`id`),
    FOREIGN KEY `fk_auditoria_atividade` (`auditoria`) REFERENCES `#__auditoria` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;