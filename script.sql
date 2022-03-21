-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2022 at 08:37 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schedule_control_system`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `sp_getPayments`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getPayments` (IN `id` INT)  BEGIN
    SELECT idPagos, idUsuario, tp.idTipoPago as `idTipoPago`, tp.nombre as `tipopago`, fechaPago, monto, isss, renta, montoFinal
    FROM pagos p
    INNER JOIN tipopagos tp ON tp.idTipoPago = p.idTipoPago
    WHERE idUsuario = id;
END$$

DROP PROCEDURE IF EXISTS `sp_getUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getUser` (IN `id` INT)  BEGIN
		SELECT idUsuario, codigoUsuario, p.idPuesto as idPuesto, u.nombre as nombre, apellido, fechaNacimiento, email, teléfono, dui, pagoHoras, p.nombre as puesto, dui
        FROM usuarios u 
		INNER JOIN puestos p ON u.idPuesto = p.idPuesto
        WHERE idUsuario = id;
END$$

DROP PROCEDURE IF EXISTS `sp_getUsers`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getUsers` ()  BEGIN
		SELECT idUsuario, codigoUsuario, p.idPuesto as idPuesto, u.nombre as nombre, apellido, fechaNacimiento, email, teléfono, dui, pagoHoras, p.nombre as puesto, dui
        FROM usuarios u 
		INNER JOIN puestos p ON u.idPuesto = p.idPuesto;
END$$

DROP PROCEDURE IF EXISTS `sp_login`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login` (IN `codeU` VARCHAR(50), IN `emailU` VARCHAR(50), IN `password` VARCHAR(25))  BEGIN
	SELECT idUsuario, codigoUsuario, p.idPuesto as idPuesto, u.nombre as nombre, apellido, fechaNacimiento, email, teléfono, dui, pagoHoras, p.nombre as puesto, dui
    FROM usuarios u
    INNER JOIN puestos p ON u.idPuesto = p.idPuesto
    WHERE (codigoUsuario = codeU OR email = emailU) AND contraseña = AES_ENCRYPT(password,"schedule_control_system");
END$$

DROP PROCEDURE IF EXISTS `sp_getSchedule`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getSchedule` (IN `day` VARCHAR(1))  BEGIN
	SELECT * FROM horarios WHERE dia LIKE concat('%',day,'%');
END$$

DROP PROCEDURE IF EXISTS `sp_signIn`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_signIn` (IN `code` varchar(50), IN `password` VARCHAR(25))  BEGIN
	UPDATE usuarios SET contraseña = AES_ENCRYPT(password,"schedule_control_system") WHERE codigoUsuario = code AND contraseña = '';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `asistencias`
--

DROP TABLE IF EXISTS `asistencias`;
CREATE TABLE IF NOT EXISTS `asistencias` (
  `idAsistencia` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imagen` varchar(10000) NOT NULL,
  PRIMARY KEY (`idAsistencia`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asistencias`
--

INSERT INTO `asistencias` (`idAsistencia`, `idUsuario`, `fecha`, `imagen`) VALUES
(2, 2, '2022-03-21 14:35:14', 'E00001 6238e182c6454.png');

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
CREATE TABLE IF NOT EXISTS `horarios` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `dia` varchar(25) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFinal` time NOT NULL,
  PRIMARY KEY (`idHorario`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`idHorario`, `nombre`, `dia`, `horaInicio`, `horaFinal`) VALUES
(1, 'Inicio Labores', '1,2,3,4,5,6', '07:00:00', '16:00:00'),
(2, 'Descanso (20 min)', '1,2,3,4,5,6', '10:00:00', '10:20:00'),
(3, 'Almuerzo', '1,2,3', '12:00:00', '13:00:00'),
(4, 'Finalización de labores', '1,2,3', '16:00:00', '16:00:00'),
(4, 'Finalización de labores', '4,5,6', '12:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `idPagos` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idTipoPago` int(11) NOT NULL,
  `fechaPago` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `monto` decimal(10,2) NOT NULL,
  `isss` decimal(10,2) NOT NULL,
  `renta` decimal(10,2) NOT NULL,
  `montoFinal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idPagos`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idTipoPago` (`idTipoPago`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`idPagos`, `idUsuario`, `idTipoPago`, `fechaPago`, `monto`, `isss`, `renta`, `montoFinal`) VALUES
(1, 2, 4, '2022-03-21 14:22:50', '400.00', '20.00', '40.00', '340.00');

-- --------------------------------------------------------

--
-- Table structure for table `puestos`
--

DROP TABLE IF EXISTS `puestos`;
CREATE TABLE IF NOT EXISTS `puestos` (
  `idPuesto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idPuesto`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `puestos`
--

INSERT INTO `puestos` (`idPuesto`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Es un administrador del sistema'),
(2, 'Director de Marketing', NULL),
(3, 'Analista Big Data', NULL),
(4, 'Analista Programador', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipopagos`
--

DROP TABLE IF EXISTS `tipopagos`;
CREATE TABLE IF NOT EXISTS `tipopagos` (
  `idTipoPago` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idTipoPago`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipopagos`
--

INSERT INTO `tipopagos` (`idTipoPago`, `nombre`) VALUES
(4, 'Mensual'),
(3, 'Quincenal');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `codigoUsuario` char(6) DEFAULT NULL,
  `idPuesto` char(3) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fechaNacimiento` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(25) NOT NULL,
  `teléfono` char(10) DEFAULT NULL,
  `dui` char(10) DEFAULT NULL,
  `pagoHoras` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `idPuesto` (`idPuesto`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `codigoUsuario`, `idPuesto`, `nombre`, `apellido`, `fechaNacimiento`, `email`, `contraseña`, `teléfono`, `dui`, `pagoHoras`) VALUES
(1, 'E00000', '1', 'super', 'admin', '2022-03-19 16:01:49', 'sa@gmail.com', 'àÿÝL=?O£$­vDµ', NULL, NULL, NULL),
(2, 'E00001', '2', 'Juan Carlos', 'Almería', '1992-02-15 10:13:18', 'juan@gmail.com', 'Q
[þ©<³§¶¿OñÐ/', '7777-8888', '060108266', '5.00'),
(3, 'E00002', '3', 'Naomi', 'Guardado Iglesias', '1992-03-15 10:13:18', 'naomi@gmail.com', 'ÖåçµÆZ¢5½þwb‘è•
', '2222-3333', '060108267', '6.78'),
(4, 'E00003', '4', 'Katherine', 'Mejía', '1992-04-15 10:13:18', 'katherine@gmail.com', '2BëÙQc8;JÞ`Ê\\‹O', '7898-2314', '060108268', '4.50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
