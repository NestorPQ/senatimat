USE senatimat;

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_listar()
BEGIN
	SELECT	EST.idestudiante,
				EST.apellidos, EST.nombres,
				EST.tipodocumento, EST.nrodocumento,
				EST.fechanacimiento,
				ESC.escuela,
				CAR.carrera,
				SED.sede,
				EST.fotografia
		FROM estudiantes EST
		INNER JOIN carreras CAR ON CAR.idcarrera = EST.idcarrera
		INNER JOIN sedes SED ON SED.idsede = EST.idsede
		INNER JOIN escuelas ESC ON ESC.idescuela = CAR.idescuela
		WHERE EST.estado = '1';
END $$


DELIMITER $$
CREATE PROCEDURE spu_estudiantes_registrar
(
	IN _apellidos 			VARCHAR(40),
	IN _nombres 			VARCHAR(40),
	IN _tipodocumento		CHAR(1),
	IN _nrodocumento		CHAR(8),
	IN _fechanacimiento	DATE,
	IN _idcarrera 			INT,
	IN _idsede 				INT,
	IN _fotografia 		VARCHAR(100)
)
BEGIN
	-- Validar el contenido de _fotografia
	IF _fotografia = '' THEN 
		SET _fotografia = NULL;
	END IF;

	INSERT INTO estudiantes 
	(apellidos, nombres, tipodocumento, nrodocumento, fechanacimiento, idcarrera, idsede, fotografia) VALUES
	(_apellidos, _nombres, _tipodocumento, _nrodocumento, _fechanacimiento, _idcarrera, _idsede, _fotografia);
END $$

--  ELIMINAR ESTUDIANTE
DELIMITER $$
CREATE PROCEDURE spu_estudiante_eliminar(IN _idestudiante INT)
BEGIN
	UPDATE estudiantes
	SET estado = '0' 
	WHERE idestudiante = _idestudiante;
END $$

CALL spu_estudiante_eliminar(7);
SELECT * FROM estudiantes;

/*
CALL spu_estudiantes_registrar('Francia Minaya', 'Jhon', 'D', '12345678', '1984-09-20', 5, 1, '');
CALL spu_estudiantes_registrar('Munayco', 'José', 'D', '77779999', '1999-09-20', 3, 2, NULL);
CALL spu_estudiantes_registrar('Prada', 'Teresa', 'C', '01234567', '2002-09-25', 3, 2, '');
SELECT * FROM estudiantes;
*/
DELIMITER $$
CREATE PROCEDURE spu_cargos_listar()
BEGIN 
	SELECT * FROM cargos ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT * FROM sedes ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_escuelas_listar()
BEGIN 
	SELECT * FROM escuelas ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_carreras_listar(IN _idescuela INT)
BEGIN
	SELECT idcarrera, carrera 
		FROM carreras
		WHERE idescuela = _idescuela;
END $$

CALL spu_carreras_listar(3);
CALL spu_estudiantes_listar();

SELECT * FROM estudiantes;
SELECT * FROM carreras;
SELECT * FROM escuelas;
SELECT * FROM colaboradores;


CALL spu_cargos_listar();
CALL spu_sedes_listar();

UPDATE estudiantes
	SET fotografia = NULL
	WHERE fotografia = 'unafoto.jpg' OR
			fotografia = '';


--  ================================================================
--  PROCEDIMIENTOS ALMACENADO DE LA TABLA COLABORADORES

-- LISTAR COLABORADORES (consulta multitabla)
DELIMITER $$
CREATE PROCEDURE spu_colaboradores_listar()
BEGIN
	SELECT 
			COL.idcolaborador,
			COL.apellidos,
			COL.nombres,
			CAR.cargo,
			SED.sede,
			COL.telefono,
			COL.tipocontrato,
			COL.cv,
			COL.direccion,
			COL.fecharegistro,
			COL.estado
		FROM colaboradores COL
		INNER JOIN sedes SED ON SED.idsede = COL.idsede
		INNER JOIN cargos CAR ON CAR.idcargo = COL.idcargo
		WHERE COL.estado = '1';
END $$

CALL spu_colaboradores_listar();


-- REGISTRAR COLABORADORES
DELIMITER $$
CREATE PROCEDURE spu_colaboradores_registrar
(
	IN _apellidos			VARCHAR(30),
	IN _nombres 			VARCHAR(30),
	IN _idcargo				INT,
	IN _idsede				INT,
	IN _telefono			CHAR(9),
	IN _tipocontrato 		CHAR(1),
	IN _cv 					VARCHAR(100),
	IN _direccion 			VARCHAR(40)
)
BEGIN
	-- Validar el contenido de _fotografia
	IF _cv = '' THEN 
		SET _cv = NULL;
	END IF;

	INSERT INTO colaboradores 
	(apellidos, nombres, idcargo, idsede, telefono, tipocontrato, cv, direccion) VALUES
	(_apellidos, _nombres, _idcargo, _idsede, _telefono, _tipocontrato, _cv, _direccion);
END $$

CALL spu_colaboradores_registrar('Yataco Peña', 'Miguel Angel', 1, 1, '987654321', 'C', '', 'Calle  Senati');
CALL spu_colaboradores_registrar('Zarate Apolaya', 'Fiorela', 2, 3, '863254796', 'P', '', 'Calle  Lima');


--  ELIMINAR COLABORADORES
DELIMITER $$
CREATE PROCEDURE spu_colaborador_eliminar(IN _idcolaborador INT)
BEGIN
	UPDATE colaboradores 
	SET estado = '0' 
	WHERE idcolaborador = _idcolaborador;
END $$

CALL spu_colaborador_eliminar(13);


--  ACTUALIZAR COLABORADORES
-- recuperar id

DELIMITER $$
CREATE PROCEDURE spu_colaborador_recuperar_id(IN _idcolaborador INT)
BEGIN
	SELECT * FROM colaboradores WHERE idcolaborador = _idcolaborador;
END $$

CALL spu_colaborador_recuperar_id(3);


--  Actualizar
DELIMITER $$
CREATE PROCEDURE spu_colaborador_actualizar(
	IN _idcolaborador 	INT,
	IN _apellidos			VARCHAR(30),
	IN _nombres 			VARCHAR(30),
	IN _idcargo				INT,
	IN _idsede				INT,
	IN _telefono			CHAR(9),
	IN _tipocontrato 		CHAR(1),
	IN _cv 					VARCHAR(100),
	IN _direccion 			VARCHAR(40)
)
BEGIN
	UPDATE colaboradores SET
		apellidos = _apellidos,
		nombres = _nombres,
		idcargo = _idcargo,
		idsede = _idsede,
		telefono = _telefono,
		tipocontrato = _tipocontrato,
		cv = _cv,
		direccion = _direccion
	WHERE idcolaborador = _idcolaborador;
END $$



--  ================================================================
--  PROCEDIMIENTOS ALMACENADO DE LA TABLA USUARIOS

-- USUARIO LOGIN
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login
(
	IN _nombreusuario VARCHAR(30)
)
BEGIN
	SELECT	idusuario, nombreusuario, claveacceso,
				apellidos,nombres,nivelacceso
		FROM usuarios
		WHERE nombreusuario = _nombreusuario AND estado = '1';
END $$

CALL spu_usuarios_login("NESTOR");
SELECT * FROM usuarios;

-- REGISTRAR USUARIO
DELIMITER $$
CREATE PROCEDURE spu_usuarios_registrar
(
	IN _nombreusuario	VARCHAR(30),
	IN _nombres	VARCHAR(30),
	IN _apellidos	VARCHAR(30),
	IN _claveacceso	VARCHAR(90)		
)
BEGIN
	INSERT INTO usuarios (nombreusuario, nombres, apellidos, claveacceso) VALUES
		(_nombreusuario,_nombres, _apellidos, _claveacceso);
END $$

--  MOSTRAR USUARIO
-- (puede ser modificado, despues de borrarlo)
DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN
	SELECT	
		idusuario,
		nombreusuario,
		nombres,
		apellidos,
		claveacceso
		FROM usuarios
		WHERE estado = '1'
		ORDER BY idusuario DESC;
END $$

--  BORRAR USUARIOS
DELIMITER $$
CREATE PROCEDURE spu_usuarios_eliminar(IN _idusuario INT)
BEGIN
	UPDATE usuarios SET estado = '0' WHERE idusuario = _idusuario;
END $$

--  RECUPERAR ID
DELIMITER $$
CREATE PROCEDURE spu_usuarios_recuperar_id(IN _idusuario INT)
BEGIN 
	SELECT * FROM usuarios WHERE idusuario = _idusuario;
END $$

--  ACTUALIZAR USUARIOS

DELIMITER $$
CREATE PROCEDURE spu_usuarios_actualizar(
	IN _idusuario	INT,  --  necesita el id por actualizar
	IN _nombreusuario	VARCHAR(30),
	IN _nombres	VARCHAR(30),
	IN _apellidos	VARCHAR(30),
	IN _claveacceso	VARCHAR(90)	
)
BEGIN
	UPDATE usuarios SET
		nombreusuario = _nombreusuario,
		nombres = _nombres,
		apellidos = _apellidos,
		claveacceso = _claveacceso
		
	WHERE idusuario = _idusuario;
END $$

--  ===================================
CALL spu_colaboradores_listar()

UPDATE colaboradores SET estado = '1';

-- Ejemplo de inserción de datos adicionales en la tabla "colaboradores"

CALL spu_colaboradores_registrar('Ramírez Torres', 'Martín', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. Pedro Vilcapaza #305, Wanchaq');
CALL spu_colaboradores_registrar('González López', 'Carolina', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Calle San Martín #102, San Sebastián');
CALL spu_colaboradores_registrar('Pérez Sánchez', 'Ana María', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. Los Incas #503, Santiago');
CALL spu_colaboradores_registrar('Torres Castro', 'Luis', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Calle Mariscal Gamarra #208, San Jerónimo');
CALL spu_colaboradores_registrar('Sánchez Rodríguez', 'María', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. Pachacútec #701, Wanchaq');
CALL spu_colaboradores_registrar('López García', 'José', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. Los Álamos #401, San Jerónimo');
CALL spu_colaboradores_registrar('Gómez Vargas', 'Laura', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Calle Real #305, Santiago');
CALL spu_colaboradores_registrar('Castillo Ramírez', 'Andrés', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. Los Jazmines #201, Wanchaq');
CALL spu_colaboradores_registrar('González Castro', 'Sandra', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Calle Bolívar #503, San Sebastián');
CALL spu_colaboradores_registrar('Romero Salazar', 'Pedro', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Av. Los Pinos #102, Santiago');
CALL spu_colaboradores_registrar('Fernández Medina', 'Ana', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Calle Lima #208, San Jerónimo');
CALL spu_colaboradores_registrar('Ortega López', 'Jorge', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. La Paz #701, Wanchaq');
CALL spu_colaboradores_registrar('Soto Cruz', 'María', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Calle Arequipa #305, Santiago');
CALL spu_colaboradores_registrar('Pérez Mendoza', 'Carlos', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Jr. Wari N° 245, Urb. 16 de Abril, Huamanga');
CALL spu_colaboradores_registrar('García Ramos', 'Isabel', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Av. Grau N° 502, Urb. San Agustín, Cusco');
CALL spu_colaboradores_registrar('Luna Torres', 'Luis', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Calle Bolívar N° 203, Urb. La Merced, Trujillo');
CALL spu_colaboradores_registrar('Cruz Rojas', 'Mariana', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. Los Libertadores N° 150, Urb. Santa María, Lima');
CALL spu_colaboradores_registrar('Vargas Gómez', 'Pedro', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Calle Grau N° 305, Urb. San Juan, Arequipa');
CALL spu_colaboradores_registrar('Sánchez Torres', 'Laura', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Jr. Tacna N° 408, Urb. El Carmen, Chiclayo');
CALL spu_colaboradores_registrar('Romero Medina', 'Ana', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. Universitaria N° 701, Urb. Los Olivos, Lima');
CALL spu_colaboradores_registrar('González López', 'Javier', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Calle San Martín N° 405' );
CALL spu_colaboradores_registrar('Torres López', 'María', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Jr. Junín N° 302, Urb. Santa Rosa, Iquitos');
CALL spu_colaboradores_registrar('Rojas Pérez', 'Juan', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Av. Los Pinos N° 204, Urb. Las Casuarinas, Huancayo');
CALL spu_colaboradores_registrar('Gómez Sánchez', 'Carolina', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Calle Progreso N° 405, Urb. San Pedro, Trujillo');
CALL spu_colaboradores_registrar('Medina Romero', 'Luis', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. La Mar N° 601, Urb. Santa Isabel, Chiclayo');
CALL spu_colaboradores_registrar('López González', 'Ana', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Calle Los Ángeles N° 208, Urb. Los Jazmines, Arequipa');
CALL spu_colaboradores_registrar('Pérez Rojas', 'Pedro', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Jr. Los Alamos N° 305, Urb. San Agustín, Cusco');
CALL spu_colaboradores_registrar('Ramos García', 'Laura', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. Grau N° 503, Urb. El Bosque, Lima');
CALL spu_colaboradores_registrar('González López', 'Javier', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Calle San Martín N° 405, Urb. Las Palmeras, Piura');
CALL spu_colaboradores_registrar('Sánchez Gutiérrez', 'Luisa', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Av. Los Cedros N° 305, Urb. Las Orquídeas, Tarapoto');
CALL spu_colaboradores_registrar('Cruz Vargas', 'Carla', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Calle Las Palmas N° 402, Urb. San Juan, Chimbote');
CALL spu_colaboradores_registrar('Luna Paredes', 'Diego', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Jr. Los Pinos N° 208, Urb. Los Álamos, Huaraz');
CALL spu_colaboradores_registrar('Vega Rodríguez', 'Marcela', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Av. Los Olivos N° 601, Urb. Las Palmeras, Ayacucho');
CALL spu_colaboradores_registrar('Fernández Chávez', 'Gonzalo', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Calle Los Cerezos N° 305, Urb. Los Pinos, Tacna');
CALL spu_colaboradores_registrar('Mendoza Medina', 'Andrea', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'C', NULL, 'Av. La Paz N° 503, Urb. Santa Rosa, Ica');
CALL spu_colaboradores_registrar('Huamán Flores', 'Oscar', FLOOR(RAND() * 6) + 1, FLOOR(RAND() * 4) + 1, CAST((FLOOR(RAND() * 100000000) + 900000000) AS CHAR(9)), 'P', NULL, 'Calle Los Girasoles N° 405, Urb. Los Ángeles, Juliaca');

-- Registro de usuarios
CALL spu_usuarios_registrar('john.doe', 'John', 'Doe', '123456');
CALL spu_usuarios_registrar('alice.jones', 'Alice', 'Jones', 'qwerty');
CALL spu_usuarios_registrar('michael.smith', 'Michael', 'Smith', 'pass123');
CALL spu_usuarios_registrar('emily.wilson', 'Emily', 'Wilson', 'secret123');
CALL spu_usuarios_registrar('david.brown', 'David', 'Brown', 'password');
CALL spu_usuarios_registrar('sarah.thompson', 'Sarah', 'Thompson', 'abc123');
CALL spu_usuarios_registrar('james.miller', 'James', 'Miller', 'p@ssw0rd');
CALL spu_usuarios_registrar('linda.jackson', 'Linda', 'Jackson', 'ilovecats');
CALL spu_usuarios_registrar('robert.white', 'Robert', 'White', 'securepass');
CALL spu_usuarios_registrar('jennifer.davis', 'Jennifer', 'Davis', 'letmein123');
CALL spu_usuarios_registrar('matthew.anderson', 'Matthew', 'Anderson', 'hello123');
CALL spu_usuarios_registrar('amanda.harris', 'Amanda', 'Harris', 'welcome1');
CALL spu_usuarios_registrar('william.wilson', 'William', 'Wilson', 'test123');
CALL spu_usuarios_registrar('olivia.johnson', 'Olivia', 'Johnson', 'changeme');
CALL spu_usuarios_registrar('daniel.thomas', 'Daniel', 'Thomas', 'newpass123');
CALL spu_usuarios_registrar('sophia.davis', 'Sophia', 'Davis', 'secretpass');
CALL spu_usuarios_registrar('jackson.brown', 'Jackson', 'Brown', 'qwerty123');
CALL spu_usuarios_registrar('emma.wilson', 'Emma', 'Wilson', 'letmein');
CALL spu_usuarios_registrar('samuel.jones', 'Samuel', 'Jones', 'password1234');
CALL spu_usuarios_registrar('chloe.smith', 'Chloe', 'Smith', 'pass1234');
CALL spu_usuarios_registrar('Alan21', 'Alan Gabriel Ludwig', 'García Pérez', 'pass19{+2449');
CALL spu_usuarios_registrar('JaneSmith', 'Jane', 'Smith', 'S3cur3Pass!');
CALL spu_usuarios_registrar('CarlosGonzalez', 'Carlos', 'González', 'Passw0rd!');
CALL spu_usuarios_registrar('EmilyWong', 'Emily', 'Wong', 'StrongP@ssword');
CALL spu_usuarios_registrar('MohammedAli', 'Mohammed', 'Ali', 'Myp@ss123');
CALL spu_usuarios_registrar('SophieLefebvre', 'Sophie', 'Lefebvre', 'P@ssword123!');
CALL spu_usuarios_registrar('HiroshiTanaka', 'Hiroshi', 'Tanaka', 'T4nak@Pass');
CALL spu_usuarios_registrar('IsabellaMartinez', 'Isabella', 'Martínez', 'M@rtinez1!');
CALL spu_usuarios_registrar('AntonioRusso', 'Antonio', 'Russo', 'RussoPassw0rd');
CALL spu_usuarios_registrar('OliviaFischer', 'Olivia', 'Fischer', 'Fisch3rP@ss');
CALL spu_usuarios_registrar('LuisHernandez', 'Luis', 'Hernández', 'P@ssw0rd456');
CALL spu_usuarios_registrar('MiaMoreau', 'Mia', 'Moreau', 'MoreauP@ss!');
CALL spu_usuarios_registrar('RaviPatel', 'Ravi', 'Patel', 'P@t3lPassword');
CALL spu_usuarios_registrar('EmmaGarcia', 'Emma', 'García', 'G@rc1@Pass');
CALL spu_usuarios_registrar('AndreasMüller', 'Andreas', 'Müller', 'Müll3rPassw0rd');
CALL spu_usuarios_registrar('ChihiroSato', 'Chihiro', 'Sato', 'S@t0P@ss');
CALL spu_usuarios_registrar('AnastasiaKuznetsova', 'Anastasia', 'Kuznetsova', 'Kuzn3ts0va!');
CALL spu_usuarios_registrar('FelipeFernandez', 'Felipe', 'Fernández', 'Fern@nd3zPass');
CALL spu_usuarios_registrar('AlessiaRicci', 'Alessia', 'Ricci', 'R1cciP@ss');
CALL spu_usuarios_registrar('SebastianLopez', 'Sebastián', 'López', 'L0pezS3cur3');

CALL spu_usuarios_registrar('WilliamJohnson', 'William', 'Johnson', 'J0hnsonP@ss');
CALL spu_usuarios_registrar('SophiaLee', 'Sophia', 'Lee', 'L33P@ssword');
CALL spu_usuarios_registrar('RaphaelDubois', 'Raphael', 'Dubois', 'Dub0isP@ss');
CALL spu_usuarios_registrar('EmilySantos', 'Emily', 'Santos', 'S@ntosP@ssw0rd');
CALL spu_usuarios_registrar('LiamGarcia', 'Liam', 'García', 'G@rc1@P@ssw0rd');
CALL spu_usuarios_registrar('IsabellaRossi', 'Isabella', 'Rossi', 'R0ss1P@ssw0rd');
CALL spu_usuarios_registrar('DavidKumar', 'David', 'Kumar', 'Kum@rP@ssw0rd');
CALL spu_usuarios_registrar('AmeliaIvanova', 'Amelia', 'Ivanova', 'Iv@n0v@P@ss');
CALL spu_usuarios_registrar('AlexanderSmith', 'Alexander', 'Smith', 'SmithP@ssw0rd');
CALL spu_usuarios_registrar('MiaLópez', 'Mia', 'López', 'L0p3zP@ssw0rd');
CALL spu_usuarios_registrar('GabrielAndersen', 'Gabriel', 'Andersen', 'And3rsenP@ss');
CALL spu_usuarios_registrar('SofiaFernandez', 'Sofia', 'Fernández', 'Fern@nd3zP@ssw0rd');
CALL spu_usuarios_registrar('BenjaminNguyen', 'Benjamin', 'Nguyen', 'Nguy3nP@ss');
CALL spu_usuarios_registrar('CharlotteLam', 'Charlotte', 'Lam', 'L@mP@ssw0rd');
CALL spu_usuarios_registrar('LeoGonzález', 'Leo', 'González', 'G0nz@lezP@ss');
CALL spu_usuarios_registrar('AvaCheung', 'Ava', 'Cheung', 'Ch3ungP@ssword');
CALL spu_usuarios_registrar('LucasLefebvre', 'Lucas', 'Lefebvre', 'Lef3bvr3P@ss');
CALL spu_usuarios_registrar('EmmaMüller', 'Emma', 'Müller', 'Müll3rP@ssw0rd');
CALL spu_usuarios_registrar('NoahKawamura', 'Noah', 'Kawamura', 'K@w@mur@P@ss');
CALL spu_usuarios_registrar('OliviaLópez', 'Olivia', 'López', 'L0p3zS3cur3');