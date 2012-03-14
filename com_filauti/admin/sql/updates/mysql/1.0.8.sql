CREATE TABLE IF NOT EXISTS `#__filauti_mod` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `filaid` INT NOT NULL default '0',
    `respiratory` TINYINT(1) NOT NULL default '0',
    `coagulation` TINYINT(1) NOT NULL default '0',
    `cardiovascular` TINYINT(1) NOT NULL default '0',
    `glasgow` TINYINT(1) NOT NULL default '0',
    `liver` TINYINT(1) NOT NULL default '0',
    `renal` TINYINT(1) NOT NULL default '0',
    `created` datetime NOT NULL default '0000-00-00 00:00:00',
    `created_by` int(10) unsigned NOT NULL default '0', 
    PRIMARY KEY (`id`),
    FOREIGN KEY (`filaid`) REFERENCES `#__filauti`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;