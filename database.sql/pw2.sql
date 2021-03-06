-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2021 a las 02:47:05
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
(1, 'Calandria', 300, 'O1', 200, 75, 25, 'Suborbital'),
(2, 'Colibri', 120, 'O2', 100, 18, 2, 'Suborbital'),
(3, 'Zorzal', 100, 'BA1', 50, 0, 50, 'BA'),
(4, 'Carancho', 110, 'BA4', 110, 0, 0, 'BA'),
(5, 'Aguilucho', 60, 'BB4', 0, 50, 10, 'BA'),
(6, 'Canario', 80, 'BA14', 0, 70, 10, 'BA'),
(7, 'Aguila', 300, 'AA13', 200, 75, 25, 'AA'),
(8, 'Condor', 350, 'CO10', 300, 10, 40, 'AA'),
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
-- Estructura de tabla para la tabla `lista_espera`
--

CREATE TABLE `lista_espera` (
  `id_lista_espera` smallint(6) NOT NULL,
  `idvuelo` smallint(6) NOT NULL,
  `idusuario` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lista_espera`
--

INSERT INTO `lista_espera` (`id_lista_espera`, `idvuelo`, `idusuario`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idreserva` smallint(6) NOT NULL,
  `vuelo_id` smallint(6) NOT NULL,
  `usuario_id` smallint(6) NOT NULL,
  `comprobante` varchar(15) NOT NULL,
  `tipo_asiento` varchar(10) NOT NULL,
  `numero_asiento` int(10) NOT NULL,
  `fila_asiento` varchar(1) NOT NULL,
  `tipo_servicio` varchar(20) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idreserva`, `vuelo_id`, `usuario_id`, `comprobante`, `tipo_asiento`, `numero_asiento`, `fila_asiento`, `tipo_servicio`, `estado`) VALUES
(75, 15, 11, '5f7354de', 'general', 1, 'A', 'Standard', 'Confirmado'),
(76, 15, 11, '5f7354de', 'general', 2, 'A', 'Standard', 'Confirmado');

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
(7, 2, 1, '2021-10-30'),
(8, 2, 3, '2021-10-30'),
(9, 2, 2, '2021-11-30'),
(10, 2, 1, '2021-10-30'),
(11, 3, 1, '2021-10-30'),
(13, 3, 3, '2021-10-31'),
(14, 2, 2, '2021-10-28'),
(17, 2, 1, '2021-11-27'),
(18, 2, 2, '2021-11-27'),
(36, 3, 1, '2021-11-04'),
(46, 3, 1, '2021-11-07'),
(47, 3, 1, '2021-11-07'),
(48, 3, 1, '2021-11-08'),
(49, 3, 1, '2021-11-09'),
(50, 10, 1, '2021-11-16'),
(51, 3, 1, '2021-11-15'),
(52, 3, 1, '2021-11-15'),
(53, 3, 1, '2021-11-16'),
(54, 3, 1, '2021-11-15'),
(55, 11, 1, '2021-11-15');

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
(10, 'ezequiel.sanson@hotmail.com', 'USUARIO', 'asd', NULL, 3),
(11, 'ezequieldamian1@gmail.com', 'USUARIO', 'asd', NULL, 3);

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
  `destino` varchar(50) NOT NULL,
  `general` int(10) NOT NULL,
  `familiar` int(10) NOT NULL,
  `suite` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`idvuelo`, `dia`, `equipo_id`, `duracion`, `origen`, `horario`, `tipo_vuelo`, `destino`, `general`, `familiar`, `suite`) VALUES
(1, '2021-11-08', 1, 5, 'Buenos Aires', '22:00:00', 'Orbital', 'Estacion Espacial Internacional', 0, 0, 0),
(11, '2021-11-10', 3, 8, 'Ankara', '19:00:00', 'BA', 'Luna', 37, 0, 50),
(15, '2021-11-17', 3, 8, 'Ankara', '19:00:00', 'BA', 'Luna', 45, 0, 50),
(16, '2021-11-15', 1, 2, 'Buenos Aires', '12:10:00', 'Suborbital', 'Estacion Espacial Internacional', 200, 75, 25),
(17, '2021-11-15', 1, 5, 'Buenos Aires', '22:00:00', 'Orbital', 'Estacion Espacial Internacional', 200, 75, 25),
(18, '2021-11-19', 7, 3, 'Buenos Aires', '09:00:00', 'AA', 'Ganimedes', 200, 75, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo_semanal`
--

CREATE TABLE `vuelo_semanal` (
  `idvuelo_semanal` smallint(6) NOT NULL,
  `dia` varchar(15) NOT NULL,
  `equipo_id` smallint(6) NOT NULL,
  `duracion` smallint(6) DEFAULT NULL,
  `partida` varchar(15) NOT NULL,
  `destino` varchar(45) NOT NULL,
  `tipo_vuelo` varchar(15) NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vuelo_semanal`
--

INSERT INTO `vuelo_semanal` (`idvuelo_semanal`, `dia`, `equipo_id`, `duracion`, `partida`, `destino`, `tipo_vuelo`, `horario`) VALUES
(1, 'Lunes', 1, 5, 'Buenos Aires', 'Estacion Espacial Internacional', 'Orbital', '22:00:00'),
(2, 'Martes', 2, 6, 'Buenos Aires', 'OrbiterHotel', 'Orbital', '20:00:00'),
(3, 'Miercoles', 3, 8, 'Ankara', 'Luna', 'BA', '19:00:00'),
(4, 'Jueves', 4, 9, 'Ankara', 'Marte', 'BA', '11:00:00'),
(5, 'Viernes', 7, 3, 'Buenos Aires', 'Ganimedes', 'AA', '09:00:00'),
(6, 'Sabado', 8, 2, 'Buenos Aires', 'Europa', 'AA', '14:00:00'),
(7, 'Domingo', 5, 4, 'Ankara', 'Lo', 'BA', '18:00:00'),
(8, 'Lunes', 10, 1, 'Buenos Aires', 'Encendalo', 'AA', '15:00:00'),
(9, 'Martes', 2, 11, 'Buenos Aires', 'Titan', 'Orbital', '16:00:00'),
(10, 'Miercoles', 5, 8, 'Ankara', 'Europa', 'BA', '17:00:00'),
(11, 'Lunes', 1, 2, 'Buenos Aires', 'Estacion Espacial Internacional', 'Suborbital', '12:10:00'),
(12, 'Domingo', 1, 3, 'Buenos Aires', 'Estacion Espacial Internacional', 'Suborbital', '13:12:00');

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
-- Indices de la tabla `lista_espera`
--
ALTER TABLE `lista_espera`
  ADD PRIMARY KEY (`id_lista_espera`),
  ADD KEY `lista_ibfk_1` (`idusuario`),
  ADD KEY `lista_ibfk_2` (`idvuelo`);

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
-- Indices de la tabla `vuelo_semanal`
--
ALTER TABLE `vuelo_semanal`
  ADD PRIMARY KEY (`idvuelo_semanal`),
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
-- AUTO_INCREMENT de la tabla `lista_espera`
--
ALTER TABLE `lista_espera`
  MODIFY `id_lista_espera` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idreserva` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `idturno` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  MODIFY `idvuelo` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `vuelo_semanal`
--
ALTER TABLE `vuelo_semanal`
  MODIFY `idvuelo_semanal` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lista_espera`
--
ALTER TABLE `lista_espera`
  ADD CONSTRAINT `lista_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `lista_ibfk_2` FOREIGN KEY (`idvuelo`) REFERENCES `vuelo` (`idvuelo`);

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

--
-- Filtros para la tabla `vuelo_semanal`
--
ALTER TABLE `vuelo_semanal`
  ADD CONSTRAINT `vuelo_semanal_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`idequipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
