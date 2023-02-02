-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-12-2022 a las 01:33:50
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
-- Indices de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plate` (`plate`(15));

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
