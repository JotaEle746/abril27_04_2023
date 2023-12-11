-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para dbprueba
CREATE DATABASE IF NOT EXISTS `dbprueba` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dbprueba`;

-- Volcando estructura para tabla dbprueba.colegiadosni
CREATE TABLE IF NOT EXISTS `colegiadosni` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cip` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `paterno` varchar(30) NOT NULL,
  `materno` varchar(30) NOT NULL,
  `phone` varchar(9) DEFAULT NULL,
  `capitulo` varchar(30) NOT NULL,
  `especialidad` varchar(30) NOT NULL,
  `fechaultimopago` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla dbprueba.colegiadosni: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `colegiadosni` DISABLE KEYS */;
INSERT INTO `colegiadosni` (`id`, `dni`, `cip`, `name`, `paterno`, `materno`, `phone`, `capitulo`, `especialidad`, `fechaultimopago`) VALUES
	(1, '84567431', '174567', 'CARLOS', 'VELASQUEZ', 'MAMANI', '945678432', 'CIVILES', 'CIVIL', '2022-12-31'),
	(2, '74567372', '1284588', 'ANDRES', 'MARTINEZ', 'MAMANI', '955844854', 'SISTEMAS', 'SISTEMAS', '2023-05-31'),
	(3, '43466655', '3443', 'MATIAS', 'JIMENEZ', 'CONDORI', '933448848', 'ECONOMISTAS', 'ECONOMIA', '2022-12-13'),
	(4, '34343222', NULL, 'ANDREA', 'CONDORI', 'MAYHUA', '934443333', 'PESQUEROS', 'PESQUEROS', '2022-12-13');
/*!40000 ALTER TABLE `colegiadosni` ENABLE KEYS */;

-- Volcando estructura para tabla dbprueba.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cip` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `capitulo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `especialidad` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `f_ultimomespago` date DEFAULT NULL,
  `situacion` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `joined` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lugar_entrega` varchar(20) DEFAULT NULL,
  `fechahora_entrega` datetime DEFAULT NULL,
  `id_user` int NOT NULL,
  `special_case` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `id_user_entrega` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla dbprueba.employees: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `dni`, `cip`, `name`, `surname`, `phone`, `capitulo`, `especialidad`, `f_ultimomespago`, `situacion`, `joined`, `lugar_entrega`, `fechahora_entrega`, `id_user`, `special_case`, `id_user_entrega`) VALUES
	(1, '72471491', '174386', 'JULIO ELIAS', 'MAMANI LÓPEZ', '996627919', 'MECANICOS_Y_ELECTRICISTAS', 'ENERGÍAS RENOVABLES', NULL, '1', ' 09 Dec 2022 ', NULL, NULL, 1, '', NULL),
	(6, '75480778', '12134', 'CARLOS', 'MARTINEZ', '951654321', 'MINAS', 'SEGURIDAD Y GESTIÓN MINERA', NULL, '1', ' 09 Dec 2022 ', 'PUNO', '2022-12-09 21:23:29', 1, '', NULL),
	(7, '45013123', '', 'BRENDA', 'VELASQUEZ', '953432145', 'AMBIENTAL_Y_FORESTAL', 'AMBIENTAL Y FORESTAL', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:30:19', 1, '', NULL),
	(8, '46500615', '3343434', 'USERTESTNAME', 'MAMANI LOPEZ', '955342231', 'AGRICOLAS', 'AGRÍCOLA', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:29:48', 1, '', NULL),
	(9, '34465755', '3434', 'ANDY', 'MARTINEZ', '944543343', 'CIVILES', 'CIVIL', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:29:29', 1, '', NULL),
	(10, '71621160', '', 'ANDRES', 'CARI', '944343434', 'AGROINDUSTRIALES', 'AGROINDUSTRIAL', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:35:19', 20, '', NULL),
	(11, '38483478', '21222', 'LUIS', 'CAYMA', '933434322', 'ECONOMISTAS', 'ECONOMÍA', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:38:30', 20, '', NULL),
	(12, '58475845', '', 'KEVIN', 'SANCHEZ', '934343222', 'GEOLOGOS', 'GEÓLOGOS', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:41:26', 20, '', NULL),
	(13, '44549584', '', 'KATY', 'JARA', '944343434', 'NINGUNO', 'NINGUNO', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:44:02', 20, '', NULL),
	(14, '34343493', '12121', 'EDY', 'ARPASI', '933434343', 'AMBIENTAL_Y_FORESTAL', 'AMBIENTAL Y FORESTAL', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:44:12', 20, '', NULL),
	(15, '38239239', '2929239', 'ADSKFJFLJK', 'SKDJSKDJK', '093493493', 'SISTEMAS', 'EMPRESARIAL E INFORMATICA', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:48:32', 20, '', NULL),
	(16, '34435849', '3493849', 'KSDFLDSJF', 'KDFLDSF', '030493493', 'METALURGISTAS', 'METALURGISTA', NULL, '1', ' 09 Dec 2022 ', 'JULIACA', '2022-12-09 16:52:17', 20, '', NULL),
	(17, '30493498', '23234', 'DLDLFDLF', 'DLFDF', '033049349', 'NINGUNO', 'NINGUNO', NULL, '1', ' 09 Dec 2022 ', 'PUNO', '2022-12-12 10:15:33', 20, '', NULL),
	(18, '84567431', '174567', 'CARLOS', 'VELASQUEZ', '945678432', 'SISTEMAS', 'NINGUNO', NULL, '1', ' 12 Dec 2022 ', 'PUNO', '2022-12-12 11:37:55', 1, '', NULL),
	(19, '38743748', '2932932', 'ALBERTO', 'BOLUARTE', '933434322', 'MINAS', 'SEGURIDAD Y GESTIÓN MINERA', NULL, '1', '13 Dec 2022', 'PUNO', '2022-12-13 09:57:51', 1, NULL, NULL),
	(20, '74567372', '1284588', 'ANDRES', 'MARTINEZ', '955844854', 'SISTEMAS', 'SISTEMAS', NULL, '1', '13 Dec 2022', 'PUNO', '2022-12-13 10:22:43', 1, NULL, NULL),
	(21, '87485645', '837232', 'JULIO', 'HUAMAN', '934933434', 'NINGUNO', 'NINGUNO', NULL, '1', '13 Dec 2022', 'PUNO', '2022-12-13 10:47:56', 1, NULL, NULL),
	(22, '22232222', '', 'ESTEBAN', 'VARGAS', '934344848', 'SISTEMAS', 'SISTEMAS', NULL, '1', '13 Dec 2022', 'PUNO', '2022-12-13 10:47:36', 1, NULL, NULL),
	(23, '38473874', '2321', 'MANUEL', 'ORTEGA', '934343422', 'MECANICOS_Y_ELECTRICISTAS', 'MECÁNICO ELECTRICISTA', NULL, '1', '13 Dec 2022', 'PUNO', '2022-12-13 10:47:45', 1, NULL, NULL),
	(24, '43466655', '3443', 'MATIAS', 'JIMENEZ', '933448848', 'ECONOMISTAS', 'ECONOMIA', NULL, '1', '13 Dec 2022', 'PUNO', '2022-12-13 10:47:18', 1, NULL, NULL),
	(25, '34343222', '', 'ANDREA', 'CONDORI', '934443333', 'PESQUEROS', 'PESQUEROS', NULL, '1', '13 Dec 2022', 'PUNO', '2022-12-13 10:47:28', 1, NULL, NULL),
	(26, '49394394', '2232', 'ANDERSON', 'MARIA', '923923828', 'MINAS', 'SEGURIDAD Y GESTIÓN MINERA', '2022-12-13', '1', '13 Dec 2022', 'JULIACA', '2022-12-13 15:21:36', 1, NULL, 21),
	(27, '22736263', '232323', 'ESTEBAN', 'COAQUIRA', '939349349', 'AMBIENTAL_Y_FORESTAL', 'FORESTAL', NULL, '1', '13 Dec 2022', 'PUNO', '2022-12-13 15:17:41', 1, NULL, 1),
	(28, '88488458', '23223', 'CARLA', 'MAMANI', '939383483', 'METALURGISTAS', 'METALURGISTA', NULL, '1', '13 Dec 2022', 'JULIACA', '2022-12-13 15:18:50', 1, NULL, 20);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Volcando estructura para tabla dbprueba.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `joined` varchar(30) NOT NULL,
  `permission` varchar(10) NOT NULL,
  `type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'user',
  `gender` varchar(1) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `lugar_entrega` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla dbprueba.users: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `surname`, `username`, `password`, `joined`, `permission`, `type`, `gender`, `phone`, `lugar_entrega`) VALUES
	(1, 'JULIO ELIAS', 'MAMANI LOPEZ', 'julioml', '827ccb0eea8a706c4c34a16891f84e7b', '09 Dec 2022', '1', 'user', 'M', '996627919', 'PUNO'),
	(20, 'TESTNAMEe', 'TESTLASTNAME', 'user', '827ccb0eea8a706c4c34a16891f84e7b', '09 Dec 2022', '2', 'user', 'M', '984567432', 'JULIACA'),
	(21, 'BRENDA', 'VELASQUEZ', 'brenda', '827ccb0eea8a706c4c34a16891f84e7b', '12 Dec 2022', '2', 'user', 'F', '956643455', 'JULIACA'),
	(22, 'ESTER', 'VARGAS', 'ester', '827ccb0eea8a706c4c34a16891f84e7b', '13 Dec 2022', '2', 'user', 'F', '934005320', 'JULIACA');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
