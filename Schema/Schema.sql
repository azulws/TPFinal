-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2022 a las 03:57:12
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `owner`
--

CREATE TABLE `owner` (
  `idOwner` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `userPassword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `idOwner` int(11) DEFAULT NULL,
  `idPetType` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pettype`
--

CREATE TABLE `pettype` (
  `id` int(11) NOT NULL,
  `tamaño` varchar(50) DEFAULT NULL,
  `specie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pettype`
--

INSERT INTO `pettype` (`id`, `tamaño`, `specie`) VALUES
(1, 'Small', 'Dog'),
(2, 'Medium', 'Dog'),
(3, 'Big', 'Dog'),
(4, 'Small', 'Cat');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`idOwner`);

--
-- Indices de la tabla `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idOwner` (`idOwner`),
  ADD KEY `fk_idPetType` (`idPetType`);

--
-- Indices de la tabla `pettype`
--
ALTER TABLE `pettype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `owner`
--
ALTER TABLE `owner`
  MODIFY `idOwner` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `fk_idOwner` FOREIGN KEY (`idOwner`) REFERENCES `owner` (`idOwner`),
  ADD CONSTRAINT `fk_idPetType` FOREIGN KEY (`idPetType`) REFERENCES `pettype` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
