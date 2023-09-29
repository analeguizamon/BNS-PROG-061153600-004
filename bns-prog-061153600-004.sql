-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2023 a las 14:21:41
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bns-prog-061153600-004`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(5) UNSIGNED NOT NULL,
  `sala` varchar(127) NOT NULL,
  `numero` int(5) UNSIGNED NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `sala`, `numero`, `disponible`) VALUES
(1, 'quirofano', 8, 0),
(2, 'quirofano', 7, 1),
(3, 'quirofano', 6, 1),
(4, 'quirofano', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `dni` bigint(40) UNSIGNED NOT NULL,
  `nombre` varchar(127) NOT NULL,
  `apellido` varchar(127) NOT NULL,
  `enfermero` bigint(40) UNSIGNED NOT NULL,
  `nacimiento` date NOT NULL,
  `telefono` varchar(127) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `enfermedad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(20) UNSIGNED NOT NULL,
  `area` int(5) UNSIGNED NOT NULL,
  `emergencia` tinyint(1) NOT NULL DEFAULT 0,
  `atendido` tinyint(1) NOT NULL DEFAULT 0,
  `tiempo1` datetime NOT NULL,
  `tiempo2` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `area`, `emergencia`, `atendido`, `tiempo1`, `tiempo2`) VALUES
(5, 1, 1, 0, '2023-09-29 06:45:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cuil` bigint(20) UNSIGNED NOT NULL,
  `clave` varchar(127) NOT NULL,
  `nombre` varchar(127) NOT NULL,
  `apellido` varchar(127) NOT NULL,
  `telefono` varchar(127) DEFAULT NULL,
  `email` varchar(127) DEFAULT NULL,
  `rol` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cuil`, `clave`, `nombre`, `apellido`, `telefono`, `email`, `rol`) VALUES
(27466808739, '85d06df09dc1871b839fda6192a4c773', 'ana', 'leguizamon', '', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cuil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
