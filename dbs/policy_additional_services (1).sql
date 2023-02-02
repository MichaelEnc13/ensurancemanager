-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-12-2022 a las 01:59:21
-- Versión del servidor: 10.5.12-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u790594714_seguros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `policy_additional_services`
--

CREATE TABLE `policy_additional_services` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_spanish_ci NOT NULL,
  `price` int(11) NOT NULL,
  `policynumber` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `policy_additional_services`
--

INSERT INTO `policy_additional_services` (`id`, `name`, `price`, `policynumber`, `uid`) VALUES
(37, 'Servicio de avería mecánica', 2000, '', 17),
(36, 'Centro del automovilista', 1300, '', 17),
(34, 'Patria asistencia plus', 1500, '', 17),
(35, 'Casa del conductor', 1500, '', 17),
(33, 'Patria asistencia', 720, '', 17),
(38, 'Grúas plus', 1500, '', 17),
(39, 'Aero ambulancia', 900, '', 17),
(40, 'Moto salud (solo motores)', 100, '', 17),
(41, 'Gastos funenrarios', 100, '', 17),
(43, 'GASTOS FUNERARIOS', 100, '', 19),
(44, '	MOTO SALUD (SOLO MOTORES)', 100, '', 19),
(45, 'AERO AMBULANCIA', 900, '', 19),
(46, 'GRÚAS PLUS', 1500, '', 19),
(47, 'SERVICIO DE AVERÍA MECÁNICA', 2000, '', 19),
(48, 'CENTRO DEL AUTOMOVILISTA', 1300, '', 19),
(49, 'CASA DEL CONDUCTOR', 1500, '', 19),
(50, 'PATRIA ASISTENCIA PLUS', 1500, '', 19),
(51, 'PATRIA ASISTENCIA', 720, '', 19);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `policy_additional_services`
--
ALTER TABLE `policy_additional_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `policy_additional_services`
--
ALTER TABLE `policy_additional_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
