-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-11-2022 a las 20:49:38
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

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
-- Estructura de tabla para la tabla `mantenaince`
--

DROP TABLE IF EXISTS `mantenaince`;
CREATE TABLE IF NOT EXISTS `mantenaince` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_from` text COLLATE utf8_spanish_ci NOT NULL,
  `date_until` text COLLATE utf8_spanish_ci NOT NULL,
  `car_id` int NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mantenaince`
--

INSERT INTO `mantenaince` (`id`, `date_from`, `date_until`, `car_id`, `cid`, `uid`) VALUES
(8, '01-11-2022', '08-11-2022', 15, '114-1414141-7', 17),
(9, '03-11-2022', '04-11-2022', 13, '114-1414141-7', 17);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
