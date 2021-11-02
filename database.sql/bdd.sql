-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2021 a las 19:20:18
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
                          `matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequipo`, `modelo`, `capacidad`, `matricula`) VALUES
                                                                          (1, 'calandria', 266, 'O1'),
                                                                          (2, 'colibri', 96, '');

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
    (21, 1, 2, '1', '1061d214');

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
                                                                        (18, 2, 2, '2021-11-27');

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
                                                                                         (3, 'ari@ari.com', 'USUARIO', 'hola', NULL, 3),
                                                                                         (4, 'NahuelSavedra@gmail.com', 'USUARIO', 'hola', 'f1b6f2857fb6d44dd73c7041e0aa0f19', 2),
                                                                                         (5, 'admin2@admin.com', 'USUARIO', 'hola', '6395ebd0f4b478145ecfbaf939454fa4', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

CREATE TABLE `vuelo` (
                         `idvuelo` smallint(6) NOT NULL,
                         `dia` text NOT NULL,
                         `equipo_id` smallint(6) NOT NULL,
                         `duracion` smallint(6) DEFAULT NULL,
                         `partida` varchar(15) NOT NULL,
                         `horario` time NOT NULL,
                         `tipo_vuelo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`idvuelo`, `dia`, `equipo_id`, `duracion`, `partida`, `horario`, `tipo_vuelo`) VALUES
                                                                                                        (1, '2021-11-03', 1, 8, 'BA', '08:00:00', 'orbital'),
                                                                                                        (4, '2021-11-02', 1, 8, 'BA', '08:00:00', 'orbital');

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
    MODIFY `idequipo` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `hospital`
--
ALTER TABLE `hospital`
    MODIFY `idhospital` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
    MODIFY `idreserva` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
    MODIFY `idturno` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
    MODIFY `idusuario` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vuelo`
--
ALTER TABLE `vuelo`
    MODIFY `idvuelo` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
