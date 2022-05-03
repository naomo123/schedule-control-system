-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 03, 2022 at 05:24 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

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

DROP PROCEDURE IF EXISTS `sp_getPaymentsAll`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getPaymentsAll` ()  SELECT idPagos, u.idUsuario, CONCAT(u.nombre, ' ', u.apellido) as `usuario`, tp.idTipoPago as `idTipoPago`, tp.nombre as `tipopago`, fechaPago, monto, isss, renta, montoFinal
    FROM pagos p
    INNER JOIN tipopagos tp ON tp.idTipoPago = p.idTipoPago
    INNER JOIN usuarios u ON u.idUsuario = p.idUsuario$$

DROP PROCEDURE IF EXISTS `sp_getPositions`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getPositions` ()  SELECT * FROM puestos$$

DROP PROCEDURE IF EXISTS `sp_getSchedule`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getSchedule` (IN `day` VARCHAR(1))  BEGIN
	SELECT * FROM horarios WHERE dia LIKE concat('%',day,'%');
END$$

DROP PROCEDURE IF EXISTS `sp_getUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getUser` (IN `id` INT)  BEGIN
		SELECT idUsuario, codigoUsuario, p.idPuesto as idPuesto, u.nombre as nombre, apellido, fechaNacimiento, email, teléfono as telefono, dui, pagoHoras, p.nombre as puesto, dui
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

DROP PROCEDURE IF EXISTS `sp_setPayment`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_setPayment` (IN `idUsuarioIpt` INT, IN `idTipoPagoIpt` INT, IN `fechaPagoIpt` DATETIME, IN `montoIpt` DECIMAL(10,2), IN `isssIpt` DECIMAL(10,2), IN `rentaIpt` DECIMAL(10,2), IN `montoFinalIpt` DECIMAL(10,2))  INSERT INTO pagos(idUsuario, idTipoPago, fechaPago, monto, isss, renta, montoFinal)
	VALUES(idUsuarioIpt, idTipoPagoIpt, fechaPagoIpt, montoIpt, isssIpt, rentaIpt, montoFinalIpt)$$

DROP PROCEDURE IF EXISTS `sp_setSchedule`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_setSchedule` (IN `nombreIpt` VARCHAR(25), IN `horaInicioIpt` TIME, IN `horaFinIpt` TIME, IN `diasIpt` VARCHAR(25))  INSERT INTO horarios(nombre, horaInicio, horaFinal, dia)
	VALUES(nombreIpt,horaInicioIpt,horaFinIpt,diasIpt)$$

DROP PROCEDURE IF EXISTS `sp_setUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_setUser` (IN `codigoUsuarioIpt` CHAR(6), IN `idPuestoIpt` CHAR(3), IN `nombreIpt` VARCHAR(50), IN `apellidoIpt` VARCHAR(50), IN `fechaNacimientoIpt` DATETIME, IN `emailIpt` VARCHAR(50), IN `teléfonoIpt` CHAR(10), IN `duiIpt` CHAR(10), IN `pagoHorasIpt` DECIMAL(10,2))  INSERT INTO usuarios(codigoUsuario, idPuesto, nombre, apellido, fechaNacimiento, email, contraseña, teléfono, dui, pagoHoras) 
VALUES(codigoUsuarioIpt, idPuestoIpt, nombreIpt, apellidoIpt, fechaNacimientoIpt, emailIpt, "", teléfonoIpt, duiIpt, pagoHorasIpt)$$

DROP PROCEDURE IF EXISTS `sp_signIn`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_signIn` (IN `code` VARCHAR(50), IN `password` VARCHAR(25))  BEGIN
	UPDATE usuarios SET contraseña = AES_ENCRYPT(password,"schedule_control_system") WHERE codigoUsuario = code AND contraseña = '';
END$$

DROP PROCEDURE IF EXISTS `sp_updateSchedule`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateSchedule` (IN `idIpt` INT, IN `nombreIpt` VARCHAR(25), IN `horaInicioIpt` TIME, IN `horaFinIpt` TIME, IN `diasIpt` VARCHAR(25))  UPDATE horarios SET nombre = nombreIpt, horaInicio = horaInicioIpt, horaFinal = horaFinIpt, dia = diasIpt WHERE idHorario = idIpt$$

DROP PROCEDURE IF EXISTS `sp_updateUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateUser` (IN `idIpt` CHAR(6), IN `idPuestoIpt` CHAR(3), IN `nombreIpt` VARCHAR(50), IN `apellidoIpt` VARCHAR(50), IN `fechaNacimientoIpt` DATETIME, IN `teléfonoIpt` CHAR(10), IN `duiIpt` CHAR(10), IN `pagoHorasIpt` DECIMAL(10,2))  UPDATE usuarios SET idPuesto = idPuestoIpt, nombre = nombreIpt, apellido = apellidoIpt, fechaNacimiento = fechaNacimientoIpt, teléfono = teléfonoIpt, dui = duiIpt, pagoHoras = pagoHorasIpt WHERE codigoUsuario = idIpt$$

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asistencias`
--

INSERT INTO `asistencias` (`idAsistencia`, `idUsuario`, `fecha`, `imagen`) VALUES
(10, 3, '2022-05-03 11:22:18', 'E00002 627164ca25530.png');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`idHorario`, `nombre`, `dia`, `horaInicio`, `horaFinal`) VALUES
(1, 'Inicio Labores', '1,2,3,4,5,6', '07:00:00', '16:00:00'),
(2, 'Descanso (20 min)', '1,2,3,4,5,6', '10:00:00', '10:20:00'),
(3, 'Almuerzo', '1,2,3', '12:00:00', '13:00:00'),
(4, 'Finalizacion de labores', '1,2,3', '16:00:00', '16:00:00'),
(5, 'Finalizacion de labores', '4,5', '12:00:00', '12:00:00');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`idPagos`, `idUsuario`, `idTipoPago`, `fechaPago`, `monto`, `isss`, `renta`, `montoFinal`) VALUES
(1, 2, 4, '2022-03-21 14:22:50', '400.00', '20.00', '40.00', '340.00'),
(2, 2, 3, '2022-05-03 00:00:00', '400.00', '12.00', '12.00', '376.00');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `puestos`
--

INSERT INTO `puestos` (`idPuesto`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Hola'),
(2, 'Director de Marketing', NULL),
(3, 'Analista Big Data', NULL),
(4, 'Analista Programador', 'Este es un analista');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `codigoUsuario`, `idPuesto`, `nombre`, `apellido`, `fechaNacimiento`, `email`, `contraseña`, `teléfono`, `dui`, `pagoHoras`) VALUES
(1, 'E00000', '1', 'super', 'admin', '2022-03-19 16:01:49', 'sa@gmail.com', 'àÿÝL=?O£$­vDµ', NULL, NULL, NULL),
(2, 'E00001', '2', 'Juan Carlos', 'Almeria', '1992-02-15 00:00:00', 'juan@gmail.com', 'Q[þ©<³§¶¿OñÐ/', '7777-8888', '06010826-6', '5.00'),
(3, 'E00002', '3', 'Naomi', 'Guardado Iglesias', '1992-03-15 10:13:18', 'naomi@gmail.com', 'V„‘*êPÙÏl¨ ]ùûú', '2222-3333', '060108267', '6.78'),
(4, 'E00003', '4', 'Katherine', 'Mejia', '1992-04-15 00:00:00', 'katherine@gmail.com', '2BëÙQc8;JÞ`Ê\\‹O', '7898-2314', '06010826-8', '4.50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
