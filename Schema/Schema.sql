-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-11-2022 a las 21:37:24
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pethero`
--
CREATE DATABASE IF NOT EXISTS `pethero` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pethero`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `availability`
--

DROP TABLE IF EXISTS `availability`;
CREATE TABLE IF NOT EXISTS `availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `idKeeper` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idKeeper` (`idKeeper`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keeper`
--

DROP TABLE IF EXISTS `keeper`;
CREATE TABLE IF NOT EXISTS `keeper` (
  `idKeeper` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `userPassword` varchar(50) DEFAULT NULL,
  `remuneration` int(50) DEFAULT '0',
  `reputation` int(50) DEFAULT '0',
  PRIMARY KEY (`idKeeper`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `owner`
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `idOwner` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `userPassword` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idOwner`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `owner`
--

INSERT INTO `owner` (`idOwner`, `firstName`, `lastName`, `userName`, `userPassword`) VALUES
(3, 'Santiago', 'Marcos', 'ChoryDay', 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE IF NOT EXISTS `pet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `idOwner` int(11) DEFAULT NULL,
  `idPetType` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `petsize` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `vaccination` varchar(50) DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idOwner` (`idOwner`),
  KEY `fk_idPetType` (`idPetType`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pet`
--

INSERT INTO `pet` (`id`, `name`, `idOwner`, `idPetType`, `description`, `petsize`, `image`, `vaccination`, `video`) VALUES
(1, 'joan', 3, 2, 'amigable', 'MEDIUM', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `petsize`
--

DROP TABLE IF EXISTS `petsize`;
CREATE TABLE IF NOT EXISTS `petsize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `petsize` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `petsize`
--

INSERT INTO `petsize` (`id`, `petsize`) VALUES
(1, 'SMALL'),
(2, 'MEDIUM'),
(3, 'BIG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pettype`
--

DROP TABLE IF EXISTS `pettype`;
CREATE TABLE IF NOT EXISTS `pettype` (
  `id` int(11) NOT NULL,
  `breed` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pettype`
--

INSERT INTO `pettype` (`id`, `breed`) VALUES
(1, 'Dog'),
(2, 'Cat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idKeeper` int(11) NOT NULL,
  `idPet` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `state` varchar(100) NOT NULL DEFAULT 'PENDING',
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Keeper` (`idKeeper`),
  KEY `FK_Pet` (`idPet`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `size_x_keeper`
--

DROP TABLE IF EXISTS `size_x_keeper`;
CREATE TABLE IF NOT EXISTS `size_x_keeper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPetSize` int(11) DEFAULT NULL,
  `idKeeper` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_sizeXkeeper` (`idPetSize`,`idKeeper`),
  KEY `idKeeper` (`idKeeper`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `fk_idKeeper` FOREIGN KEY (`idKeeper`) REFERENCES `keeper` (`idKeeper`);

--
-- Filtros para la tabla `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `fk_idOwner` FOREIGN KEY (`idOwner`) REFERENCES `owner` (`idOwner`),
  ADD CONSTRAINT `fk_idPetType` FOREIGN KEY (`idPetType`) REFERENCES `pettype` (`id`);

--
-- Filtros para la tabla `size_x_keeper`
--
ALTER TABLE `size_x_keeper`
  ADD CONSTRAINT `size_x_keeper_ibfk_1` FOREIGN KEY (`idKeeper`) REFERENCES `keeper` (`idKeeper`),
  ADD CONSTRAINT `size_x_keeper_ibfk_2` FOREIGN KEY (`idPetSize`) REFERENCES `petsize` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
