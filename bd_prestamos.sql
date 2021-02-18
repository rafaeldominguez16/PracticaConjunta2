-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2021 a las 15:44:39
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_prestamos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `num_serie` varchar(12) NOT NULL,
  `nombre_materiales` enum('camara','auricular','cable','microfono','tripode') NOT NULL,
  `marca` varchar(15) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `estado` enum('prestamo','reparacion','stock') NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `ruta` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`num_serie`, `nombre_materiales`, `marca`, `modelo`, `estado`, `observaciones`, `ruta`) VALUES
('1', 'camara', 'canon', 'm89', 'prestamo', 'Davi no te pase', ''),
('34', 'auricular', 'trtw', 'rtrt', 'reparacion', 'erwerw', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `dni` varchar(9) NOT NULL,
  `num_serie` varchar(12) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `fecha_maxima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`dni`, `num_serie`, `fecha_prestamo`, `fecha_devolucion`, `fecha_maxima`) VALUES
('53535353H', '1', '2021-02-16', '0000-00-00', '2021-03-16'),
('53535353H', '34', '2021-02-10', '2021-02-11', '2021-04-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` varchar(9) NOT NULL,
  `nombre_usuarios` varchar(25) NOT NULL,
  `apellidos` varchar(25) NOT NULL,
  `curso` int(1) NOT NULL,
  `rol` enum('administrador','servicio_tecnico','usuario','') NOT NULL,
  `ciclo` varchar(10) NOT NULL,
  `moroso` tinyint(1) NOT NULL,
  `num_objetos` tinyint(4) NOT NULL,
  `contrasenia` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre_usuarios`, `apellidos`, `curso`, `rol`, `ciclo`, `moroso`, `num_objetos`, `contrasenia`) VALUES
('1', 'pepe', 'pepe', 2, 'usuario', 'DAW', 1, 1, ''),
('2', 'jojo', 'jojo', 1, 'usuario', 'DAM', 1, 2, ''),
('53535353H', 'jj', 'jj', 1, 'servicio_tecnico', 'dd', 1, 3, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`num_serie`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`dni`,`num_serie`,`fecha_prestamo`),
  ADD KEY `foranea` (`num_serie`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `foranea` FOREIGN KEY (`num_serie`) REFERENCES `materiales` (`num_serie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forenea_dni` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
