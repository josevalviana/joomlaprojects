-- TABELA `#__filauti`
ALTER TABLE `#__filauti` ADD COLUMN `avc` TINYINT(1) NOT NULL default '0' AFTER `promotoria`;
ALTER TABLE `#__filauti` ADD COLUMN `mencef` TINYINT(1) NOT NULL default '0' AFTER `avc`;
ALTER TABLE `#__filauti` ADD COLUMN `hemodialise` TINYINT(1) NOT NULL default '0' AFTER `mencef`;
ALTER TABLE `#__filauti` ADD COLUMN `isolamento` TINYINT(1) NOT NULL default '0' AFTER `hemodialise`;
ALTER TABLE `#__filauti` ADD COLUMN `posop` TINYINT(1) NOT NULL default '0' AFTER `isolamento`;

-- TABELA `#__filauti_evolucoes`

ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `prioridade`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `avc`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `mencef`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `hemodialise`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `isolamento`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `posop`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `gcs`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `tcc`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `convulsao`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `arritmia`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `iam`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `icc`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `acidose`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `sepse`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `monitor`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `pcr`;
ALTER TABLE `#__filauti_evolucoes` ADD COLUMN `ira` TINYINT(1) UNSIGNED NOT NULL default '0' AFTER `hepatica`;

-- TABELA `#__filauti_mods`
DROP TABLE IF EXISTS `#__filauti_mod`;