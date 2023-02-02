-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-12-2022 a las 01:33:08
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cid` (`cid`(15),`email`(50)) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
