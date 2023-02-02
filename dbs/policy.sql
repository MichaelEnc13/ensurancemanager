-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-12-2022 a las 01:33:24
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
(42, ' 1-3132-251643', 0, 1925, 720, 0, 0, 0, '{\"5\":\"Patria grua por accidente\"}', '19', '27-10-2022', '27-10-2023', '', '402-2427462-7', 19),
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `policy` (`policynumber`(35),`car_plate`(20)) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `policy`
--
ALTER TABLE `policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
