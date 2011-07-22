DROP TABLE IF EXISTS `#__vehicle`;

CREATE TABLE `#__vehicle` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `#__vehicle` (`name`) VALUES ('BASICA'),('CARRO MEDICO');