# TABELA `#__filauti`
ALTER TABLE `#__filauti` ADD COLUMN `avc` TINYINT(1) NOT NULL default '0' AFTER `promotoria`;
ALTER TABLE `#__filauti` ADD COLUMN `mencef` TINYINT(1) NOT NULL default '0' AFTER `avc`;
ALTER TABLE `#__filauti` ADD COLUMN `hemodialise` TINYINT(1) NOT NULL default '0' AFTER `mencef`;
ALTER TABLE `#__filauti` ADD COLUMN `isolamento` TINYINT(1) NOT NULL default '0' AFTER `hemodialise`;
ALTER TABLE `#__filauti` ADD COLUMN `posop` TINYINT(1) NOT NULL default '0' AFTER `isolamento`;

# TABELA `#__filauti__evolucoes`

ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `prioridade`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `avc`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `mencef`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `hemodialise`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `isolamento`;
ALTER TABLE `#__filauti_evolucoes` DROP COLUMN `posop`;