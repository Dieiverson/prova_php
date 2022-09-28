# Host: 127.0.0.1  (Version 5.5.5-10.4.17-MariaDB)
# Date: 2022-09-28 09:21:23
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "aeroporto"
#

DROP TABLE IF EXISTS `aeroporto`;
CREATE TABLE `aeroporto` (
  `id_aeroporto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `sigla` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_aeroporto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "aeroporto"
#


#
# Structure for table "cia_aerea"
#

DROP TABLE IF EXISTS `cia_aerea`;
CREATE TABLE `cia_aerea` (
  `Id_cia` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL COMMENT 'regional, nacional,internacional',
  `id_aeroporto` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id_cia`),
  KEY `id_aeroporto` (`id_aeroporto`),
  CONSTRAINT `id_aeroporto` FOREIGN KEY (`id_aeroporto`) REFERENCES `aeroporto` (`id_aeroporto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "cia_aerea"
#


#
# Structure for table "aviao"
#

DROP TABLE IF EXISTS `aviao`;
CREATE TABLE `aviao` (
  `id_aviao` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `id_cia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aviao`),
  KEY `id_cia` (`id_cia`),
  CONSTRAINT `id_cia` FOREIGN KEY (`id_cia`) REFERENCES `cia_aerea` (`Id_cia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "aviao"
#

