-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2021 a las 18:36:31
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
('AB3672DE38', 'camara', 'Nikon', 'D800', 'stock', '', 'img/materiales/AB3672DE38.png'),
('AG5872HY89', 'auricular', 'Bose', '35 II', 'stock', '', 'img/materiales/AG5872HY89.png'),
('AW3429FJ32', 'microfono', 'Sennheiser', 'MD441-U', 'stock', '', 'img/materiales/AW3429FJ32.png'),
('DJ3782NJ39', 'auricular', 'Audio-Technica', 'ATHM50XBT', 'stock', '', 'img/materiales/DJ3782NJ39.png'),
('DU3784GD32', 'camara', 'Canon', 'XF100', 'stock', '', 'img/materiales/DU3784GD32.png'),
('HR4568RS56', 'cable', 'VMC', '15FS', 'stock', '', 'img/materiales/HR4568RS56.png'),
('RE3847RF38', 'microfono', 'Shure', 'SM 7B', 'stock', '', 'img/materiales/RE3847RF38.png'),
('UY3783JK39', 'tripode', 'Manfrotto', 'MVK504XT', 'stock', '', 'img/materiales/UY3783JK39.png');

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
  `contrasenia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre_usuarios`, `apellidos`, `curso`, `rol`, `ciclo`, `moroso`, `num_objetos`, `contrasenia`) VALUES
('', 'admin', '', 0, '', '', 0, 0, 'admin'),
('27263749O', 'Ibai', 'Llanos Garatea', 2, 'usuario', 'DAM', 0, 0, ''),
('28749290N', 'Manuel', 'Ruiz de Lopera', 2, 'usuario', 'RAE', 0, 0, ''),
('28894737E', 'Joaquín', 'Sánchez Rodriguez', 1, 'usuario', 'A3D', 0, 0, ''),
('29254729Z', 'Nuria', 'Fuentes Fuentes', 1, 'usuario', 'DAM', 0, 0, '');

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
