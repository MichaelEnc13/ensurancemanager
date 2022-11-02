-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-10-2022 a las 17:06:39
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
-- Estructura de tabla para la tabla `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` text COLLATE utf8_spanish_ci NOT NULL,
  `lname` text COLLATE utf8_spanish_ci NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `address` text COLLATE utf8_spanish_ci NOT NULL,
  `tel` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `date` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cid` (`cid`(15),`email`(50)) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `fname`, `lname`, `cid`, `address`, `tel`, `email`, `date`, `uid`) VALUES
(14, 'Laura Melissa', 'Encarnación Florentino', '1004113171', 'esadsad', '8295942398', 'lauramelissa26@gmail.com', '10/10/2022', 17),
(15, 'Juana', 'Diaz', '11454582455', 'Calle bonaire', '8294455432', 'jd@mail.com', '10/10/22', 17),
(16, 'Marina', 'Perez', '774185256', 'Salcedo', '44854966664', 'mp@mail.com', '10/10/22', 17),
(17, 'Antonifel', 'Pimentel', '11456a1d6s1ad6', 'sadsdsa', '‪8094423750‬', 'am@d.c', '19/10/22', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ensurance_company`
--

DROP TABLE IF EXISTS `ensurance_company`;
CREATE TABLE IF NOT EXISTS `ensurance_company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company` text COLLATE utf8_spanish_ci NOT NULL,
  `img_dir` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `policy`
--

DROP TABLE IF EXISTS `policy`;
CREATE TABLE IF NOT EXISTS `policy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `policynumber` text COLLATE utf8_spanish_ci NOT NULL,
  `type` int NOT NULL,
  `value` int NOT NULL,
  `totalAdditional` int NOT NULL,
  `payMethod` int NOT NULL,
  `time` int NOT NULL,
  `aditionalService` text COLLATE utf8_spanish_ci NOT NULL,
  `car_plate` text COLLATE utf8_spanish_ci NOT NULL,
  `date_from` text COLLATE utf8_spanish_ci NOT NULL,
  `date_until` text COLLATE utf8_spanish_ci NOT NULL,
  `date_diff` text COLLATE utf8_spanish_ci NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `policy` (`policynumber`(35),`car_plate`(20)) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `policy`
--

INSERT INTO `policy` (`id`, `policynumber`, `type`, `value`, `totalAdditional`, `payMethod`, `time`, `aditionalService`, `car_plate`, `date_from`, `date_until`, `date_diff`, `cid`, `uid`) VALUES
(38, '14885-1515151515-4', 1, 25000, 540, 0, 0, '{\"0\":\"Patria asistencia\"}', 'A011226', '23-10-2022', '25-10-2022', '', '11456a1d6s1ad6', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `policy_dues`
--

DROP TABLE IF EXISTS `policy_dues`;
CREATE TABLE IF NOT EXISTS `policy_dues` (
  `id` int NOT NULL AUTO_INCREMENT,
  `policynumber` text COLLATE utf8_spanish_ci NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `due` int NOT NULL,
  `paid` int NOT NULL,
  `validity` text COLLATE utf8_spanish_ci NOT NULL,
  `amount` int NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `policy_dues`
--

INSERT INTO `policy_dues` (`id`, `policynumber`, `cid`, `due`, `paid`, `validity`, `amount`, `uid`) VALUES
(39, '14885-1515151515-2', '1004113171', 2, 0, '25-12-2022', 12500, 17),
(35, '14885-1515151515-3', '11454582455', 1, 1, '21-11-2022', 25000, 17),
(36, '14885-1515151515-3', '1004113171', 1, 1, '22-11-2022', 12500, 17),
(37, '14885-1515151515-3', '1004113171', 2, 1, '22-12-2022', 12500, 17),
(38, '14885-1515151515-2', '1004113171', 1, 0, '25-11-2022', 12500, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` text COLLATE utf8_spanish_ci NOT NULL,
  `lname` text COLLATE utf8_spanish_ci NOT NULL,
  `company` text COLLATE utf8_spanish_ci NOT NULL,
  `company_logo` text COLLATE utf8_spanish_ci NOT NULL,
  `representant` text COLLATE utf8_spanish_ci NOT NULL,
  `address` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `ip` text COLLATE utf8_spanish_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `company`, `company_logo`, `representant`, `address`, `email`, `password`, `ip`, `status`) VALUES
(17, 'Michael', 'Encarnacion', 'Seguros Patria, S. A.', 'patria.png', '41a1', 'Enriquillo', 'michaelenc.personal@gmail.com', '$2y$10$3aSN0i.SYoatYAcChCXRA.bLvd3sDRhWxSI0IOSoAq0M9c8H2qJ4.', '', 1),
(18, 'Michael', 'Encarnación', 'Atlántica Seguros, S.A.', 'atlantica.png', 'A002', 'Enriquillo', 'maicol132603@gmail.com', '$2y$10$Dxxod5c25mVm1DaZz8HpxuY.J8Sg3nv21IlH4kgXH/SUJbYtJo1ha', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` text COLLATE utf8_spanish_ci NOT NULL,
  `service` text COLLATE utf8_spanish_ci NOT NULL,
  `chassis` text COLLATE utf8_spanish_ci NOT NULL,
  `brand` text COLLATE utf8_spanish_ci NOT NULL,
  `model` text COLLATE utf8_spanish_ci NOT NULL,
  `year` text COLLATE utf8_spanish_ci NOT NULL,
  `ciliders` int NOT NULL,
  `passengers` int NOT NULL,
  `color` text COLLATE utf8_spanish_ci NOT NULL,
  `plate` text COLLATE utf8_spanish_ci NOT NULL,
  `ensured` tinyint(1) NOT NULL,
  `date` text COLLATE utf8_spanish_ci NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plate` (`plate`(15))
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`id`, `type`, `service`, `chassis`, `brand`, `model`, `year`, `ciliders`, `passengers`, `color`, `plate`, `ensured`, `date`, `cid`, `uid`) VALUES
(9, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'HONDA', 'CIVIC EX', '2020', 4, 5, 'NEGRO', 'A011223', 1, '10/10/22', '1004113171', 17),
(10, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s4112', 'TOYOTA', 'VITZ', '2016', 4, 5, 'BLANCO', 'A011243', 0, '10/10/22', '11454582455', 17),
(11, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41s', 'HONDA', 'CIVIC', '2020', 4, 5, 'NEGRO', 'A011224', 1, '10/10/22', '774185256', 17),
(13, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'HONDA', 'CIVIC EX', '2020', 4, 5, 'NEGRO', 'A011222', 0, '11/10/22', '1004113171', 17),
(14, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'HONDA', 'CIVIC EX', '2020', 4, 5, 'NEGRO', 'A909192', 0, '11/10/22', '1004113171', 17),
(15, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'HONDA', 'CIVIC EX', '2020', 4, 5, 'NEGRO', 'F14455121', 0, '11/10/22', '1004113171', 17),
(17, 'AUTOMOVIL', 'PRIVADO', 'asdasd111sd', 'HONDA', 'CIVIC', '2020', 4, 5, 'NEGRO', 'A011226', 1, '19/10/22', '11456a1d6s1ad6', 17);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
