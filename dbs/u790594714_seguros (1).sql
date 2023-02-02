-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-12-2022 a las 02:00:55
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
-- Estructura de tabla para la tabla `aditionalservice`
--

CREATE TABLE `aditionalservice` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `policynumber` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aditionalservice`
--

INSERT INTO `aditionalservice` (`id`, `service_id`, `policynumber`, `uid`) VALUES
(236, 37, '14885-1515151515-2', 17),
(238, 36, '14885-1515151515-2', 17),
(220, 37, '14885-1515151515-213', 17),
(221, 36, '14885-1515151515-213', 17),
(222, 34, '14885-1515151515-213', 17),
(257, 34, '14885-1515151515-2', 17),
(262, 51, '1-3132-251643', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `plan` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `date_start` int(11) NOT NULL,
  `date_next` int(11) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `fname` text COLLATE utf8_spanish_ci NOT NULL,
  `lname` text COLLATE utf8_spanish_ci NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `address` text COLLATE utf8_spanish_ci NOT NULL,
  `tel` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `date` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `fname`, `lname`, `cid`, `address`, `tel`, `email`, `date`, `uid`) VALUES
(14, 'Laura Melissa', 'Encarnación Florentino', '1004113171', 'esadsad', '8295942398', 'lauramelissa26@gmail.com', '10/10/2022', 17),
(15, 'Juana', 'Diaz', '11454582455', 'Calle bonaire', '8294455432', 'jd@mail.com', '10/10/22', 17),
(16, 'Marina l', 'Perez', '774185256', 'Salcedo', '44854966', 'mp@mail.com', '10/10/22', 17),
(17, 'Antonifel', 'Pimentel', '11456a1d6s1ad6', 'sadsdsa', '‪8094423750‬', 'am@d.c', '19/10/22', 17),
(18, 'Antonifel E.', 'Pimentel Mancebo', '001-1732828-6', 'Av. 5to Centenario edif.31 Apt 4E', '809-442-3750', 'apm.system@gmail.com', '26/10/22', 19),
(19, 'Anderson Starlin', 'Guzman Soto', '402-2427462-7', 'c/ juan marichal casa 77 los  rios', '849-846-3289', '', '26/10/22', 19),
(20, 'RAYMUNDO MAÑON', 'DE LA CRUZ', '00110244662', 'C/SANTA LUCIA #36 LOS GUANDULES', '8294679981', '', '28/10/22', 19),
(21, 'MARTIRIS', 'FELIZ HENRIQUEZ', '12300147365', 'C/SANTA LUCIA #36 LOS GUANDULES', '8294679981', '', '28/10/22', 19),
(22, 'Laura', 'Encarnación', '40214445849', 'esadsad', '8294455432', 'maicol132603@gmail.com', '28/10/22', 17),
(23, 'JULIO CESAR', 'SANCHEZ AQUINO', '402-1502311-6', 'C/SANTA RITA #24 APT 2A BARRIO 27 DE FEBRERO', '829-785-0209', 'A@COM.COM', '28/10/22', 19),
(24, 'JULIO CESAR', 'MERCEDES RAMIREZ', '001-1652337-4', 'PROLONGACION VENEZUELA #22', '829-448-3369', '', '01/11/22', 19),
(25, 'Laura', 'Encarnación', '101-1114141-4', 'esadsa', '111-111-1111', '', '01/11/22', 17),
(26, 'Laura', 'Encarnación', '888-8888888-8', 'esadsad8', '8294455432', '', '01/11/22', 17),
(27, 'jose manuel', 'mieses ramirez', '402-2031889-9', 'central brisas de las palmeras casa 10', '829-390-3485', '', '01/11/22', 19),
(28, 'lenin vladimir', 'reyes perez', '018-0060515-4', 'c/4 casa 13 camboya barahona', '849-360-5275', '', '01/11/22', 19),
(29, 'john miguel', 'garcia ramirez', '402-2004058-4', 'av.5to centenario edif 31 apt 1c', '829-479-5577', '', '01/11/22', 19),
(30, 'jose gabriel', 'gerardo cleto', '001-1047188-5', 'romance casa 37 santa cruz', '829-328-1252', '', '07/11/22', 19),
(31, 'JOSE CARLOS', 'PEREZ JORGE', '402-2593485-6', 'CALLE DUARTE #5 MELLA', '809-358-4107', '', '09/11/22', 19),
(32, 'fraily', 'ureña valdes', '402-5268954-8', 'Av. 5to Centenario edif.27 apt 27A', '829-497-3663', '', '22/11/22', 19),
(33, 'robert', 'rosario medina', '402-4024722-7', 'c/orlando martinez #11 villa esfuerzo', '829-357-7683', '', '02/12/22', 19),
(34, 'HENRY DAVID', 'MANCEBO JAVIER', '001-1873062-1', 'C/MIGUEL ANGEL MONCLUS #227', '829-592-1992', 'LIC.MANCEBO14@GMAIL.COM', '21/12/22', 19),
(35, 'Aaa', 'AaAa', '111-1111111-1', 'Aqqq', '588-885-8058', 'mm@m.com', '30/12/22', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ensurance_company`
--

CREATE TABLE `ensurance_company` (
  `id` int(11) NOT NULL,
  `company` text COLLATE utf8_spanish_ci NOT NULL,
  `img_dir` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenaince`
--

CREATE TABLE `mantenaince` (
  `id` int(11) NOT NULL,
  `date_from` text COLLATE utf8_spanish_ci NOT NULL,
  `date_until` text COLLATE utf8_spanish_ci NOT NULL,
  `oil_type` text COLLATE utf8_spanish_ci NOT NULL,
  `oil_grade` text COLLATE utf8_spanish_ci NOT NULL,
  `car_id` int(11) NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mantenaince`
--

INSERT INTO `mantenaince` (`id`, `date_from`, `date_until`, `oil_type`, `oil_grade`, `car_id`, `cid`, `uid`) VALUES
(10, '01-11-2022', '23-11-2022', '', '', 27, '888-8888888-8', 17),
(11, '23-11-2022', '08-11-2022', '', '', 26, '101-1114141-4', 17),
(12, '12-11-2022', '12-01-2023', '', '', 18, '001-1732828-6', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `policy`
--

CREATE TABLE `policy` (
  `id` int(11) NOT NULL,
  `policynumber` text COLLATE utf8_spanish_ci NOT NULL,
  `type` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `totalAdditional` int(11) NOT NULL,
  `initial` int(11) NOT NULL DEFAULT 0,
  `payMethod` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `aditionalService` text COLLATE utf8_spanish_ci NOT NULL,
  `car_plate` text COLLATE utf8_spanish_ci NOT NULL,
  `date_from` text COLLATE utf8_spanish_ci NOT NULL,
  `date_until` text COLLATE utf8_spanish_ci NOT NULL,
  `date_diff` text COLLATE utf8_spanish_ci NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `policy`
--

INSERT INTO `policy` (`id`, `policynumber`, `type`, `value`, `totalAdditional`, `initial`, `payMethod`, `time`, `aditionalService`, `car_plate`, `date_from`, `date_until`, `date_diff`, `cid`, `uid`) VALUES
(40, '1-3132-222382', 0, 1508, 0, 0, 0, 0, '{}', '18', '03-09-2022', '03-09-2023', '', '001-1732828-6', 19),
(48, '1-3132-230252', 0, 1925, 0, 0, 0, 0, '{}', '23', '20-9-2022', '20-9-2023', '', '402-1502311-6', 19),
(60, '1-3132-251643', 0, 1925, 720, 0, 0, 0, '', '19', '27-10-2022', '27-10-2023', '', '402-2427462-7', 19),
(43, '3-3132-252759', 0, 400, 0, 0, 0, 0, '{\"5\":\"\"}', '20', '28-10-2022', '28-11-2023', '', '00110244662', 19),
(44, '3-3132-252877', 0, 400, 0, 0, 0, 0, '{\"5\":\"\"}', '21', '28-10-2022', '28-10-2023', '', '12300147365', 19),
(47, '3-3132-255296', 0, 1925, 0, 1000, 1, 1, '{}', '25', '01-11-2022', '01-11-2023', '', '001-1652337-4', 19),
(49, '14885-1515151515-2', 0, 25000, 3720, 10000, 1, 2, '{\"0\":\"Patria asistencia\",\"1\":\"Patria asistencia plus\",\"2\":\"Casa del conductor\"}', '27', '05-11-2022', '01-12-2023', '', '888-8888888-8', 17),
(50, '80193326', 0, 400, 0, 0, 0, 0, '{}', '28', '03-10-2022', '03-10-2023', '', '402-2031889-9', 19),
(51, '1-3132-238908', 0, 1189, 0, 0, 0, 0, '{}', '29', '05-10-2022', '05-10-2023', '', '018-0060515-4', 19),
(52, '177355', 0, 400, 0, 0, 0, 0, '{}', '30', '12-10-2022', '12-10-2023', '', '402-2004058-4', 19),
(53, '1-20968336-1', 0, 400, 0, 0, 0, 0, '{}', '31', '07-11-2022', '07-11-2023', '', '001-1047188-5', 19),
(54, '3-3132-260629', 0, 1925, 0, 1000, 1, 1, '{\"0\":\"\"}', '32', '09-11-2022', '09-12-2022', '', '402-2593485-6', 19),
(55, '3-3132-268567', 0, 400, 0, 0, 0, 0, '{}', '33', '22-11-2022', '22-11-2023', '', '402-5268954-8', 19),
(57, '14885-1515151515-213', 2, 1925, 0, 1000, 1, 1, '{}', '26', '01-12-2022', '01-01-2023', '', '101-1114141-4', 17),
(58, '3-3132-276042', 0, 1925, 0, 1000, 1, 1, '{}', '34', '02-12-2022', '02-01-2023', '', '402-4024722-7', 19),
(59, '1-3132-292868', 0, 1925, 0, 2000, 1, 1, '{}', '35', '21-12-2022', '21-01-2023', '', '001-1873062-1', 19);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `policy_dues`
--

CREATE TABLE `policy_dues` (
  `id` int(11) NOT NULL,
  `policynumber` text COLLATE utf8_spanish_ci NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `due` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `validity` text COLLATE utf8_spanish_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `policy_dues`
--

INSERT INTO `policy_dues` (`id`, `policynumber`, `cid`, `due`, `paid`, `validity`, `amount`, `uid`) VALUES
(39, '14885-1515151515-2', '1004113171', 2, 0, '25-12-2022', 12500, 17),
(35, '14885-1515151515-3', '11454582455', 1, 1, '21-11-2022', 25000, 17),
(36, '14885-1515151515-3', '1004113171', 1, 1, '22-11-2022', 12500, 17),
(37, '14885-1515151515-3', '1004113171', 2, 1, '22-12-2022', 12500, 17),
(38, '14885-1515151515-2', '1004113171', 1, 0, '25-11-2022', 12500, 17),
(40, '14885-1515151515-2', '40214445849', 1, 1, '30-11-2022', 12500, 17),
(41, '14885-1515151515-2', '40214445849', 2, 1, '30-12-2022', 12500, 17),
(42, '177360', '001-1652337-4', 1, 0, '01-12-2022', 1925, 19),
(43, '14885-1515151515-2', '888-8888888-8', 2, 1, '03-02-2023', 9360, 17),
(44, '177362', '402-2593485-6', 1, 0, '09-12-2022', 1925, 19),
(45, '3-3132-260629', '402-2593485-6', 1, 0, '09-12-2022', 1925, 19),
(46, '3-3132-255296', '001-1652337-4', 1, 1, '30-12-2022', 1925, 19),
(47, '3-3132-255296', '001-1652337-4', 1, 0, '01-01-2023', 1925, 19),
(48, '14885-1515151515-2', '888-8888888-8', 2, 1, '03-02-2023', 9360, 17),
(49, '14885-1515151515-2', '888-8888888-8', 2, 1, '03-02-2023', 9360, 17),
(50, '14885-1515151515-256', '101-1114141-4', 1, 0, '01-01-2023', 1925, 17),
(51, '14885-1515151515-213', '101-1114141-4', 1, 0, '01-01-2023', 1925, 17),
(52, '177364', '402-4024722-7', 1, 1, '02-01-2023', 1925, 19),
(53, '177364', '402-4024722-7', 1, 0, '02-01-2023', 1925, 19),
(54, '3-3132-276042', '402-4024722-7', 1, 0, '02-01-2023', 1925, 19),
(55, '14885-1515151515-2', '888-8888888-8', 2, 0, '03-02-2023', 9360, 17),
(56, '14885-1515151515-2', '888-8888888-8', 2, 0, '03-02-2023', 9360, 17),
(57, '177365', '001-1873062-1', 1, 0, '21-01-2023', 1925, 19),
(58, '1-3132-292868', '001-1873062-1', 1, 0, '26-01-2023', 1925, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `template_pos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`template_pos`)),
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `template_pos`, `uid`) VALUES
(6, '{\"posX\": \"\", \"posY\": \"\"}', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` text COLLATE utf8_spanish_ci NOT NULL,
  `lname` text COLLATE utf8_spanish_ci NOT NULL,
  `company` text COLLATE utf8_spanish_ci NOT NULL,
  `company_logo` text COLLATE utf8_spanish_ci NOT NULL,
  `representant` text COLLATE utf8_spanish_ci NOT NULL,
  `address` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `ip` text COLLATE utf8_spanish_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `company`, `company_logo`, `representant`, `address`, `email`, `password`, `ip`, `status`) VALUES
(17, 'Michael', 'Encarnacion', 'Seguros Patria, S. A.', 'patria.png', '41a1', 'Enriquillo', 'michaelenc.personal@gmail.com', '$2y$10$3aSN0i.SYoatYAcChCXRA.bLvd3sDRhWxSI0IOSoAq0M9c8H2qJ4.', '', 1),
(18, 'Michael', 'Encarnación', 'Atlántica Seguros, S.A.', 'atlantica.png', 'A002', 'Enriquillo', 'maicol132603@gmail.com', '$2y$10$Dxxod5c25mVm1DaZz8HpxuY.J8Sg3nv21IlH4kgXH/SUJbYtJo1ha', '', 1),
(19, 'Antonifel', 'Pimentel', 'Seguros Patria, S. A.', 'patria.png', 'A2209', 'Av. 5to Centenario edif.31 Local 5A', 'apm.system@gmail.com', '$2y$10$Bn3xRgAbX2HUVvO7Jlwx9enUbsph/ZaC/sk801GlSCWZHF6fLQBf2', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `type` text COLLATE utf8_spanish_ci NOT NULL,
  `service` text COLLATE utf8_spanish_ci NOT NULL,
  `chassis` text COLLATE utf8_spanish_ci NOT NULL,
  `brand` text COLLATE utf8_spanish_ci NOT NULL,
  `model` text COLLATE utf8_spanish_ci NOT NULL,
  `year` text COLLATE utf8_spanish_ci NOT NULL,
  `ciliders` int(11) NOT NULL,
  `passengers` int(11) NOT NULL,
  `color` text COLLATE utf8_spanish_ci NOT NULL,
  `plate` text COLLATE utf8_spanish_ci NOT NULL,
  `ensured` tinyint(1) NOT NULL,
  `date` text COLLATE utf8_spanish_ci NOT NULL,
  `cid` text COLLATE utf8_spanish_ci NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`id`, `type`, `service`, `chassis`, `brand`, `model`, `year`, `ciliders`, `passengers`, `color`, `plate`, `ensured`, `date`, `cid`, `uid`) VALUES
(26, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'HONDA', 'CIVIC', '2020', 4, 5, 'BLANCO', 'TRANSITO', 1, '01/11/22', '101-1114141-4', 17),
(10, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s4112', 'TOYOTA', 'VITZ', '2016', 4, 5, 'BLANCO', 'A011243', 0, '10/10/22', '11454582455', 17),
(11, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41s', 'HONDA', 'CIVIC', '2020', 4, 5, 'NEGRO', 'A011224', 1, '10/10/22', '774185256', 17),
(27, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'merecedes', 'benz', '2020', 4, 5, 'NEGRO', 'a00525', 1, '01/11/22', '888-8888888-8', 17),
(25, 'AUTOMOVIL', 'PRIVADO', '1NXAE09B5RZ119092', 'TOYOTA', 'COROLLA', '1994', 4, 5, 'DORADO', 'A134217', 1, '01/11/22', '001-1652337-4', 19),
(17, 'AUTOMOVIL', 'PRIVADO', 'asdasd111sd', 'HONDA', 'CIVIC', '2020', 4, 5, 'NEGRO', 'A011226', 1, '19/10/22', '11456a1d6s1ad6', 17),
(18, 'MOTOCICLETA', 'PRIVADO', 'JYAJ16E99A015399', 'YAMAHA', 'R600', '2009', 4, 1, 'AZUL', 'K0212006', 1, '26/10/22', '001-1732828-6', 19),
(24, 'AUTOMOVIL', 'PRIVADO', 'A1140024554s41', 'HONDA', 'CIVIC', '2020', 4, 5, 'NEGRO', 'a002', 0, '31/10/22', '40214445849', 17),
(19, 'AUTOMOVIL', 'PRIVADO', 'KMHEU41MBBA812841', 'HYUNDAI', 'SONATA N20', '2011', 4, 5, 'GRIS', 'A745428', 1, '26/10/22', '402-2427462-7', 19),
(20, 'MOTOCICLETA', 'PRIVADO', 'LTMKD119XM5100572', 'HONDA', 'XRISOL', '2020', 1, 2, 'BLANCA', 'K2041761', 1, '28/10/22', '00110244662', 19),
(21, 'MOTOCICLETA', 'PRIVADO', 'LFFWHV6D4M1900057', 'GATO', 'LEAD 150', '2021', 1, 2, 'BLANCA', 'k2190924', 1, '28/10/22', '12300147365', 19),
(22, 'AUTOMOVIL', 'march', 'k13', 'NISSAN', 'MARCH', '2016', 3, 5, 'blanco', 'a929516', 0, '28/10/22', '40214445849', 17),
(23, 'AUTOMOVIL', 'PRIVADO', 'KNDJP3A5XF7183418', 'KIA', 'SOUL', '2015', 4, 5, 'GRIS', 'A970980', 1, '28/10/22', '402-1502311-6', 19),
(28, 'MOTOCICLETA', 'PRIVADO', 'lz3jlx12th109183', 'sucaty', 'sg150', '2017', 1, 2, 'negro', 'lk1849273', 1, '01/11/22', '402-2031889-9', 19),
(29, 'MOTOCICLETA', 'PRIVADO', 'js1gn7ea682107882', 'suzuki', 'r600', '2008', 4, 2, 'negro', 'k0212009', 1, '01/11/22', '018-0060515-4', 19),
(30, 'MOTOCICLETA', 'PRIVADO', 'md2a76ax3mwg48236', 'bajaj', 'platina 100', '2020', 1, 2, 'negro', 'k2047869', 1, '01/11/22', '402-2004058-4', 19),
(31, 'MOTOCICLETA', 'PRIVADO', 'lappcjlj14f409158', 'bm', 'super ax ', '2004', 1, 2, 'rojo', 'k0358231', 1, '07/11/22', '001-1047188-5', 19),
(32, 'AUTOMOVIL', 'PRIVADO', 'KMHEU41MBAA784501', 'HYUNDAI', 'SONATA N20', '2010', 4, 5, 'BLANCO', 'A682994', 1, '09/11/22', '402-2593485-6', 19),
(33, 'MOTOCICLETA', 'PRIVADO', 'tarpck506nc001078', 'tauro', 'cg-150', '2022', 1, 2, 'rojo', 'tramite', 1, '22/11/22', '402-5268954-8', 19),
(34, 'AUTOMOVIL', 'PRIVADO', 'bg1032146187', 'mazda', '323', '1994', 4, 5, 'dorado', 'a280365', 1, '02/12/22', '402-4024722-7', 19),
(35, 'AUTOMOVIL', 'PRIVADO', '1FADP3K21DL186459', 'FORD', 'FOCUS SE', '2013', 4, 5, 'GRIS', 'A830724', 1, '21/12/22', '001-1873062-1', 19),
(36, 'Aa', 'Aa', 'Aa', 'Aa', 'Aa', 'Aa', 0, 0, 'Aa', 'Ss', 0, '30/12/22', '111-1111111-1', 17);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aditionalservice`
--
ALTER TABLE `aditionalservice`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cid` (`cid`(15),`email`(50)) USING BTREE;

--
-- Indices de la tabla `ensurance_company`
--
ALTER TABLE `ensurance_company`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mantenaince`
--
ALTER TABLE `mantenaince`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `policy` (`policynumber`(35),`car_plate`(20)) USING BTREE;

--
-- Indices de la tabla `policy_additional_services`
--
ALTER TABLE `policy_additional_services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `policy_dues`
--
ALTER TABLE `policy_dues`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plate` (`plate`(15));

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aditionalservice`
--
ALTER TABLE `aditionalservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT de la tabla `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `ensurance_company`
--
ALTER TABLE `ensurance_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenaince`
--
ALTER TABLE `mantenaince`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `policy`
--
ALTER TABLE `policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `policy_additional_services`
--
ALTER TABLE `policy_additional_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `policy_dues`
--
ALTER TABLE `policy_dues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
