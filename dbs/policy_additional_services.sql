-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-12-2022 a las 00:42:05
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seguros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `policy_additional_services`
--

DROP TABLE IF EXISTS `policy_additional_services`;
CREATE TABLE IF NOT EXISTS `policy_additional_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_spanish_ci NOT NULL,
  `price` int NOT NULL,
  `policynumber` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(41, 'Gastos funenrarios', 100, '', 17);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
