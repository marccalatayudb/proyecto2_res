-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2017 a las 15:21:12
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto2_res`
--
CREATE DATABASE IF NOT EXISTS `proyecto2_res` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `proyecto2_res`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso`
--

CREATE TABLE `recurso` (
  `idrecurso` int(3) NOT NULL,
  `nom_recurso` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `recurso`
--

INSERT INTO `recurso` (`idrecurso`, `nom_recurso`) VALUES
(1, 'Aula A de teoría con Proyector'),
(2, 'Aula B de teoría con Proyector'),
(3, 'Aula C de teoría sin proyector'),
(4, 'Aula de Informática A'),
(5, 'Aula de Informática B'),
(6, 'Despacho de entrevista A'),
(7, 'Despacho de entrevista B'),
(8, 'Sala de reuniones'),
(9, 'Proyector portátil'),
(10, 'Carro de portátiles'),
(11, 'Portátil A1'),
(12, 'Portátil B2'),
(13, 'Portátil C3'),
(14, 'Móvil A1'),
(15, 'Móvil A2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idreserva` int(3) NOT NULL,
  `idusuario` int(3) DEFAULT NULL,
  `disponibilidad` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idreserva`, `idusuario`, `disponibilidad`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, NULL, 1),
(4, NULL, 1),
(5, NULL, 1),
(6, NULL, 1),
(7, NULL, 1),
(8, NULL, 1),
(9, NULL, 1),
(10, NULL, 1),
(11, NULL, 1),
(12, NULL, 1),
(13, NULL, 1),
(14, NULL, 1),
(15, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_recurso`
--

CREATE TABLE `reserva_recurso` (
  `idreserva_recurso` int(3) NOT NULL,
  `idreserva` int(3) DEFAULT NULL,
  `idrecurso` int(3) DEFAULT NULL,
  `fecha_hora_reserva` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_hora_devolucion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reserva_recurso`
--

INSERT INTO `reserva_recurso` (`idreserva_recurso`, `idreserva`, `idrecurso`, `fecha_hora_reserva`, `fecha_hora_devolucion`) VALUES
(1, 1, 1, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(2, 2, 2, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(3, NULL, 3, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(4, NULL, 4, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(5, NULL, 5, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(6, NULL, 6, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(7, NULL, 7, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(8, NULL, 8, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(9, NULL, 9, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(10, NULL, 10, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(11, NULL, 11, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(12, NULL, 12, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(13, NULL, 13, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(14, NULL, 14, '2017-11-10 09:00:00', '2017-11-10 11:00:00'),
(15, NULL, 15, '2017-11-10 09:00:00', '2017-11-10 11:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(3) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `apellidos`, `alias`, `pwd`) VALUES
(1, 'Luis David', 'Pallo', 'ldavidp', 'hola'),
(2, 'Óscar', 'Solé', 'osole', 'qweQWE123'),
(3, 'Rubén', 'Jurado', 'rjurado', 'asdASD123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`idrecurso`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idreserva`),
  ADD KEY `FK_idusuario` (`idusuario`) USING BTREE;

--
-- Indices de la tabla `reserva_recurso`
--
ALTER TABLE `reserva_recurso`
  ADD PRIMARY KEY (`idreserva_recurso`),
  ADD KEY `FK_idreserva` (`idreserva`),
  ADD KEY `FK_idrecurso` (`idrecurso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recurso`
--
ALTER TABLE `recurso`
  MODIFY `idrecurso` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idreserva` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `reserva_recurso`
--
ALTER TABLE `reserva_recurso`
  MODIFY `idreserva_recurso` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `reserva_recurso`
--
ALTER TABLE `reserva_recurso`
  ADD CONSTRAINT `FK_idrecurso` FOREIGN KEY (`idrecurso`) REFERENCES `recurso` (`idrecurso`),
  ADD CONSTRAINT `FK_idreserva` FOREIGN KEY (`idreserva`) REFERENCES `reserva` (`idreserva`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
