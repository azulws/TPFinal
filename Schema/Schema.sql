-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2022 a las 20:00:12
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
-- Estructura de tabla para la tabla `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idKeeper` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keeper`
--

CREATE TABLE `keeper` (
  `idKeeper` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `userPassword` varchar(50) DEFAULT NULL,
  `remuneration` int(50) DEFAULT 0,
  `reputation` int(50) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Volcado de datos para la tabla `owner`
--

INSERT INTO `owner` (`idOwner`, `firstName`, `lastName`, `userName`, `userPassword`) VALUES
(3, 'Santiago', 'Marcos', 'ChoryDay', 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `idOwner` int(11) DEFAULT NULL,
  `idPetType` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `petsize` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `vaccination` varchar(50) DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pet`
--

INSERT INTO `pet` (`id`, `name`, `idOwner`, `idPetType`, `description`, `petsize`, `image`, `vaccination`, `video`) VALUES
(1, 'joan', 3, 2, 'amigable', 'MEDIUM', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `petsize`
--

CREATE TABLE `petsize` (
  `id` int(11) NOT NULL,
  `petsize` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `pettype` (
  `id` int(11) NOT NULL,
  `breed` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pettype`
--

INSERT INTO `pettype` (`id`, `breed`) VALUES
(1, 'Dog'),
(2, 'Cat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `size_x_keeper`
--

CREATE TABLE `size_x_keeper` (
  `id` int(11) NOT NULL,
  `idPetSize` int(11) DEFAULT NULL,
  `idKeeper` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idKeeper` (`idKeeper`);

--
-- Indices de la tabla `keeper`
--
ALTER TABLE `keeper`
  ADD PRIMARY KEY (`idKeeper`);

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
-- Indices de la tabla `petsize`
--
ALTER TABLE `petsize`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pettype`
--
ALTER TABLE `pettype`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `size_x_keeper`
--
ALTER TABLE `size_x_keeper`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_sizeXkeeper` (`idPetSize`,`idKeeper`),
  ADD KEY `idKeeper` (`idKeeper`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `keeper`
--
ALTER TABLE `keeper`
  MODIFY `idKeeper` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `owner`
--
ALTER TABLE `owner`
  MODIFY `idOwner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `petsize`
--
ALTER TABLE `petsize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `size_x_keeper`
--
ALTER TABLE `size_x_keeper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
