-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-12-2022 a las 01:06:15
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
(222, 34, '14885-1515151515-213', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billing`
--

DROP TABLE IF EXISTS `billing`;
CREATE TABLE IF NOT EXISTS `billing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plan` int NOT NULL,
  `value` int NOT NULL,
  `date_start` int NOT NULL,
  `date_next` int NOT NULL,
  `cid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `fname`, `lname`, `cid`, `address`, `tel`, `email`, `date`, `uid`) VALUES
(14, 'Laura Melissa', 'Encarnación Florentino', '1004113174', 'esadsad', '8295942398', '', '10/10/2022', 17),
(15, 'Juana', 'Diaz', '11454582456', 'Calle bonaire', '8294455432', 'jd@mail.com', '10/10/22', 17),
(16, 'Marina', 'Perez', '145541', 'Salcedo', '44854966664', 'mp@mail.com', '10/10/22', 17),
(20, 'Laura Melissa', 'Encarnación', '151-5151515-1', 'esadsad515', '849-344-5432', 'MAIL@EXAMPLE.c', '30/11/22', 17),
(17, 'Antonifel', 'Pimentel', '11456a1d6s1ad6', 'sadsdsa', '‪809-442-3750‬', 'am@d.c', '19/10/22', 17),
(18, 'Laura', 'Encarnación', '414-4444444-4', 'esadsad', '8294455432', '', '30/10/22', 17),
(19, 'Jhon', 'Doe', '114-1414141-7', 'esadsad', '111-111-1111', '', '30/10/22', 17),
(21, 'aa', 'aa', '111-1111111-1', 'aa', '114-141-4141', 'aa4@mail.com', '30/12/22', 17);

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
-- Estructura de tabla para la tabla `mantenaince`
--

DROP TABLE IF EXISTS `mantenaince`;
CREATE TABLE IF NOT EXISTS `mantenaince` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_from` text COLLATE utf8_spanish_ci NOT NULL,
  `date_until` text COLLATE utf8_spanish_ci NOT NULL,
  `oil_type` text COLLATE utf8_spanish_ci NOT NULL,
  `oil_grade` text COLLATE utf8_spanish_ci NOT NULL,
  `car_id` int NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `initial` int NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `policy`
--

INSERT INTO `policy` (`id`, `policynumber`, `type`, `value`, `totalAdditional`, `initial`, `payMethod`, `time`, `aditionalService`, `car_plate`, `date_from`, `date_until`, `date_diff`, `cid`, `uid`) VALUES
(48, '14885-1515151515-2', 1, 25000, 3300, 20000, 1, 1, '', '17', '08-12-2022', '31-01-2023', '', '151-5151515-1', 17);

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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(43, 'otros', 500, '', 17);

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
  `amount` float NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `policy_dues`
--

INSERT INTO `policy_dues` (`id`, `policynumber`, `cid`, `due`, `paid`, `validity`, `amount`, `uid`) VALUES
(170, '14885-1515151515-2', '151-5151515-1', 1, 0, '30-01-2023', 8300, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `template_pos` json NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `template_pos`, `uid`) VALUES
(6, '{\"posX\": \"\", \"posY\": \"\"}', 17);

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
  `plan` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `company`, `company_logo`, `representant`, `address`, `email`, `password`, `ip`, `plan`, `status`) VALUES
(17, 'Michael Jr.', 'Encarnacion Florentino', 'Seguros Patria, S. A.', 'patria.png', 'A002', 'Enriquillo', 'michaelenc.personal@gmail.com', '$2y$10$9TGQ1j6GB.a8Nxb2eIiqpuaux465EVlcpRsVfa8XFTpVmXukd.OYC', '', 0, 1),
(18, 'Michael', 'Encarnación', 'Atlántica Seguros, S.A.', 'atlantica.png', 'A002', 'Enriquillo', 'apm.system@gmail.com', '$2y$10$Bn3xRgAbX2HUVvO7Jlwx9enUbsph/ZaC/sk801GlSCWZHF6fLQBf2', '', 0, 1),
(20, 'Michael', 'Encarnación', 'Atlántica Seguros, S.A.', 'atlantica.png', 'A001', 'Enriquillo', 'matilde_florentino@hotmail.com', '$2y$10$zuUmyMs9yHQ.TjVLPR1eyOfLPVjiYKXAo9tqyg3PyQ4Q56UzJPyE2', '', 0, 0),
(21, 'Michael', 'Encarnación', 'Atlántica Seguros, S.A.', 'atlantica.png', '41a12', 'Enriquillo', 'lauramelissa26@gmail.com', '$2y$10$GYQokEM6ZV/EU17TcXMCiO.auMx5LxMxigpoqLkSU19SG8gseOHX6', '', 0, 0),
(28, 'Michael', 'Encarnación', 'Seguros Patria, S. A.', 'patria.png', '41a1152', 'esadsad', 'maicol132603@gmail.com', '$2y$10$CVTbDWjmcFGZsjSEGk19KOdnzboU7f.zTGUnjfNSNV1Qiy2P/CjRy', '', 0, 0);

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`id`, `type`, `service`, `chassis`, `brand`, `model`, `year`, `ciliders`, `passengers`, `color`, `plate`, `ensured`, `date`, `cid`, `uid`) VALUES
(17, 'AUTOMOVIL', 'PRIVADO', 'A1140024554sa41', 'HONDA', 'CIVIC', '2020', 4, 5, 'NEGRO', 'TRANSITO', 1, '04/12/22', '151-5151515-1', 17),
(16, 'AUTOMOVIL', 'asa', 'sasas', 'sas', 'asaasa', 'sas', 0, 5, 'sas', 'asa', 1, '30/11/22', '151-5151515-1', 17),
(5, 'asasas', 'asas', 'A1140024554s41', 'HONDA', 'CIVIC', '2020', 4, 5, 'NEGRO', 'a003', 1, '30/10/22', '11454582456', 17),
(6, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'HONDA', 'CIVIC', '2020', 4, 5, 'BLANCO', 'a002', 0, '30/10/22', '1004113174', 17),
(20, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'HONDA', 'CIVIC', '2020', 4, 5, 'Rojo', 'aasd', 0, '30/12/22', '111-1111111-1', 17),
(15, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'TOYOTA', 'CIVIC', '2020', 4, 5, 'NEGRO', 'TRANSITO', 0, '01/11/22', '114-1414141-7', 17),
(9, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'HONDA', 'CIVIC', '2020', 4, 5, 'NEGRO', 'TRANSITO', 0, '30/10/22', '', 17);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
