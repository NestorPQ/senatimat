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
CALL spu_cargos_listar();
SELECT * FROM estudiantes;
SELECT * FROM carreras;
SELECT * FROM escuelas;
SELECT * FROM colaboradores;
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

	INSERT INTO colaboradores `senatimat`
	(apellidos, nombres, idcargo, idsede, telefono, tipocontrato, cv, direccion) VALUES
	(_apellidos, _nombres, _idcargo, _idsede, _telefono, _tipocontrato, _cv, _direccion);
END $$

CALL spu_colaboradores_registrar('Yataco Peña', 'Miguel Angel', 1, 1, '987654321', 'C', '', 'Calle  Senati');
CALL spu_colaboradores_registrar('Zarate Apolaya', 'Fiorela', 2, 3, '863254796', 'P', '', 'Calle  Lima');


--  ELIMINAR COLABORADORES


--  ACTUALIZAR COLABORADORES
