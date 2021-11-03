-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2021 a las 02:46:39
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pw2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idequipo` smallint(6) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `matricula` varchar(10) NOT NULL,
  `general` int(10) NOT NULL,
  `familiar` int(10) NOT NULL,
  `suite` int(10) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequipo`, `modelo`, `capacidad`, `matricula`, `general`, `familiar`, `suite`, `tipo`) VALUES
(1, 'Calandria', 267, 'O1', 200, 75, 25, 'Suborbital'),
(2, 'Colibri', 120, 'O2', 100, 18, 2, 'Suborbital'),
(3, 'Zorzal', 100, 'BA1', 50, 0, 50, 'BA'),
(4, 'Carancho', 110, 'BA4', 110, 0, 0, 'BA'),
(5, 'Aguilucho', 60, 'BB4', 0, 50, 10, 'BA'),
(6, 'Canario', 80, 'BA14', 0, 70, 10, 'BA'),
(7, 'Aguila', 300, 'AA13', 200, 75, 25, 'AA'),
(8, 'Condor', 333, 'CO10', 300, 10, 40, 'AA'),
(9, 'Halcon', 200, 'HA1', 150, 25, 25, 'AA'),
(10, 'Guanaco', 100, 'GU14', 100, 0, 0, 'AA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospital`
--

CREATE TABLE `hospital` (
  `idhospital` smallint(6) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `capacidad` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `hospital`
--

INSERT INTO `hospital` (`idhospital`, `nombre`, `capacidad`) VALUES
(1, 'Buenos Aires', 300),
(2, 'Shanghái', 210),
(3, 'Ankara', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idreserva` smallint(6) NOT NULL,
  `vuelo_id` smallint(6) NOT NULL,
  `usuario_id` smallint(6) NOT NULL,
  `cantidad_pasajeros` varchar(15) NOT NULL,
  `comprobante` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idreserva`, `vuelo_id`, `usuario_id`, `cantidad_pasajeros`, `comprobante`) VALUES
(31, 4, 2, '2', 'f83f2fec'),
(36, 4, 3, '3', '8f381f7a'),
(37, 4, 3, '3', '8f381f7a'),
(38, 10, 3, '2', 'b6971516'),
(39, 10, 3, '1', '2f9e44ac'),
(40, 10, 3, '1', '2f9e44ac'),
(41, 10, 3, '1', '2f9e44ac'),
(42, 10, 3, '1', '2f9e44ac'),
(51, 10, 3, '1', '2f9e44ac'),
(52, 10, 3, '1', '2f9e44ac'),
(53, 10, 3, '1', '2f9e44ac');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `idturno` smallint(6) NOT NULL,
  `usuario_id` smallint(6) NOT NULL,
  `hospital_id` smallint(30) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`idturno`, `usuario_id`, `hospital_id`, `dia`) VALUES
(4, 1, 1, '2021-10-26'),
(5, 1, 1, '2021-10-29'),
(6, 1, 2, '2021-10-30'),
(7, 2, 1, '2021-10-30'),
(8, 2, 3, '2021-10-30'),
(9, 2, 2, '2021-11-30'),
(10, 2, 1, '2021-10-30'),
(11, 3, 1, '2021-10-30'),
(12, 3, 2, '2021-10-30'),
(13, 3, 3, '2021-10-31'),
(14, 2, 2, '2021-10-28'),
(17, 2, 1, '2021-11-27'),
(18, 2, 2, '2021-11-27'),
(19, 3, 1, '2021-11-03'),
(35, 3, 1, '2021-11-24'),
(36, 3, 1, '2021-11-04'),
(37, 3, 1, '2021-11-05'),
(38, 3, 1, '2021-11-04'),
(39, 3, 1, '2021-11-04'),
(40, 3, 1, '2021-11-13'),
(41, 3, 1, '2021-11-13'),
(42, 3, 1, '2021-11-13'),
(43, 3, 1, '2021-11-19'),
(44, 3, 1, '2021-11-06'),
(45, 3, 1, '2021-11-02'),
(46, 3, 1, '2021-11-07'),
(47, 3, 1, '2021-11-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` smallint(6) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `rol` varchar(15) NOT NULL DEFAULT 'USUARIO',
  `clave` varchar(30) NOT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `nivelVuelo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario`, `rol`, `clave`, `hash`, `nivelVuelo`) VALUES
(1, 'admin@admin.com', 'ADMIN', 'admin', NULL, NULL),
(2, 'nsavedra97@gmail.com', 'USUARIO', 'hola', NULL, 3),
(3, 'ari@ari.com', 'USUARIO', 'hola', NULL, 1),
(4, 'NahuelSavedra@gmail.com', 'USUARIO', 'hola', 'f1b6f2857fb6d44dd73c7041e0aa0f19', 2),
(5, 'admin2@admin.com', 'USUARIO', 'hola', '6395ebd0f4b478145ecfbaf939454fa4', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

CREATE TABLE `vuelo` (
  `idvuelo` smallint(6) NOT NULL,
  `dia` date NOT NULL,
  `equipo_id` smallint(6) NOT NULL,
  `duracion` smallint(6) DEFAULT NULL,
  `origen` varchar(15) NOT NULL,
  `horario` time NOT NULL,
  `tipo_vuelo` varchar(15) NOT NULL,
  `destino` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`idvuelo`, `dia`, `equipo_id`, `duracion`, `origen`, `horario`, `tipo_vuelo`, `destino`) VALUES
(1, '2021-11-03', 1, 8, 'Buenos Aires', '08:00:00', 'Orbital', 'Titan'),
(4, '2021-11-02', 1, 8, 'Buenos Aires', '08:00:00', 'Orbital', 'Marte'),
(10, '2021-11-02', 8, 6, 'Buenos Aires', '22:08:20', 'AA', 'Titan');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idequipo`);

--
-- Indices de la tabla `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`idhospital`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idreserva`),
  ADD KEY `vuelo_id` (`vuelo_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`idturno`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD PRIMARY KEY (`idvuelo`),
  ADD KEY `equipo_id` (`equipo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequipo` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `hospital`
--
ALTER TABLE `hospital`
  MODIFY `idhospital` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idreserva` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `idturno` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  MODIFY `idvuelo` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`vuelo_id`) REFERENCES `vuelo` (`idvuelo`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `turno`
--
ALTER TABLE `turno`
  ADD CONSTRAINT `turno_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `turno_ibfk_2` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`idhospital`);

--
-- Filtros para la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`idequipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE vuelo_semanal (idvuelo_semanal SMALLINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                            dia VARCHAR(15) NOT NULL,
                            equipo_id SMALLINT NOT NULL,
                            duracion SMALLINT,
                            partida VARCHAR(15) NOT NULL,
                            destino VARCHAR(15) NOT NULL,
                            tipo_vuelo VARCHAR(15) NOT NULL,
                            horario TIME NOT NULL ,
                            FOREIGN KEY (equipo_id) REFERENCES equipo(idequipo));