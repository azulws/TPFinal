-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-11-2022 a las 18:54:19
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

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `reservation_Add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_Add` (IN `idKeeper` INT, IN `idPet` INT, IN `startDate` DATE, IN `endDate` DATE, IN `price` INT)  BEGIN
    INSERT INTO reservation
        (reservation.idKeeper, reservation.idPet, reservation.startDate, reservation.endDate, reservation.price)
    VALUES
        (idKeeper, idPet, startDate, endDate, price);
	select last_insert_id();
END$$

DELIMITER ;

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
) ENGINE=MyISAM AUTO_INCREMENT=1479 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `availability`
--

INSERT INTO `availability` (`id`, `fecha`, `idKeeper`) VALUES
(1478, '2022-12-04', 1),
(1477, '2022-11-30', 1),
(1476, '2022-11-26', 1),
(1475, '2022-11-25', 1);

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
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idKeeper`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `keeper`
--

INSERT INTO `keeper` (`idKeeper`, `firstName`, `lastName`, `userName`, `userPassword`, `remuneration`, `reputation`, `email`) VALUES
(1, 'nabo', 'db', 'nabodb', 'asd', 50, 0, 'asd@hotmail.com'),
(3, 'test', 'test', 'testM', 'asd', 0, 0, 'testMail@hotmail.com'),
(4, 'n', 'u', 'nuevo', 'asd', 0, 0, 'nuevo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idMsg` int(11) NOT NULL AUTO_INCREMENT,
  `idKeeper` int(11) NOT NULL,
  `idOwner` int(11) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `isKeeper` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idMsg`),
  KEY `fk_idKeeper` (`idKeeper`),
  KEY `fk_idOwner` (`idOwner`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`idMsg`, `idKeeper`, `idOwner`, `msg`, `isKeeper`) VALUES
(62, 1, 1, 'asd', 'True'),
(63, 1, 1, 'as', 'True'),
(64, 1, 1, 's', 'True'),
(65, 1, 1, 'a', 'True'),
(66, 1, 1, 'a', 'True'),
(67, 3, 1, 'a', 'True'),
(68, 3, 1, 'v', 'True'),
(69, 1, 3, 'asd', 'True'),
(70, 1, 3, 'ds', 'True'),
(71, 1, 3, 'fddfd', 'True'),
(72, 1, 4, 'asd', 'True'),
(73, 1, 4, 'asd', 'True'),
(74, 1, 4, 'asd', 'True'),
(75, 1, 4, 'a', 'False'),
(76, 1, 4, 'je', 'False'),
(77, 1, 4, 'asd', 'True'),
(78, 1, 4, 'fd', 'True'),
(79, 1, 1, 'soy re pete', 'False'),
(80, 1, 1, ':(', 'False');

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
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idOwner`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `owner`
--

INSERT INTO `owner` (`idOwner`, `firstName`, `lastName`, `userName`, `userPassword`, `email`) VALUES
(1, 'azulws', 'db', 'azulwsdb', 'asd', 'azul1155cs@hotmail.com'),
(3, 'owner', 'owner', 'owner', 'asd', 'owner@gmail.com'),
(4, 'owner2', 'owner2', 'owner2', 'asd', 'owner2@gmail.com');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pet`
--

INSERT INTO `pet` (`id`, `name`, `idOwner`, `idPetType`, `description`, `petsize`, `image`, `vaccination`, `video`) VALUES
(1, 'gatodb', 1, 2, 'gato', 'MEDIUM', '', '', ''),
(2, 'asd', 1, 1, 'asd', 'MEDIUM', '', '', ''),
(3, 'emi', 1, 2, 'perra', 'SMALL', '', '', ''),
(4, 'emi2', 1, 1, 'asd', 'SMALL', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `petsize`
--

DROP TABLE IF EXISTS `petsize`;
CREATE TABLE IF NOT EXISTS `petsize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `petsize` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `idState` int(11) DEFAULT '1',
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Keeper` (`idKeeper`),
  KEY `FK_Pet` (`idPet`),
  KEY `FK_State` (`idState`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`id`, `idKeeper`, `idPet`, `startDate`, `endDate`, `idState`, `price`) VALUES
(10, 1, 3, '2022-11-20', '2022-11-20', 1, 100),
(11, 1, 2, '2022-11-25', '2022-11-25', 3, 100),
(12, 1, 3, '2022-11-25', '2022-11-25', 2, 100),
(13, 1, 1, '2022-11-25', '2022-11-25', 2, 50),
(14, 1, 1, '2022-11-26', '2022-11-26', 1, 50),
(15, 1, 3, '2022-11-26', '2022-11-26', 3, 50);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `size_x_keeper`
--

INSERT INTO `size_x_keeper` (`id`, `idPetSize`, `idKeeper`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `state`
--

INSERT INTO `state` (`id`, `state`) VALUES
(1, 'PENDING'),
(2, 'CANCELED'),
(3, 'ACCEPTED');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
