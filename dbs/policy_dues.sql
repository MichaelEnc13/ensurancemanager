-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-12-2022 a las 01:36:30
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `policy_dues`
--
ALTER TABLE `policy_dues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `policy_dues`
--
ALTER TABLE `policy_dues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
