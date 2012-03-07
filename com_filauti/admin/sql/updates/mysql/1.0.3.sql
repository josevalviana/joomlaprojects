ALTER TABLE `#__filauti_evolucoes` ADD COLUMN `ventilacao` TINYINT(1) UNSIGNED NOT NULL default '0';
ALTER TABLE `#__filauti_evolucoes` ADD COLUMN `vasoativa` TINYINT(1) UNSIGNED NOT NULL default '0';
ALTER TABLE `#__filauti_evolucoes` ADD COLUMN `hemodialise` TINYINT(1) UNSIGNED NOT NULL default '0';
ALTER TABLE `#__filauti_evolucoes` ADD COLUMN `hepatica` TINYINT(1) UNSIGNED NOT NULL default '0';
ALTER TABLE `#__filauti_evolucoes` ADD COLUMN `doador` TINYINT(1) UNSIGNED NOT NULL default '0';
ALTER TABLE `#__filauti_evolucoes` ADD COLUMN `gcs` TINYINT(2) UNSIGNED NOT NULL default '15';