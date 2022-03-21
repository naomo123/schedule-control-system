 CREATE DATABASE schedule_control_system;
 USE schedule_control_system;
 
 CREATE TABLE Puestos
 (
     idPuesto int PRIMARY KEY NOT NULL AUTO_INCREMENT,
     nombre varchar(25) NOT NULL,
     descripcion varchar(200)
 );

CREATE TABLE Usuarios 
(
    idUsuario int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    codigoUsuario char(6),
    idPuesto char(3) NOT NULL,
    nombre varchar(50) NOT NULL,
    apellido varchar(50) NOT NULL,
    fechaNacimiento datetime NOT NULL,
    email varchar(50) NOT NULL,
    contraseña varchar(25) NOT NULL,
    teléfono char(10),
    dui char(10),
    pagoHoras decimal(10,2),
    FOREIGN KEY (idPuesto) REFERENCES Puestos (idPuesto)
 );

 CREATE TABLE Asistencias
 (
     idAsistencia int PRIMARY KEY NOT NULL AUTO_INCREMENT,
     idUsuario int NOT NULL,
     fecha dateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
     imagen varchar(10000) NOT NULL,
     FOREIGN KEY (idUsuario) REFERENCES Usuarios (idUsuario)
 );

 CREATE TABLE Horarios(
     idHorario int PRIMARY KEY NOT NULL AUTO_INCREMENT,
     nombre varchar(25) NOT NULL,
     dia varchar(25) NOT NULL,
     horaInicio time NOT NULL,
     horaFinal time NOT NULL
 );

  CREATE TABLE tipoPagos
 (
     idTipoPago int PRIMARY KEY NOT NULL AUTO_INCREMENT,
     nombre varchar(25)
 );
 
 CREATE TABLE Pagos
 (
     idPagos int PRIMARY KEY NOT NULL AUTO_INCREMENT,
     idUsuario int NOT NULL,
     idTipoPago int NOT NULL,
     fechaPago date NOT NULL,
     monto decimal NOT NULL,
     isss decimal NOT NULL,
     renta decimal not null,
     montoFinal decimal NOT NULL,

     FOREIGN KEY (idUsuario) REFERENCES Usuarios (idUsuario),
     FOREIGN KEY (idTipoPago) REFERENCES tipoPagos (idTipoPago)
 );

DELIMITER //

CREATE PROCEDURE sp_login(IN codeU varchar(50), IN emailU varchar(50), IN password varchar(25))
BEGIN
	SELECT idUsuario, codigoUsuario, p.idPuesto as idPuesto, u.nombre as nombre, apellido, fechaNacimiento, email, teléfono, dui, pagoHoras, p.nombre as puesto, dui
    FROM usuarios u
    INNER JOIN puestos p ON u.idPuesto = p.idPuesto
    WHERE (codigoUsuario = codeU OR email = emailU) AND contraseña = AES_ENCRYPT(password,"schedule_control_system");
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_getUsers()
BEGIN
		SELECT idUsuario, codigoUsuario, p.idPuesto as idPuesto, u.nombre as nombre, apellido, fechaNacimiento, email, teléfono, dui, pagoHoras, p.nombre as puesto, dui
        FROM usuarios u 
		INNER JOIN puestos p ON u.idPuesto = p.idPuesto;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_getUser(IN id INT)
BEGIN
		SELECT idUsuario, codigoUsuario, p.idPuesto as idPuesto, u.nombre as nombre, apellido, fechaNacimiento, email, teléfono, dui, pagoHoras, p.nombre as puesto, dui
        FROM usuarios u 
		INNER JOIN puestos p ON u.idPuesto = p.idPuesto
        WHERE idUsuario = id;
END //

DELIMITER ;