-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-12-2022 a las 00:41:11
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
-- Estructura de tabla para la tabla `aditionalservice`
--

DROP TABLE IF EXISTS `aditionalservice`;
CREATE TABLE IF NOT EXISTS `aditionalservice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `policynumber` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=262 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aditionalservice`
--

INSERT INTO `aditionalservice` (`id`, `service_id`, `policynumber`, `uid`) VALUES
(236, 37, '14885-1515151515-2', 17),
(238, 36, '14885-1515151515-2', 17),
(220, 37, '14885-1515151515-213', 17),
(221, 36, '14885-1515151515-213', 17),
(222, 34, '14885-1515151515-213', 17),
(257, 34, '14885-1515151515-2', 17);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
